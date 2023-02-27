@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Create New Contact</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Contact </li>
                            <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">List</a></li>

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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">

                            <!-- form start -->
                            <form action="{{ route('contacts.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Client *</label>
                                                <select class="form-control js-basic-select2" name="client_id" class="form-control">
                                                    <option value="" disabled selected>Select Any</option>
                                                    @foreach($clients as $client)
                                                        <option value="{{ $client->id }}" {{old('client_id') == $client->id ? 'selected' : '' }} >{{ $client->user->first_name }} {{ $client->user->last_name }} </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('client_id'))
                                                    <div class="text-danger">{{ $errors->first('client_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label> Message</label>
                                                <textarea class="form-control" name="message" rows="3" placeholder="Enter Message">{{ old('message') }}</textarea>
                                                @if($errors->has('message'))
                                                    <div class="text-danger">{{ $errors->first('message') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
