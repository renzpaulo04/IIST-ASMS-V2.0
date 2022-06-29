<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Dashboard
                </h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('faculty.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>

                </ol>

            </div>
        </div>
    </div>
</div>
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo e($handledStudent); ?></h3>

                <p>Handled Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo e(route('faculty.profile')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo e($handleSubjects); ?></h3>
                <p>Handled Courses</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo e(route('faculty.profile')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">

                <h3><?php echo e($handleSubjects); ?></h3>

                <p>Handled Subjects</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo e(route('faculty.profile')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        </div>
            <!-- /.card -->
    </section>

</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/faculty/dashboard.blade.php ENDPATH**/ ?>