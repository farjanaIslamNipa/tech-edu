<footer id="element-container" class="">
        {{-- skill from open btn section --}}
    <div class="bg-white py-3">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div>
                        <img src="{{ asset('/images/logo/footer-logo.svg') }}" alt="Footer logo">
                        <p style="" class="mb-0 mt-4 ">Achieve results through Geeks Learning. Hand on training that you will understand. </p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="d-flex">
                        <div>
                            <h4 class=" pt-4">Explore</h4>
                            <div class="explore-link pt-3">
                                <a href="{{ route('website.getHomePage') }}">Home</a>
                                <a href="{{ route('website.getAllCurrentCourses') }}">View Programs</a>
                                <a href="{{ route('website.getInformationPage', 'how-geeks-learning-works') }}">How It Works</a>
                                <a href="{{ route('website.getAboutUsPage') }}">About</a>
                                <a href="{{ route('website.getContactPage') }}">Contact</a>

                                {{-- <a href="{{ route('website.getInformationPage', 'faqs') }}">FAQs</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div>
                        <h4 class=" pt-4">All programs</h4>
                        <div class="explore-link pt-3">
                            @foreach($courseCategoriesOnly as $courseCategory)
                            <a class="mb-3" href="{{ route('website.getCourseCategoryPage', $courseCategory?->slug) }}">{{ $courseCategory->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="d-flex ">
                        <div class="mt-5">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/frontEnd/footer/call-icon.png') }}" alt="">
                                <a style="text-decoration: none" href="tel:02 9160 0075" style="font-size: 14px;" class="mb-0 ml-3 text-dark">02 9160 0075</a>
                            </div>
                            <div class="d-flex align-items-center my-3">
                                <img src="{{ asset('/images/frontEnd/footer/web-icon.png') }}" alt="">
                                <a style="text-decoration: none" href="https://geekslearning.au/" style="font-size: 14px;" class="mb-0 ml-3 text-dark">geekslearning.au</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/frontEnd/footer/mail-icon.png') }}" alt="">
                                <p style="font-size: 14px;" class="mb-0  ml-3">hello@geekslearning.au</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-bg py-4 text-white">
        <div class="container">
            <div class="d-lg-flex d-block justify-content-between">
                <div>
                    <p class="text-center mb-0 footer-bottom-text px-2">Copyright © <script>document.write(new Date().getFullYear())</script> Geeks Learning
                        All rights reserved.</p>
                </div>
                <div class="text-center">
                    <a class="footer-bottom-link" href="{{ route('website.getInformationPage', 'terms-and-conditions') }}">Terms & Conditions</a> <span class="">|</span>
                    <a class="footer-bottom-link" href="{{ route('website.getInformationPage', 'privacy-policies') }}">Privacy Policy</a>
                </div>
                <div class="text-center">
                    <div class="d-flex justify-content-center social-icon">
                        <a class="mx-2" href=""><img class="social-icon-img" src="{{ asset('/images/frontEnd/footer/facebook.svg') }}" alt=""></a>
                        <a class="mx-2" href=""><img class="social-icon-img" src="{{ asset('/images/frontEnd/footer/instagram.svg') }}" alt=""></a>
                        <a class="mx-2" href=""><img class="social-icon-img" src="{{ asset('/images/frontEnd/footer/twitter.svg') }}" alt=""></a>
                        <a class="mx-2" href=""><img class="social-icon-img" src="{{ asset('/images/frontEnd/footer/google.svg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
