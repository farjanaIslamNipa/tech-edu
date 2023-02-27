<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="fa-solid fa-user"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right " style="left: inherit; right: 0px;">
                        <button type="submit" class="dropdown-item px-4 text-center">
                            <i class="fa-solid fa-power-off"></i> <span class="ml-2"> Logout</span>
                        </button>
                    </div>
                </li>
        {{-- <button type="submit" class="btn btn-sm btn-primary">Logout</button> --}}
        </form>
        </li>
    </ul>
</nav>
