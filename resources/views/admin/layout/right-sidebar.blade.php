<ul class="navbar-nav ml-auto mr-4">




    <li class="nav-item dropdown open" style="padding-left: 15px;">

        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
          <img class="mr-2" height="30px" width="30px"  src="{{ asset('dashboard/images/user.png') }}" alt="">{{ auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

          <a class="dropdown-item"  onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"  href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </div>
      </li>

</ul>
