@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>FAQs/Create</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">FAQs</li>
                            <li class="breadcrumb-item"><a href="{{ route('frequently-asked-questions.index') }}">List</a></li>
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
                            <form action="{{ route('frequently-asked-questions.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-8">
                                            <div class="form-group">
                                                <label for="question">Question *</label>
                                                <input type="text" name="question" value="{{ old('question') }}" id="firstName"  class="form-control" placeholder="Enter Question">
                                                @if($errors->has('question'))
                                                    <div class="text-danger">{{ $errors->first('question') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="order">Order *</label>
                                                <input type="text" name="order" value="{{ old('order') }}" id="order"  class="form-control" placeholder="Enter Order">
                                                @if($errors->has('order'))
                                                    <div class="text-danger">{{ $errors->first('order') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="answer">Answer *</label>
                                            <textarea id="shortDescription" class="form-control" name="answer" rows="3" placeholder="Write an answer">{{ old('answer') }}</textarea>
                                            @if($errors->has('answer'))
                                                <div class="text-danger">{{ $errors->first('answer') }}</div>
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
