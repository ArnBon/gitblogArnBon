 <!-- Sidebar Menu -->
 <ul class="sidebar-menu" data-widget="tree">
     <li class="header">Menú de Navegación</li>
     <!-- Optionally, you can add icons to the links -->
     <li class="{{ setActiveRoute('dashboard') }}">
         <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li>
     {{-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}

     <li class="treeview {{ setActiveRoute('admin.posts.index') }}">

         <a href="#"><i class="fa fa-bars"></i> <span>Blog</span>
             <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
             </span>
         </a>

         <ul class="treeview-menu">
             <li class="{{ setActiveRoute('admin.posts.index') }}">
                 <a href="{{ route('admin.posts.index') }}"><i class="fa fa-dashboard"></i>Ver todos los posts</a></li>

             <li>
                 @if(request()->is('admin/posts/*'))
                 <a href="{{route('admin.posts.index','#create' )}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>Crear un post</a>
                 @else

                 <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>Crear un post</a></li>
             @endif
         </ul>


     </li>


     <li class="treeview {{ setActiveRoute(['admin.users.index', 'admin.users.create']) }}">

         <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
             <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
             </span>
         </a>

         <ul class="treeview-menu">
             <li class="{{ setActiveRoute('admin.users.index') }}">
                 <a href="{{ route('admin.users.index') }}"><i class="fa fa-dashboard"></i>Ver todos los usuarios</a>
              </li>

             <li class="{{ setActiveRoute('admin.users.create') }}">
                 <a href="{{ route('admin.users.create' ) }}"><i class="fa fa-pencil"></i>Crear usuario</a>
             </li>
         </ul>
     </li>



          <li class="treeview {{ setActiveRoute(['admin.roles.index', 'admin.roles.create']) }}">

              <a href="#"><i class="fa fa-users"></i> <span>Roles</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>

              <ul class="treeview-menu">
                  <li class="{{ setActiveRoute('admin.roles.index') }}">
                      <a href="{{ route('admin.roles.index') }}"><i class="fa fa-dashboard"></i>Ver todos los roles</a>
                  </li>

                  <li class="{{ setActiveRoute('admin.roles.create') }}">
                      <a href="{{ route('admin.roles.create' ) }}"><i class="fa fa-pencil"></i>Crear rol</a>
                  </li>
              </ul>
          </li>



 </ul>
 <!-- /.sidebar-menu -->
