@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Package Subscriptions/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Package Subscriptions</li>
                            <li class="breadcrumb-item"><a href="{{ route('package-subscriptions.index') }}">List</a>
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
                            <h4>Subscriber Details:</h4>
                            <div>

                            <h6>
                                <strong> Name: </strong>
                                <span>{{ $packageSubscription?->client?->user?->first_name }} {{ $packageSubscription?->client?->user?->last_name }}</span>
                            </h6>
                            <h6>
                                <strong> Email: </strong>
                                <span>{{ $packageSubscription?->client?->user?->email }}</span>
                            </h6>
                            <h6>
                                <strong> Phone: </strong>
                                <span>{{ $packageSubscription?->client?->user?->phone_number }}</span>
                            </h6>
                            @if($packageSubscription?->client?->address)
                                <strong> Email: </strong>
                                <span
                                    class="font-italic">{{ $packageSubscription->client?->address?->street }}, {{ $packageSubscription->client?->address?->suburb }} {{ $packageSubscription->client?->address?->state }} {{ $packageSubscription->client?->address?->post_code }}, {{ $packageSubscription->client?->address?->country }}</span>

                            @endif
                                <h6>
                                    <strong class="font-italic"> Status: </strong>
                                    <span
                                        class="badge {{$packageSubscription?->client?->status == 1 ? 'badge-success': 'badge-danger'}}">{{ $packageSubscription?->client?->status == 1 ? 'Active' : 'Inactive' }}</span>
                                </h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div>
                                <img src="{{ $packageSubscription->package?->thumbnail ?? asset('default/images/backend/no-image.png')  }}"
                                     style="height: 250px" class="rounded img-fluid img-thumbnail mx-auto"
                                     alt="{{ $packageSubscription->package?->name }}">
                                <div class="text-center pt-3">
                                    <h3>{{ $packageSubscription->package?->name ?? 'Not Assigned' }} </h3>
                                </div>
                                <h6><strong>Reference: </strong><span
                                        class="{{ $packageSubscription?->reference ? "" : "text-danger" }}">{{ $packageSubscription?->reference ?? 'Not Assigned' }}</span>
                                </h6>
                                <h6>
                                    <strong class="font-italic">Package Price: </strong>
                                    <span
                                        class="{{ $packageSubscription?->package_price ? '': 'text-danger'}}">${{ ($packageSubscription?->package_price)/100 }} </span>
                                </h6>
                                <h6>
                                    <strong class="font-italic">Discount Price: </strong>
                                    <span
                                        class="{{ $packageSubscription?->discount_price ? '0': 'text-danger'}}">${{ ($packageSubscription?->discount_price)/100 }}</span>
                                </h6>
                                <h6>
                                    <strong class="font-italic">Gst Price: </strong>
                                    <span
                                        class="{{ $packageSubscription?->gst_price ? '': 'text-danger'}}">${{ ($packageSubscription?->gst_price)/100}} </span>
                                </h6>
                                <h6>
                                    <strong class="font-italic">Total Price: </strong>
                                    <span
                                        class="{{ $packageSubscription?->total_price ? '0': 'text-danger'}}">${{ ($packageSubscription?->total_price)/100 }}</span>
                                </h6>
                                <h6>
                                    <strong class="font-italic">Payment Status: </strong>
                                    <span
                                        class="badge {{ $packageSubscription?->payment_status == 1 ? 'badge-success': 'badge-danger'}}">{{ $packageSubscription?->payment_status == 1 ? 'Paid' : 'Unpaid' }}</span>
                                </h6>
                                <h6>
                                    <strong class="font-italic">Subscription Status: </strong>
                                    <span>
                                     @if ($packageSubscription->subscription_status === 1)
                                            <span class="badge badge-success m-1">Active</span>
                                        @elseif($packageSubscription->subscription_status === 0)
                                            <span class="badge badge-danger m-1">Inactive</span>
                                        @else
                                            <span class="badge badge-danger m-1">Suspend</span>
                                        @endif
                                </span>
                                </h6>
                                <h6>
                                    <strong class="font-italic">Subscription End Date: </strong>
                                    <span
                                        class="{{ $packageSubscription?->subscription_end_date ? '0': 'text-danger'}}">{{ date('d F Y h:i A', strtotime($packageSubscription?->subscription_end_date))}}</span>
                                </h6>
                                <h6>
                                    <strong class="font-italic">Selected Courses: </strong>
                                    <span>
                                         @foreach($packageSubscription->courseModules as $key => $course)
                                            <span class="badge {{  $course->name?? '' ? 'badge-info': 'badge-warning'}}">{{  $course->name }}</span>

                                        @endforeach
                                    </span>
                                </h6>
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
