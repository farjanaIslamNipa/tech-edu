@extends('backEnd.layouts.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Packages/List</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Packages </li>
                            @can('package-create')
                                <li class="breadcrumb-item"><a href="{{ route('packages.create') }}">Create</a></li>
                            @endcan
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
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
                                <form action="{{ route('packages.index')}}" style="padding-bottom: 1.25rem" method="get">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-8">
                                            <div class="form-group">
                                                <input type="text" name="search_query" value="{{ Request::get('search_query') }}" class="form-control rounded" placeholder="Search by name"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-2">
                                            <div class="input-group">
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
                                        <th style="width: 20%">Image</th>
                                        <th style="width: 30%">Name</th>
                                        <th style="width: 30%">Package Type - Discount</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 5%" class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($packages as $key => $package)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $package?->thumbnail ?? asset('default/images/backend/no-image.png')}}" alt="{{ $package?->name }}"  class="img-thumbnail" style="height: 5rem; width: 5rem">
                                            </td>
                                            <td>
                                                <span class="{{ $package?->name ? '' : 'text-danger' }}">{{  $package?->name  ?? '' }}</span>
                                            </td>
                                            <td>
                                            @foreach ($package->packageTypes as $key => $packageType)
                                                <div>
                                                    <span class="">{{ $packageType?->type ?? '' }} </span> -  <span class="{{$packageType?->discount_percentage ? '' : 'text-danger' }}">{{$packageType?->discount_percentage ?? '0' }} % </span>
                                                </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                <form action="{{ route('packages.updateStatus', $package->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="{{ $package->status == 1 ? 0 : 1 }}">
                                                    <input type="hidden" name="redirect_route" value="{{ url()->full() }}">
                                                    <button type="submit" title="{{ $package->status == 1 ? "Click to Inactive" : "Click to Active" }}" class="badge {{ $package->status == 1 ? "badge-success" : "badge-danger" }}">{{ $package?->status == 1 ? "Active" : "Inactive" }}</button>
                                                </form>
                                            </td>
                                            <td class="d-flex text-right">
                                                <a class="link-btn mr-1" title="View"  href="{{ route('packages.show', $package->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a class="link-btn mr-1" title="Edit"  href="{{ route('packages.edit', ['package' => $package->id, 'redirect_route' => url()->full()]) }}">

                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a class="link-btn mr-1" title="Update Image"  href="#" data-toggle="modal" data-target="#imageUploadModal" onclick="assignImageUploadIdToModalFromAction(this)" data-route="{{ route('packages.updateImage', $package->id) }}">
                                                    <i class="fa-solid fa-file-image"></i>
                                                </a>
                                                <a class="link-btn" title="Delete"  href="#" data-toggle="modal" data-target="#deleteModal" onclick="assignDeleteRouteToDeleteForm(this)" data-route="{{ route('packages.destroy', $package->id) }}">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-start">
                                        Showing {{ $packages?->firstItem() ?? 0 }} to {{ $packages->lastItem() ?? 0 }} of total {{ $packages?->total() }} records.
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-sm-center">
                                        {{ $packages->links() }}
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
    <!-- Image Upload Modal -->
    <div class="modal fade" id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageUploadModalLabel">Upload Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="imageUploadFormId" method="POST" enctype="multipart/form-data" data-url="">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" id="imageInput" onchange="convertToBase64(this)" class="custom-file-input" >
                                <label id="customFileLabel" class="custom-file-label" for="imageInput">Choose file</label>
                                <input type="hidden" id="image" name="image" value="">
                                <input type="hidden" name="redirect_route" value="{{ url()->full()  }}">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Upload Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        function assignDeleteRouteToDeleteForm(target) {
            document.getElementById("deleteRoute").action = target.getAttribute('data-route');
        }

        function assignImageUploadIdToModalFromAction(target) {
            let imageUpdateRoute = target.getAttribute('data-route');
            document.getElementById('imageUploadFormId').setAttribute('action', imageUpdateRoute);
        }

        function convertToBase64(element){
            let file = element.files[0];

            document.getElementById('customFileLabel').innerText = file.name;

            let reader = new FileReader();
            reader.onloadend = function () {
                document.getElementById('image').value = reader.result;
            }

            reader.readAsDataURL(file);
        }
    </script>

@endsection

