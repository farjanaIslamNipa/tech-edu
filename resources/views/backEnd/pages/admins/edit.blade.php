@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Admins/Edit</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Admins</li>
                            <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">List</a></li>
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
                            <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <h5>Personal Info</h5>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">First Name *</label>
                                                <input type="text" name="first_name" value="{{ $admin?->user->first_name ?? '' }}" id="firstName" class="form-control" placeholder="Enter First Name">
                                                @if($errors->has('first_name'))
                                                    <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" name="last_name" value="{{ $admin?->user->last_name ?? '' }}" id="lastName" class="form-control" placeholder="Enter Last Name">
                                                @if($errors->has('last_name'))
                                                    <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">Phone Number *</label>
                                                <input type="text" name="phone_number" value="{{ $admin?->user?->phone_number ?? '' }}" id="phoneNumber" class="form-control" placeholder="Enter Phone Number">
                                                @if($errors->has('phone_number'))
                                                    <div class="text-danger">{{ $errors->first('phone_number') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="text" name="email" value="{{ $admin?->user?->email ?? '' }}" id="email" class="form-control" placeholder="Enter Email">
                                                @if($errors->has('email'))
                                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <h5>Role Info</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="roleId">Role *</label>
                                                <select class="form-control js-basic-select2" name="role_id" id="roleId" required>
                                                    <option value=""  disabled selected>Select a Role</option>
                                                    @foreach($roles as $role)
                                                        <option {{ $admin?->user?->roles[0]->name == $role?->name ? 'selected' : '' }} value="{{ $role?->id }}">{{ $role?->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('role_id'))
                                                    <div class="text-danger">{{ $errors->first('role_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <input type="hidden" name="redirect_route" value="{!! $redirectRoute !!}">
                                            <button type="submit" class="btn btn-warning">Update</button>
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
