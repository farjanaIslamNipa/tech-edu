@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Settings/Edit</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Settings</li>
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
                            <form action="{{ route('settings.noticeUpdate', $setting->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label for="status">Notice Status *</label>
                                                <select id="status" class="form-control js-basic-select2" name="status">
                                                    <option value="" disabled selected>Select One</option>
                                                    <option {{ $settingValue?->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                                    <option {{ $settingValue?->status == '0' ? 'selected' : '' }} value="0">Inactive</option>
                                                </select>
                                                @if($errors->has('status'))
                                                    <div class="text-danger">{{ $errors->first('status') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="summernote">Notice Value*</label>
                                                <textarea class="form-control" id="summernote" name="notice" rows="12"  placeholder="Write a Notice Description">{{$settingValue->notice}}</textarea>
                                                @if($errors->has('notice'))
                                                    <div class="text-danger">{{ $errors->first('notice') }}</div>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
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
