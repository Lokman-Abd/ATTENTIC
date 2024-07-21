<!--non-changing part-->@include ("student.Includes.topLayout")<!--non-changing part-->

<!--changing part-->
    <div class="container-fluid" id="container-wrapper"><!-- Container Fluid-->
          
        <div class="d-sm-flex align-items-center justify-content-between mb-4"><!--header-->
            <h1 class="h3 mb-0 text-gray-800">My absences</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">see my absences</li>
            </ol>
        </div><!--header-end-->
        
            
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Total Absences</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Module</th>
                        <th>Type</th>
                        <th>Absence Without Justification</th>
                        <th>Absence With Justification</th>
                        <th>Status</th>
                        <th>Justify</th>
                        {{-- <th>Action</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @for ($i = 0; $i <count($module_list); $i++)
                      <?php
                      $moduleANDtype=$module_list[$i];
                      $tempvar=explode(' ',$moduleANDtype,2);
                      ?>
                    
                      <tr> 
                        <td>{{$tempvar[1]}}</td>
                        <td>{{$tempvar[0]}}</td>
                        <td><?php 
                        if (array_key_exists($tempvar[1].'.'.$tempvar[0],$non_justified_list)==true) {
                          $count_non_justified=$non_justified_list[$tempvar[1].'.'.$tempvar[0]];
                          echo $count_non_justified;
                        }
                        else {
                          $count_non_justified=0;
                          echo $count_non_justified;
                        }
                        ?></td>
                        <td><?php 
                          if (array_key_exists($tempvar[1].'.'.$tempvar[0],$justified_list)==true) {
                            $count_justifie=$justified_list[$tempvar[1].'.'.$tempvar[0]];
                            echo $count_justifie ;
                          }
                          else {
                            $count_justifie=0;
                            echo $count_justifie;
                          }
                          ?></td>
                           <?php
                           if($count_justifie>=5||$count_non_justified>=3||$count_non_justified+$count_justifie>=5)
                           {
                             ?>
                             <td><span class="badge badge-danger">Danger</span></td>
                             <?php
                           }
                           elseif (($count_justifie+$count_non_justified>3&&$count_justifie+$count_non_justified<5)||$count_non_justified>=2|| $count_justifie>=3) {
                            ?>
                             <td><span class="badge badge-warning">Warning</span></td>
                             <?php
                           }
                           else{
                            ?>
                            <td><span class="badge badge-success">Okay</span></td>
                            <?php
                           }
                           ?>
                        
                        <td><a href="{{route ('student_dashboard')}}" class="btn btn-sm btn-primary">justify</a></td>
                      </tr>
                      @endfor
                 
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
        </div><!--Row--> 
    </div><!-- Container-Fluid-end-->
<!--changing part-->

<!--non-changing part--> @include ("Student.Includes.bottomLayout")<!--non-changing part-->