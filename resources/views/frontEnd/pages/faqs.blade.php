@extends('frontEnd.layouts.layout')
@section('title') FAQs @endsection
@section('meta-tag')
<link rel="canonical" href="https://geekslearning.au" />
<meta property="og:title" content="FAQs | Geeks Learning" />
<meta property="og:url" content="https://geekslearning.au" />
<meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
<meta name="twitter:title" content="FAQs | Geeks Learning" />
<meta name="twitter:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
@endsection

@section('content')
    <div class="">
        <div class="faq-header-bg text-center">
            <h1 class="text-500 faq-header-top">Frequently asked questions</h1>
            <p class="text-500 faq-header-description">The answers to all the finer details.</p>

        </div>
            {{-- skill test component --}}
    <div class="">
        @include('frontEnd.includes.skillTest')
    </div>
        <div class="container faq-question-container" class="accordion" id="accordionExample">
            <div class="row">
                @foreach($faqs as $faq)
                    <div class="col-12">
                        <div class="card form-group">
                            <div class="card-header collapsed faq-question-title d-flex" data-toggle="collapse"
                                 data-target="#collapseThree" aria-expanded="false">
                                <span class="title">{{ $faq->question }}</span>
                                <span class="accicon ml-auto"><i class="fas fa-angle-down rotate-icon"></i></span>
                            </div>
                            <div id="collapseThree" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <h1 class="text-capitalize text-primary text-center text-500 faq-footer-text ">further any query</h1>
        </div>

        <div class="d-flex justify-content-center mb-5">
            <button class="d-flex align-items-center faq-contact-us-btn">
                <span  class="faq-contact-us-text text-500">conatct us </span>
                <span class="ml-1"><img style="height: 15px;width: 15px;" src="{{ asset('images/frontEnd/faq/arrow-double-right.svg') }}" alt=""></span>
            </button>
        </div>









    </div>

    </div>
@endsection
