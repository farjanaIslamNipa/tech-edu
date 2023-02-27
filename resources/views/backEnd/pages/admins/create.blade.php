@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Admins/Create</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Admins</li>
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
                    <div class="col-12">
                        <!-- general form elements -->
                        <div class="card card-primary">

                            <!-- form start -->
                            <form action="{{ route('admins.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <h5>Personal Info</h5>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">First Name *</label>
                                                <input type="text" name="first_name" value="{{ old('first_name') }}" id="firstName"  class="form-control" placeholder="Enter First Name">
                                                @if($errors->has('first_name'))
                                                    <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" name="last_name" value="{{ old('last_name') }}" id="lastName" class=" form-control" placeholder="Enter Last Name">
                                                @if($errors->has('last_name'))
                                                    <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">Phone Number *</label>
                                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" id="phoneNumber" class=" form-control" placeholder="Enter Phone Number">
                                                @if($errors->has('phone_number'))
                                                    <div class="text-danger">{{ $errors->first('phone_number') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" placeholder="Enter Email">
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
                                                <label for="role">Role *</label>
                                                <select class="form-control js-basic-select2" name="role_id" id="role" class="form-control">
                                                    <option value="" disabled selected>Select a Role</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" {{old('role_id') == $role->id ? 'selected' : '' }} >{{ $role->name }} </option>
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
