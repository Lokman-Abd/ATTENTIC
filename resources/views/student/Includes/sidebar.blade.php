<ul class="navbar-nav sidebar sidebar-light accordion " id="accordionSidebar">
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('student_dashboard')}}">
        <div class="sidebar-brand-icon">
          ATTE<span style="color:rgba(0,172,193,1);">NTIC</span>
        </div>
      </a>

      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{route ('student_dashboard')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading"> 
        Absence
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="fas fa-file"></i>
          
          <span>About</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">About</h6>
            <a class="collapse-item" href="{{route('SeeMyAbsence')}}">My Absences</a>
          </div>
        </div>
      </li>
       <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin">version 3.0</div>        
</ul>