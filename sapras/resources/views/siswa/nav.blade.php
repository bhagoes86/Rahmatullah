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
          <a href="#"></i>NIS : {{ Auth::user()->username }}</a>
        </div>
      </div>
      <!-- search form -->
      
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <li class="active treeview">
          <a href="/home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
          
        </li>
        <li class="treeview">
          <a href="/siswa/sarana/">
            <i class="fa fa-briefcase"></i>
            <span>Sarana</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/siswa/sarana/"><i class="fa fa-circle-o"></i>Lihat Sarana</a></li>
            <li><a href="/siswa/sarana/pinjaman"><i class="fa fa-circle-o"></i> Peminjaman Sarana</a></li>
            <li><a href="/siswa/sarana/pengajuan/"><i class="fa fa-circle-o"></i>Pengajuan Sarana </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="/siswa/prasarana">
            <i class="fa fa-building"></i>
            <span>Prasarana</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        </li>
        <li class="header">Lainnya</li>
        <li class="treeview">
          <a href="/siswa/profil/{{ Auth::user()->username }}">
            <i class="fa fa-cog"></i>
            <span>Olah Profile</span>
            <span class="pull-right-container">
            
            </span>
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
        </span></a></li>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>