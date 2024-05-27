@extends('layouts.adminapp')
@php
use App\Models\RolePermission;
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $role = $user->role;

    // Fetch the permissions for the current user's role
    $permission = RolePermission::where('role', $role)->first();

    // Ensure the permissions are decoded only if they are not already arrays
    $permissions = $permission && is_string($permission->permission) ? json_decode($permission->permission, true) : ($permission->permission ?? []);
    $sub_permissions = $permission && is_string($permission->sub_permissions) ? json_decode($permission->sub_permissions, true) : ($permission->sub_permissions ?? []);

    $hasAddUserPermission = in_array('add-user', $sub_permissions) || $user->role == 'Admin';
    $hasEditUserPermission = in_array('edit-user', $sub_permissions) || $user->role == 'Admin';
    $hasDeleteUserPermission = in_array('delete-user', $sub_permissions) || $user->role == 'Admin';
@endphp
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class=" m-4 d-flex justify-content-between">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 card-no-border">
                            {{-- <h4>Keytable Integration</h4>
                            <span>If you are looking to emulate the UI of spreadsheet programs such as Excel with DataTables, the combination of KeyTable and AutoFill will take you a long way there!</span> --}}
                            </div>
                            <div class="card-body">
                                <div class=" m-4 d-flex justify-content-between">
                                <h4 class="card-title mg-b-10">
                                    All Users
                                </h4>
                                <div class="col-md-1 col-6 text-center">
                                    @if ($hasAddUserPermission)
                                        <div class="task-box primary  mb-0">
                                            <a class="text-white" href="{{ route('users.create') }}">
                                                <p class="mb-0 tx-12">Add </p>
                                                <h3 class="mb-0"><i class="fa fa-plus"></i></h3>
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="dt-ext table-responsive custom-scrollbar">
                                <table class="display" id="keytable">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>ROLE</th>
                                            @if ($hasEditUserPermission || $hasDeleteUserPermission)
                                                <th>ACTION</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{-- <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Tata Co.</td>
                                        <td>#AS61</td>
                                        <td> <i class="icofont icofont-arrow-up me-1">1.4%</i></td>
                                        <td>2011/04/25</td>
                                        <td><span class="badge badge-light-warning">Medium</span></td>
                                        <td>$320.800,00</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Edinburgh</td>
                                        <td>#FG63</td>
                                        <td> <i class="icofont icofont-arrow-up me-1">1.4%</i></td>
                                        <td>2011/07/25</td>
                                        <td><span class="badge badge-light-danger">Urgent</span></td>
                                        <td>$170.750,00</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>Mphasis Ltd</td>
                                        <td>#GH66</td>
                                        <td> <i class="icofont icofont-arrow-up me-1">1.4%</i></td>
                                        <td>2009/01/12</td>
                                        <td><span class="badge badge-light-warning">Medium</span></td>
                                        <td>$86.000,00</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                                <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr> --}}


                                    </tbody>

                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function(){

     	var table = $('#keytable').DataTable({
            processing: true,
            serverSide: true,
	        buttons: [
	            'copyHtml5',
	            'excelHtml5',
	            'csvHtml5',
	            'pdfHtml5'
	        ],
             "ajax": {

			       	"url": "{{ route('get.users-list') }}",
			       	"data": function ( d ) {
			        	return $.extend( {}, d, {

			          	});
       				}
       			},

            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'role' },
                @if ($hasEditUserPermission || $hasDeleteUserPermission)
                    { data: 'edit' }
                @endif
			],
            "order": [0, 'desc'],
            'ordering': true
        });
      	table.draw();
    });
    $(document).on('click', '.delete-btn', function() {
        var Id = $(this).data('id');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: '/users/' + Id,
                type: 'POST', // Use POST method
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'DELETE' // Override method to DELETE
                },
                success: function(response) {
                    // Handle success response
                    // Reload the page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText)
                }
            });
        }
    });
</script>
@endsection
