@extends('frontEnd.layouts.layout')
@section('title') About Us @endsection
@section('meta-tag')
<link rel="canonical" href="https://geekslearning.au/about-us" />
<meta property="og:title" content="About Us | Geeks Learning" />
<meta property="og:url" content="https://geekslearning.au/about-us" />
<meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
<meta name="twitter:title" content="About Us | Geeks Learning" />
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
    <div class="about-us-top-bg">
        <div class="container" data-aos="zoom-in">
            <div class="row">
                <div class="col-12 col-lg-7 h-100 d-flex align-items-center ">
                    <div class="">
                        <h3 class="text-blue about-us-top-header pt-5 mt-lg-5 mt-0">About Geeks Learning</h3>
                        <p class="pt-4 about-us-top-header-des text-600 mb-3">Everyone is different rite? We all have our strengths and weaknesses.</p>
                        <p class="">Here at Geeks Learning we are not judgmental; we are here to guide you and help you strengthen your skills so that you can achieve your goals.​​​​</p>
                        <p class="">Sometimes all we need is some guidance and understanding and Geeks Learning provide the understanding through hands on learning so that you are comfortable when you return home or to work.​​</p>
                        <p class="mb-0">​Providing actual context to our learning programs is a proven method and will dramatically increase what you remember after the training is complete​</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- middle section --}}
    <div class="pb-5">
        <div class="container-fluid">
            <div class="row align-items-center py-xl-5 py-lg-4 py-0">
                <div class="col-lg-5 col-12 order-lg-1 order-2">
                    <div class="">
                    <img class="img-fluid about-us-img" src="/images/frontEnd/aboutUs/about-image.png" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-12 order-lg-2 order-1 mb-lg-0 mb-4">
                    <div class="row">
                        <div class="col-xl-9 col-lg-11 col-12">
                            <div class="px-lg-5 pl-0">
                                <h2 class="text-brand pb-3 text-uppercase">What we’re about</h2>
                                <p class="pb-xl-4 pb-2">We are eager to help people achieve their goals. No matter if you are preparing for an exam or just need some support, we can provide that support.​</p>
                                <p class="pb-xl-4 pb-2">​All our training programs are designed with the customer's needs in mind. We don’t teach you something you don’t need to know. We will ask you to ask questions as this is the fastest way assess where specific training is required.​</p>
                                <p>Private coaching for students of all ages is becoming common as we all try to improve our career prospects in life and technology becomes integrated into our lives.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <div class="text-center">
                <h1 class="text-blue">Why Choose Us</h1>
                <h6>Geeks Learning will help you every step of the way and provide you with the training and knowledge that you need.</h6>
            </div>
            <div class="row align-items-center mt-lg-5 mt-3 mb-5">
                <div class="col-lg-4 mb-lg-0 mb-0">
                    <div>
                        <div class="d-flex mb-4">
                            <div class="text-lg-right text-left order-lg-1 order-2">
                                <h6 class="text-deep-red text-700">Passion</h6>
                                <p class="mb-0 why-choose-text">Geeks Learning staff is committed to their customers providing an unapparelled experience in customer service</p>
                            </div>
                            <div class="pl-lg-4 pl-0 pr-lg-0 pr-4 order-lg-2 order-1"><img class="why-choose-icon" src="/images/frontEnd/aboutUs/passion-icon.svg" alt=""></div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="text-lg-right text-left order-lg-1 order-2">
                                <h6 class="text-gold text-700">Integrity</h6>
                                <p class="mb-0 why-choose-text">Geeks Learning staff is committed to their customers providing an unapparelled experience in customer service</p>
                            </div>
                            <div class="pl-lg-4 pl-0 pr-lg-0 pr-4 order-lg-2 order-1"><img class="why-choose-icon" src="/images/frontEnd/aboutUs/integrity-icon.svg" alt=""></div>
                        </div>
                        <div class="d-flex">
                            <div class="text-lg-right text-left order-lg-1 order-2">
                                <h6 class="text-blue text-700">Drive</h6>
                                <p class="mb-0 why-choose-text">Geeks Learning staff is committed to their customers providing an unapparelled experience in customer service</p>
                            </div>
                            <div class="pl-lg-4 pl-0 pr-lg-0 pr-4 order-lg-2 order-1"><img class="why-choose-icon" src="/images/frontEnd/aboutUs/drive-icon.svg" alt=""></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-lg-0 mt-4">
                    <div class="text-center mb-lg-0 mb-4">
                        <img class="about-img" src="/images/frontEnd/aboutUs/why-choose-img.png" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <div>
                            <div class="d-flex mb-4">
                                <div class="pr-4"><img class="why-choose-icon" src="/images/frontEnd/aboutUs/excellence-icon.svg" alt=""></div>
                                <div>
                                    <h6 class="text-orange text-700">Excellence</h6>
                                    <p class="mb-0 why-choose-text">Geeks Learning staff is committed to their customers providing an unapparelled experience in customer service</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="pr-4"><img class="why-choose-icon" src="/images/frontEnd/aboutUs/commitment-icon.svg" alt=""></div>
                                <div>
                                    <h6 class="text-green text-700">Commitment</h6>
                                    <p class="mb-0 why-choose-text">Geeks Learning staff is committed to their customers providing an unapparelled experience in customer service</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="pr-4"><img class="why-choose-icon" src="/images/frontEnd/aboutUs/innovation-icon.svg" alt=""></div>
                                <div>
                                    <h6 class="text-deep-red text-700">Innovation</h6>
                                    <p class="mb-0 why-choose-text">Geeks Learning staff is committed to their customers providing an unapparelled experience in customer service</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- why choose us section ends --}}
@endsection
