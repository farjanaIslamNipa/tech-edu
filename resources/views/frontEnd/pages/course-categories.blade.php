@extends('frontEnd.layouts.layout')
@section('title')
    {{ $courseCategory?->name }}
@endsection
@section('meta-tag')
    <link rel="canonical" href="https://geekslearning.au/programs/{{ $courseCategory?->slug }}" />
    <meta property="og:title" content="{{ $courseCategory?->name }} | Geeks Learning" />
    <meta property="og:url" content="https://geekslearning.au/programs/{{ $courseCategory?->slug }}" />
    <meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
    <meta name="twitter:title" content="{{ $courseCategory?->name }} | Geeks Learning" />
    <meta name="twitter:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
    <meta name="description"  content="{{ $courseCategory?->short_description }}" />
    <meta name="keywords"  content="Geeks Learning, {{ $courseCategory?->name }}, {{ $courseCategory?->code }}" />
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '879767379702949');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=879767379702949&ev=PageView
&noscript=1"/>
    </noscript>
@endsection

@section('content')
    <header>
        <div class="container">
            <div style="background-image: url('{{ $courseCategory?->image ?? asset('default/images/backend/courseModules/no-image.png') }}')" class="course-banner d-flex align-items-center justify-content-center">
                {{-- <div style="background-image: url('{{ $courseCategory?->image ?? asset('default/images/backend/no-image.png') }}')" class="course-banner d-flex align-items-center justify-content-center"> --}}
                <div class="col-lg-6 col-md-7">
                    <div class="text-center text-white">
                        <h1>{{ $courseCategory->name }}</h1>
                        @if($courseCategory?->short_description)
                            <p class="mb-0">{{ $courseCategory?->short_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main style="background: rgba(241, 246, 249, 0.51);" class="py-5">
        <div class="container">
            <h4 class="text-blue">Geeks Learning can assist you:</h4>
            <section class="py-3">
                @foreach($courseCategory?->courseModules as $course)
                    <article>
                        <div style="border-radius: 5px; box-shadow: rgba(50, 50, 93, 0.25) 0 6px 12px -2px, rgba(0, 0, 0, 0.3) 0 3px 7px -3px;" class="d-md-flex d-block w-100 bg-white  mb-4 course-card position-relative">
                        <div class="text-md-left text-center">
                            <img class="course-image" src="{{ $course?->image ?? asset('default/images/backend/no-image.png')}}" alt="{{ $course->name }}">
                        </div>
                        <div class="py-3 px-4 w-100">
                            <h5 class="font-weight-bold text-brand">{{ $course->name }} @if($course->code) ({{ $course->code }}) @endif</h5>
                            @if($course->short_description)
                                <p class="mb-0">{{ $course->short_description }}</p>
                            @endif
                            <div class="text-right know-details-btn">
                                <hr class="d-xl-block d-none">
                                <a href="{{ route('website.getSingleCourseModulePage', $course->slug) }}" class="text-blue font-weight-bold qualification-link"><span>Know Details</span> <span><i class="fas fa-long-arrow-alt-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                    </article>
                @endforeach
            </section>
        </div>
    </main>
@endsection
