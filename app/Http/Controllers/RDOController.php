<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaseDetails;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use MongoDB\BSON\UTCDateTime;
use Illuminate\Support\Facades\Auth;


class RDOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("rdo.case-list");

    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }



    public function getCaseList(Request $request)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

            // Total records
            $totalRecord = CaseDetails::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = CaseDetails::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = CaseDetails::where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            $records = $items->skip($start)->take($rowperpage)->get();

            $data_arr = array();
            $i=$start;

            foreach($records as $record){
                $i++;
                $id = $record->id;
                $opposition_name = $record->opposition_name;
                $opposition_address =  $record->opposition_address;
                $case_details  =  $record->case_details;
                $case_id  =  $record->case_id;
                $status = $record->Rdo_status;
                $edit = '';

                if ($status == 1) {
                    $edit = '<a  href="' . route('ViewRdoCases', $id) . '" class="btn btn-primary edit-btn">view</a>&nbsp;&nbsp;<div class="badge bg-success">Approved</div>';
                } else if ($status == 2) {
                    $edit = '<a  href="' . route('ViewRdoCases', $id) . '" class="btn btn-primary edit-btn">view</a>&nbsp;&nbsp;<div class="badge bg-danger">Rejected</div>';
                } else if ($status == null) {
                    $edit = '<a  href="' . route('ViewRdoCases', $id) . '" class="btn btn-primary edit-btn">view</a>';
                }




                $data_arr[] = array(
                    "id" => $i,
                    "opposition_name" => $opposition_name,
                    "opposition_address" => $opposition_address,
                    "case_details" => $case_details,
                    "case_id"=>$case_id,
                    "edit" => $edit
                );
            }

            $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
            );

            return response()->json($response);
    }


    public function ViewRdoCases($id)
    {
        $opposition = CaseDetails::find($id);
        $opposition = CaseDetails::with('district', 'user')->findOrFail($id);
        return view('rdo.rdo-case-view',compact('opposition'));
    }

    public function caseDataRdoApprove(Request $request)
    {
        $caseDataRdo = CaseDetails::where('_id', $request->id)->first();
        $id = $request->id;
        $reason = $request->reason;
        //  $currentTime = Carbon::now();
        $currentTimeInKerala = now()->timezone('Asia/Kolkata');
        $currenttime = $currentTimeInKerala->format('d-m-Y h:i a');


        $caseDataRdo->update([
            'Rdo_status' => 1,
            'Rdo_status_date' => $currenttime,
            'Rdo_status_id' => Auth::user()->id,
            'Rdo_status_reason' => $reason,
        ]);
        return response()->json([
            'success' => 'Rdo Approved successfully.'
        ]);
    }
    public function caseDataRdoReject(Request $request)
    {
        $caseDataRdo = CaseDetails::where('_id', $request->id)->first();
        $id = $request->id;
        $reason = $request->reason;
        //  $currentTime = Carbon::now();
        $currentTimeInKerala = now()->timezone('Asia/Kolkata');
        $currenttime = $currentTimeInKerala->format('d-m-Y h:i a');

        $caseDataRdo->update([
            'Rdo_status' => 2,
            'Rdo_status_date' => $currenttime,
            'Rdo_status_id' => Auth::user()->id,
            'Rdo_status_reason' => $reason,
        ]);
        return response()->json([
            'success' => 'Rdo Reject the Application.'
        ]);
    }


    public function rdoOders()
    {
        return view("rdo.order-list");

    }

    public function getOrderList(Request $request)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

            // Total records
            $totalRecord = CaseDetails::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = CaseDetails::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = CaseDetails::where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder)->where('Rdo_status',1)->where('Rdo_status',2);
            $records = $items->skip($start)->take($rowperpage)->get();

            $data_arr = array();
            $i=$start;

            foreach($records as $record){
                $i++;
                $id = $record->id;
                $opposition_name = $record->opposition_name;
                $opposition_address =  $record->opposition_address;
                $case_details  =  $record->case_details;
                $case_id  =  $record->case_id;
                $status = $record->Rdo_status;
                $edit = '';

                if ($status == 1) {
                    $edit = '<a  href="' . route('ViewRdoOrders', $id) . '" class="btn btn-primary edit-btn">view</a>&nbsp;&nbsp;<div class="badge bg-success">Approved</div>';
                } else if ($status == 2) {
                    $edit = '<a  href="' . route('ViewRdoOrders', $id) . '" class="btn btn-primary edit-btn">view</a>&nbsp;&nbsp;<div class="badge bg-danger">Rejected</div>';
                }




                $data_arr[] = array(
                    "id" => $i,
                    "opposition_name" => $opposition_name,
                    "opposition_address" => $opposition_address,
                    "case_details" => $case_details,
                    "case_id"=>$case_id,
                    "edit" => $edit
                );
            }

            $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
            );

            return response()->json($response);
    }


    public function ViewRdoOrders($id)
    {
        $opposition = CaseDetails::find($id);
        $opposition = CaseDetails::with('district', 'user')->findOrFail($id);
        return view('rdo.rdo-order-view',compact('opposition'));
    }






}
