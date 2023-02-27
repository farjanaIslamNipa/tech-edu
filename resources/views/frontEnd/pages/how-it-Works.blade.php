@extends('frontEnd.layouts.layout')
@section('title') How Geeks Learning Works @endsection
@section('meta-tag')
    <link rel="canonical" href="https://geekslearning.au/information/how-geeks-learning-works" />
    <meta property="og:title" content="How Geeks Learning Works | Geeks Learning" />
    <meta property="og:url" content="https://geekslearning.au/information/how-geeks-learning-works" />
    <meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
    <meta name="twitter:title" content="How Geeks Learning Works | Geeks Learning" />
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
    <div class="how-it-works-banner">
        <div class="container">
            <div class="row justify-content-end" >
                <div class="col-lg-6 col-md-8" >
                    <div data-aos="fade-up">
                        <h1 class="text-700 text-blue mb-0 pb-3 text-capitalize">how geeks learning works </h1>
                        <p class="text-16 mb-0">Geeks Learning is the latest trend for In Home Learning. We have created training packages that are related to the home and commercial computer sector.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center pt-5">
            <div class="col-md-6">
                <div>
                    <p class="text-17"><strong>Geeks technicians</strong> experience calls for assistance every day and have created the top 20 training modules based on our call outs. This means that we are providing the latest training relevant to today's circumstances and user experiences.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <img src="{{asset('/images/frontEnd/how-it-works/img-1.png')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="row align-items-center pt-5">
            <div class="col-md-6 d-md-block d-none">
                <div>
                    <img src="{{asset('/images/frontEnd/how-it-works/img-2.png')}}" alt="" class=" py-5 how-it-works-middle-img">
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <p class="text-17">We provide <strong>one-off sessions</strong> for our customers, for example “Cyber Security for Today” or “Calculating in Excel” to cover specific training needs. Alternatively, you can also purchase a subscription that will cover you for bother computer trouble shooting and repairs. This also covers the training modules that we provide. </p>
                </div>
            </div>
        </div>
        <div class="row align-items-center pt-5 pb-md-5 pb-0">
            <div class="col-md-6 order-md-1 order-2">
                <div>
                    <p class="text-17">We also offer <strong>remote training sessions</strong> to our customers as we are experienced in providing desktop support and training where a particular function or operation is not working as desired.</p>
                </div>
            </div>
            <div class="col-md-6 order-md-2 order-1 mb-md-0 mb-3">
                <div>
                    <img src="{{asset('/images/frontEnd/how-it-works/img-3.png')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="how-it-works-bottom-bg">
       <div class="container">
            <h4 class="mb-md-4 mb-0 pb-5 text-center">Please <b>contact us</b> today or read through our <b>training modules</b> to see we can be of assistance to you.</h4>
       </div>
    </div>
@endsection
