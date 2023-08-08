@php
    use App\Models\User;
    $user = User::with('employeeRoleOrganization.role')->find(auth::user()->id);
    $role = $user->employeeRoleOrganization->role;
@endphp

<ul class="navbar-nav">

    <li class="nav-item toggel-buuton">
      <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fas fa-bars"></i></a>
    </li>

    <a class="navbar-brand mr-4" href="{{ route('home') }}" style="margin-top: -2px;">Employee Task Portal</a>

    @if($role->slug == 'lead')
    <li class="nav-item d-none d-sm-inline-block  ml-3" style="margin-left: -30px;">
      <a href="{{ route('tasks.index') }}" class="nav-link">Tasks</a>
    </li>

    <li class="nav-item d-none d-sm-inline-block  ml-3" style="margin-left: -30px;">
        <a href="{{ route('pending.tasks') }}" class="nav-link">Pending Tasks</a>
    </li>

    <li class="nav-item d-none d-sm-inline-block  ml-3" style="margin-left: -30px;">
        <a href="{{ route('completed.tasks') }}" class="nav-link">Completed Tasks</a>
    </li>
    @endif

    @if($role->slug == 'team-member')
    <li class="nav-item d-none d-sm-inline-block  ml-3" style="margin-left: -30px;">
        <a href="{{ route('my.tasks.index') }}" class="nav-link">My Tasks</a>
    </li>
    @endif

</ul>
