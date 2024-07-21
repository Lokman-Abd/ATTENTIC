<!--non-changing part--><?php include "Includes/topLayout.php";?><!--non-changing part-->

<!--changing part-->
          <div class="container-fluid" id="container-wrapper"><!-- Container Fluid-->

            <div class="d-sm-flex align-items-center justify-content-between mb-4"><!-- header-->
              <h1 class="h3 mb-0 text-gray-800">View Student Attendance</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Student Attendance</li>
              </ol>
            </div><!-- header-end-->

            <div class="row"><!--Row-->
              <div class="col-lg-12"><!--Col-->  
                <div class="card mb-4"><!-- Form Basic -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">View Student Attendance</h6>
                    <?php echo'comment'; ?>
                  </div>
                  <div class="card-body">
                    <form method="post">
                      <div class="form-group row mb-3">
                        <div class="col-xl-6">
                          <label class="form-control-label">Select Student<span class="text-danger ml-2">*</span></label>
                          <select required name="admissionNumber" class="form-control mb-3">
                            <option value="">--Select Student--</option>
                            <option value="1" >All</option>
                          </select>
                        </div>
                        <div class="col-xl-6">
                          <label class="form-control-label">Type<span class="text-danger ml-2">*</span></label>
                          <select required name="type" onchange="typeDropDown(this.value)" class="form-control mb-3">
                            <option value="">--Select--</option>
                            <option value="1" >All</option>
                            <option value="2" >By Single Date</option>
                            <option value="3" >By Date Range</option>
                          </select>
                        </div>
                      </div>
                      
                      <?php echo"<div id='txtHint'></div>";?>
                      <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
                    </form>
                  </div>
                </div><!-- Form Basic-end -->
              </div><!--Col-->
            </div><!--Row end-->

            <div class="row"><!-- Input Group -->
              <div class="col-lg-12"><!--Col-->
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                  </div>
                  <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                      <thead class="thead-light">
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Admission No</th>
                          <th>Module</th>
                          <th>Groupe</th>
                          <th>Status</th>
                          <th>Date</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td class="align-middle"><a href='/attendance/ClassTeacher/takeAttendance.php'><i class='fas fa-fw fa-edit'></i></a></td>
                          <td class="align-middle"><a href='/attendance/ClassTeacher/takeAttendance.php'><i class='fas fa-fw fa-trash'></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div><!--Col-end-->
            </div><!--Input Group End-->

          </div><!--Container Fluid end-->
<!--changing part-->

<!--non-changing part--><?php include "Includes/bottomLayout.php";?><!--non-changing part--> 