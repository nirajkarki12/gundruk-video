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
                    <li id="view-categories"><a href="{{route('admin.category')}}"><i class="fa fa-eye"></i>View Categories</a></li>
                    <li id="add-category"><a href="{{route('admin.category.create')}}"><i class="fa fa-plus"></i>Add Category</a></li>
                </ul>
            </li>

            <li class="treeview" id="categories">
                <a href="{{route('admin.channels')}}">
                    <i class="fa fa-television"></i> <span>Channels</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="view-videos"><a href="{{route('admin.channels')}}"><i class="fa fa-eye"></i>View Channels</a></li>
                    <li id="add-video"><a href="{{route('admin.channel.create')}}"><i class="fa fa-plus"></i>Add Channel</a></li>
                </ul>
            </li>

            <li class="treeview" id="categories">
                <a href="{{route('admin.videos')}}">
                    <i class="fa fa-video-camera"></i> <span>Videos</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="view-videos"><a href="{{route('admin.videos')}}"><i class="fa fa-eye"></i>View Videos</a></li>
                    <li id="add-video"><a href="{{route('admin.video.create')}}"><i class="fa fa-plus"></i>Add Video</a></li>
                    <li id="view-deleted-video"><a href="{{route('admin.video.deleted')}}"><i class="fa fa-trash"></i>View Deleted</a></li>
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