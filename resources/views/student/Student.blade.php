<!--non-changing part-->@include("student.Includes.topLayout")
<!--non-changing part-->

<!--changing part-->
<div class="container-fluid" id="container-wrapper">
    <!-- Container Fluid-->
    <!-- <div class="alert alert-success text-center" role="alert">
    lokman test
    </div> -->
    <div id="alert_container">

    </div>


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!--header-->
        <h1 class="h3 mb-0 text-gray-800">Justification</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('student_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Justification</li>
        </ol>
    </div>
    <!--header-end-->


    <div class="row">
        <!--Row-->
        <div class="col-lg-12">
            <!--col-->
            <div class="card mb-4">
                <!-- Form Basic -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Upload justification</h6>
                </div>
                <div class="card-body">
                    <form>
                        <input type="hidden" name="student_id" id="student_id" value="{{$student_id}}">
                        <div class="form-group col mb-3">
                            <div class="col-xl-12">
                                <div class="form-group" id="simple-date4">
                                    <label for="dateRangePicker">Time Range</label>
                                    <div class="input-daterange input-group">
                                        <input type="text" class="input-sm form-control" name="start" id="start_date" />
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">to</span>
                                        </div>
                                        <input type="text" class="input-sm form-control" name="end" id="end_date" />
                                    </div>
                                </div>
                            </div>
                            <!-- file-input styling css -->
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <button type="button"  class="btn btn-primary btn-block addFileButton" onclick="document.getElementById('inputFile').click()">Add Image Or PDF</button>
                                    <div class="form-group inputDnD">
                                        <label class="sr-only" for="inputFile">File Upload</label>
                                        <input type="file" id="inputFile" class="form-control-file text-primary font-weight-bold" accept="image/*,.pdf" data-title="Drag and drop a file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" name="save" id="send" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div><!-- Form Basic end -->
        </div>
        <!--col-end-->
    </div>
    <!--row-end-->



</div><!-- Container-Fluid-end-->
<!--changing part-->

<!--non-changing part--> @include("student.Includes.bottomLayout")
<!--non-changing part-->
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        $(document).on('change', '#inputFile', function() {
            input = this
            var co = 0;
            var children = "";
            for (var i = 0; i < input.files.length; ++i) {
                children += input.files.item(i).name + ', ';
                co++;
            }
            input.setAttribute("data-title", children + `        `);
            $('.addFileButton').html(children)
        })

        $("#send").click(function() {

            var form_data = new FormData();
            var student_id = $("#student_id").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            form_data.append('student_id', student_id);
            form_data.append('justification', $('#inputFile')[0].files[0]);
            form_data.append('start_date', start_date);
            form_data.append('end_date', end_date);
            
            jQuery.ajax({
                url: '{{route("justifications")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:form_data
                ,
                processData: false,
                contentType: false,
                method: 'POST',
                success: function(response) {
                    if (response.status) {
                        $("#alert_container").html(
                            `
                        <div class="alert alert-success alert-dismissible " role="alert" id="buttonAlert">
                            <strong>Success! </strong>${response.message}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        `
                        )

                    } else {
                        $("#alert_container").html(
                            `
                        <div class="alert alert-danger alert-dismissible " role="alert" id="buttonAlert">
                            <strong> Sorry ! </strong>${response.message}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        `
                        )
                    }
                    $.each($('.input-daterange input'), function(i, field) {
                        field.value = '';
                    });
                }
            });
        });

    });
</script>