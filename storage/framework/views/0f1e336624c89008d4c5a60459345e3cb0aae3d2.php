<div>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Schedule
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('faculty.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>
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
                                <label>Start School Year <?php echo e($dt); ?></label>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-2">
                            <label wire:model="semesterId" value="<?php echo e($semesters); ?>"><?php echo e($semesters); ?> Semester</label>
                                 </div>

                         </div>
                    </div>
                </div>
            </div>
    <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive-md">
                    <table id="example2" class="table table-bordered table-striped">
                    <?php if(!empty($generates)): ?>
                    <thead>
                        <th with='125'>Time</th>
                        <?php $__currentLoopData = $weekDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($day); ?></th>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </thead>
                            <tbody>

                             <?php $__currentLoopData = $timeRange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                     <td style="padding-left: 10px;
                                        padding-bottom: 3px; padding-top: 3px;"><?php echo e($time['start']); ?>-<?php echo e($time['end']); ?></td>

                               <?php $__currentLoopData = $weekDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($lesson = $generates->where('weekday',$day)->where('startTime',$time['start'])->first()): ?>
                                        <td rowspan="<?php echo e($lesson->difference/30 ?? ''); ?>" class="align-middle text-center" style="background-color:#f0f0f0">
                                        <?php echo e($lesson->room); ?><br>
                                    <?php echo e($lesson->subject); ?>

                                      <br>

                                        <?php echo e($lesson->course); ?>  <?php echo e($lesson->year[0]); ?>-<?php echo e($lesson->section); ?></td>
                                    <?php elseif($generates->where('weekday',$day)->where('startTime','<',$time['end'])->where('endTime','>',$time['start'])->count()): ?>

                                    <?php else: ?>
                                    <td></td>
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <label class="form-control">Input start school year and semester to see your schedule if available</label>
                            </tbody>

                                <?php endif; ?>
                    </table>

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
</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/faculty/faculty-schedule-view.blade.php ENDPATH**/ ?>