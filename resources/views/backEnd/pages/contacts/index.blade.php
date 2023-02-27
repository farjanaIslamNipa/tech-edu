@extends('backEnd.layouts.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Contacts/List</h5>
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
                                <form action="{{ route('contacts.index')}}" style="padding-bottom: 1.25rem" method="GET">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="search_query" value="{{ Request::get('search_query') }}" class="form-control rounded" placeholder="Search by client personal info, address, subject or message part"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-3">
                                            <div class="input-group">
                                                <select class="form-control js-basic-select2" name="read_status">
                                                    <option value="" selected>Any Status</option>
                                                    <option value="1" {{ Request::get('read_status') == '1' ? 'selected' : '' }}>read</option>
                                                    <option value="0" {{ Request::get('read_status') == '0' ? 'selected' : '' }}>Unread</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-3">
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
                                        <th style="width: 20%">Reference</th>
                                        <th style="width: 30%">Client</th>
                                        <th style="width: 20%">Subject</th>
                                        <th style="width: 10%">Date</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 5%" class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($contacts as $key => $contact)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span>{{ $contact->reference }}</span>
                                            </td>
                                            <td>
                                                <div><span>{{ $contact?->client?->user?->first_name }} {{ $contact?->client?->user?->last_name }}</span></div>
                                                @if($contact?->client?->address)
                                                    <div><span>{{ $contact?->client?->address?->street }}, {{ $contact?->client?->address?->suburb }} {{ $contact?->client?->address?->state }} {{ $contact?->client?->address?->post_code }}</span></div>
                                                @endif
                                            </td>
                                            <td>
                                                <span>{{ $contact?->subject }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $contact->created_at->format('d F Y h:i A') }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('contacts.updateStatus', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="read_status" value="{{ $contact->read_status == 1 ? 0 : 1 }}">
                                                    <input type="hidden" name="redirect_route" value="{{ url()->full() }}">
                                                    <button type="submit" title="{{ $contact->read_status == 1 ? "Click to Unread" : "Click to Read" }}" class="badge {{ $contact->read_status == 1 ? "badge-info" : "badge-warning" }}">{{ $contact?->read_status == 1 ? "Read" : "Unread" }}</button>
                                                </form>
                                            </td>
                                            <td class="d-flex text-right">
                                                <a class="link-btn mr-1" title="View"  href="{{ route('contacts.show', $contact->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a class="link-btn" title="Delete"  href="#" data-toggle="modal" data-target="#deleteModal" onclick="assignDeleteRouteToDeleteForm(this)" data-route="{{ route('contacts.destroy', $contact->id) }}">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-start">
                                        Showing {{ $contacts->firstItem() ?? 0 }} to {{ $contacts?->lastItem() ?? 0 }} of total {{ $contacts->total() }} records.
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-sm-center">
                                        {{ $contacts->links() }}
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

