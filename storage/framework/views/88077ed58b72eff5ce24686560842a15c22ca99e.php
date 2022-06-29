<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Faculty
                <small>List</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Faculty List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!---------- Button fucntion for Faculty -------->
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2">
    <div>
    <?php if($selectedRows): ?>
    <button wire:click.prevent="deleteSelectedRows" class="btn btn-outline-danger btn-xs"><i class="fa fa-trash mr-1"></i>Delete Selected</button>
    <button wire:click.prevent="markAsActivated" class="btn btn-outline-success btn-xs"><i class="fas fa-check-circle mr-1"></i>Mark as Active</button>
    <button wire:click.prevent="markAsDeactivated" class="btn btn-outline-secondary btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as Inactive</button>

    <span class="ml-2">Selected <?php echo e(count($selectedRows)); ?> faculty <?php echo e(Str::plural('member', count($selectedRows))); ?></span>  
    <?php endif; ?>
    </div>
    <div class="btn-group ml-2">
        <button id="all" wire:click="filterFacultysByActivation" type="button" class="btn <?php echo e(is_null($activation) ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info"><?php echo e($facultyCount); ?></span>
        </button>
        <button id="active"wire:click="filterFacultysByActivation('ACTIVE')"type="button" class="btn <?php echo e(($activation == 'ACTIVE') ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">Active</span>
            <span class="badge badge-pill badge-success"><?php echo e($activateFacultysCount); ?></span>
        </button>
        <button id="deactive" wire:click="filterFacultysByActivation('INACTIVE')"type="button" class="btn <?php echo e(($activation == 'INACTIVE') ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">Inactve</span>
            <span class="badge badge-pill badge-primary"><?php echo e($deactivateFacultysCount); ?></span>
        </button>
    </div>
    </div>
</div>
<!----------End button fucntion for faculty -------->

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
                        <thead>
                            <tr>
                                <th><div class="icheck-primary d-inline ml-2">
                      <input wire:model="selectedPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                      <label for="todoCheck2"></label>
                    </div></th>
                                <th> Id Number</th>
                                <th> First Name</th>
                                <th> Last Name</th>
                                <th> Middle Name</th>
                                <th> Email</th>
                                <th> Designation </th>
                                <th> Regular</th>
                                <th> Overload</th>
                                <th> Status </th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php if($facultys->isnotEmpty()): ?> 
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
                                <td><?php echo e($faculty->middleName); ?></td>
                                <td><?php echo e($faculty->email); ?></td>
                                <td><?php echo e($faculty->units); ?></td>
                                <td><?php echo e($faculty->regular); ?></td>
                                <td><?php echo e($faculty->overload); ?></td>
                                <td>
                                    <span class="badge badge-<?php echo e($faculty->activation_badge); ?>"><?php echo e($faculty->activation); ?></span>
                                </td>
                               
                 
                            </tr>
                           
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr> 
                           <td colspan="10" class="text-center"><label class="text-danger">No record found!</label></td>
                        </tr> 
                                <?php endif; ?> 
                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                    <?php echo e($facultys->links()); ?>

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


</div><?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/admin/settings/list-facultys.blade.php ENDPATH**/ ?>