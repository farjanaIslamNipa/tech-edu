@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Clients/Create</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Client</li>
                            <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">List</a></li>
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
                            <form action="{{ route('clients.store')}}" method="post">
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
                                                <input type="text" name="last_name" value="{{ old('last_name') }}" id="lastName" class="form-control" placeholder="Enter Last Name">
                                                @if($errors->has('last_name'))
                                                    <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">Phone Number *</label>
                                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" id="phoneNumber" class="form-control" placeholder="Enter Phone Number">
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
                                    <h5>Address Info</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="street">Street *</label>
                                                <input type="text" name="street" value="{{ old('street') }}" id="street" class="form-control" placeholder="Enter Street">
                                                @if($errors->has('street'))
                                                    <div class="text-danger">{{ $errors->first('street') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="suburb">City/Suburb *</label>
                                                <input type="text" name="suburb" value="{{ old('suburb') }}" id="suburb" class=" form-control" placeholder="Enter Suburb">
                                                @if($errors->has('suburb'))
                                                    <div class="text-danger">{{ $errors->first('suburb') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="state">State *</label>
                                                <input type="text" name="state" value="{{ old('state') }}" id="state" class=" form-control" placeholder="Enter state">
                                                @if($errors->has('state'))
                                                    <div class="text-danger">{{ $errors->first('state') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="postCode">Post Code *</label>
                                                <input type="text" name="post_code" value="{{ old('post_code') }}" id="postCode" class="form-control" placeholder="Enter Post Code">
                                                @if($errors->has('post_code'))
                                                    <div class="text-danger">{{ $errors->first('post_code') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="country">Country *</label>
                                                <input type="text" name="country" value="{{ old('country') }}" id="country" class="form-control" placeholder="Enter Country">
                                                @if($errors->has('country'))
                                                    <div class="text-danger">{{ $errors->first('post_code') }}</div>
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
