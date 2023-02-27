@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Course Modules/Create</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Course Modules</li>
                            <li class="breadcrumb-item"><a href="{{ route('course-modules.index') }}">List</a></li>

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
                            <form action="{{ route('course-modules.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="categoryId">Category *</label>
                                                <select class="form-control js-basic-select2" name="course_category_id" id="categoryId">
                                                    <option value="" selected disabled>Select a Category</option>
                                                    @foreach($courseCategories as $courseCategory)
                                                        <option value="{{ $courseCategory->id }}" {{ old('course_category_id') == $courseCategory->id ? 'selected' : '' }}>{{ $courseCategory->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('course_category_id'))
                                                    <div class="text-danger">{{ $errors->first('course_category_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text" name="code" value="{{ old('code') }}"  id="code" class="form-control" placeholder="Enter Course Code" >
                                                @if($errors->has('code'))
                                                    <div class="text-danger">{{ $errors->first('code') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Name *</label>
                                                <input type="text" name="name" value="{{ old('name') }}"  id="name" class="form-control" placeholder="Enter Course Module Name" >
                                                @if($errors->has('name'))
                                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="training_type">Training Type *</label>
                                                <select class="form-control js-basic-select2" name="training_type" id="training_type">
                                                    <option value="1" {{ old('training_type') == '1' ? 'selected' : '' }}>Remote Learning </option>
                                                    <option value="0" {{ old('training_type') == '0' ? 'selected' : '' }}>Onsite Training</option>
                                                </select>
                                                @if($errors->has('training_type'))
                                                    <div class="text-danger">{{ $errors->first('training_type') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price *</label>
                                                <input type="text" name="price" value="{{ old('price') }}" id="price"  class="form-control" placeholder="Enter Price">

                                                @if($errors->has('price'))
                                                    <div class="text-danger">{{ $errors->first('price') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
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
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="rating">Rating</label>
                                                <input type="number" step="0.5" min="1" max="5" name="rating" value="{{ old('rating') ?? 5 }}" id="rating"  class="form-control" placeholder="Enter Rating">
                                                @if($errors->has('rating'))
                                                    <div class="text-danger">{{ $errors->first('rating') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="shortDescription">Short Description</label>
                                                <textarea id="shortDescription" class="form-control" name="short_description" rows="3" placeholder="Enter Short Description">{{ old('short_description') }}</textarea>
                                                @if($errors->has('short_description'))
                                                    <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="summernote">Description</label>
                                                <textarea class="form-control" id="summernote" name="description" rows="12"  placeholder="Write a Description">{{ old('description') }}</textarea>
                                                @if($errors->has('description'))
                                                <div class="text-danger">{{ $errors->first('description') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Payment Link</label>
                                                <input type="text" name="payment_link" value="{{ old('payment_link') }}"  id="payment_link" class="form-control" placeholder="Enter Course Payment Link" >
                                                @if($errors->has('payment_link'))
                                                    <div class="text-danger">{{ $errors->first('payment_link') }}</div>
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
@section('scripts')
    <script src="{{asset('js/backEnd/bootstrap.bundle.min.js')}}"></script>

    <script>
        $('#summernote').summernote({
            height: 300
        });
    </script>
@endsection

