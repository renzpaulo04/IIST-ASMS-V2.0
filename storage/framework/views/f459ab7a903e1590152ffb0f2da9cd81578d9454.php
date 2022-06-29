<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Subject
                <small>List</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Subject List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!---------- Button fucntion for Faculty -------->
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2">
    <div>
    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>
       Add Subject Data
    </button>

    </div>

    </div>
</div> 
<!----------End button fucntion for Room -------->
<!----------Start Table for Room -------->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
            </div>
                <div class="d-flex justify-content-end">
                <div class="row">
                    <label class=" mr-1 text-secondary" >By subject:  </label>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input  wire:model="search" type="text" name="table_search" class="form-control float-right fas fa-search input-group-sm" placeholder="Search">
                    </div>
                </div>
                </div>
        </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                                <th> Program code</th>
                                <th> Coriculum Year</th>
                                <th> Course code</th>
                                <th> Course Title</th>
                                <th> Units </th>
                                <th> Lec Hours </th>
                                <th> Lab Hours</th>
                                <th> Year </th>
                                <th> Semester </th>
                                <th> Created By</th>
                                <th> Changed By</th>
                                <th> Status </th>
                                <th> Edit </th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php if($subjects->isnotEmpty()): ?> 
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr> 
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="<?php echo e($subject->id); ?>" name="todo2" id="<?php echo e($subject->id); ?>">
                                        <label for="<?php echo e($subject->id); ?>"></label>
                                    </div>
                                </th>
                                <td><?php echo e($subject->course_code); ?></td>
                                <td><?php echo e($subject->coriculum_year); ?></td>
                                <td><?php echo e($subject->subject_code); ?></td>
                                <td><?php echo e($subject->subject_title); ?></td>
                                <td><?php echo e($subject->units); ?></td>
                                <td><?php echo e($subject->lecHours); ?></td>
                                <td><?php echo e($subject->labHours); ?></td>
                                <td><?php echo e($subject->year); ?></td>
                                <td><?php echo e($subject->semester); ?></td>
                                <?php if($user = $users->where('idNumber',$subject->created_by)->first()): ?>
                                <td><?php echo e(ucfirst(trans($user->lastName))); ?>, <?php echo e(ucfirst(trans($user->firstName))); ?> <?php echo e(ucfirst(trans($user->middleName[0]))); ?>.</td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <?php if($user = $users->where('idNumber',$subject->changed_by)->first()): ?>
                                <td><?php echo e(ucfirst(trans($user->lastName))); ?>, <?php echo e(ucfirst(trans($user->firstName))); ?> <?php echo e(ucfirst(trans($user->middleName[0]))); ?>.</td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <td>
                                    <span class="badge badge-<?php echo e($subject->subjects_badge); ?>"><?php echo e($subject->role); ?></span>
                                </td>
                                <td><a href="" ><i wire:click.prevent="edit(<?php echo e($subject); ?>)" class="fa fa-edit mr-2"></i></a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr> 
                           <td colspan="14" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr> 
                                <?php endif; ?> 
                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                    <?php echo e($subjects->links()); ?>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

<!----------Start Modal for adding Room and editting Room -------->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <form autocomplete="off" wire:submit.prevent="<?php echo e($showEditSubjectModal ? 'updateSubject': 'createSubject'); ?>">
                <div class="modal-content">
                    <?php if($showEditSubjectModal): ?>
                    <div class="modal-header bg-gradient-info">
                    <?php else: ?>
                    <div class="modal-header bg-gradient-primary">
                     <?php endif; ?>
                    <h5 class="modal-title" id="exampleModalLabel">
                    <?php if($showEditSubjectModal): ?>
                        <span>Edit Subject</span>
                    <?php else: ?>
                        <span>Add New Subject</span>
                    <?php endif; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="control-group">
                    <div class="row">
                            <div class="col-xs-2 col-md-3 mb-6">
                                <label >Program Code </label>
                            </div>
                            <div class="col-xs-2 col-md-3 mb-6">
                                <label >Coriculum Year </label>
                            </div>
                            <div class="col-xs-2 col-md-3 mb-6">
                                <label>Year</label>
                            </div>
                            <div class="col-xs-2 col-md-3 mb-6">
                                <label>semester</label>
                            </div>
                    </div>
                    </div>
                    <div class="control-group">
                        <div class="row ">
                            <div class="col-xs-2 col-md-3 mb-6">
                                <select wire:model="courseId" name="courseId"class="form-control  <?php $__errorArgs = ['courseId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> 
                                <option>--Select Course--</option> 
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value='<?php echo e($course->course_code); ?>'><?php echo e($course->course_code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['courseId'];
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

                              
                                 <div class="col-xs-2 col-md-3 mb-6">
                                  <select wire:model="coriculumYear" name="coriculumYear" class="form-control <?php $__errorArgs = ['coriculumYear'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                                 <option>--Select coriculum year--</option>
                                 <?php $__currentLoopData = $coriculums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coriculum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value='<?php echo e($coriculum->coriculum_year); ?>'><?php echo e($coriculum->coriculum_year); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                                 <?php $__errorArgs = ['coriculumYear'];
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

                                 
                                <div class="col-xs-2 col-md-3 mb-6">
                                 <select  wire:model="year" name="year" class="form-control <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option>--Select Year --</option> 
                                    <option value="1st">1st</option> 
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>  
                                    <option value="4th">4th</option>   
                                </select>
                                                    <?php $__errorArgs = ['year'];
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
                                    <div class="col-xs-2 col-md-3 mb-8">
                                                <select   wire:model="semester" name="semester" class="form-control <?php $__errorArgs = ['semester'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    <option>--Select Semester --</option> 
                                                    <option value="1st">1st</option> 
                                                    <option value="2nd">2nd</option>
                                                </select>
                                                <?php $__errorArgs = ['semester'];
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
                                          
                        </div>
                    </div>
                    <div class="control-group">
                    <div class="row mt-4">
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label >Course Code </label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label >Course Title </label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label>Units</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label>Lec hours</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label>Lab hours</label>
                            </div>
                            <div class="col-xs-2 col-md-2 mb-6">
                                <label>Add More </label>
                            </div>
                    </div>
                    </div>
                        <div class="control-group">
                        <div class="row">
                        <div class="col-xs-2 col-md-2 mb-6">
   
                            <input  type="text" wire:model="courseCode.0" name="courseCode" class="form-control <?php $__errorArgs = ['courseCode.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Course Code">
                            <?php $__errorArgs = ['courseCode.0'];
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
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="text" wire:model.defer="subjectTitle.0" name="subjectName" class="form-control <?php $__errorArgs = ['subjectTitle.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Course Title">
                            <?php $__errorArgs = ['subjectTitle.0'];
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

                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="units.0" name="units" class="form-control <?php $__errorArgs = ['units.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Units">
                            <?php $__errorArgs = ['units.0'];
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
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="lecHours.0" name="lecHours" class="form-control <?php $__errorArgs = ['lecHours.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Lec Hours">
                            <?php $__errorArgs = ['lecHours.0'];
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
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="labHours.0" name="labHours" class="form-control <?php $__errorArgs = ['labHours.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Lab Hours">
                            <?php $__errorArgs = ['labHours.0'];
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
                        <div class="col-xs-2 col-md-2 mb-6">
                        <button wire:click.prevent="add(<?php echo e($i); ?>)" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i></button>
                        </div>
                    </div>
                    </div>
                    


                        <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="control-group">
                        <div class="row mt-2">
                        <div class="col-md-2 col-md-2 mb-6">
                            <input  type="text" wire:model="courseCode.<?php echo e($value); ?>" name="courseCode" class="form-control <?php $__errorArgs = ['courseCode.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Subject Code" required>
                            <?php $__errorArgs = ['courseCode.'.$value];
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
                        <div class="col-xs-2 col-md-2 mb-6">
                   
                            <input  type="text" wire:model.defer="subjectTitle.<?php echo e($value); ?>" name="subjectTitle" class="form-control <?php $__errorArgs = ['subjectTitle.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Subject Title" required>
                            <?php $__errorArgs = ['subjectTitle.'.$value];
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

                        <div class="col-xs-2 col-md-2 mb-6">

                            <input  type="number" wire:model.defer="units.<?php echo e($value); ?>" name="units" class="form-control <?php $__errorArgs = ['units.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Units" required>
                            <?php $__errorArgs = ['units.'.$value];
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
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="lecHours.<?php echo e($value); ?>" name="lecHours" class="form-control <?php $__errorArgs = ['lecHours.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Lec Hours">
                            <?php $__errorArgs = ['lecHours.'.$value];
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
                        <div class="col-xs-2 col-md-2 mb-6">
                            <input  type="number" wire:model.defer="labHours.<?php echo e($value); ?>" name="labHours" class="form-control <?php $__errorArgs = ['labHours.'.$value];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Lab Hours">
                            <?php $__errorArgs = ['labHours.'.$value];
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
                        <div class="col-xs-2 col-md-2 mb-6">
                            <button class="btn btn-danger" wire:click.prevent="remove(<?php echo e($key); ?>)"><i class="fa fa-times-circle mr-1"></i></button>
                        </div>
                        </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="submit" name="addFaculty" class="btn btn-primary" value="addFaculty"><i class="fa fa-save mr-1"></i>
                        <?php if($showEditSubjectModal): ?>
                        <span>Save Change</span>
                    <?php else: ?>
                        <span>Save</span>
                    <?php endif; ?>
                        </button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div> 
<!----------End Modal for adding Room and editting Room -------->
</div><?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/admin/settings/list-subjects.blade.php ENDPATH**/ ?>