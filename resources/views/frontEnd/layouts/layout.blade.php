<!DOCTYPE html>
<html lang="en">

<head>
      <!--- FAVICONS --->
    <link rel="icon" href="{{ asset('images/favicon/favicon-32.png') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('images/favicon/favicon-192.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicon/favicon-180.png') }}" />


    <title>{{ config('app.name') }} |
        @if (request()->route()->uri === '/')
        Making Future Geeks
        @else
        @yield('title')
        @endif
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"  content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
    <meta name="keywords"  content="Geeks Learning offers hands-on training on computer hardware, home networking, coding, cyber security, operating systems, and more for kids" />
    <meta property="fb:app_id" content="879767379702949" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Geeks Learning" />
    <meta property="og:image" content="{{ asset('images/social-image.png') }}" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="390" />
    <meta name="twitter:domain" content="geekslearning.au" />
    <meta name="twitter:image" content="{{ asset('images/social-image.png') }}" />
    <meta name="twitter:card" content="summary" />
    @yield('meta-tag')
    {{-- bootstrap css cdn links --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    {{-- font awesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- aos animation library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Custom Css --}}
    <link rel="stylesheet" href="{{ asset('/css/frontEnd/frontEnd.css') }}">
</head>

<body>
<div>
    @include('frontEnd.includes.navBar')
    <div class="body-margin">@yield('content')</div>
    @include('frontEnd.includes.footer')
</div>

<script src="{{ mix('js/app.js') }}"></script>

{{-- bootstrap 4.5 js files cdn links --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
</script>

{{-- aos animation js library --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

@yield('script')

</body>

</html>
