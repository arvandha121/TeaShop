@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Menus Table')

@section('container')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Menus Table </h3>
                <div class="float-left my-2">
                    <form action="{{ route('menu.index') }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search . . . " name="search"
                                value="{{ request('search') }}">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right my-2 mb-4">
                                <a class="btn btn-success" href="{{ route('menu.create') }}"> Input Menu</a>
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
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Picture</th>
                                        <th width="500px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paginate as $menu)
                                        <tr>
                                            <td>{{ $menu->id }}</td>
                                            <td style="width: 270px">{{ $menu->name }}</td>
                                            <td>{{ $menu->price }}</td>
                                            <td>{{ $menu->stock }}</td>
                                            @if ($menu->menu_photo_path != null)
                                                @php
                                                    $img = $menu->menu_photo_path;
                                                @endphp
                                            @else
                                                @php
                                                    $img = 'images/default_menu.png';
                                                @endphp
                                            @endif
                                            <td><img class="rounded" width="50px" height="50px"
                                                    src="{{ 'https://storage.googleapis.com/laravel-cafe-app/' . $img }}"
                                                    alt="" srcset=""></td>
                                            <td style="max-width: 200px">
                                                <div class="d-flex">
                                                    <a class="btn btn-info"
                                                        href="{{ route('menu.show', $menu->id) }}">Show</a>
                                                    <a class="btn btn-primary mx-1"
                                                        href="{{ route('menu.edit', $menu->id) }}">Edit</a>
                                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Are you sure want to delete this menu?')">Delete</button>
                                                    </form>
                                                </div>
                                                {{--  <button onclick="show_alert({{$menu->id}})" class="btn btn-danger">Delete</button>  --}}

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
                    <h5 class="modal-title" style="text-align:center;">Anda yakin akan meghapus menu?</h5>
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

        function show_alert(id) {
            $('#delete_modal').modal('show', {
                backdrop: 'static'
            });
            deletedId = id;
            // alert(deletedId);
            var action = "/menu/destroy/" + deletedId + "";
            // alert(action);
            $('#del').attr("action", action);
        }
    </script>
@endsection
