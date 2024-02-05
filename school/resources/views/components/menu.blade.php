<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ url('assets/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Jhon Doe</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            @if (Auth::user()->user_role == 1)
            <a href="{{ url('/') }}" class="nav-item nav-link @if (Request::segment(1) == 'dashboard') active @endif"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('all.user') }}" class="nav-item nav-link @if (Request::segment(1) == 'user') active @endif"><i class="fa fa-th me-2"></i>Users</a>
            <a href="{{ route('all.class') }}" class="nav-item nav-link @if (Request::segment(1) == 'class') active @endif"><i class="fa fa-th me-2"></i>Class</a>
            <a href="{{ route('all.subject') }}" class="nav-item nav-link @if (Request::segment(1) == 'subject') active @endif"><i class="fa fa-th me-2"></i>Subjects</a>
            <a href="{{ route('all.student') }}" class="nav-item nav-link @if (Request::segment(1) == 'student') active @endif"><i class="fa fa-th me-2"></i>Student</a>
            <a href="{{ route('all.parent') }}" class="nav-item nav-link @if (Request::segment(1) == 'parent') active @endif"><i class="fa fa-th me-2"></i>Parent</a>

            @elseif (Auth::user()->user_role == 2){{-- teacher access --}}
            <a href="{{ url('/') }}" class="nav-item nav-link @if (Request::segment(1) == 'dashboard') active @endif"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('all.class') }}" class="nav-item nav-link @if (Request::segment(1) == 'class') active @endif"><i class="fa fa-th me-2"></i>Class</a>
            @endif
        </div>
    </nav>
</div>
