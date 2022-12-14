@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Employees Table')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Employees Table </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right my-2 mb-4">
                            <a class="btn btn-success" href="{{ route('employee.create') }}"> Input Employee</a>
                        </div>

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-error">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Employee Id</th>
                                    <th>User Id</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paginate as $employee)
                                <tr>
                                    <td>{{ $employee ->id }}</td>
                                    <td>{{ $employee ->user_id }}</td>
                                    <td>{{ $employee ->user->role->role_name }}</td>
                                    <td>{{ $employee ->user->name }}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-info  mx-1" href="{{ route('employee.show',$employee->id) }}">Detail</a>
                                        <a class="btn btn-primary  mx-1" href="{{ route('employee.edit',$employee->id) }}">Edit</a>
                                        <form action="{{ route('employee.destroy',$employee->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger  mx-1" onclick="return confirm('Are you sure want to delete this employee?')">Delete</button>
                                        </form>                                    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="btn">
                        {{ $paginate->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Popup untuk delete-->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align:center;">Anda yakin akan meghapus employee?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <form method="POST" id="del">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Javascript untuk popup modal OK-->
<script type="text/javascript">
    var deletedId = 0;
    function show_alert(id)
    {
        $('#delete_modal').modal('show', {backdrop: 'static'});
        deletedId = id;
        // alert(deletedId);
        var action = "/admin/employee/destroy/{" + deletedId +"}";
        // alert(action);
        $('#del').attr("action", action);
    }
  </script>
@endsection