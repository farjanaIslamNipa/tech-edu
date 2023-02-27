@extends('frontEnd.layouts.layout')
@section('title') {{ $courseModule?->name }} @endsection
@section('meta-tag')
    <link rel="canonical" href="https://geekslearning.au/program-module/{{ $courseModule?->slug }}" />
    <meta property="og:title" content="{{ $courseModule?->name }} | Geeks Learning" />
    <meta property="og:url" content="https://geekslearning.au/program-module/{{ $courseModule?->slug }}" />
    <meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
    <meta name="twitter:title" content="{{ $courseModule?->name }} | Geeks Learning" />
    <meta name="twitter:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
    <meta name="description"  content="{{ $courseModule?->short_description }}" />
    <meta name="keywords"  content="Geeks Learning, {{ $courseModule?->name }}" />
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
    <div>
        <div class="container">
            <div class="row py-md-5 py-4 d-flex">
                <div class="col-lg-4 mb-lg-0 mb-4 text-center">
                    <img class="img-fluid" src="{{ $courseModule->image ?? asset('default/images/backend/no-image.png') }}" alt="{{ $courseModule->name }}">
                    {{-- <img src="{{ $qualification->image ?? asset('default/images/backend/courseModules/no-image.png') }}"
                        class="qualification-image-size" alt=""> --}}
                </div>
                <div class="col-lg-8">
                    <div>
                        <h1 class="text-blue text-500 single-course-header mb-2">{{ $courseModule->name }}</h1>
                        <p class="text-500" style="color: #5E5C5C;">{{ $courseModule->short_description }}</p>
                        <div>
                            @for($i=1; $i <= $courseModule->rating; $i++)
                            <span class="text-orange"><i class="fa-solid fa-star mr-1"></i></span>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  style="background-color: #F1F6F9">
            <div class="container py-md-5 py-5">
                <div class="row">
                    <div class="col-lg-8 ">
                        @if ($courseModule?->description)
                        <div class="course-overview-section">
                            <h1 class="text-brand text-600 course-overview-header pb-0 mb-3">Description:</h1>
                            {!! $courseModule?->description !!}

                        </div>
                        <div class="pt-5 qualification-overview-accordian" class="accordion" id="accordionExample">
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="get-in-touch-wrapper">
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
                            <h1 class="text-center text-brand text-700 get-in-touch-header">Get in Touch</h1>
                            <p class="text-center text-brand text-500 ">Interested in this course?</p>
                            <form class="get-in-touch-form" action="{{ route('website.postContact') }}" id="websitePostContactForm" method="post">
                                @csrf
                                <div class="form-group">
                                    <input name="first_name" value="{{ old('first_name') ?? '' }}" id="fastName" class="get-in-touch-input rounded" type="text" placeholder="First Name *" required>
                                    @if($errors->has('first_name'))
                                        <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input name="last_name" value="{{ old('last_name') ?? '' }}" id="lastName" class="get-in-touch-input rounded" type="text" placeholder="Last Name">
                                    @if($errors->has('last_name'))
                                        <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input name="email" value="{{ old('email') ?? '' }}" id="email" class="get-in-touch-input rounded" type="text" placeholder="Email *" required>
                                    @if($errors->has('email'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input name="phone_number" value="{{ old('phone_number') ?? '' }}" id="phoneNumber" class="get-in-touch-input rounded" type="text" placeholder="Phone *" required>
                                    @if($errors->has('phone_number'))
                                        <div class="text-danger">{{ $errors->first('phone_number') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input name="subject" value="{{ old('subject') ?? '' }}" id="subject" class="get-in-touch-input rounded" type="text" placeholder="Subject *" required>
                                    @if($errors->has('subject'))
                                        <div class="text-danger">{{ $errors->first('subject') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <textarea name="message" class="get-in-touch-input rounded" id="message" rows="5" placeholder="Write a message ... *" required>{{ old('message') ?? '' }}</textarea>
                                    @if($errors->has('message'))
                                        <div class="text-danger">{{ $errors->first('message') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div>
                                            <input name="agree_with_tnc" value="1" type="checkbox" class="mr-1 rounded" id="agreeWithTnc" {{ old('agree_with_tnc') == 1 ? 'checked' : '' }} required>
                                        </div>
                                        <p style="color: #5E5C5C;font-size: 13px" class="mb-1"> I understand and accept the websites
                                            <a href="{{ route('website.getInformationPage', 'terms-and-conditions') }}" class="text-blue font-weight-bold">terms and conditions</a> and <a href="{{ route('website.getInformationPage', 'privacy-policies') }}" class="text-blue font-weight-bold">privacy policies</a>. I agree that Geeks Learning may
                                            contact me about the services it provides.
                                        </p>
                                    </div>
                                    @if($errors->has('agree_with_tnc'))
                                        <div class="text-danger">{{ $errors->first('agree_with_tnc') }}</div>
                                    @endif
                                    @if($errors->has('robot_detected'))
                                        <div class="text-danger font-weight-bold">{{ $errors->first('robot_detected') }}</div>
                                    @endif
                                </div>
                                <input type="hidden" name="redirect_route" value="{{ url()->full() }}">
                                <button type="submit"
                                    class="g-recaptcha get-in-touch-submit-btn"
                                    data-sitekey="{{ config('google_recaptcha.site_key') }}"
                                    data-callback='onSubmit'
                                    data-action='contactUs'>
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("websitePostContactForm").submit();
        }
    </script>

@endsection
