@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Clients/Edit</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Clients</li>
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
                            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <h5>Personal Info</h5>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">First Name *</label>
                                                <input type="text" name="first_name" value="{{ $client?->user?->first_name ?? '' }}" id="firstName" class="form-control" placeholder="Enter First Name">
                                                @if($errors->has('first_name'))
                                                    <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" name="last_name" value="{{ $client?->user?->last_name ?? '' }}" id="lastName" class="form-control" placeholder="Enter Last Name">
                                                @if($errors->has('last_name'))
                                                    <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">Phone Number *</label>
                                                <input type="text" name="phone_number" value="{{ $client?->user?->phone_number ?? '' }}" id="phoneNumber" class="form-control" placeholder="Enter Phone Number">
                                                @if($errors->has('phone_number'))
                                                    <div class="text-danger">{{ $errors->first('phone_number') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="text" name="email" value="{{ $client?->user?->email ?? '' }}" id="email" class="form-control" placeholder="Enter Email">
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
                                                <input type="text" name="street" value="{{ $client?->address?->street ?? '' }}" id="street" class="form-control" placeholder="Enter Street">
                                                @if($errors->has('street'))
                                                    <div class="text-danger">{{ $errors->first('street') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="suburb">City/Suburb *</label>
                                                <input type="text" name="suburb" value="{{ $client?->address?->suburb ?? '' }}" id="suburb" class="form-control" placeholder="Enter City or Suburb">
                                                @if($errors->has('suburb'))
                                                    <div class="text-danger">{{ $errors->first('suburb') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="state">State *</label>
                                                <input type="text" name="state" value="{{ $client?->address?->state ?? '' }}" id="state" class="form-control" placeholder="Enter state">
                                                @if($errors->has('state'))
                                                    <div class="text-danger">{{ $errors->first('state') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="postCode">Post Code *</label>
                                                <input type="text" name="post_code" value="{{ $client?->address?->post_code ?? '' }}" id="postCode" class="form-control" placeholder="Enter Post Code">
                                                @if($errors->has('post_code'))
                                                    <div class="text-danger">{{ $errors->first('post_code') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="country">Country *</label>
                                                <input type="text" name="country" value="{{ $client?->address?->country ?? '' }}" id="country" class="form-control" placeholder="Enter Country">
                                                @if($errors->has('country'))
                                                    <div class="text-danger">{{ $errors->first('country') }}</div>
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
