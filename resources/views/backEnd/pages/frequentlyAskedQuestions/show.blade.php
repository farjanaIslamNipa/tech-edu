
@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>FAQs/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">FAQs</li>
                            <li class="breadcrumb-item"><a href="{{ route('frequently-asked-questions.index') }}">List</a></li>
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
                            <h5>Question: {{ $frequentlyAskedQuestion?->question ?? 'Not Provided' }}</h5>
                            <p><span class="font-weight-bold">Answer: </span><span>{{ $frequentlyAskedQuestion->answer ?? '' }}</span>
                            </p>
                            <p>Status: <span class="badge {{ $frequentlyAskedQuestion?->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $frequentlyAskedQuestion?->status == 1 ? "Active" : "Inactive" }}</span></p>
                            <p>Order: <span class="{{ $frequentlyAskedQuestion?->order ? '' : 'text-danger' }}">{{ $frequentlyAskedQuestion?->order ?? "Not Provided" }}</span></p>

                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
