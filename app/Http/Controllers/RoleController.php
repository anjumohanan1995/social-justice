<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.user-management.role.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("admin.user-management.role.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validate = Validator::make($request->all(),
        [
          'name' => 'required',



        ]);
        if ($validate->fails()) {
            //dd($validate);
            return Redirect::back()->withInput()->withErrors($validate);
        }

        Role::create([
            'name' => @$request->name? $request->name:'',

        ]);

        return redirect()->route('roles.index')->with('success','Role Added successfully.');


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
        $data = Role::findOrFail($id);


        return view('admin.user-management.role.edit', ['data' => $data,]);
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
         // Validate the incoming request data
         $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        // Find the role by its ID.
        $data = Role::findOrFail($id);

        // Update the role with the data from the request
        $data->name = $request->name;

        // Update other attributes as needed
        // Save the updated role
        $data->save();

        // Redirect back with success message
        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Role::findOrFail($id);

        $data->delete();

        return response()->json(['success' => 'Role successfully deleted!']);
    }



    public function getRoles(Request $request)
    {


    $user = Auth::user();
    $role = $user->role;

    // Fetch the permissions for the current user's role
    $permission = RolePermission::where('role', $role)->first();

    // Ensure the permissions are decoded only if they are not already arrays
    $permissions = $permission && is_string($permission->permission) ? json_decode($permission->permission, true) : ($permission->permission ?? []);
    $sub_permissions = $permission && is_string($permission->sub_permissions) ? json_decode($permission->sub_permissions, true) : ($permission->sub_permissions ?? []);

    $hasEditPermissionPermission = in_array('edit-permission', $sub_permissions) || $user->role == 'Admin';

    $hasEditRolePermission = in_array('edit-role', $sub_permissions) || $user->role == 'Admin';
    $hasDeleteRolePermission = in_array('delete-role', $sub_permissions) || $user->role == 'Admin';
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
            $totalRecord = Role::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Role::where('deleted_at',null)->orderBy('created_at','desc');
            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Role::where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            $records = $items->skip($start)->take($rowperpage)->get();

            $data_arr = array();
            $i=$start;

            foreach($records as $record){
                $i++;
                $id = $record->id;
                $name = $record->name;

                $edit = '';

// Check conditions for edit button
if ($hasEditRolePermission) {
    $edit .= '<a  href="' . url('roles/'.$id.'/edit') . '" class="btn btn-primary edit-btn">Edit</a>&nbsp;&nbsp;';
}

// Check conditions for delete button
if ($hasDeleteRolePermission) {
    $edit .= '<button class="btn btn-danger delete-btn" data-id="'.$id.'">Delete</button>&nbsp;&nbsp;';
}

// Check conditions for permission button
if ($hasEditPermissionPermission) {
    $edit .= '<a href="' . url('roles/'.$name.'/editPermission') . '"><button class="btn btn-primary">Permission</button></a>';
}


                $data_arr[] = array(
                    "id" => $i,
                    "name" => $name,

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

    public function editPermission( $id)
    {
        $role_name = $id;
        $totalRecord = Permission::where('deleted_at',null)->get();
        $role = Auth::user()->role;
        $checked = RolePermission::where('role',$role_name)->first();
        return view('admin.user-management.role.editpermission',compact('totalRecord','role_name','checked'));

    }
    public function addPermission(Request $request, $id)
    {

        $validate = Validator::make($request->all(),
        [
         'permission' => 'required',

         ]);
        if ($validate->fails()) {
            /*return response()->json([
                'error' => $validate->errors()->all()
            ]);*/
            return Redirect::back()->withErrors($validate);

        }
        $sub="";
        if($request->sub_permission) {
            $content = $request->sub_permission;
            $content = array_values($content);
            $sub = ($content)? json_encode($content): null;
        }
        $data =$request->all();
        $book=RolePermission::where('role',$id)->first();
        if($book == null){
            RolePermission::create([
                'role' => $id,
                'permission' => $data['permission'],
                'sub_permissions' =>$sub
            ]);
             return redirect()->route('roles.index')

                    ->with('success','Permission added successfully');


        }
        else{
            $book->update([
                'role' => $id,
                'permission' => $data['permission'],
                'sub_permissions' =>$sub
            ]);

            return redirect()->route('roles.index')

            ->with('success','Permission added successfully');
       }
    }



}
