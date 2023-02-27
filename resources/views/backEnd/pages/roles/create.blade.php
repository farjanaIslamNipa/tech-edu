@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Roles/Create</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Roles</li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">List</a></li>
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
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->
                            <form action="{{ route('roles.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <h5>Role Info</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="roleName">Role Name *</label>
                                                <input type="text" name="name" value="{{ old('name') }}" id="roleName" class="form-control" placeholder="Enter Role Name">
                                                @if($errors->has('name'))
                                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <h5>Permission Info</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="roleName">Permission List *</label>
                                            <div class="row">
                                            @foreach($permissions as $permission)
                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 form-group">
                                                        <div class="d-flex align-items-start">
                                                            <div><input style="margin-top: 7px;" class="btn-check" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="flexCheckDefault"></div>
                                                            <div><label>&nbsp;{{ Str::headline($permission?->name) }}</label></div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if($errors->has('permission'))
                                                <div class="text-danger">{{ $errors->first('permission') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
