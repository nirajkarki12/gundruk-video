<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(Auth::guard('admin')->user()->picture){{Auth::guard('admin')->user()->picture}} @else {{asset('admin-css/dist/img/avatar.png')}} @endif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::guard('admin')->user()->name}}</p>
                <a href="{{route('admin.profile')}}">{{Auth::guard('admin')->user()->email}}</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li id="dashboard">
              <a href="{{route('admin.dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>

            <li class="treeview" id="categories">
                <a href="{{route('admin.category')}}">
                    <i class="fa fa-suitcase"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-category"><a href="{{route('admin.category.create')}}"><i class="fa fa-circle-o"></i>Add Category</a></li>
                    <li id="view-categories"><a href="{{route('admin.category')}}"><i class="fa fa-circle-o"></i>View Categories</a></li>
                </ul>
            </li>


            <!-- place at bottom -->
            <li id="dashboard">
              <a href="{{route('admin.setting')}}">
                <i class="fa fa-cogs"></i> <span>Settings</span>
              </a>
            </li>
        </ul>

    </section>

    <!-- /.sidebar -->

</aside>