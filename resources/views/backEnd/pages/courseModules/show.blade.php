
@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Course Modules/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Course Modules</li>
                            <li class="breadcrumb-item"><a href="{{ route('course-modules.index') }}">List</a></li>
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
                            <div class="text-center">
                                <img src="{{ $courseModule?->image ?? asset('default/images/backend/courseModules/no-image.png')  }}" style="height: auto" class="rounded img-fluid img-thumbnail mx-auto" alt="{{ $courseModule?->name }}">
                                <h5>
                                    <span>{{ $courseModule?->name }}</span>
                                    @if($courseModule?->code)
                                        <span class="font-italic">&nbsp;{{ $courseModule?->code }}</span>
                                    @endif
                                </h5>
                                <h6>Category: {{ $courseModule?->courseCategory?->name ?? "Not assigned" }}</h6>
                            </div>
                            <div class="h6">
                                <span>Status: </span>
                                @if ($courseModule?->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </div>
                            <div class="h6">
                                <span>Training Type: </span>
                                @if ($courseModule?->training_type == 1)
                                    <span class="badge badge-success">Remote Learning</span>
                                @else
                                    <span class="badge badge-secondary">Onsite Training</span>
                                @endif
                            </div>
                            <h6>Price: {{ $courseModule?->price ?? '' }}</h6>
                            <h6>Payment Link: {{ $courseModule?->payment_link ?? "Not assigned" }}</h6>


                            <div class="bg-light">
                                <strong>Short Description: </strong>
                                <p>{{ $courseModule?->short_description }}</p>
                            </div>
                            <div class="bg-light">
                                <strong>Description: </strong>
                                {!! $courseModule?->description !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
