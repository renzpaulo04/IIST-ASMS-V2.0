<div>
  <!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Faculty
                <small>Schedule View</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Faculty Schedule View</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!----------Start Table for faculty -------->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
            </div>
                <div class="d-flex justify-content-end">
                <div class="row">
                    <label class=" mr-1 text-secondary" >By Facutly Name:  </label>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input  wire:model="search" type="text" name="table_search" class="form-control float-right fas fa-search input-group-sm" placeholder="Search">
                    </div>
                </div>
                </div>
        </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                    <?php if($facultyCount != 0): ?>
                        <thead>
                            <tr>
                                <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                                <th> Id Number</th>
                                <th> First Name</th>
                                <th> Last Name</th>
                                <th> Email </th>
                                <th> View </th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php $__currentLoopData = $facultys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="<?php echo e($faculty->id); ?>" name="todo2" id="<?php echo e($faculty->id); ?>">
                                        <label for="<?php echo e($faculty->id); ?>"></label>
                                    </div>
                                </th>
                                <td><?php echo e($faculty->idNumber); ?></td>
                                <td><?php echo e($faculty->firstName); ?></td>
                                <td><?php echo e($faculty->lastName); ?></td>
                                <td><?php echo e($faculty->email); ?></td>
                                <td><a href="" ><i wire:click.prevent="view(<?php echo e($faculty); ?>)"  class="fa fa-edit mr-2"></i></a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <label class="form-control">No record Found</label>
                            </tbody>
                            <?php endif; ?>


                    </table>

                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!----------End Table for Room -------->
<!----------Start Modal for adding faculty and editting faculty -------->
<div class="modal fade" id="modal-xl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <form autocomplete="off" wire:submit.prevent="">
            <div class="modal-content">
                <div class="modal-header bg-gradient-info">
                    <h5 class="modal-title" id="exampleModalLabel">
                    <?php if(!empty($showUnits)): ?>
                    <?php $__currentLoopData = $showUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span> <?php echo e($showUnit->lastName); ?>, <?php echo e($showUnit->firstName); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
             <!----------Start Table for faculty -------->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
            </div>
        </div>
        <div class="card card-outline card-success">
    <div class="card-body">
    <div class="control-group">

                      <div class="row mt-2">
                      <div class="col-xs-3 col-md-2 mb-1">
                                <label>Start School Year:</label>
                            </div>
                                <div class="col-xs-3 col-md-2 mb-2">
                                <?php if(!empty($dt)): ?>
                                <label><?php echo e($dt); ?></label>
                                <?php endif; ?>
                                 </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <label wire:model="semesterId" value="<?php echo e($semesters); ?>"><?php echo e($semesters); ?> Semester</label>
                            </div>

                         </div>
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Regular Units: </label>

                            </div>
                                 <div class="col-xs-2 col-md-1 mb-2">
                                 <?php if(!empty($showUnits)): ?>
                                 <?php $__currentLoopData = $showUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label><?php echo e($showUnit->regular); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >OverLoad:</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                             <?php $__currentLoopData = $showUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label><?php echo e($showUnit->overload); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>Total Units:</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                            <?php $__currentLoopData = $showUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label><?php echo e($showUnit->overload + $showUnit->regular + $showUnit->units); ?> </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>Designation:</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                            <?php $__currentLoopData = $showUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label><?php echo e($showUnit->units); ?> </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>

                    </div>
            </div>
    </div>

        <div class="card card-outline card-success">
    <div class="card-body">
        <div class="control-group">
            <div class="table-responsive-md">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <th with='125'>Time</th>
                        <?php $__currentLoopData = $weekDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($day); ?></th>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </thead>
                            <tbody>

                            <?php if(!empty($timeRange)): ?>
                             <?php $__currentLoopData = $timeRange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                     <td style="padding-left: 10px;
                                        padding-bottom: 3px; padding-top: 3px;"><?php echo e($time['start']); ?>-<?php echo e($time['end']); ?></td>
                                        <?php $__currentLoopData = $weekDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($generates)): ?>
                                    <?php if($lesson = $generates->where('weekday',$day)->where('startTime',$time['start'])->first()): ?>

                                        <td rowspan="<?php echo e($lesson->difference/30 ?? ''); ?>" class="align-middle text-center" style="background-color:blue">
                                        <?php echo e($lesson->room); ?><br>
                                        <?php echo e($lesson->subject); ?><br>
                                        <?php echo e($lesson->course); ?>  <?php echo e($lesson->year[0]); ?>-<?php echo e($lesson->section); ?></td>

                                    <?php elseif($generates->where('weekday',$day)->where('startTime','<=',$time['end'])->where('endTime','>',$time['start'])->count()): ?>

                                    <?php else: ?>
                                    <td></td>
                                    <?php endif; ?>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </tbody>


                </table>

            </div>
        </div>
    </div>
</div>

                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!----------End Table for Room -------->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="button"  name="addFaculty" class="btn btn-primary" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <span>Print</span>
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
<!----------End Modal for adding Room and editting Room -------->
</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/admin/schedule-view/list-faculty-schedules.blade.php ENDPATH**/ ?>