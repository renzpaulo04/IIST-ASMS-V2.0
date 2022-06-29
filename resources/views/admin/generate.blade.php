@extends('layouts.app')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              Generate
              <small>Schedule</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Genrate Schedule</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
             <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                  Add Schedule
                </button>
           
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
              <h4 class="modal-title">Generate Schedule</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="row">
            <div class="col-xs-3 col-md-6 mb-6">
                 <label >Course : </label>
                    <select id="course" name="course" class="form-control" onchange="getcourse(this.value)" required>
                        <option selected disabled>--Select Courses--</option> 
                    </select>
            </div>

            <div class="col-xs-3 col-md-6 mb-6">
                <label for="year">Year : </label>
                    <input type="hidden" id="cr_id" name="cr_id">
                        <select id="year" name="year" class="form-control" reuired>
                            <option selected disabled>--Select Year--</option> 
                        </select>
            </div>
            </div>
            <div class="row">
            <div class="col-xs-3 col-md-6 mb-6">
               <label >Section : </label>
               <select id="section" name="section" class="form-control" reuired>
                 <option selected disabled>--Select Year--</option> 
                 <option value="A">A</option>
                 <option value="B">B</option>   
                 <option value="C">C</option>   
                 <option value="D">D</option>   
                 <option value="E">E</option>   
                 <option value="F">F</option>   
                 <option value="G">G</option> 
                </select>       
             </div>

            <div class="col-xs-3 col-md-6 mb-6"> 
                  <label for="sem" >Semester : </label>
                      <input type="hidden" id="years_id" name="years_id">
                          <select id="sem" name="sem" class="form-control" >
                             <option selected disabled >--Select Semester--</option> 
                           </select>
             </div> 
            </div>
            <div class="row">
              <div class="col-xs-3 col-md-6 mb-6">
                     <label >Subject : </label>
                     <label id="sm_id" name="sm_id"></label>
                             <select id="subject" name="subject" class="form-control" >
                                <option selected disabled >--Select Subject Available--</option>

                            </select>
              </div> 
              <div class="col-xs-3 col-md-6 mb-6">
                <label for="room" >Room : </label>
                <label id="sb_id" name="sb_id"></label>
                  <select id="room" name="room" class="form-control" >
                    <option value="">--Select Room--</option> 
                  </select>
              </div> 
            </div>
            <div class="row">
              <div class="col-xs-3 col-md-6 mb-6">
                <label for="day" >Weekdays : </label>
                <label id="st_id" name="st_id"></label>
                  <select id="weekdays" name="weekdays" class="form-control" >
                    <option value="#">--Select Weekdays--</option>    
                  </select> 
            </div>
            <div class="col-xs-3 col-md-8 mb-6">
              <label for="time" >Time Start : </label>
              <input type="time" name="startTime">
              <label for="time" >Time End :   </label>
                <input type="time" name="endTime">
              </div>
              <div class="col-xs-3 col-md-6 mb-6">
                <label>Start School Year</label>
                  <input  type="number" name="startSchool" class="form-control" min="2000" max="3999"  value="2022" required>
              </div>
              <div class="col-xs-3 col-md-6 mb-6">
                <label>End School Year</label>
                <input  type="number" name="endSchool" class="form-control" min="2000" max="3999"  value="2022" required>
              </div> 
            <!-- general form elements disabled -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
    <div class="datamodal">
    <a class="btn btn-info fas fa-edit" data-toggle="modal" onclick="editFunc()" data-target="#editModal"></a>
    <a class="btn btn-danger fas fa-trash-alt" data-toggle="modal" onclick="removeFunc()" data-target="#removeModal"></a>
    </div>

</div>
        </div>
    </section>
    <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-head-fixed text-nowrap table-responsive p-0" style="height: 150px;">
                  <thead>
                  <tr>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Section</th>
                    <th>Semester</th>
                    <th>Subject</th>
                    <th>Room</th>
                    <th>Weekdays</th>
                    <th>Time Start</th>
                    <th>Time End</th>
                    <th>Start School Year</th>
                    <th>End School Year</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td> 4</td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td> 4</td>
                    <td> 4</td>
                    <td> 4</td>
                    <td> 4</td>
                  </tr>
                  </tbody>
                </table>
                </div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>  
@endsection