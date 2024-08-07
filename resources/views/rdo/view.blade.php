@extends('layouts.adminapp')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="m-4 d-flex justify-content-between">
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
                        </div>
                        <div class="card-body">
                            <div class="m-4 d-flex justify-content-between">
                                <h4 class="card-title mg-b-10">
                                    RDO
                                </h4>
                                <div class="col-md-1 col-6 text-center">
                                    <div class="task-box primary mb-0">
                                        <a class="text-white" href="{{ route('rdo.create') }}">
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
                                            <th>District</th>
                                            <th>RDO</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- DataTables will populate this area -->
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        var table = $('#keytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('getRdoList') }}",
                type: 'GET',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'district', name: 'district' },
                { data: 'name', name: 'name' },
                { data: 'edit', name: 'edit', orderable: false, searchable: true }
            ],
            order: [[0, 'desc']]
        });

        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: '/rdo/' + id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

@endsection
