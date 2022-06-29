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
                    <li class="breadcrumb-item"><a href="<?php echo e(route('guest.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>

            </ol>

            </div>
        </div>
    </div>
</div>

 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">


            <div class="card card-outline card-success">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active "  href="#create_attendance" data-toggle="tab">Fill Up Below</a></li>

                </ul>

              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                <div class="active tab-pane" id="create_attendance">
                  <form class="form-horizontal">
                    <div class="row">
                        <div class="col-xs-2 col-md-1 mb-2">
                              <label for="inputName" class=" col-form-label">Day</label>

                     </div>
                              <div class="col-xs-1 col-md-2 mb-1">
                        <select wire:model="dayId"wire:model.defer="state.day" class="form-control" required>
                        <option value="">--Select Day--</option>
                        <?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weekday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value='<?php echo e($weekday); ?>'><?php echo e($weekday); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                    <div class="col-xs-2 col-md-1 mb-1">
                        <label for="inputName" class="col-form-label">Room</label>
                    </div>
                    <div class="col-xs-1 col-md-2 mb-1">
                        <select  wire:model="roomId" wire:model.defer="state.room" class="form-control" required>
                        <option value="">--Select Room--</option>
                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value='<?php echo e($room->room); ?>'><?php echo e($room->room); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-2 col-md-1 mb-1">
                        <label for="inputName" class="col-form-label">Teacher</label>
                    </div>
                    <div class="col-xs-1 col-md-2 mb-1">
                        <select  wire:model="teacherId" wire:model.defer="state.teacher" class="form-control" required>
                        <option value="">--Select teacher--</option>
                        <?php $__currentLoopData = $Fteachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fteacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($teacher = $teachers->where('teacher',$fteacher->idNumber)->first()): ?>
                        <option value='<?php echo e($teacher->teacher); ?>'>
                                        <?php echo e(ucfirst(trans($fteacher->firstName[0]))); ?>.<?php echo e(ucfirst(trans($fteacher->middleName[0]))); ?>.<?php echo e(ucfirst(trans($fteacher->lastName))); ?>

                                        </option>
                                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-xs-2 col-md-1 mb-1">
                            <label class="text-success">Time start</label>
                            </div>

                            <div class="col-xs-1 col-md-2 mb-1">
                            <input  wire:model.defer="state.startTime" type="time" name="startTime" class="form-control">
                            </div>
                            <div class=" col-xs-2 col-md-1 mb-1">
                            <label class="text-success">Time End</label>
                            </div>
                            <div class="col-xs-1 col-md-2 mb-1">
                            <input  wire:model.defer="state.endTime" type="time" name="endTime" class="form-control">
                            </div>
                            </div>
                    <div class="row">
                            <div class=" col-xs-2 col-md-1 mb-1">
                                <label class="text-primary">No. students</label>
                            </div>
                            <div class="col-xs-1 col-md-2 mb-1">
                                <input type="number"  wire:model.defer="state.noStudent"class="form-control" placeholder="Number Of Student" required>
                            </div>
                    </div>
                    <div class="modal-footer mt-4">
                    <p  class= "float-sm-right" >    Fill up the form above if your are barrowing class room in our department. Then click Save</p>
                        <button type="submit" wire:click.prevent="createForm" name="addFaculty" class="btn btn-primary" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <span>Save</span>
                        </button>

                    </div>

                    </form>
                </div>


              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/guest/guest-dashboard.blade.php ENDPATH**/ ?>