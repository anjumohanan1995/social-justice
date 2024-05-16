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


class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("user.case-list");
        
    }

    public function caseRegister()
    {
        $districts = District::get();
        return view("user.case-register",compact('districts'));
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
    public function storecaseRegister(Request $request)
    {
        //dd( $request);
        

        $validate = Validator::make($request->all(),
        [
          'opposition_name' => 'required',
          'case_details' => 'required' ,
          'opposition_address' => 'required',
          'district_id' => 'required', 
          'police_station' => 'required',
        ]);
        if ($validate->fails()) {
            //dd($validate);
            return Redirect::back()->withInput()->withErrors($validate);
        }

        $data =CaseDetails::create([
            'opposition_name' => @$request->opposition_name? $request->opposition_name:'',
            'district_id' => @$request->district_id? $request->district_id:'',
            'police_station' => @$request->police_station? $request->police_station:'',
            'opposition_address' => @$request->opposition_address?$request->opposition_address:'',
            'pincode' => @$request->pincode?$request->pincode:'',
            'opp_phone' => @$request->opp_phone?$request->opp_phone:'',
            'case_details' => @$request->case_details?$request->case_details:'',
            'user_id'=> Auth::user()->id,
        ]);


        $currentDate = now();

        // Extract year, month, and day from the current date
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $currentDay = $currentDate->day;

        // Generate the application number format (STDD00YYYYMMDD)
        $applicationNumber = "CASE00" . $currentYear . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . str_pad($currentDay, 2, '0', STR_PAD_LEFT);

        // Get the count of existing applications for the current month
        $existingApplicationsCount = CaseDetails::where('created_at', '>=', new UTCDateTime($currentDate->startOfMonth()->timestamp * 1000))
            ->where('created_at', '<', new UTCDateTime($currentDate->endOfMonth()->timestamp * 1000))
            ->count();

        //dd($existingApplicationsCount);

        // Increment the count to get the unique application number
        $applicationNumber .= str_pad($existingApplicationsCount + 1, 2, '0', STR_PAD_LEFT);
       // $applicationNumber = 'STDD002023122820';

        $Count = CaseDetails::where('case_id', $applicationNumber)->count();
        //dd($user);
        if ($Count > 0) {
            $applicationNumber1 = "CASE00" . $currentYear . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . str_pad($currentDay, 2, '0', STR_PAD_LEFT);
            $existingApplicationsCount = CaseDetails::where('created_at', '>=', new UTCDateTime($currentDate->startOfMonth()->timestamp * 1000))
                ->where('created_at', '<', new UTCDateTime($currentDate->endOfMonth()->timestamp * 1000))
                ->count();
            /// dd($existingApplicationsCount);

            // Increment the count to get the unique application number
            $incrementedCount = $existingApplicationsCount + 1;
            $applicationNumber1 .= str_pad($incrementedCount, 2, '0', STR_PAD_LEFT);

            $applicationNo =  $applicationNumber1;
            // dd($applicationNumber1);
        } else {
            $applicationNo = $applicationNumber;
        }

        $update = CaseDetails::where('_id', $data->id)->update(['case_id' => $applicationNo]);
        return redirect()->back()->with('success','Case Added successfully.');

   
    }

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
        $cases = CaseDetails::find($id);
        $districts = District::get();
        return view('user.case-edit',compact('cases','districts'));
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
        $validate = Validator::make($request->all(),
        [
          'opposition_name' => 'required',
          'case_details' => 'required' ,
          'opposition_address' => 'required',
          'district_id' => 'required', 
          'police_station' => 'required',
        ]);
        if ($validate->fails()) {
            //dd($validate);
            return Redirect::back()->withInput()->withErrors($validate);
        }
        $case = CaseDetails::find($id);
        $data = $case->update([
            'opposition_name' => @$request->opposition_name? $request->opposition_name:'',
            'district_id' => @$request->district_id? $request->district_id:'',
            'police_station' => @$request->police_station? $request->police_station:'',
            'opposition_address' => @$request->opposition_address?$request->opposition_address:'',
            'pincode' => @$request->pincode?$request->pincode:'',
            'opp_phone' => @$request->opp_phone?$request->opp_phone:'',
            'case_details' => @$request->case_details?$request->case_details:'',
            'user_id'=> Auth::user()->id,
        ]);

        return redirect()->route('cases.index')->with('success','Case Updated successfully.');
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
            $totalRecord = CaseDetails::where('user_id',Auth::user()->id)->where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = CaseDetails::where('user_id',Auth::user()->id)->where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = CaseDetails::where('user_id',Auth::user()->id)->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($request->casenumber){
                $items->where('case_id',$request->casenumber);
            }
            if($request->name){
                $items->where('opposition_name',$request->name);
            }
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
                $edit = '<a  href="' . url('cases/'.$id.'/edit') . '" class="btn btn-primary edit-btn">Edit</a>&nbsp;&nbsp;<button class="btn btn-danger delete-btn" data-id="'.$id.'">Delete</button>';

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

    

    
}
