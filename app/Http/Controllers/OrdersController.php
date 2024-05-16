<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    //
    public function index(){
        return view('orders.list');
    }

    public function create(){
        return view('orders.create');
    }

    public function store(Request $request){
        
        $validate = Validator::make($request->all(),
        ['type' => 'required',
        'file' => 'required|file|max:10240',
        ]);
        if ($validate->fails()) {
          return Redirect::back()->withInput()->withErrors($validate);
        }
       
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads/orders', $filename);
        Order::create([
            'type' => $request->type,
            'file' => $filename 
        ]);
        return redirect()->route('orders.index')->with('success','Order Added successfully.');               

    }

    public function getOrdersList(Request $request)
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
            $totalRecord = Order::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Order::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Order::where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);

            $records = $items->skip($start)->take($rowperpage)->get();

            $data_arr = array();
            $i=$start;

            foreach($records as $record){
                $i++;
                $id = $record->id;
                $type = $record->type;
                $file = '<a href="">'.$record->file.'</a>';
                $edit = '<a href="' . url('policestation/'.$id.'/edit') . '" class="btn btn-primary edit-btn">Edit</a>&nbsp;&nbsp;<button class="btn btn-danger delete-btn" data-id="'.$id.'">Delete</button>';

                $data_arr[] = array(
                    "id" => $i,
                    "type" => $type,
                    "file" => $file,
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
