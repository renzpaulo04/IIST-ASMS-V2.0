<div>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Profile
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('faculty.dashboard')); ?>">Home</a></li>

                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user.pngs"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo e(Auth::user()->firstName); ?>, <?php echo e(Auth::user()->middleName); ?> <?php echo e(Auth::user()->lastName); ?></h3>

                <p class="text-muted text-center">Faculty</p>



                <a href="#" class="btn btn-primary btn-block"><b>change Image</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          <!-- /.col -->
            <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Personal Information</a></li>
                  <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change Password</a></li>

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                <div class="active tab-pane" id="personal_info">
                  <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="First Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Middle Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Middle Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="First Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
                  <!-- /.tab-pane -->


                <div class="tab-pane" id="change_password">
                  <form class="form-horizontal" >
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Passoword">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputName" placeholder="Confirm Passoword">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
                  <!-- /.tab-pane -->


                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/guest/guest-profile.blade.php ENDPATH**/ ?>