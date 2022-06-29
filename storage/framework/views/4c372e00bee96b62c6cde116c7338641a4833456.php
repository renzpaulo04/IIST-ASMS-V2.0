<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Attendance
                </h1>
            </div>
            </button>
     
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('faculty.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                    <li class="breadcrumb-item active"><?php echo e($semesters); ?> Semester / <?php echo e($dt); ?> School Year</li>



                </ol>

            </div>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <?php if($selectedRows): ?>
    <button wire:click.prevent="markAsPresent" class="btn btn-outline-success btn-xs"><i class="fas fa-check-circle mr-1"></i>Mark as Present</button>
    <button wire:click.prevent="markAsLate" class="btn btn-outline-warning btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as Late</button>
    <button wire:click.prevent="markAsAbsent" class="btn btn-outline-danger btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as Absent</button>

    <span class="ml-2">Selected <?php echo e(count($selectedRows)); ?> <?php echo e(Str::plural('student', count($selectedRows))); ?></span>  
    <?php endif; ?>
    </div>
    <!-- Main content -->
 <section class="content">
      <div class="container-fluid">


            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link <?php echo e($activeC); ?> " wire:click.prevent="c_attendance" href="#create_attendance" data-toggle="tab">Create Class Attendance</a></li>
                  <li class="nav-item"><a class="nav-link <?php echo e($activeS); ?> "wire:click.prevent="s_attendance" href="#student_attendance" data-toggle="tab">Class Attendance Scan By ID</a></li>
                  <li class="nav-item"><a class="nav-link <?php echo e($activeM); ?> "wire:click.prevent="m_attendance" href="#manual_attendance" data-toggle="tab">Class Attendance Manual</a></li>
                </ul>


              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                <div class="<?php echo e($activeC); ?> tab-pane" id="create_attendance">
                  <form class="form-horizontal">
                    <div class="row">

                    <div class="col-xs-3 col-md-1 mb-2">
                        <label for="inputName" class="col-form-label">Section</label>
                    </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select  wire:model="sectionId" class="form-control" required>
                        <option value="">--Select Section--</option>
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
                    <div class="col-xs-3 col-md-1 mb-2">
                        <label for="inputName" class=" col-form-label" >Subject</label>
                    </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select wire:model="subjectId" class="form-control" required>
                        <option value="">--Select Subject--</option>

                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value='<?php echo e($subject->subject); ?>'><?php echo e($subject->subject); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                    </div>
                    </div>



                    <div class="card card-outline card-success">
                    <div class="card-body">
                    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >Student Id No.</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label >last Name</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                                <label>First Name</label>
                            </div>
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="IdNumberId.0" class="form-control  <?php $__errorArgs = ['IdNumberId.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputName" placeholder="Id Number">
                            <?php $__errorArgs = ['IdNumberId.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="lastNameId.0" class="form-control  <?php $__errorArgs = ['lastNameId.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputName" placeholder="Last Name">
                            <?php $__errorArgs = ['lastNameId.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="firstNameId.0"  class="form-control <?php $__errorArgs = ['firstNameId.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputName" placeholder="First Name">
                            <?php $__errorArgs = ['firstNameId.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                         <button wire:click.prevent="add(<?php echo e($i); ?>)" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i></button>
                            </div>
                    </div>
                    </div>

                    <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="control-group">
                    <div class="row mt-2">
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="IdNumberId.<?php echo e($value); ?>" class="form-control  <?php $__errorArgs = ['IdNumberId.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  placeholder="Id Number">
                            <?php $__errorArgs = ['IdNumberId.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="lastNameId.<?php echo e($value); ?>" class="form-control  <?php $__errorArgs = ['lastNameId.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Last Name">
                            <?php $__errorArgs = ['lastNameId.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <input type="text" wire:model="firstNameId.<?php echo e($value); ?>"  class="form-control  <?php $__errorArgs = ['firstNameId.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="First Name">
                            <?php $__errorArgs = ['firstNameId.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                            <div class="col-xs-2 col-md-2 mb-2">
                            <button class="btn btn-danger" wire:click.prevent="remove(<?php echo e($key); ?>)"><i class="fa fa-times-circle mr-1"></i></button>
                        </div>
                    </div>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="submit" wire:click.prevent="createStudent" name="addFaculty" class="btn btn-primary" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <span>Save</span>
                        </button>

                    </div>

                    </form>
                </div>

                <div class="<?php echo e($activeS); ?> tab-pane" id="student_attendance">
                  <form class="form-horizontal">
                  <div class="row">

                     <div class="col-xs-3 col-md-1 mb-2">
                        <label  class="col-form-label">Section</label>
                        </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select  wire:model="sectionIds" class="form-control" required>
                        <option value="">--Select Section--</option>
                        <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($sectionstime->section == 'A'): ?>
                                        <option value='A'>A</option>
                                        <?php break; ?>
                                        <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'B'): ?>
                                        <option value='B'>B</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'C'): ?>
                                        <option value='C'>C</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'D'): ?>
                                        <option value='D'>D</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'E'): ?>
                                        <option value='E'>E</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'F'): ?>
                                        <option value='F'>F</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'G'): ?>
                                        <option value='G'>G</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'H'): ?>
                                        <option value='H'>H</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>
                        <div class="col-xs-3 col-md-1 mb-2">
                        <label class=" col-form-label" >Subject</label>
                    </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select wire:model="subjectIds" class="form-control" required>
                        <option value="">--Select Subject--</option>

                        <?php $__currentLoopData = $subjectstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subjectstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value='<?php echo e($subjectstime->subject); ?>'><?php echo e($subjectstime->subject); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                    <div class="col-xs-3 col-md-2 mb-2">
                    <label class=" col-form-label float-right">Room:</label>
                    </div>
                    <div class="col-xs-3 col-md-2 mb-2">
                        <input type="text" wire:model="roomId" class="form-control" placeholder="Input Room" required>
                    </div>
                    </div>


                    <div class="card card-outline card-success">
                    <div class="card-body">
                    <div class="table-responsive-md">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                           <th with='125'>Student Name</th>
                           <th>Time Start</th>
                           <th>Time End</th>
                           <th>Attendance</th>
                        </thead>
                        <tbody>
         
                        </tbody>
                    </table>


                    <div class="modal-footer mt-4">
                        <button type="submit"  name="addFaculty" class="btn btn-success" value="addFaculty"><i ></i>
                        <span>Start</span>
                        </button>
                        <button type="submit"  name="addFaculty" class="btn btn-danger" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <span>Stop</span>
                        </button>
                    </div>

                      </div>
                      </div>
                    </form>
                </div>
                </div>
                  <!-- /.tab-pane -->
                  <div class="<?php echo e($activeM); ?> tab-pane" id="manual_attendance">
                  <form class="form-horizontal">
                  <div class="row">

                     <div class="col-xs-3 col-md-1 mb-2">
                        <label  class="col-form-label">Section</label>
                        </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select  wire:model="sectionIds" class="form-control" required>
                        <option value="">--Select Section--</option>
                        <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($sectionstime->section == 'A'): ?>
                                        <option value='A'>A</option>
                                        <?php break; ?>
                                        <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'B'): ?>
                                        <option value='B'>B</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'C'): ?>
                                        <option value='C'>C</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'D'): ?>
                                        <option value='D'>D</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'E'): ?>
                                        <option value='E'>E</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'F'): ?>
                                        <option value='F'>F</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'G'): ?>
                                        <option value='G'>G</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $sectionstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sectionstime->section == 'H'): ?>
                                        <option value='H'>H</option>
                                        <?php break; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>
                        <div class="col-xs-3 col-md-1 mb-2">
                        <label class=" col-form-label" >Subject</label>
                    </div>
                     <div class="col-xs-3 col-md-2 mb-2">
                        <select wire:model="subjectIds" class="form-control" required>
                        <option value="">--Select Subject--</option>

                        <?php $__currentLoopData = $subjectstimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subjectstime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value='<?php echo e($subjectstime->subject); ?>'><?php echo e($subjectstime->subject); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                    <div class="col-xs-3 col-md-1 mb-2">
                    <label class=" col-form-label float-right">Room:</label>
                    </div>
                    <div class="col-xs-3 col-md-2 mb-2">
                        <input type="text" wire:model="roomId" class="form-control" placeholder="Input Room" required>
                    </div>
                    <div class="col-xs-3 col-md-1 mb-2">
                    <label class=" col-form-label float-right">week:</label>
                    </div>
                    <div class="col-xs-3 col-md-2 mb-2">
                        <input type="number" wire:model="weekId" class="form-control" placeholder="Input Week" required>
                    </div>
                    </div>


                    <div class="card card-outline card-success">
                    <div class="card-body">
                    <div class="table-responsive-md">
                 
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                           <th with='125'>Student Name</th>
                           <th>Attendance</th>
                        </thead>
                    
                 
                        <tbody wire:model="tablePages">
               
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <th>
                                <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="<?php echo e($student->id); ?>" name="todo2" id="<?php echo e($student->id); ?>">
                                        <label for="<?php echo e($student->id); ?>"></label>
                                    </div>
                                </th>
                                <td value="<?php echo e($student->idNumber); ?>"><?php echo e(ucfirst(trans($student->lastName))); ?>, <?php echo e(ucfirst(trans($student->firstName))); ?></td>
                                <td value="<?php echo e($student->attendance); ?>"> <span class="badge badge-<?php echo e($student->Attendance_badge); ?>"><?php echo e($student->attendance); ?></span></td>
                
                               
                            </tr>
                           
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        
                    </table>
                  

                    <div class="modal-footer mt-4">
                        <button type="submit" wire:click.prevent="saveAttendance" name="addFaculty" class="btn btn-success" value="addFaculty"><i ></i>
                        <span>Save</span>
                        </button>
                    </div>

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
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/faculty/faculty-attendance.blade.php ENDPATH**/ ?>