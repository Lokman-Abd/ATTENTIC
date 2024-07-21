 <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('teacherDashboard')}}">
        <div class="sidebar-brand-icon">
       
          ATTE<span style="color:rgba(0,172,193,1);">NTIC</span>
        </div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('teacherDashboard')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> 
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Students
      </div>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
          aria-expanded="true" aria-controls="collapseBootstrap2">
          <i class="fas fa-user-graduate"></i>
          <span>Manage Session</span>
        </a>
        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Session</h6>
            <a class="collapse-item" href="{{route('manageStudy')}}">manage Session</a>
          </div>
        </div>
      </li>
      
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin">version 3.0</div>
    </ul>