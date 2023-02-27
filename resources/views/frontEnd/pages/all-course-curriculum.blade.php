@extends('frontEnd.layouts.layout')
@section('title') All Programs @endsection
@section('meta-tag')
<link rel="canonical" href="https://geekslearning.au/all-programs" />
<meta property="og:title" content="All Programs | Geeks Learning" />
<meta property="og:url" content="https://geekslearning.au/all-programs" />
<meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
<meta name="twitter:title" content="All Programs | Geeks Learning" />
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
    <div class="">
      <div id="all_current_courses">
        <all-current-courses
        :subscription="{{ $subscriptionCategories }}"
        :test="1"
         />
      </div>
    </div>
@endsection
