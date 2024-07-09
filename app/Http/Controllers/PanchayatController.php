<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Panchayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class PanchayatController extends Controller
{
    //

    public function index(){
        return view('panchayat.list');
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

            // Total records
            $totalRecord = Panchayat::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Panchayat::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Panchayat::where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if (!empty($searchValue)) {
                $items->where(function ($query) use ($searchValue) {
                    $query->where('district_name', 'like', '%' . $searchValue . '%')
                          ->orWhere('name', 'like', '%' . $searchValue . '%');
                });
            }


            $records = $items->skip($start)->take($rowperpage)->get();

            $data_arr = array();
            $i=$start;

            foreach($records as $record){
                $i++;
                $id = $record->district_name;
                $panchayat = $record->name;
                $edit = '<a  href="' . url('panchayat/'.$record->id.'/edit').'" class="btn btn-primary edit-btn">Edit</a>&nbsp;&nbsp;<button class="btn btn-danger delete-btn" data-id="'.$record->id.'">Delete</button>';

                $data_arr[] = array(
                    "id" => $i,
                    "district" => $id,
                    "panchayat" => $panchayat,
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
    public function create(){
        $districts = District::all();
        return view('panchayat.create',compact('districts'));
    }
    public function store(Request $request){
        $validate = Validator::make($request->all(),
        [
          'name' => 'required',
           'district' => 'required'
        ]);
        if ($validate->fails()) {
          return Redirect::back()->withInput()->withErrors($validate);
        }
        Panchayat::create([
            'district_id' => $request->district,
            'name' => $request->name
        ]);
        return redirect()->route('panchayat.index')->with('success','Panchayat Added successfully.');
    }

    public function edit($id){
        $data = Panchayat::findOrFail($id);
        $district =District::orderBy('id','desc')->where('deleted_at',null)->get();
        return view('panchayat.edit', ['data' => $data,'districts'=>$district]);
    }

    public function update(Request $request  , $id){
        $validate = Validator::make($request->all(),
        [
          'name' => 'required',
           'district' => 'required'
        ]);
        if ($validate->fails()) {
          return Redirect::back()->withInput()->withErrors($validate);
        }
        $panchayat = Panchayat::find($id);
        $panchayat->district_id = $request->district;
        $panchayat->name = $request->name;
        $panchayat->update();
        return redirect()->route('panchayat.index')->with('success','Panchayat updated successfully.');
    }

    public function destroy($id){

        $data = Panchayat::findOrFail($id);
        $data->delete();
        return response()->json(['success' => 'Panchayat successfully deleted!']);
    }


    public function getPanchayat(Request $request)
    {
        //dd("hgdhndhd");
        $districtName = $request->input('district_name');
        // dd($districtName);

        // Assuming PoliceStation is your model for police stations
        $panchayats = Panchayat::where('district_name', 'regexp', '/' . preg_quote($districtName, '/') . '/i')->get();

        // dd($panchayats);

        return response()->json($panchayats);
    }

}
