@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Package/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Package</li>
                            <li class="breadcrumb-item"><a href="{{ route('packages.index') }}">List</a></li>
                            <li class="breadcrumb-item">
                              <a href="{{ route('packages.edit', ['package' => $package->id, 'redirect_route' => url()->full()]) }}">Edit</a>
                            </li>
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

                                <img src="{{ $package?->thumbnail ?? asset('default/images/backend/no-image.png')  }}"
                                     style="height: 200px" class="rounded img-fluid img-thumbnail mx-auto"
                                     alt="{{ $package?->name }}">
                                <h5 class="mb-1 text-center pt-3 pb-2">{{ $package?->name ?? 'Not Assigned' }}
                                <span>
                                     @if($package->status == '1')
                                        <span class="badge badge-success m-1">Active</span>
                                    @else
                                        <span class="badge badge-danger m-1">Inactive</span>
                                    @endif
                                </span>
                                </h5>
                            </div>
                            <div class="row col-12 mb-2">
                                @foreach ($package->packageTypes as $key => $packageType)

                                    <div class="row col-12">
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <strong class="font-italic">Type: </strong><span
                                                class="{{ $packageType?->type ? '': 'text-danger'}}">{{ $packageType?->type }} </span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <strong class="font-italic">Discount: </strong><span
                                                class="{{ $packageType?->discount_percentage ? '0': 'text-danger'}}">{{ $packageType?->discount_percentage?? '0' }} %</span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <strong class="font-italic">Min Course: </strong><span
                                                class="{{ $packageType?->minimum_course_count ? '': 'text-danger'}}">{{ $packageType?->minimum_course_count }}</span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4">
                                            <strong class="font-italic">Payment Link: </strong><span
                                                class="{{ $packageType?->payment_link ? '': 'text-danger'}}">{{ $packageType?->payment_link }}</span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <strong class="font-italic">Status: </strong>
                                            <span class="badge {{ $packageType?->status == 1 ? 'badge-success': 'badge-danger'}}">{{ $packageType?->status == 1 ? 'Active' : 'Inactive' }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <strong>Courses: </strong>
                                    @foreach($package->courseModules as $key => $course)
                                        <span class="badge {{  $course->name?? '' ? 'badge-info': 'badge-warning'}}">{{  $course->name }}</span>

                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <strong>Short Description: </strong>
                                    <span
                                        class="{{ $package?->short_description ? '': 'text-danger'}}">{{ $package?->short_description?? 'Not Provided' }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <strong>Description: </strong>
                                    <span
                                        class="{{ $package?->description ? '': 'text-danger'}}">{!! $package?->description?? 'Not Provided' !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection



