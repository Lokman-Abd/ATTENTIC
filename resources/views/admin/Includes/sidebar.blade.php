
<ul class="navbar-nav sidebar sidebar-light accordion " id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-icon">
          ATTE<span style="color:rgba(0,172,193,1);">NTIC</span>
        </div>
      </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="{{route('dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Study
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
      <i class="fas fa-chalkboard"></i>
      <span>Manage Study</span>
    </a>
    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage Moduls</h6>
        <a class="collapse-item" href="{{route('manageModuleSections')}}">Manage Sections</a>
        <a class="collapse-item" href="{{route('manageTeaching')}}">Manage Teaching</a>
        <a class="collapse-item" href="{{route('manageGroupTeaching')}}">Manage Group Teaching</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Teachers
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapassests" aria-expanded="true" aria-controls="collapseBootstrapassests">
      <i class="fas fa-chalkboard-teacher"></i>
      <span>Manage Teachers</span>
    </a>
    <div id="collapseBootstrapassests" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage Class Teachers</h6>
        <a class="collapse-item" href="{{ route('manageTeacher')}}">Manage Teachers</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Students
  </div>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap2">
      <i class="fas fa-user-graduate"></i>
      <span>Manage Students </span>
    </a>
    <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage </h6>
        <a class="collapse-item" href="{{route('manageStudent')}}">Manage Students</a>
        <a class="collapse-item" href="{{route('displayJustifications')}}">Manage Justifications</a>
        <a class="collapse-item" href="{{route('displayExcludedStudents')}}">Excluded Students</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">
  <div class="version" id="version-ruangadmin">version 3.0</div>

</ul>