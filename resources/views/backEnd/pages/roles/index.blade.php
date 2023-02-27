@extends('backEnd.layouts.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Roles/List</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Roles</li>
                            <li class="breadcrumb-item">
                                @can('role-create')
                                    <a href="{{ route('roles.create') }}">Create</a>
                                @endcan
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            @if(session('message'))
                <div class="col-12">
                    <div class="alert @if(session('message')['status'] == 'success') alert-success @elseif(session('message')['status'] == 'danger') alert-danger @else alert-warning  @endif alert-dismissible fade show" role="alert">
                        @if(session('message')['status'])
                            <strong>{{ Str::ucfirst(session('message')['status']) }}!</strong>
                        @endif
                        {{ session('message')['info'] }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('roles.index')}}" style="padding-bottom: 1.25rem" method="get">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input type="text" name="search_query" value="{{ Request::get('search_query') }}" class="form-control rounded" placeholder="Search by name"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-primary btn-block">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <table class="table col-12 table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th style="width:5%">SL</th>
                                        <th style="width:60%">Role Name</th>
                                        <th style="width:30%">Assigned Permissions</th>
                                        <th class="text-right" style="width:5%">Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span>{{ $role?->name ?? 'Not Assigned' }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $role?->permissions_count ?? "No Permission Assigned" }}</span>
                                        </td>
                                        <td class="d-flex text-right">
                                            <a class="link-btn mr-1" title="View"  href="{{ route('roles.show',$role->id) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a class="link-btn mr-1" title="Edit"  href="{{ route('roles.edit', ['role' => $role->id, 'redirect_route' => url()->full()]) }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a class="link-btn" title="Delete"  href="#" data-toggle="modal" data-target="#deleteModal" onclick="assignDeleteRouteToDeleteForm(this)" data-route="{{ route('roles.destroy', $role->id) }}">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-start">
                                        Showing {{ $roles?->firstItem() ?? 0 }} to {{ $roles->lastItem() ?? 0 }} of total {{ $roles?->total() }} records.
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-sm-center">
                                        {{ $roles->links() }}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="roleDeleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-circle fa-5x mt-3"></i>
                    <h3 class="pt-4 mb-2 text-dark">Are you sure?</h3>
                    <p class="text-secondary">Do you really want to delete this records? This process can't be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="" id="deleteRoute" method="post">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" id="" class="btn btn-danger">Delete it.</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function assignDeleteRouteToDeleteForm(target) {
            document.getElementById("deleteRoute").action = target.getAttribute('data-route');
        }
    </script>

@endsection

