@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Course Categories/Create</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Course Categories</li>
                            <li class="breadcrumb-item"><a href="{{ route('course-categories.index') }}">List</a></li>

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
                            <form action="{{ route('course-categories.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-8">
                                            <div class="form-group">
                                                <label for="name">Category Name *</label>
                                                <input type="text" name="name" value="{{ old('name') }}" id="name"  class="form-control" placeholder="Enter Category Name">
                                                @if($errors->has('name'))
                                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="is_primary">Is Primary? *</label>
                                                <select class="form-control js-basic-select2" name="is_primary" id="is_primary">
                                                    <option value="1" {{ old('is_primary') == '1' ? 'selected' : '' }}>Primary</option>
                                                    <option value="0" {{ old('is_primary') == '0' ? 'selected' : '' }}>Others</option>
                                                </select>
                                                @if($errors->has('is_primary'))
                                                    <div class="text-danger">{{ $errors->first('is_primary') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="status">Status *</label>
                                                <select class="form-control js-basic-select2" name="status" id="status">
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @if($errors->has('status'))
                                                    <div class="text-danger">{{ $errors->first('status') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="course_color_code">Course Color Code</label>
                                                <input type="text" name="course_color_code" value="{{ old('course_color_code') }}" id="course_color_code"  class="form-control" placeholder="Enter Category Color Code">
                                                @if($errors->has('course_color_code'))
                                                    <div class="text-danger">{{ $errors->first('course_color_code') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="background_color_code">Background Color Code</label>
                                                <input type="text" name="background_color_code" value="{{ old('background_color_code') }}" id="background_color_code"  class="form-control" placeholder="Enter Background Color Code">
                                                @if($errors->has('background_color_code'))
                                                    <div class="text-danger">{{ $errors->first('background_color_code') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="shortDescription">Short Description</label>
                                                <textarea id="shortDescription" class="form-control" name="short_description" rows="3" placeholder="Write a Short Description">{{ old('short_description') }}</textarea>
                                                @if($errors->has('short_description'))
                                                    <div class="text-danger">{{ $errors->first('short_description') }}</div>
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
