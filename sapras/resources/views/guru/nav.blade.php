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
      <!-- search form -->
      
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="/guru/home/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="/guru/sarana/">
            <i class="fa fa-briefcase"></i>
            <span>Data Sarana</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/guru/sarana/"><i class="fa fa-circle-o"></i> Olah Data Sarana</a></li>
            <li><a href="/guru/sarana/pinjaman/"><i class="fa fa-circle-o"></i>Olah Data Pinjaman Sarana </a></li>
            <li><a href="/guru/sarana/pengajuan/"><i class="fa fa-circle-o"></i>Olah Data Pengajuan Sarana</a></li>
           <!-- <li><a href="/guru/sarana_pinjaman"><i class="fa fa-circle-o"></i>Data Permintaan Pinjaman</a></li>-->
            
          </ul>
        </li>
        <li class="treeview">
          <a href="/guru/prasarana/">
            <i class="fa fa-building"></i>
            <span>Data Prasarana</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/guru/prasarana/"><i class="fa fa-circle-o"></i> Olah Prasarana</a></li>
            <li><a href="/guru/prasarana/ruangan/"><i class="fa fa-circle-o"></i>Olah Prasarana Ruangan </a></li>
          </ul>
        </li>
        
        <li class="header">Lainnya</li>
        <li class="treeview">
          <a href="/guru/profil/{{ Auth::user()->username }}/">
            <i class="fa fa-cog"></i> <span>Olah Profil</span>
          </a>
        </li>
        <li class="treeview">
          <a href="/guru/user/">
            <i class="fa fa-user"></i> <span>Olah User</span>
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