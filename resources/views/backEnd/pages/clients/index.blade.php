@extends('backEnd.layouts.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Clients/List</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Clients</li>
                            @can('client-create')
                                <li class="breadcrumb-item"><a href="{{ route('clients.create') }}">Create</a></li>
                            @endcan
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
                    <div class="col-12">
                        <div class="card">
                            <!-- ./card-header -->
                            <div class="card-body">
                                <form action="{{ route('clients.index')}}" style="padding-bottom: 1.25rem" method="GET">
                                    <div class="row form-group">
                                        <div class="col-12 col-md-9">
                                            <div class="form-group">
                                                <input type="text" name="search_query" value="{{ Request::get('search_query') }}" id="searchQuery" class="form-control rounded" placeholder="Search by name, email, phone number or address"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-primary btn-block">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <table class="table col-12 table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">SL</th>
                                        <th style="width: 25%">Full Name</th>
                                        <th style="width: 15%">Email</th>
                                        <th style="width: 15%">Phone Number</th>
                                        <th style="width: 35%">Address</th>
                                        <th style="width: 5%" class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($clients as $key => $client)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span>{{ $client?->user?->first_name ?? '' }} {{ $client?->user?->last_name ?? '' }}</span>
                                            </td>

                                            <td>
                                                <span>{{ $client?->user?->email ?? 'Not provided' }}</span>
                                            </td>

                                            <td>
                                                <span>{{ $client?->user?->phone_number ?? 'Not provided' }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $client?->address?->street }}, {{ $client?->address?->suburb }} {{ Str::upper($client?->address?->state) }} {{ $client?->address?->post_code }}, {{ $client?->address?->country }}</span>
                                            </td>
                                            <td class="d-flex justify-content-end">
                                                <a title="edit" class="link-btn mr-1" href="{{ route('clients.edit', ['client' => $client->id, 'redirect_route' => url()->full()]) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a title="Delete" class="link-btn" href="#" data-toggle="modal" data-target="#deleteModal" onclick="assignDeleteRouteToDeleteForm(this)" data-route="{{ route('clients.destroy', $client->id) }}">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-start">
                                        Showing {{ $clients?->firstItem() ?? 0 }} to {{ $clients->lastItem() ?? 0 }} of total {{ $clients?->total() }} records.
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-sm-center">
                                        {{ $clients->links() }}
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-circle fa-5x mt-3"></i>
                    <h3 class="pt-4 mb-2 text-dark">Are you sure?</h3>
                    <p class="text-secondary">Do you really want to delete this records? This process can't be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="" id="deleteRoute" method="post">
                        @csrf
                        @method('delete')
                        <button  type="submit" id="" class="btn btn-danger">Delete it.</button>
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
    </script>

@endsection

