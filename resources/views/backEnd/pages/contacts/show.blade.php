
@extends('backEnd.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>Contacts/View</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Contacts</li>
                            <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">List</a></li>
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
                                <strong>From: </strong>
                                <span>{{ $contact?->client?->user?->first_name }} {{ $contact?->client?->user?->last_name }}</span>
                            </h5>
                            @if($contact?->client?->address)
                            <h6>
                                <span class="font-italic">{{ $contact->client?->address?->street }}, {{ $contact->client?->address?->suburb }} {{ $contact->client?->address?->state }} {{ $contact->client?->address?->post_code }}, {{ $contact->client?->address?->country }}</span>
                            </h6>
                            @endif
                            <h6>
                                <strong>Subject: </strong>
                                <span class="{{ $contact?->subject ? "" : "text-danger" }}">{{ $contact->subject ?? 'Not provided'}}</span>
                            </h6>

                            <h6><strong>Reference: </strong><span class="{{ $contact?->reference ? "" : "text-danger" }}">{{ $contact?->reference ?? 'Not assigned' }}</span></h6>
                            <p>
                                {{ $contact->message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
