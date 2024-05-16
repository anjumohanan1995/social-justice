<?php

namespace App\Http\Controllers;


use App\Models\District;
use App\Models\PoliceStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class PoliceStationController extends Controller
{
    //
    public function index(){
        return view('policestation.policestation-list');
    }

    public function create(){
        $districts = District::all();
        return view('policestation.create',compact('districts'));
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),
        [
          'name' => 'required',
           'district' => 'required'
        ]);
        if ($validate->fails()) {
            //dd($validate);
            return Redirect::back()->withInput()->withErrors($validate);
        }
        PoliceStation::create([
            'district_id' => $request->district,
            'name' => $request->name
        ]);
        return redirect()->route('policestation')->with('success','policestation Added successfully.');
    }

    public function getPoliceStationList(Request $request)
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
            $totalRecord = PoliceStation::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = PoliceStation::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = PoliceStation::where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);

            $records = $items->skip($start)->take($rowperpage)->get();

            $data_arr = array();
            $i=$start;

            foreach($records as $record){
                $i++;
                $id = $record->id;
                $district = $record->district->name;
                $policestation =  $record->name;
                $edit = '<a href="' . url('policestation/'.$id.'/edit') . '" class="btn btn-primary edit-btn">Edit</a>&nbsp;&nbsp;<button class="btn btn-danger delete-btn" data-id="'.$id.'">Delete</button>';

                $data_arr[] = array(
                    "id" => $i,
                    "district" => $district,
                    "policestation" => $policestation,
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

    public function edit($id){
        $data = PoliceStation::findOrFail($id);

        $district =District::orderBy('id','desc')->where('deleted_at',null)->get();
        return view('policestation.edit', ['data' => $data,'districts'=>$district]);
    }

    public function update(Request $request , $id){
        $validate = Validator::make($request->all(),
        [
          'name' => 'required',
           'district' => 'required'
        ]);
        if ($validate->fails()) {
            //dd($validate);
            return Redirect::back()->withInput()->withErrors($validate);
        }
        $police_station = PoliceStation::find($id);
        $police_station->district_id = $request->district;
        $police_station->name = $request->name;
        $police_station->update();
        return redirect()->route('policestation')->with('success','policestation Updated successfully.');
    }

    public function destroy($id){

        $data = PoliceStation::findOrFail($id);
        $data->delete();
        return response()->json(['success' => 'Police Station successfully deleted!']);
    }

    public function get_police_station(Request $request){
        $police_stations = PoliceStation::where('district_id', $request->district_id)->get();
        return response()->json($police_stations);
    }
}
