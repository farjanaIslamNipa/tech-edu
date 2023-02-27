
@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Roles/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> Roles</li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">List</a></li>
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
                            <h5>
                                <span>Role Name:</span>
                                <span class="badge badge-info">{{ $role?->name ?? 'Not Assigned' }}</span>
                            </h5>
                            <h5>Assigned Permission:</h5>
                            <div class="row col-12">
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $permission)
                                        <span class="col-12 col-sm-12 col-md-3">
                                            <span class="badge badge-success m-1">{{ Str::headline($permission?->name) }}</span>
                                        </span>
                                    @endforeach
                                @else
                                    <span>No Permission Assigned</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
