@extends('layouts.app')
@section('content')
 
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              SUBJECT
              <small>Listed</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../view/home.php">Home</a></li>
              <li class="breadcrumb-item active">Subject Listed</li>
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
                  Add Subject
                </button>
           
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
              <h4 class="modal-title">Add Faculty</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="row">
            <div class="col-xs-3 col-md-6 mb-6">
                <label>Course</label>
                <select id="course" name="course" class="form-control" required>
        <option value="">--Select Courses --</option> 
        <option value="BSIS">BSIS</option> 
        <option value="BSIT">BSIT</option>    
        </select>
        </div>
                <div class="col-xs-3 col-md-6 mb-6">
              <label>Course Code</label>
                 <input  type="text" name="courseCode" class="form-control" placeholder="Enter Course Code" required>
             </div>

             <div class="col-xs-3 col-md-6 mb-6">
                 <label>Subject Title</label>
                 <input  type="text" name="SubjectTitle" class="form-control" placeholder="Enter Subject Name" required>
            </div>

    
            <div class="col-xs-3 col-md-6 mb-6">
                    <label>Units</label>
                    <input  type="number" name="units" class="form-control" placeholder="Enter Units" required>
            </div>

            <div class="col-xs-3 col-md-6 mb-6">
                <label>Lecture Hours</label>
                <input  type="number" name="lecHours" class="form-control" placeholder="Enter Lecture Hours">

             </div>

             <div class="col-xs-3 col-md-6 mb-6">
                <label>leboratory Hours</label>
                 <input  type="number" name="labHours" class="form-control" placeholder="Enter Laboratory hours ">
             </div>
             <div class="col-xs-3 col-md-6 mb-6">
                <label>Status</label>
                <select id="status" name="status" class="form-control" required>
        <option value="">--Select major or minor subject --</option> 
        <option value="major">Major</option> 
        <option value="minor">Minor</option>    
        </select>
             </div>
             <div class="col-xs-3 col-md-6 mb-6">
                <label>Year</label>
                <select id="year" name="year" class="form-control" required>
        <option value="">--Select what year--</option> 
        <option value="1st">1st</option> 
        <option value="2nd">2nd</option>
        <option value="3rd">3rd</option> 
        <option value="4th">4th</option>     
        </select>
             </div>
             <div class="col-xs-3 col-md-6 mb-6">
                <label>Semester</label>
                <select id="semester" name="semester" class="form-control" required>
        <option value="">--Select what Semester--</option> 
        <option value="1st">1st</option> 
        <option value="2nd">2nd</option>    
        </select>
        </div>
            <!-- general form elements disabled -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Add</button>
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
@endsection