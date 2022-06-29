<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Set Up
                <small>Schedule</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Set up Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!---------- Button fucntion for Faculty -------->
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2">
    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>
       Create Schedule Data
    </button>
    <div class="btn-group ml-2">

        <button id="all" wire:click="filterGeneratesByCourse" type="button" class="btn <?php echo e(is_null($courseview) ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info"><?php echo e($courseCount); ?></span>
        </button>
        <button  wire:click="dataReset" type="button" class="btn btn-info btn-sm">
            <span class="mr-1">Archive</span>
        </button>
 </div>
    </div>
</div>
   <!----------Start Table for generate -------->
   <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
            </div>
                <div class="d-flex justify-content-end">
                <div class="row">
                    <label class=" mr-1 text-secondary" >schedule:  </label>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input  wire:model="search" type="text" name="table_search" class="form-control float-right fas fa-search input-group-sm" placeholder="Search">
                    </div>
                </div>
                </div>
        </div>
              <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive-md">
                    <table id="exampl2" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                                <th> Program Code</th>
                                <th> Year</th>
                                <th> Section</th>
                                <th> Semester </th>
                                <th> Course title </th>
                                <th> Teacher </th>
                                <th> Room </th>
                                <th> Weekdays </th>
                                <th> Start time </th>
                                <th> End time </th>
                                <th>Start School year </th>
                                <th>End school year</th>
                                <th> Created By</th>
                                <th> Updated By</th>


                            </tr>
                        </thead>


                        <tbody>

                        <?php if($generateviews->isnotEmpty()): ?>
                        <?php $__currentLoopData = $generateviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generateview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="<?php echo e($generateview->id); ?>" name="todo2" id="<?php echo e($generateview->id); ?>">
                                        <label for="<?php echo e($generateview->id); ?>"></label>
                                    </div>
                                </th>
                                <td><?php echo e($generateview->course); ?></td>
                                <td><?php echo e($generateview->year); ?></td>
                                <td><?php echo e($generateview->section); ?></td>
                                <td><?php echo e($generateview->semester); ?></td>
                                <td><?php echo e($generateview->subject); ?></td>
                                <td><?php echo e($generateview->teacher); ?></td>
                                <td><?php echo e($generateview->room); ?></td>
                                <td><?php echo e($generateview->weekday); ?></td>
                                <td><?php echo e($generateview->startTime); ?></td>
                                <td><?php echo e($generateview->endTime); ?></td>
                                <td><?php echo e($generateview->startSchool); ?></td>
                                <td><?php echo e($generateview->endSchool); ?></td>
                                <?php if($user = $users->where('idNumber',$generateview->created_by)->first()): ?>
                                <td><?php echo e(ucfirst(trans($user->lastName))); ?>, <?php echo e(ucfirst(trans($user->firstName))); ?> <?php echo e(ucfirst(trans($user->middleName[0]))); ?>.</td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <?php if($user = $users->where('idNumber',$generateview->changed_by)->first()): ?>
                                <td><?php echo e(ucfirst(trans($user->lastName))); ?>, <?php echo e(ucfirst(trans($user->firstName))); ?> <?php echo e(ucfirst(trans($user->middleName[0]))); ?>.</td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                           <td colspan="15" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr>
                                <?php endif; ?>
                        </tbody>


                    </table>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                <?php echo e($generateviews->links()); ?>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!----------Start Modal for adding Room and editting Room -------->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <form autocomplete="off" wire:submit.prevent="createGenerate">
            <div class="modal-content">

                <div class="modal-header bg-gradient-<?php echo e(($ActiveR == 'hide') ? 'success':'primary'); ?>">
                    <h5 class="modal-title" id="exampleModalLabel">

                        <span>Add New Schedule</span>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

</div>
                <div class="modal-body">
                <div class="control-group">
                 <div class="row ">
                 <div class="col-xs-3 col-md-1 mb-1">
                                <label>Name:</label>
                            </div>
                            <div class="col-xs-3 col-md-3 mb-2">
                                <select wire:model="teacherId" name="teacherId"class="form-control">
                                <option value="">--Select Teacher Name--</option>
                                <?php $__currentLoopData = $facultys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($faculty->idNumber); ?>"><?php echo e(ucfirst(trans($faculty->lastName))); ?>, <?php echo e(ucfirst(trans($faculty->firstName))); ?> <?php echo e(ucfirst(trans($faculty->middleName[0]))); ?>.</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                 </div>
                    <div class="col-xs-3 col-md-2 mb-1">
                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label >ID Code: <?php echo e($teacher->idNumber); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        <div class="col-xs-3 col-md-2 mb-1">
                                <label wire:model="semesterId" value="<?php echo e($semesters); ?>"><?php echo e($semesters); ?> Semester</label>
                            </div>
                                 <div class="col-xs-3 col-md-3 mb-1">
                                <label wire:model="startSchoolYearId" value="<?php echo e($dt); ?>">Start School Year: <?php echo e($dt); ?></label>
                            </div>

                    </div>
                    </div>
                </div>
                <div class="card card-outline card-<?php echo e(($ActiveR == 'hide') ? 'primary':'success'); ?>">
              <div class="card-header p-2">
              <div class="btn-group ml-2">
        <button id="active" wire:click="regularClass" type="button" class="btn <?php echo e(is_null($ActiveR) ? 'btn-primary':'btn-default'); ?> btn-sm" data-toggle="tab">
            <span class="mr-1">Regular Class</span>
        </button>
        <button id="hide" wire:click="regularClass('hide')"type="button" class="btn <?php echo e(($ActiveR == 'hide') ? 'btn-success':'btn-default'); ?> btn-sm" data-toggle="tab">
            <span class="mr-1">Special Class</span>
        </button>
    </div>

              </div><!-- /.card- -->

              </div><!-- /.card-header -->
              <div class="card-body">

              <div class="tab-content">
                <div class="tab-pane  <?php echo e(is_null($ActiveR) ? 'active': $ActiveS); ?>"  >
                  <form class="form-horizontal">
                      <div class="form-group row">
                      <div class="col-xs-2 col-md-1 mb-2" >
                                <label class="text-primary">Program Code</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-primary" >Year</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-primary">Section</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label class="text-primary">Course Title</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-primary">Room</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-primary">Day</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <label class="text-primary">Time start</label>
                            </div>
                            <div class=" col-xs-2 col-md-2 mb-2">
                            <label class="text-primary">Time End</label>
                            </div>
                      </div>
                      <div class="form-group row">

                      <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="courseId" wire:model.defer="state.course"class="form-control" id="courseId" placeholder="Program Code">
                        <option value="">-Courses-</option>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value='<?php echo e($course->course_code); ?>'><?php echo e($course->course_code); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                            <select  wire:model="yearId" wire:model.defer="state.year" id="yearId" class="form-control" reuired>
                                <option  value="">-Year-</option>
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
                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="sectionId" wire:model.defer="state.section" id="sectionId" class="form-control" >
                            <option value="" >--Select Section--</option>
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($section); ?>'><?php echo e($section); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                             <select wire:model="subjectId" wire:model.defer="state.subject" id="subjectId" class="form-control" >
                            <option value="" >--Select Course--</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($subject->subject_code); ?>'><?php echo e($subject->subject_title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2"  >
                            <select wire:model="roomId" wire:model.defer="state.room" id="roomId" class="form-control" >
                            <option value="" >--Select room--</option>
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($room->room); ?>'><?php echo e($room->room); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2" >
                            <select wire:model="weekdayId" wire:model.defer="state.weekday" id="weekday" name="weekday" class="form-control" >
                                <option value="">--Select Weekdays--</option>
                                <?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weekday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value='<?php echo e($weekday); ?>'><?php echo e($weekday); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1"  >
                            <input wire:model="startTimeId" wire:model.defer="state.startTime" type="time" name="startTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1">
                            <input wire:model="endTimeId" wire:model.defer="state.endTime" type="time" name="endTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                        <button wire:click.prevent="add" class="btn btn-primary">Save</button>
                        </div>
                      </div>

                    </form>
                </div>
                  <!-- /.tab-pane -->


                <div class="tab-pane <?php echo e($ActiveSp); ?>" >
                  <form class="form-horizontal" >
                  <div class="form-group row">
                      <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success" >Program Code</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success">Year</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success">Section</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label class="text-success">Course title</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success">Room</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label class="text-success">Day</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <label class="text-success">Time start</label>
                            </div>
                            <div class=" col-xs-2 col-md-2 mb-2">
                            <label class="text-success">Time End</label>
                            </div>
                      </div>
                      <div class="form-group row">

                      <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="courseId" wire:model.defer="state.course"class="form-control" id="courseId" placeholder="Program Code">
                        <option value="">-Courses-</option>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value='<?php echo e($course->course_code); ?>'><?php echo e($course->course_code); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="yearId" wire:model.defer="state.year" id="yearId" class="form-control" reuired>
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
                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="sectionId" wire:model.defer="state.section" id="sectionId" class="form-control" >
                            <option value="" >--Select Section--</option>
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($section); ?>'><?php echo e($section); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                             <select wire:model="subjectId" wire:model.defer="state.subject" id="subjectId" class="form-control" >
                            <option value="" >--Select course--</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($subject->subject_code); ?>'><?php echo e($subject->subject_title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2"  >
                            <select wire:model="roomId" wire:model.defer="state.room" id="roomId" class="form-control" >
                            <option value="" >--Select room--</option>
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($room->room); ?>'><?php echo e($room->room); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2" >
                            <select wire:model="weekdayId" wire:model.defer="state.weekday" id="weekday" name="weekday" class="form-control" >
                                <option value="">--Select Weekdays--</option>
                                <?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weekday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value='<?php echo e($weekday); ?>'><?php echo e($weekday); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1"  >
                            <input wire:model="startTimeId" wire:model.defer="state.startTime" type="time" name="startTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1">
                            <input wire:model="endTimeId" wire:model.defer="state.endTime" type="time" name="endTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                        <button wire:click.prevent="add" class="btn btn-success">Save</button>
                        </div>
                      </div>
                    </form>
                </div>
                  <!-- /.tab-pane -->

                  </div>
                <!-- /.tab-content -->
            <!--    <div class="card-body">
                    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label >Course</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label >Year</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label>Section</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>Subject</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label>Room</label>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2">
                                <label>Day</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <label>Time start</label>
                            </div>
                            <div class=" col-xs-2 col-md-2 mb-2">
                            <label>Time End</label>
                            </div>

                    </div>
                    </div>

                    <div class="control-group">
                    <div class="row mt-2">

                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="courseId" wire:model.defer="state.course"class="form-control" id="courseId" placeholder="courses">
                        <option value="">-Courses-</option>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value='<?php echo e($course->course_code); ?>'><?php echo e($course->course_code); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="yearId" wire:model.defer="state.year" id="yearId" class="form-control" reuired>
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
                            <div class="col-xs-2 col-md-1 mb-2">
                            <select wire:model="sectionId" wire:model.defer="state.section" id="sectionId" class="form-control" >
                            <option value="" >--Select Section--</option>
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($section); ?>'><?php echo e($section); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                             <select wire:model="subjectId" wire:model.defer="state.subject" id="subjectId" class="form-control" >
                            <option value="" >--Select Subject--</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($subject->subject_code); ?>'><?php echo e($subject->subject_title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2"  >
                            <select wire:model="roomId" wire:model.defer="state.room" id="roomId" class="form-control" >
                            <option value="" >--Select room--</option>
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($room->room); ?>'><?php echo e($room->room); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                            <div class="col-xs-2 col-md-1 mb-2" >
                            <select wire:model="weekdayId" wire:model.defer="state.weekday" id="weekday" name="weekday" class="form-control" >
                                <option value="">--Select Weekdays--</option>
                                <?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weekday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value='<?php echo e($weekday); ?>'><?php echo e($weekday); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1"  >
                            <input wire:model="startTimeId" wire:model.defer="state.startTime" type="time" name="startTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-2 mb-1">
                            <input wire:model="endTimeId" wire:model.defer="state.endTime" type="time" name="endTime" class="form-control">
                            </div>

                            <div class="col-xs-2 col-md-1 mb-2">
                        <button wire:click.prevent="add" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i></button>
                        </div>
                    </div>
                    </div>
                </div> -->
                </div>
        <div class="card card-outline card-<?php echo e(($ActiveR == 'hide') ? 'primary':'success'); ?>">
    <div class="card-body">
    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Regular Units: </label>

                            </div>
                                 <div class="col-xs-2 col-md-1 mb-2">
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
                            </div>
                    </div>
                    </div>
    </div>
        </div>
<div class="card card-outline card-<?php echo e(($ActiveR == 'hide') ? 'primary':'success'); ?>">
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




                             <?php $__currentLoopData = $timeRange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                     <td style="padding-left: 10px;
                                        padding-bottom: 3px; padding-top: 3px;"><?php echo e($time['start']); ?>-<?php echo e($time['end']); ?></td>

                                <?php $__currentLoopData = $weekDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($lesson = $generates->where('weekday',$day)->where('startTime',$time['start'])->first()): ?>

                                        <td rowspan="<?php echo e($lesson->difference/30 ?? ''); ?>" class="align-middle text-center" style="background-color:#f0f0f0">
                                        <?php echo e($lesson->room); ?><br>
                                        <?php echo e($lesson->subject); ?><br>
                                        <?php echo e($lesson->course); ?>  <?php echo e($lesson->year[0]); ?>-<?php echo e($lesson->section); ?></td>
                                    </td>
                                    <?php elseif($generates->where('weekday',$day)->where('startTime','<=',$time['end'])->where('endTime','>',$time['start'])->count()): ?>

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
</div>


                    <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="submit" name="addFaculty" class="btn btn-primary" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <span>Done</span>

                        </button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!----------End Modal for adding Room and editting Room -------->
</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/admin/list-generates.blade.php ENDPATH**/ ?>