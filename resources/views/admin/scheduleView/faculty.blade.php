@extends('layouts.app')
@section('content')
 
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              Faculty
              <small>Listed</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../view/home.php">Home</a></li>
              <li class="breadcrumb-item active">Faculty Listed</li>
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
                  Add Faculty
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
            <label>ID Number</label>
                 <input  type="text" name="id_number" class="form-control" placeholder="Enter Id Number" required>
            </div>

            <div class="col-xs-3 col-md-6 mb-6">
            <label>Fist Name</label>
                 <input  type="text" name="firstName" class="form-control" placeholder="Enter First Name" required>
            </div>
            <div class="col-xs-3 col-md-6 mb-6">
            <label>Last Name</label>
                 <input  type="text" name="lastName" class="form-control" placeholder="Enter last Name" required>
             </div>

            <div class="col-xs-3 col-md-6 mb-6"> 
            <label>Password</label>
                 <input  type="text" name="password" class="form-control" placeholder="Enter Password" required>
             </div> 
            <div class="col-xs-3 col-md-6 mb-6">
            <label>Email</label>
                 <input  type="email" name="email" class="form-control" placeholder="Enter your Email " required>
              </div> 
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