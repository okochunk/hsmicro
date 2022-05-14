<header class="main-header">

    <!-- Logo -->
    <a href="{{ (Auth::user()->roles[0]->name == 'admin')  ? action('DashboardController@index') : action('Customer\OrderController@index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>BB</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Sari</b>Roti</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="{{ asset("/AdminLTE-2.3.11/dist/img/GuestAvatar128.png") }}" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="{{ asset("/AdminLTE-2.3.11/dist/img/GuestAvatar128.png") }}" class="img-circle" alt="User Image">

                        <p>
                            {{ Auth::user()->name }}
                            <small> {{ Auth::user()->company }} </small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-body">

                        <!-- /.row -->
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
{{--                          <a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('logout.custom') }}" class="btn btn-default btn-flat"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </div>
                      </li>
                    </ul>
                  </li>

                </ul>
              </div>
    </nav>
</header>