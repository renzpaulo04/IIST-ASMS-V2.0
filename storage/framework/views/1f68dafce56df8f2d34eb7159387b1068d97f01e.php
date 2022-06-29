<div>
    <!--- start room display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Create Prospectus
                <small>List</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Create Prospectus</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!---------- button fucntion for Room -------->
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2">
    <div>
    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>
       Add Prospectus Data
    </button>
    <?php if($selectedRows): ?>
    <button wire:click.prevent="markAsActive" class="btn btn-outline-success btn-xs"><i class="fas fa-check-circle mr-1"></i>Mark as Active</button>
    <button wire:click.prevent="markAsInactive" class="btn btn-outline-secondary btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as inactive</button>

    <span class="ml-2">Selected <?php echo e(count($selectedRows)); ?> <?php echo e(Str::plural('program', count($selectedRows))); ?></span>  
    <?php endif; ?>
    </div>
    <div class="btn-group ml-2">
        <button id="all" wire:click="filterProgramsByRoles" type="button" class="btn <?php echo e(is_null($role) ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info"><?php echo e($roleCount); ?></span>
        </button>
        <button id="active"wire:click="filterProgramsByRoles('ACTIVE')"type="button" class="btn <?php echo e(($role == 'ACTIVE') ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">Active</span>
            <span class="badge badge-pill badge-success"><?php echo e($activeRoleCount); ?></span>
        </button>
        <button id="deactive" wire:click="filterProgramsByRoles('INACTIVE')"type="button" class="btn <?php echo e(($role == 'INACTIVE') ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">Inactive</span>
            <span class="badge badge-pill badge-primary"><?php echo e($inactiveRoleCount); ?></span>
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
                    <label class=" mr-1 text-secondary" >By Program Name:  </label>
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
                                <th> Program Title </th>
                                <th> Currriculum Year</th>
                                <th> Created By</th>
                                <th> Updated By</th>
                                <th> Status</th>
                                <th> Update </th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php if($programs->isnotEmpty()): ?> 
                            <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr> 
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="<?php echo e($program->id); ?>" name="todo2" id="<?php echo e($program->id); ?>">
                                        <label for="<?php echo e($program->id); ?>"></label>
                                    </div>
                                </th>
                                <td><?php echo e($program->course_code); ?></td>
                                <td><?php echo e($program->course_title); ?></td>
                                <td><?php echo e($program->coriculum_year); ?></td>
                                <?php if($user = $users->where('idNumber',$program->created_by)->first()): ?>
                                <td><?php echo e(ucfirst(trans($user->lastName))); ?>, <?php echo e(ucfirst(trans($user->firstName))); ?> <?php echo e(ucfirst(trans($user->middleName[0]))); ?>.</td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <?php if($user = $users->where('idNumber',$program->changed_by)->first()): ?>
                                <td><?php echo e(ucfirst(trans($user->lastName))); ?>, <?php echo e(ucfirst(trans($user->firstName))); ?> <?php echo e(ucfirst(trans($user->middleName[0]))); ?>.</td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <td>
                                    <span class="badge badge-<?php echo e($program->programs_badge); ?>"><?php echo e($program->role); ?></span>
                                </td>
                                <td><a href="" ><i wire:click.prevent="edit(<?php echo e($program); ?>)" class="fa fa-edit mr-2"></i></a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr> 
                           <td colspan="8" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr> 
                                <?php endif; ?> 
                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                    <?php echo e($programs->links()); ?>

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

<!----------Start Modal for adding Room and editting Room -------->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="<?php echo e($showEditModal ? 'updateProgram': 'createProgram'); ?>">
            <div class="modal-content">
            <?php if($showEditModal): ?>
                <div class="modal-header bg-gradient-info">
                <?php else: ?>
                <div class="modal-header bg-gradient-primary">
                <?php endif; ?>
                    <h5 class="modal-title" id="exampleModalLabel">
                    <?php if($showEditModal): ?>
                        <span>Edit course</span>
                    <?php else: ?>
                        <span>Add New Prospectus</span>
                    <?php endif; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                        <div class="control-group">
                            <label>Program Code</label>
                            <input  type="text" wire:model.defer="state.course_code" name="course_code" class="form-control <?php $__errorArgs = ['course_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Program Code">
                            <?php $__errorArgs = ['course_code'];
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
                        <div class="control-group">
                            <label>Program Name</label>
                            <input  type="text" wire:model.defer="state.course_title" name="course_title" class="form-control <?php $__errorArgs = ['course_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Program Title">
                            <?php $__errorArgs = ['course_title'];
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
                        <div class="control-group">
                            <label>Curriculum Year</label>
                            <input  type="text" wire:model.defer="state.coriculum_year" name="coriculum_year" class="form-control <?php $__errorArgs = ['coriculum_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Coriculum year">
                            <?php $__errorArgs = ['coriculum_year'];
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
                        <div class="control-group">
                            <label>Status</label>
                            <select id="role" wire:model.defer="state.role" name="status" class="form-control <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option>--Select Role--</option> 
                                <option value="ACTIVE">active</option> 
                                <option value="INACTIVE">inactive</option>    
                            </select>
                            <?php $__errorArgs = ['role'];
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

                        
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> cancel</button>
                        <button type="submit" name="addProgram" class="btn btn-primary" value="addProgram"><i class="fa fa-save mr-1"></i>
                        <?php if($showEditModal): ?>
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
</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/admin/settings/list-courses.blade.php ENDPATH**/ ?>