@extends('frontEnd.layouts.layout')
@section('title') Contact Us @endsection
@section('meta-tag')
<link rel="canonical" href="http://localhost:8000/contact-us" />
<meta property="og:title" content="Contact Us | Geeks Learning" />
<meta property="og:url" content="http://localhost:8000/contact-us" />
<meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
<meta name="twitter:title" content="Contact Us | Geeks Learning" />
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
    <div>
        <div class="contact-us-header-bg text-center text-white position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9">
                    <h1 class="text-500 contact-us-header-top">Contact Us</h1>
                    <p class="contact-us-header-description">If you require specific detailed information from Geeks Learning, please contact us by Phone or email or alternatively you can complete the contact form that we have provided below.</p>
                </div>
            </div>
        </div>
        <div class="position-top">
            <div class="container">
                <div class="row text-500">
                    <div class="col-md-4 mb-4 mb-md-0 ">
                        <div class="contact-us-card h-100 text-center">
                            <img class="contact-us-icon" src="{{ asset('images/frontEnd/contactUs/phone-icon.svg') }}" alt="">
                            <p class="mb-0 mt-2 text-brand text-600 contact-card-info">02 9160 0075</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="contact-us-card h-100 text-center">
                            <img class="contact-us-icon" src="{{ asset('images/frontEnd/contactUs/globe-icon.svg') }}"
                                 style="height: 35px;width:35px;" alt="">
                            <p class="mb-0 mt-2 text-brand text-600 contact-card-info">https://geekslearning.au</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0 ">
                        <div class="contact-us-card h-100 text-center">
                            <img class="contact-us-icon" src="{{ asset('images/frontEnd/contactUs/email-icon.svg') }}" alt="">
                            <p class="mb-0 mt-2 text-brand text-600 contact-card-info"
                                  style="overflow-wrap: anywhere;">hello@geekslearning.au</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-4">
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
            <h1 class="pt-md-5 pt-0 pb-5 text-500 text-center mb-0 text-blue contact-form-header"> Our experts will help you</h1>
            <form  class="get-in-touch-form" action="{{ route('website.postContact') }}" id="websitePostContactForm" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input name="first_name" value="{{ old('first_name') ?? '' }}" id="firstName"  type="text" class="contact-us-form-input" placeholder="First Name *" required>
                            @if($errors->has('first_name'))
                                <div class="text-danger">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input name="last_name" value="{{ old('last_name') ?? '' }}" id="lastName"  type="text" class="contact-us-form-input" placeholder="Last Name">
                            @if($errors->has('last_name'))
                                <div class="text-danger">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input name="phone_number" value="{{ old('phone_number') ?? '' }}" id="phoneNumber"  type="text" class="contact-us-form-input" placeholder="Contact Phone *" required>
                            @if($errors->has('phone_number'))
                                <div class="text-danger">{{ $errors->first('phone_number') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input name="email" value="{{ old('email') ?? '' }}" id="email"  type="email" class="contact-us-form-input" placeholder="Email Address *" required>
                            @if($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input name="subject" value="{{ old('subject') ?? '' }}" id="subject"  type="text" class="contact-us-form-input" placeholder="Subject *" required>
                            @if($errors->has('subject'))
                                <div class="text-danger">{{ $errors->first('subject') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="message" class="contact-us-form-input" id="message" cols="30" rows="10" PLACEHOLDER="Enquiry Details*" required>{{ old('message') ?? '' }}</textarea>
                            @if($errors->has('message'))
                                <div class="text-danger">{{ $errors->first('message') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="d-flex">
                                <div>
                                    <input name="agree_with_tnc" value="1" type="checkbox" class="mr-1 rounded" id="agreeWithTnc" {{ old('agree_with_tnc') == 1 ? 'checked' : '' }} required>
                                </div>
                                <p style="color: #5E5C5C;font-size: 15px"> I understand and accept the websites
                                    <a href="{{ route('website.getInformationPage', 'terms-and-conditions') }}" class="text-blue">terms and conditions</a> and <a href="{{ route('website.getInformationPage', 'privacy-policies') }}" class="text-blue">privacy policies</a>. I agree that Geeks Learning may
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
                    </div>
                    <input type="hidden" name="redirect_route" value="{{ url()->full() }}">
                </div>
                <div class="d-flex justify-content-center mt-3 mb-5">
                    <button
                        class="g-recaptcha btn contact-us-form-submit-btn "
                        data-sitekey="{{ config('google_recaptcha.site_key') }}"
                        data-callback='onSubmit'
                        data-action='contactUs'>
                        SEND A MESSAGE
                    </button>
                </div>
            </form>
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
