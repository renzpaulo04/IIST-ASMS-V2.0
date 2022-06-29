<div>
<!--- start faculty display -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                 Scheduler
                <small>List</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Scheduler List</li>
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
    <button wire:click.prevent="markAsAccepted" class="btn btn-outline-success btn-xs"><i class="fas fa-check-circle mr-1"></i>Mark as Accept</button>
    <button wire:click.prevent="markAsRequesting" class="btn btn-outline-secondary btn-xs"><i class="fas fa-times-circle mr-1"></i>Mark as requesting</button>

    <span class="ml-2">Selected <?php echo e(count($selectedRows)); ?> faculty <?php echo e(Str::plural('member', count($selectedRows))); ?></span>
    <?php endif; ?>
    </div>
    <div class="btn-group ml-2">
        <button id="all" wire:click="filterSchedulersByActivation" type="button" class="btn <?php echo e(is_null($status) ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">ALL</span>
            <span class="badge badge-pill badge-info"><?php echo e($schedulerCount); ?></span>
        </button>
        <button id="active"wire:click="filterSchedulersByActivation('accept')"type="button" class="btn <?php echo e(($status == 'accept') ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">Accepted</span>
            <span class="badge badge-pill badge-success"><?php echo e($acceptedSchedulersCount); ?></span>
        </button>
        <button id="deactive" wire:click="filterSchedulersByActivation('requesting')"type="button" class="btn <?php echo e(($status == 'requesting') ? 'btn-secondary':'btn-default'); ?> btn-sm">
            <span class="mr-1">Requesting</span>
            <span class="badge badge-pill badge-primary"><?php echo e($requestingSchedulersCount); ?></span>
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
                    <label class=" mr-1 text-secondary" >By scheduler Name:  </label>
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
                                <th> Accepted By</th>
                                <th> Status </th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php if($schedulers->isnotEmpty() ): ?>
                            <?php $__currentLoopData = $schedulers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheduler): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($scheduler->status == 'accept' || $scheduler->status == 'requesting' ): ?>
                            <tr>
                                <th>
                                    <div class="icheck-primary d-inline ml-2">
                                        <input wire:model="selectedRows" type="checkbox" value="<?php echo e($scheduler->id); ?>" name="todo2" id="<?php echo e($scheduler->id); ?>">
                                        <label for="<?php echo e($scheduler->id); ?>"></label>
                                    </div>
                                </th>
                                <td><?php echo e($scheduler->idNumber); ?></td>
                                <td><?php echo e($scheduler->firstName); ?></td>
                                <td><?php echo e($scheduler->lastName); ?></td>
                                <td><?php echo e($scheduler->middleName); ?></td>
                                <?php if($user = $users->where('idNumber',$scheduler->accepted_by)->first()): ?>
                                <td><?php echo e(ucfirst(trans($user->lastName))); ?>, <?php echo e(ucfirst(trans($user->firstName))); ?> <?php echo e(ucfirst(trans($user->middleName[0]))); ?>.</td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <td>
                                    <span class="badge badge-<?php echo e($scheduler->status_badge); ?>"><?php echo e($scheduler->status); ?></span>
                                </td>


                            </tr>
                            <?php endif; ?>

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
                    <?php echo e($schedulers->links()); ?>

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


</div>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/livewire/admin/settings/list-scheduler.blade.php ENDPATH**/ ?>