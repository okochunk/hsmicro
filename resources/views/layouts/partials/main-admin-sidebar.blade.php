<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/AdminLTE-2.3.11/dist/img/GuestAvatar128.png") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
    {{--      <form action="#" method="get" class="sidebar-form">--}}
    {{--        <div class="input-group">--}}
    {{--          <input type="text" name="q" class="form-control" placeholder="Search...">--}}
    {{--              <span class="input-group-btn">--}}
    {{--                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
    {{--                </button>--}}
    {{--              </span>--}}
    {{--        </div>--}}
    {{--      </form>--}}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ title_case(Auth::user()->roles[0]->name) }} Navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ (request()->is('admin/orders*')) ? 'active' : '' }}"><a href="{{ action('OrdersController@index') }}"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
            <li class="{{ (request()->is('admin/categories*')) ? 'active' : '' }}"><a href="{{ action('CategoriesController@index') }}"><i class="fa fa-folder"></i> <span>Categories</span></a></li>
            <li class="{{ (request()->is('admin/products*')) ? 'active' : '' }}"><a href="{{ action('ProductsController@index') }}"><i class="fa fa-cubes"></i> <span>Products</span></a></li>
            <li class="{{ (request()->is('admin/notifications*')) ? 'active' : '' }}"><a href="{{ action('UserNotificationController@index') }}"><i class="fa fa-volume-up"></i> <span>Notification</span></a></li>
            <li class="{{ (request()->is('admin/users*')) ? 'active' : '' }}"><a href="{{ action('UsersController@index') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>

            <li class="{{ (request()->is('admin/characters*')) ? 'active' : '' }}"><a href="{{ action('CharactersController@index') }}"><i class="fa fa-sort-alpha-asc"></i> <span>Characters Count</span></a></li>

{{--            <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>--}}
            {{--        <li class="treeview">--}}
            {{--          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>--}}
            {{--            <span class="pull-right-container">--}}
            {{--              <i class="fa fa-angle-left pull-right"></i>--}}
            {{--            </span>--}}
            {{--          </a>--}}
            {{--          <ul class="treeview-menu">--}}
            {{--            <li><a href="#">Link in level 2</a></li>--}}
            {{--            <li><a href="#">Link in level 2</a></li>--}}
            {{--          </ul>--}}
            {{--        </li>--}}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>