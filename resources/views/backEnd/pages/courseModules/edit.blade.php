@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Course Modules/Edit</h5>
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
                            <form action="{{ route('course-modules.update', $courseModule->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="categoryId">Category *</label>
                                                <select id="categoryId" class="form-control js-basic-select2" name="course_category_id">
                                                    <option value="" disabled >Select a Category</option>
                                                    @foreach($courseCategories as $courseCategory)
                                                        <option {{ $courseCategory?->id == $courseModule?->course_category_id ? 'selected' : '' }} value="{{ $courseCategory->id }}">{{ $courseCategory->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('course_category_id'))
                                                    <div class="text-danger">{{ $errors->first('course_category_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Code</label>
                                                <input type="text" name="code" value="{{ $courseModule?->code ?? '' }}" id="code" class="form-control" placeholder="Enter Code">
                                                @if($errors->has('code'))
                                                    <div class="text-danger">{{ $errors->first('code') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Name *</label>
                                                <input type="text" name="name" value="{{ $courseModule?->name ?? '' }}" id="name" class="form-control" placeholder="Enter Course Module Name">
                                                @if($errors->has('name'))
                                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="training_type">Training Type *</label>
                                                <select id="status" class="form-control js-basic-select2" name="training_type">
                                                    <option value="" disabled selected>None</option>
                                                    <option {{ $courseModule?->training_type === 1 ? 'selected' : '' }} value="1">Remote Learning</option>
                                                    <option {{ $courseModule?->training_type == 0 ? 'selected' : '' }} value="0">Onsite Training</option>
                                                </select>
                                                @if($errors->has('training_type'))
                                                    <div class="text-danger">{{ $errors->first('training_type') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" value="{{ $courseModule?->price /100?? '' }}" id="price" class="form-control" placeholder="Enter Price in Cents">
                                                @if($errors->has('price'))
                                                    <div class="text-danger">{{ $errors->first('price') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select id="status" class="form-control js-basic-select2" name="status">
                                                    <option value="" disabled selected>None</option>
                                                    <option {{ $courseModule?->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                                    <option {{ $courseModule?->status === 0 ? 'selected' : '' }} value="0">Inactive</option>
                                                </select>
                                                @if($errors->has('status'))
                                                    <div class="text-danger">{{ $errors->first('status') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="rating">Rating</label>
                                                <input type="text" name="rating" value="{{ $courseModule?->rating ?? '' }}" id="rating" class="form-control" placeholder="Enter Rating">
                                                @if($errors->has('rating'))
                                                    <div class="text-danger">{{ $errors->first('rating') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="shortDescription">Short Description</label>
                                                <textarea id="shortDescription" class="form-control" name="short_description" rows="3" placeholder="Write a Short Description">{{ $courseModule?->short_description ?? '' }}</textarea>
                                                @if($errors->has('short_description'))
                                                    <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="summernote">Description</label>
                                                <textarea class="form-control" id="summernote" name="description" rows="12"  placeholder="Write a Description">{{ $courseModule?->description ?? '' }}</textarea>
                                                     @if($errors->has('description'))
                                                     <div class="text-danger">{{ $errors->first('description') }}</div>
                                                     @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Payment Link</label>
                                                <input type="text" name="payment_link" value="{{ $courseModule?->payment_link ?? '' }}" id="payment_link" class="form-control" placeholder="Enter Subscription Payment Link">
                                                @if($errors->has('payment_link'))
                                                    <div class="text-danger">{{ $errors->first('payment_link') }}</div>
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
@section('scripts')
    <script src="{{asset('js/backEnd/bootstrap.bundle.min.js')}}"></script>
    <script>
        $('#summernote').summernote({
            height: 300
        });
    </script>
@endsection
