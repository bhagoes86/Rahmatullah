 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          
          <img src="{{{asset('images/user.png')}}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">

          <p>{{ Auth::user()->name }}</p>
          <a href="#"></i>NIP : {{ Auth::user()->username }}</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="/operator/home/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="/operator/sarana/pinjaman/">
            <i class="fa fa-user"></i> <span>Olah Pinjaman Sarana Siswa</span>
          </a>
        </li>
        <li class="treeview">
          <a href="/operator/sarana/pengajuan">
            <i class="fa fa-user"></i> <span>Olah Pengajuan Sarana Siswa</span>
          </a>
        </li>
        <li class="header">Lainnya</li>
        <li class="treeview">
          <a href="/operator/profil/{{ Auth::user()->username }}/">
            <i class="fa fa-cog"></i> <span>Olah Profil</span>
          </a>
        </li>
         <li class="treeview">
         <a  href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> 
               <span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
          </a>
        </li>
        </li>
        </span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>