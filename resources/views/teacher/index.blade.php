<!--non-changing part-->@include("teacher.Includes.topLayout")<!--non-changing part-->

<!--changing part-->
          <div class="container-fluid" id="container-wrapper"><!-- Container Fluid-->
            <div class="d-sm-flex align-items-center justify-content-between mb-4"><!--header-->
              <h1 class="h3 mb-0 text-gray-800">Class Teacher Dashboard </h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('teacherDashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </div><!--header-end-->

            <div class="row mb-3">
              <!-- Students Card -->
              <div class="col-xl-6 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Students</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$AllStudents}}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">All Teached Students</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Class Card -->
              <div class="col-xl-6 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Classes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$allClasses}}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">All Teached Classes</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-chalkboard fa-bounce fa-2x text-primary"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Session Card -->
              <div class="col-xl-6 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Session</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$allStudies}}</div>
                        <div class="mt-2 mb-0 text-muted text-xs">All Sessions</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-briefcase fa-2x text-success"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- attendence Card -->
            </div>
          </div><!-- Container Fluid-end-->
<!--changing part-->

<!--non-changing part-->@include("teacher.Includes.bottomLayout")<!--non-changing part-->