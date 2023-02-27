@extends('frontEnd.layouts.layout')
@section('title') Home @endsection
@section('meta-tag')
    <link rel="canonical" href="https://geekslearning.au" />
    <meta property="og:title" content="Home | Geeks Learning" />
    <meta property="og:url" content="https://geekslearning.au" />
    <meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
    <meta name="twitter:title" content="Home | Geeks Learning" />
    <meta name="twitter:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
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
    {{-- banner section --}}
    <div class="position-relative">
        <div class="home-banner">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-7 col-md-8 col-12" data-aos="fade-left" data-aos-duration="1000">
                        <div class="home-header-content">
                            <h1 style="color: #6069D8;" class="header-title">Geeks Learning</h1>
                            <h1 class="text-blue header-title">In Making Future Geeks</h1>
                            <p class="text-18 text-500">We provide hands on F2F and remote learning that is effective and has a proven track record.</p>
                            <div class="pt-4"><a class="view-course-btn" href="{{ route('website.getAllCurrentCourses') }}">All Programs</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- About us section --}}
    <div class="py-5 my-xl-5 my-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-md-0 mb-4">
                    <img data-aos="fade-down" data-aos-duration="1000" src="{{ asset('/images/frontEnd/home/about-image.png') }}" alt="About image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <div class="pl-3 pt-md-5 pt-0">
                        <h1 class="text-brand font-weight-bold header-small text-capitalize">About Geeks Learning</h1>
                        <p class="about-us-details mb-4">Geeks Learning offers hands-on training on computer hardware, home networking, coding, cyber security, operating systems, and more for kids.</p>
                        <a class="btn about-learn-more-btn text-600" href="{{ route('website.getAboutUsPage') }}">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end about-card-section pt-lg-0 pt-4" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-xl-10 col-lg-11">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mb-md-0 mb-3">
                            <div class="p-3 rounded h-100 bg-white about-us-card">
                                <img class="about-card-icon" src="{{ asset('/images/frontEnd/home/vision-icon.svg') }}" alt="">
                                <p class="about-card-text">Our <strong>vision</strong> is to deliver hands on training that is relative to your circumstances.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-md-0 mb-3">
                            <div class="p-3 rounded h-100 bg-white about-us-card">
                                <img class="about-card-icon" src="{{ asset('/images/frontEnd/home/mission-icon.svg') }}" alt="">
                                <p class="about-card-text">Our <strong>missionis</strong> to empower you with the knowledge and techniques that will propel your career to new heights.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-md-0 mb-3">
                            <div class="p-3 rounded h-100 bg-white about-us-card">
                                <img class="about-card-icon" src="{{ asset('/images/frontEnd/home/focus-icon.svg') }}" alt="">
                                <p class="about-card-text">Our <strong>focus</strong> on your strengths and provide what you require to achieve your goals. Assessment is a critical factor in the equation.​</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- OUR Packages SECTION --}}
    <section class="py-md-5 py-0">
        <div class="our-program-bg py-5">
            <div class="container py-md-3 py-0">
                <h1 class="text-700 text-brand text-center mb-4 pb-3">Our Packages</h1>
                <div data-aos="fade-up" data-aos-duration="1500" class="row justify-content-center">
                    @foreach ($packages as $package)
                    <div class="col-md-4 mb-4 px-lg-2 px-md-1 px-sm-5 px-2">
                        <div class="package-card bg-white h-100">
                            <div class="package-img">
                                <img src="{{ $package?->thumbnail ?? asset('/default/images/backend/no-image.png')}}" alt="{{ $package?->name }}">
                            </div>
                            <img class="curve" src="{{ asset('/images/frontEnd/package/image-shape.svg') }}" alt="">
                            <div class="text-center pb-4">
                                <div class="package-name">
                                    <h5 class="text-brand text-600 px-lg-5 px-md-0 px-sm-5 px-0 py-2 text-capitalize">{{ $package->name }}</h5>
                                </div>
                                <div class="package-details-btn pb-4 pt-2">
                                    <a href="{{ route('website.getPackage', $package->slug) }}">Package Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- COURSE CURRICULUM SECTION --}}
    <section id="course_curriculum">
        <course-curriculum
            :subscription="{{ $courseCategories }}"
            :test="1"
        />
    </section>
     {{-- testimonial section --}}
    @include('frontEnd.includes.client-review-section')
@endsection
@section('script')
<script>



</script>
@endsection
