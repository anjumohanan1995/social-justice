@extends('layouts.adminapp')

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
                                    Orders
                                </h4>
                                <div class="col-md-1 col-6 text-center">
                                    <div class="task-box primary  mb-0">
                                        <a class="text-white" href="{{ route('orders.create') }}">
                                            <p class="mb-0 tx-12">Add </p>
                                            <h3 class="mb-0"><i class="fa fa-plus"></i></h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="dt-ext table-responsive custom-scrollbar">
                                <table class="display" id="keytable">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Order</th>
                                            <th>File</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>


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

			       	"url": "{{route('getOrdersList')}}",
			       	"data": function (d) {
			        	return $.extend( {}, d, {

			          	});
       				}
       			},

            columns: [
                { data: 'id' },
                { data: 'type' },
                { data: 'file' },
                { data: 'edit' }
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
                url: '/policestation/' + Id,
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
