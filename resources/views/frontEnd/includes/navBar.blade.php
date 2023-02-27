<div class="bg-white">
    @if($noticePageTop->status == 1)
        <div id="topbar" class="enrollment-notification py-2 d-flex align-items-center justify-content-center">
            <div class="d-sm-block d-none"><img src="{{ asset('/images/global/watch.svg') }}" alt="Enroll Time"></div>
           <div>
               <p class="mb-0 text-center ml-1">{!! $noticePageTop->notice !!}</p>
           </div>
        </div>
    @endif

    <div id="header" class="navbar-container navbar-bg bg-transparent fixed-top pb-1">
        <div class="container">
        <nav class="navbar pt-1 pb-2 navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('website.getHomePage') }}">
                <img src="{{ asset('/images/logo/logo.svg') }}" alt="" srcset="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav nav-items-container pb-lg-0 pb-4 d-lg-flex d-none">
                    @foreach($courseCategoriesOnly as $courseCategory)
                    @if ($courseCategory->is_primary === 1)
                    <li class="nav-item">
                        <a class="nav-link nav-link-item text-capitalize" href="{{ route('website.getCourseCategoryPage', $courseCategory?->slug) }}">{{ $courseCategory->name }} <span class="text-blue"><i class="fa-solid fa-chevron-down"></i></span></a>
                        <div class="mega-menu">
                         <div class="content pt-5 pb-3 px-4">
                             <div class="row">
                                 @foreach ($courseCategory->courseModules as $course)

                                 <div class="col-md-6 mb-4">
                                     <div class="row">
                                         <div class="col-md-2">
                                            <img class="mega-menu-course-img" src="{{ $course->media[0]->original_url ?? asset('default/images/backend/no-image.png') }}" alt="{{ $course->name }}">
                                        </div>
                                         <div class="col-md-10 mega-menu-course-name">
                                             <div class="d-flex justify-content-between pl-2">
                                                 <a class="d-block" href="{{ route('website.getSingleCourseModulePage', $course->slug) }}">{{ $course->name }}</a>
                                                 <span class="d-block text-blue"><i class="fa-solid fa-chevron-right"></i></span>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 @endforeach
                             </div>
                         </div>
                        </div>
                     </li>
                    @endif
                    @endforeach
                </ul>

                {{-- Only For small device --}}
                <ul class="navbar-nav nav-items-container pb-lg-0 pb-5 d-lg-none d-block">
                    @foreach($courseCategoriesOnly as $courseCategory)
                    <li class="nav-item">
                        <a class="nav-link nav-link-item text-capitalize" href="{{ route('website.getCourseCategoryPage', $courseCategory?->slug) }}">{{ $courseCategory->name }}</a>
                     </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
    <div class="book-a-tech-btn">

        <div class="wrapper">
            <a class="cta" target="_blank" href="https://geekify.au/book-online">
                <div>
                    <span class="facing-issue">Facing Tech Issues?</span> <br>
                    <span class="book-a-geek font-weight-bold">Book A Geek</span>
                </div>
            </a>
          </div>
    </div>
</div>

</div>
<!-- Modal -->
<div class="modal fade" id="coursesModal" tabindex="-1" aria-labelledby="coursesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coursesModalLabel">Geeks Learning Programs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        @foreach($courseCategoriesOnly as $courseCategory)
                            <div class="col-lg-3 col-md-6 col-12 form-group">
                                <a class="mega-nav-link" href="{{ route('website.getCourseCategoryPage', $courseCategory?->slug) }}">
                                    <div class="course-link-card h-100">
                                        <div class="mx-2 py-3">
                                            <div class="d-flex">
                                                <div>
                                                    <img src="{{ $courseCategory?->thumbnail ?? asset('default/images/backend/courses/no-image.png') }}" alt="{{ $courseCategory?->name }}" style="height: 2rem; width: 2rem">
                                                </div>
                                                <div class="ml-lg-4 ml-2">
                                                    <p class="modal-card-course-name mb-0">{{ $courseCategory->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn course-modal-close-btn py-1 px-4" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function scrollFunction() {
      const abc = document.getElementById('header');
      const def = document.getElementById('topbar');
      if (window.scrollY > 50) {
        abc.classList.add('header-scrolled');
        def.classList.add('topbar-scrolled');
      } else {
        abc.classList.remove('header-scrolled');
        def.classList.remove('topbar-scrolled');
          }
      }
    window.onscroll = function() {scrollFunction()};
  </script>
