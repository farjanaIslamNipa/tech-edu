@extends('backEnd.layouts.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Package Subscriptions/List</h5>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            @if(session('message'))
                <div class="col-12">
                    <div
                        class="alert @if(session('message')['status'] == 'success') alert-success @elseif(session('message')['status'] == 'danger') alert-danger @else alert-warning  @endif alert-dismissible fade show"
                        role="alert">
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
                    <div class="col-12">
                        <div class="card">
                            <!-- ./card-header -->
                            <div class="card-body">
                                <form action="{{ route('package-subscriptions.index')}}" style="padding-bottom: 1.25rem"
                                      method="get">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="search_query"
                                                       value="{{ Request::get('search_query') }}"
                                                       class="form-control rounded"
                                                       placeholder="Search by Client Name, Address"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <div class="form-group">
                                                <select class="form-control js-basic-select2" name="payment_status">
                                                    <option value="" selected>Payment Status</option>
                                                    <option
                                                        value="1" {{ Request::get('payment_status') == '1' ? 'selected' : '' }}>
                                                        Paid
                                                    </option>
                                                    <option
                                                        value="0" {{ Request::get('payment_status') == '0' ? 'selected' : '' }}>
                                                        Unpaid
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <div class="form-group">
                                                <select class="form-control js-basic-select2" name="payment_status">
                                                    <option value="" selected>Subscription Status</option>
                                                    <option
                                                        value="1" {{ Request::get('subscription_status') == '1' ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option
                                                        value="0" {{ Request::get('subscription_status') == '0' ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>
                                                    <option
                                                        value="0" {{ Request::get('subscription_status') == '2' ? 'selected' : '' }}>
                                                        Suspend
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-primary btn-block">Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <table class="table col-12 table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">SL</th>
                                        <th style="width: 10%">Reference</th>
                                        <th style="width: 15%">Client</th>
                                        <th style="width: 20%">Package</th>
                                        <th style="width: 15%">Total Price</th>
                                        <th style="width: 15%">Subscription Status</th>
                                        <th style="width: 15%">Payment Status</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($packageSubscriptions as $key => $packageSubscription)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span>{{ $packageSubscription?->reference ?? "Not Generated" }}</span>
                                            </td>
                                            <td>
                                                <div>
                                                    <span>{{ $packageSubscription?->client?->user?->first_name }} {{ $packageSubscription?->client?->user?->last_name }}</span>
                                                </div>
                                                @if($packageSubscription?->client?->address)
                                                    <div>
                                                        <span>{{ $packageSubscription?->client?->address?->street }}, {{ $packageSubscription?->client?->address?->suburb }} {{ $packageSubscription?->client?->address?->state }} {{ $packageSubscription?->client?->address?->post_code }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <span>{{ $packageSubscription->package->name }}</span>
                                            </td>
                                            <td>
                                                <span>${{number_format($packageSubscription->total_price/100, 2)}}</span>

                                            </td>
                                            <td>
{{--                                                data-toggle="modal" data-target="#statusModal"--}}
                                                <button class="btn" href="#" onclick="subscriptionStatusForm(this)"
                                                     current="{{$packageSubscription->subscription_status}}"   status-data-route="{{ route('package-subscriptions.updateSubscriptionStatus', $packageSubscription->id) }}">
                                                    @if ($packageSubscription->subscription_status === 1)
                                                        <span class="badge badge-success m-1">Active</span>
                                                    @elseif($packageSubscription->subscription_status === 0)
                                                        <span class="badge badge-danger m-1">Inactive</span>
                                                    @else
                                                        <span class="badge badge-warning m-1">Suspend</span>
                                                    @endif
                                                </button>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('package-subscriptions.updatePaymentStatus', $packageSubscription->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="payment_status"
                                                           value="{{ $packageSubscription->payment_status == 1 ? 0 : 1 }}">
                                                    <input type="hidden" name="redirect_route"
                                                           value="{{ url()->full() }}">
                                                    <button type="submit"
                                                            title="{{ $packageSubscription->payment_status == 1 ? "Click to Unpaid" : "Click to Paid" }}"
                                                            class="badge {{ $packageSubscription->payment_status == 1 ? "badge-success" : "badge-danger" }}">{{ $packageSubscription?->payment_status == 1 ? "Paid" : "Unpaid" }}</button>
                                                </form>
                                            </td>

                                            <td class="d-flex text-right">
                                                <a class="link-btn mr-1" title="View"
                                                   href="{{ route('package-subscriptions.show', $packageSubscription->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a class="link-btn" title="Delete" href="#" data-toggle="modal"
                                                   data-target="#deleteModal"
                                                   onclick="assignDeleteRouteToDeleteForm(this)"
                                                   data-route="{{ route('package-subscriptions.destroy', $packageSubscription->id) }}">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-start">
                                        Showing {{ $packageSubscriptions?->firstItem() ?? 0 }}
                                        to {{ $packageSubscriptions->lastItem() ?? 0 }} of
                                        total {{ $packageSubscriptions?->total() }} records.
                                    </div>
                                    <div
                                        class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-sm-center">
                                        {{ $packageSubscriptions->links() }}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-circle fa-5x mt-3"></i>
                    <h3 class="pt-4 mb-2 text-dark">Are you sure?</h3>
                    <p class="text-secondary">Do you really want to delete this records? This process can't be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="" id="deleteRoute" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" id="" class="btn btn-danger">Delete it.</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="" data-toggle="modal" data-target="#statusModal"></div>


    {{-- Subscription Status Modal --}}
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div>
                        <div class="">
                            <form
                                action=""
                                id="subscriptionStatusRoute" method="POST">
                                @csrf
                                @method('PUT')

                            <div class="form-group">
                                <label for="subscription_status">Package Subscription Status *</label>
                                <input type="hidden" name="redirect_route" value="{{ url()->full() }}">
                                <input type="hidden" name="subscription_status"
                                       value="{{ $packageSubscription->subscription_status == 1 ? 0 : 2 }}">

                                <select id="subscription_status" class="form-control js-basic-select2"
                                        name="subscription_status">
                                    <option value="" disabled selected>None</option>
                                    <option
                                        {{$packageSubscription->subscription_status== 1 ? 'selected' : '' }} value="1">
                                        Active
                                    </option>
                                    <option
                                        {{ $packageSubscription->subscription_status === 0 ? 'selected' : '' }} value="0">
                                        Inactive
                                    </option>
                                    <option
                                        {{ $packageSubscription->subscription_status === 2 ? 'selected' : '' }} value="2">
                                        Suspend
                                    </option>
                                </select>
                                @if($errors->has('subscription_status'))
                                    <div class="text-danger">{{ $errors->first('subscription_status') }}</div>
                                @endif
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" id="" class="btn btn-success">Submit</button>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endsection
            @section('scripts')
                <script>
                    function assignDeleteRouteToDeleteForm(target) {
                        document.getElementById("deleteRoute").action = target.getAttribute('data-route');
                    }

                    function subscriptionStatusForm(target) {
                        document.querySelector('[data-target="#statusModal"]').click();
                        document.getElementById("subscriptionStatusRoute").action = target.getAttribute('status-data-route');
                        console.log('adsf');
                        const allOptions = (document.getElementById('subscription_status'));
                        allOptions.value = target.getAttribute('current');



                        var country = document.getElementById("subscription_status");
                        country.options[country.options.selectedIndex].checked=true;
                        console.log(country.options[country.options.selectedIndex])
                    }
                </script>

@endsection

