<div>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Course Schedule
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Course Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
        <div class="card card-outline card-success">
    <div class="card-body">
    <div class="control-group">

                      <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Course </label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Year</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Section</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>Semester:</label>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-1">
                                <label>Start School Year:</label>
                            </div>

                        </div>
                      <div class="row mt-2">
                            <div class="col-xs-3 col-md-2 mb-2">
                                <select wire:model="courseId" name="courseId"  id="courseId" class="form-control">
                                <option value="">--Select course--</option>
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($course->course_code); ?>"><?php echo e($course->course_code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-2">
                            <select wire:model="yearId" id="yearId" class="form-control" required>
                                <option value="">-Year-</option>
                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($year->year == '1st'): ?>
                                        <option value='1st'>1st</option>
                                        <?php break; ?>
                                        <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($year->year == '2nd'): ?>
                                        <option value='2nd'>2nd</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($year->year == '3rd'): ?>
                                        <option value='3rd'>3rd</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($year->year == '4th'): ?>
                                        <option value='4th'>4th</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-2">
                            <select wire:model="sectionId" id="sectionId" class="form-control" required>
                                <option value="">-Select Section-</option>

                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($section->section == 'A'): ?>
                                        <option value='A'>A</option>
                                        <?php break; ?>
                                        <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($section->section == 'B'): ?>
                                        <option value='B'>B</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($section->section == 'C'): ?>
                                        <option value='C'>C</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($section->section == 'D'): ?>
                                        <option value='D'>D</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($section->section == 'E'): ?>
                                        <option value='E'>E</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectiont): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectiont->section == 'F'): ?>
                                        <option value='F'>F</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($section->section == 'G'): ?>
                                        <option value='G'>G</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($section->section == 'H'): ?>
                                        <option value='H'>H</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-2">
                                <label class="form-control"><?php echo e($semesters); ?></label>
                            </div>
                            <div class="col-xs-3 col-md-2 mb-2">
                                <label class="form-control"><?php echo e($dt); ?></label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                        <button wire:click="searchId" class="btn btn-primary"><i class="fas fa-search mr-1"></i></button>
                        </div>
                         </div>
            </div>
    </div>
</div>
<?php if(!empty($generates)): ?>
<div class="card card-outline card-success">
    <div class="card-body">

            <div class="table-responsive-md">
                <table id="example2" class="table table-bordered table-striped">
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
                                        <?php echo e($lesson->subject); ?><br>
                                        <?php if($teacher = $teachers->where('idNumber',$lesson->teacher)->first()): ?>
                                        <?php echo e(ucfirst(trans($teacher->firstName[0]))); ?>.<?php echo e(ucfirst(trans($teacher->middleName[0]))); ?>.<?php echo e(ucfirst(trans($teacher->lastName))); ?>

                                        <?php endif; ?> </td>
                                    <?php elseif($generates->where('weekday',$day)->where('startTime','<',$time['end'])->where('endTime','>',$time['start'])->count()): ?>

                                    <?php else: ?>
                                    <td></td>
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                </table>
            </div>
        </div>
</div>
<?php endif; ?>
</div>

<!-- /.container-fluid -->
</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/admin/schedule-view/list-course-schedules.blade.php ENDPATH**/ ?>