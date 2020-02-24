<!-- Page Sidebar -->
<div class="page-sidebar">

    <!-- Site header  -->
    <header class="site-header">
        <div class="site-logo">
            <a href="{{route('admin.home')}}">
                <img src="{{asset('assets/admin/images/logo.png')}}" title="imaging atelier" width="150">
            </a>
        </div>
        <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
        <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
    </header>
    <!-- /site header -->

    <!-- Main navigation -->
    <ul id="side-nav" class="main-menu navbar-collapse collapse">

        <li class="{{Route::is('admin.home') ? 'active' : ''}}">
            <a href="{{route('admin.home')}}">
                <i class="icon-gauge"></i><span class="title">Dashboard</span>
            </a>
        </li>

        <li class="{{Route::is('admin.days.*') ? 'active' : ''}}">
            <a href="{{route('admin.days.index')}}">
                <i class="fa fa-database"></i><span class="title">Days</span>
            </a>
        </li>
        <li class="{{Route::is('admin.users.*') ? 'active' : ''}}">
            <a href="{{route('admin.users.index')}}">
                <i class="fa fa-tasks"></i><span class="title">Speakers</span>
            </a>
        </li>
        <li class="{{Route::is('admin.events.*') ? 'active' : ''}}">
            <a href="{{route('admin.events.index')}}">
                <i class="fa fa-pencil"></i><span class="title">Events</span>
            </a>
        </li>
        <li class="{{Route::is('admin.polls.*') ? 'active' : ''}}">
            <a href="{{route('admin.polls.index')}}">
                <i class="fa fa-pie-chart"></i><span class="title">Voting</span>
            </a>
        </li>
        <li class="{{Route::is('admin.practices.*') ? 'active' : ''}}">
            <a href="{{route('admin.practices.index')}}">
                <i class="fa fa-edit"></i><span class="title">Clinical Practice</span>
            </a>
        </li>
        <li class="{{Route::is('admin.allUsers.all') ? 'active' : ''}}">
            <a href="{{route('admin.allUsers.all')}}">
                <i class="fa fa-users"></i><span class="title">All Users</span>
            </a>
        </li>
        <li class="{{Route::is('admin.settings.*') ? 'active' : ''}}">
            <a href="{{route('admin.settings.index')}}">
                <i class="fa fa-tasks"></i><span class="title">Settings</span>
            </a>
        </li>

    </ul>
    <!-- /main navigation -->
</div>
<!-- /page sidebar -->
