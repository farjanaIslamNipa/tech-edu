
@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Course Categories/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Course Categories</li>
                                <li class="breadcrumb-item"><a href="{{ route('course-categories.index') }}">List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 card">
                        <div class="card-body">
                            <h5 class="mb-1 text-center">{{ $courseCategory?->name ?? 'Not Assigned' }}</h5>
                            <p class="bg-light mb-1">
                                <strong>Short Description: </strong>
                                <span>{{ $courseCategory->short_description ?? '' }}</span>
                            </p>
                            <div class="h6">
                                <span>Status: </span>
                                @if ($courseCategory->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </div>
                            <div class="h6">
                                <span>Is Primary?: </span>
                                @if ($courseCategory->is_primary == 1)
                                    <span class="badge badge-success">Primary</span>
                                @else
                                    <span class="badge badge-info">Others</span>
                                @endif
                            </div>
                            <h6>Course Color Code : {{ $courseCategory?->course_color_code  ?? '' }}</h6>
                            <h6>Background Color Code : {{ $courseCategory?->background_color_code  ?? '' }}</h6>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
