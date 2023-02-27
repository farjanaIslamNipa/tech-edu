@extends('frontEnd.layouts.layout')
@section('title') Packages | Geeks Learning @endsection
@section('meta-tag')
  <link rel="canonical" href="https://geekslearning.au" />
  <meta property="og:title" content="Packages | Geeks Learning" />
  <meta property="og:url" content="https://geekslearning.au" />
  <meta property="og:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
  <meta name="twitter:title" content="Packages | Geeks Learning" />
  <meta name="twitter:description" content="We provide hands on F2F and remote learning that is effective and has a proven track record." />
@endsection

@section('content')
    <header>
        <div class="">
            <div class="package-details-banner d-flex align-items-center justify-content-center text-center">
              <div class="container text-white">
                <h1 class="text-700 text-capitalize">{{ $package->name }}</h1>
                <h5 class="mb-0">{{ $package->short_description }}</h5>
              </div>
            </div>
        </div>
    </header>
    <main style="background: rgba(241, 246, 249, 0.51);" class="py-5">
      <section id="package_details">
        <package-details :package="{{ $package }}"
                         :csrf-token="{{ json_encode(csrf_token()) }}"
                         :submit-route="{{ json_encode(route('website.postPackageSubscriptionOrder', $package->id)) }}"
        />
      </section>
    </main>
@endsection
