
<nav class="navbar navbar-light navbar-expand-lg bg-light" >
    <!-- Navbar content -->
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{asset('img/help.svg')}}" alt="" width="30" height="24" class="d-inline-block align-top">
            Quiz Master
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif


                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administration
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('manage users')
                                <a class="dropdown-item" href="{{route('users.index')}}">Users</a>
                            @endcan
                            <a class="dropdown-item" href="#">Global Results</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>
    </div>
</nav>
