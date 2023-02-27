@extends('backEnd.layouts.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>FAQs/List</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">FAQs</li>
                            @can('frequently-asked-question-create')
                                <li class="breadcrumb-item"><a href="{{ route('frequently-asked-questions.create') }}">Create</a></li>
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
                                <form action="{{ route('frequently-asked-questions.index')}}" style="padding-bottom: 1.25rem" method="get">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="">
                                                <input type="text" name="search_query" value="{{ Request::get('search_query') }}" class="form-control rounded" placeholder="Search by question or answer"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <select class="form-control js-basic-select2" name="status">
                                                    <option value="" selected>Any Status</option>
                                                    <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ Request::get('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
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
                                        <th style="width: 70%">Question</th>
                                        <th style="width: 10%">Order</th>
                                        <th style="width: 10%">status</th>
                                        <th style="width: 5%;" class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($frequentlyAskedQuestions as $key => $frequentlyAskedQuestion)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <span>{{ $frequentlyAskedQuestion?->question ?? '' }} </span>
                                            </td>
                                            <td>{{ $frequentlyAskedQuestion->order }}</td>
                                            <td>
                                                <form action="{{ route('frequently-asked-questions.updateStatus', $frequentlyAskedQuestion->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="{{ $frequentlyAskedQuestion->status == 1 ? 0 : 1 }}">
                                                    <input type="hidden" name="redirect_route" value="{{ url()->full() }}">
                                                    <button type="submit" title="{{ $frequentlyAskedQuestion->status == 1 ? "Click to Inactive" : "Click to Active" }}" class="badge {{ $frequentlyAskedQuestion->status == 1 ? "badge-success" : "badge-danger" }}">{{ $frequentlyAskedQuestion?->status == 1 ? "Active" : "Inactive" }}</button>
                                                </form>
                                            </td>
                                            <td class="d-flex justify-content-end">
                                                <a class="link-btn mr-1" title="View"  href="{{ route('frequently-asked-questions.show', $frequentlyAskedQuestion->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a class="link-btn mr-1" title="Edit"  href="{{ route('frequently-asked-questions.edit', ['frequently_asked_question' => $frequentlyAskedQuestion->id, 'redirect_route' => url()->full()]) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a title="Delete" class="link-btn" href="#" data-toggle="modal" data-target="#deleteModal" onclick="assignDeleteRouteToDeleteForm(this)" data-route="{{ route('frequently-asked-questions.destroy', $frequentlyAskedQuestion->id) }}">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-start">
                                        Showing {{ $frequentlyAskedQuestions?->firstItem() ?? 0 }} to {{ $frequentlyAskedQuestions->lastItem() ?? 0 }} of total {{ $frequentlyAskedQuestions?->total() }} records.
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-sm-center">
                                        {{ $frequentlyAskedQuestions->links() }}
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="frequentlyAskedQuestionDeleteLabel" aria-hidden="true">
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

