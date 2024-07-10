<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaseDetails;
use App\Models\District;
use App\Models\Rdo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use MongoDB\BSON\UTCDateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\RejectionOrder;
use App\Models\InterimOrders;


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
                $hearing_date = $record->hearingDate;
                $case_id  =  $record->case_id;
                $status = $record->Rdo_case_status;
                $edit = '';

                if ($status == 1) {
                    $edit = '<a  href="' . route('ViewRdoCases', $id) . '" class="btn btn-primary edit-btn">view</a>&nbsp;&nbsp;<div class="badge bg-success">Approved</div>';
                } else if ($status == 0) {
                    $edit = '<a  href="' . route('ViewRdoCases', $id) . '" class="btn btn-primary edit-btn">view</a>&nbsp;&nbsp;<div class="badge bg-danger">Rejected</div>';
                } else if ($status == null) {
                    $edit = '<a  href="' . route('ViewRdoCases', $id) . '" class="btn btn-primary edit-btn">view</a>';
                }




                $data_arr[] = array(
                    "id" => $i,
                    "opposition_name" => $opposition_name,
                    "opposition_address" => $opposition_address,
                    "case_details" => $case_details,
                    "hearing_date" => $hearing_date,
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
        $caseDetails = CaseDetails::find($id);
        // $opposition = CaseDetails::with('district', 'user')->findOrFail($id);
        // dd($opposition);
        return view('rdo.rdo-case-view',compact('caseDetails'));
    }

    public function caseDataRdoApprove(Request $request)
    {
        // dd($request->hearingDate);
        $caseDataRdo = CaseDetails::where('_id', $request->id)->first();
        if ($request->has('hearingDate')) {
            $hearingDate = $request->hearingDate;

            $caseDataRdo->update([
                'hearingDate' => $hearingDate
            ]);
                // Return a JSON response with the redirect URL
                return response()->json([
                    'success' => 'Hearing Date Update successfully.',
                    'redirect' => route('case.list')
                ]);
            }
        $request->validate([
            'orderfile' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048', // Validate the file type and size
        ]);

        // Find the case data
        $id = $request->id;
        $reason = $request->reason;

        $ordertype = $request->ordertype;
        $case_id = $request->case_id;
        $currentTimeInKerala = now()->timezone('Asia/Kolkata');
        $currenttime = $currentTimeInKerala->format('d-m-Y h:i a');

        // Handle the file upload
        if ($request->hasFile('orderfile')) {
            $orderfile = $request->file('orderfile');
            $originalFileName = $orderfile->getClientOriginalName();
            $extension = $orderfile->getClientOriginalExtension();

            // Generate a unique filename
            $fileName = time() . '_' . uniqid() . '.' . $extension;

            // Move the validated file to the desired directory
            $orderfile->move(public_path('/orders/uploads'), $fileName);

            // Save the file name to the database
            $uploadedFile = $fileName;
        } else {
            // Handle case when no file is uploaded
            $uploadedFile = null; // or handle accordingly, e.g., set a default file name or show an error
        }

        // Update the case data
        $caseDataRdo->update([
            'Rdo_case_status' => 1,
            'Rdo_case_status_date' => $currenttime,
            'Rdo_case_status_id' => Auth::user()->id,
            'Rdo_case_status_reason' => $reason,
        ]);

        // Save to the new collection
        if ($ordertype === 'interim Order') {
            InterimOrders::create([
                'order_type' => $ordertype,
                'order_file' => $uploadedFile, // Save the file name
                'case_no' => $case_id,
                'casedetails_id' => $id,
                'Rdo_case_status' => 1,
            ]);
        } else {
        Order::create([
            'order_type' => $ordertype,
            'order_file' => $uploadedFile, // Save the file name
            'case_no' => $case_id,
            'casedetails_id' => $id,
            'Rdo_case_status' => 1,
        ]);
        }


    // Return a JSON response with the redirect URL
    return response()->json([
        'success' => 'Rdo Approved successfully.',
        'redirect' => route('case.list')
    ]);

}
    public function caseDataRdoReject(Request $request)
    {
        // dd($request);
        $request->validate([
            'orderfile' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048', // Validate the file type and size
        ]);

        // Find the case data
        $caseDataRdo = CaseDetails::where('_id', $request->id)->first();
        $id = $request->id;
        $reason = $request->reason;

        $rejectionOrderType = $request->rejectionOrderType;
        $case_id = $request->case_id;
        $currentTimeInKerala = now()->timezone('Asia/Kolkata');
        $currenttime = $currentTimeInKerala->format('d-m-Y h:i a');

        // Handle the file upload
        if ($request->hasFile('orderfile')) {
            $orderfile = $request->file('orderfile');
            $originalFileName = $orderfile->getClientOriginalName();
            $extension = $orderfile->getClientOriginalExtension();

            // Generate a unique filename
            $fileName = time() . '_' . uniqid() . '.' . $extension;

            // Move the validated file to the desired directory
            $orderfile->move(public_path('/orders/uploads'), $fileName);

            // Save the file name to the database
            $uploadedFile = $fileName;
        } else {
            // Handle case when no file is uploaded
            $uploadedFile = null; // or handle accordingly, e.g., set a default file name or show an error
        }

        // Update the case data
        $caseDataRdo->update([
            'Rdo_case_status' => 0,
            'Rdo_case_status_date' => $currenttime,
            'Rdo_case_status_id' => Auth::user()->id,
            'Rdo_case_status_reason' => $reason,
        ]);

        // Save to the new collection
        RejectionOrder::create([
            'Rdo_case_status' => 0,
            'rejection_order_type' => $rejectionOrderType,
            'rejection_order_file' => $uploadedFile, // Save the file name
            'case_no' => $case_id,
            'casedetails_id' => $id,
        ]);

    // Return a JSON response with the redirect URL
    return response()->json([
        'success' => 'Rdo Rejected successfully.',
        'redirect' => route('case.list')
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
                $status = $record->Rdo_case_status;
                $edit = '';

                if ($status == 1) {
                    $edit = '<a  href="' . route('ViewRdoOrders', $id) . '" class="btn btn-primary edit-btn">view</a>&nbsp;&nbsp;<div class="badge bg-success">Approved</div>';
                } else if ($status == 0) {
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

    public function rdo(){
        return view ('rdo.view',);
    }

    public function list(Request $request){
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
        // dd($searchValue);

          // Total records
        $totalRecord = Rdo::where('deleted_at',null)->orderBy('created_at','desc');
        $totalRecords = $totalRecord->select('count(*) as allcount')->count();

        $totalRecordswithFilte = Rdo::where('deleted_at',null)->orderBy('created_at','desc');
        $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                  // Fetch records
        $items = Rdo::where('deleted_at',null)->where('status','Active')->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);

        if (!empty($searchValue)) {
            $items->where(function ($query) use ($searchValue) {
                    $query->where('district', 'like', '%' . $searchValue . '%')
                        ->orWhere('name', 'like', '%' . $searchValue . '%');
            });
        }

        $records = $items->skip($start)->take($rowperpage)->get();

        $data_arr = array();
        $i=$start;

        foreach($records as $record){
            $i++;
            $id = $record->district;
            $rdo = $record->name;

            $edit = '<a  href="' . url('rdo/'.$record->id.'/edit').'" class="btn btn-primary edit-btn">Edit</a>
            &nbsp;&nbsp;
            <a  href="' . url('rdo/'.$record->id.'/delete').'" class="btn btn-danger delete-btn">Delete</a>';

            $data_arr[] = array(
                "id" => $i,
                "district" => $id,
                "name" => $rdo,
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

    public function rdocreate(){
        $districts = District::all();
        return view ('rdo.rdo-create',compact('districts'));
    }

    public function rdostore(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
           'name' => 'required',
           'district' => 'required',
           'status'=>'required'
        ]);
        if ($validate->fails()) {
          return Redirect::back()->withInput()->withErrors($validate);
        }
        Rdo::create([
            'district' => $request->district,
            'name' => $request->name,
            'status'=>$request->status,
        ]);
        return redirect()->route('rdo')->with('success','RDO Added successfully.');
    }
    public function edit($id){
        $data = Rdo::findOrFail($id);
        $district =District::orderBy('id','desc')->where('deleted_at',null)->get();
        return view('rdo.edit', ['data' => $data,'districts'=>$district]);
    }

    public function update(Request $request  , $id)
    {
        $validate = Validator::make($request->all(),
        [
          'name' => 'required',
           'district' => 'required',
           'status'=>'required',
        ]);
        if ($validate->fails()) {
          return Redirect::back()->withInput()->withErrors($validate);
        }
        $panchayat = Rdo::find($id);
        $panchayat->district = $request->district;
        $panchayat->name = $request->name;
        $panchayat->status = $request->status;
        $panchayat->save();
        return redirect()->route('rdo')->with('success','RDO updated successfully.');
    }

    public function destroy($id)
    {
        $rdo = Rdo::withTrashed()->findOrFail($id);
        $rdo->forceDelete();
        return redirect()->route('rdo')->with('success', 'RDO deleted successfully.');
    }






}
