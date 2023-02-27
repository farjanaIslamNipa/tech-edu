@extends('frontEnd.layouts.layout')
@section('title') Program Modules @endsection
@section('meta-tag')
    <meta name="description"  content="We provide hands on training that is effective and with a proven track record" />
    <meta name="keywords"  content="learning, courses, training, We provide hands on training that is effective and with a proven track record" />
    {{-- <link rel="canonical" href="https://www.geekscrs.com.au/about-us" /> --}}
    <meta property="og:title" content="Courses | Geeks Learning" />
    <meta property="og:type" content="website" />
    {{-- <meta property="og:url" content="https://www.geekscrs.com.au/about-us" /> --}}
    {{-- <meta property="og:image" content="{{ asset('frontend/images/social-image.png') }}" /> --}}
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:site_name" content="Geeks Learning" />
    {{-- <meta property="fb:app_id" content="1911587015772569" /> --}}
    <meta property="og:description" content="We provide hands on training that is effective and with a proven track record" />
    <meta name="twitter:card" content="summary" />
    {{-- <meta name="twitter:domain" content="geekscrs.com.au" /> --}}
    <meta name="twitter:title" content="Courses | Geeks Learning" />
    <meta name="twitter:description" content="We provide hands on training that is effective and with a proven track record" />
    {{-- <meta name="twitter:image" content="{{ asset('frontend/images/social-image.png') }}" /> --}}
    {{-- <meta itemprop="image" content="{{ asset('frontend/images/social-image.png') }}" /> --}}
@endsection

@section('content')
    <div style="background-color: #F1F6F9; margin-top:-20px" class="py-5">
        <div class="container">
            <div class="">
                <h1 class="text-primary text-500 mb-3 text-center">All Programs</h1>
                <div class="row">
                    <div class="col-lg-7 col-12  mx-auto">
                        <form method="get">
                            <div class="px-4 position-relative mt-4">
                                <input name="search_query" value="{{ Request::get('search_query') }}" id="searchQuery" class="form-control course-search-input" type="text" placeholder="Search Programs">
                                <button type="submit" class="qualification-search-btn"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5">
                {{-- Courses --}}
                    <div class="row">
                        @foreach($courseCategories as $courseCategory)
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="course-description">
                                <img  class="course-img" src="{{ $courseCategory?->image ?? asset('default/images/backend/no-image.png') }}" alt="">
                                {{-- <img  class="course-img" src="{{ $courseCategory?->image ?? asset('default/images/backend/courseModules/no-image.png') }}" alt=""> --}}
                                <div class="course-title">
                                    <p class="mb-0 text-500 ">{{ Str::upper($courseCategory?->name) }}</p>
                                </div>
                                <div class="course-hover-content">
                                    <div class="course-hover-details">
                                        <h5 class="text-500 course-package-name mb-0 pb-0">
                                            {{ Str::upper($courseCategory?->name) }}
                                        </h5>
                                        <ul class="pl-4">
                                            @foreach($courseCategory?->courseModules as $key => $course)
                                                <li class="course-name-list">
                                                    <span>{{ $course?->name }}</span>
                                                    @if($course->code)
                                                        <span>({{ $course?->code }})</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="text-right">
                                            <a class="course-slider-hover-btn" href="{{ route('website.getCourseCategoryPage', $courseCategory->slug) }}">Find More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    {{-- testimonial section --}}
    @include('frontEnd.includes.client-review-section')
    </div>
@endsection
