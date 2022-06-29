<?php if(Auth::user()->role == 'IISTFACULTY' && Auth::user()->status == 'accept' && Auth::user()->role2 == "active"): ?>

<li class="nav-item dropdown scheduler-menu ">

        <a href="#scheduleViews" class="nav-link dropdown-toggle" data-toggle="dropdown">
            Schedule Views</a>

        <ul class="dropdown-menu dropdown-menu-md dropdown-menu-right bg-gradient-teal"  id="scheduleViews" role="menu">
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-desktop nav-icon"></i> Dashboard Schedule</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.facultySchedule')); ?>"><i class="fas fa-user-tie nav-icon"></i> Faculty</a>
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.roomSchedule')); ?>"><i class="fas fa-university nav-icon"></i> Room</a>
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.courseSchedule')); ?>"><i class="fas fa-user-graduate nav-icon"></i></i> Students</a>

    </ul>
    </li>


<li class="nav-item dropdown settings-menu ">

<a href="#settings" class="nav-link dropdown-toggle" data-toggle="dropdown">
Setting Schedule</a>

        <ul class="dropdown-menu dropdown-menu-md dropdown-menu-right bg-gradient-teal"  id="settings" role="menu">
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.generates')); ?>"><i class="fas fa-server nav-icon"></i> Set Up Schedule</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.facultys')); ?>"><i class="fas fa-university nav-icon"></i> Faculty List</a>
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.courses')); ?>"><i class="fas fa-university nav-icon"></i> Program List</a>
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.rooms')); ?>"><i class="fas fa-university nav-icon"></i> Room List</a>
        <a class="dropdown-item bg-gradient-teal" href="<?php echo e(route('admin.subjects')); ?>"><i class="fas fa-book-reader nav-icon"></i> Subject List</a>
    </ul>
    </li>
<li class="nav-item dropdown requesting-menu">
<a class="nav-link " data-toggle="dropdown" href="#requesting" >
<i class="far fa-bell"></i>
<?php if($countRequest = Auth::user()->where('status','requesting')): ?>

<span class="badge badge-warning navbar-badge"><?php echo e($countRequest->count()); ?></span>

</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right bg-gradient-teal" style="left: inherit; right: 0px;"  id="requesting" role="menu">
<span class="dropdown-item dropdown-header bg-gradient-teal"><?php echo e($countRequest->count()); ?>

<?php if($countRequest->count() > 1): ?>
Notifications
<?php else: ?>
Notification
 <?php endif; ?></span>
<div class="dropdown-divider"></div>
<a href="<?php echo e(route('admin.scheduler')); ?>" class="dropdown-item bg-gradient-teal ">
<i class="fas fa-users mr-2 "></i><?php echo e($countRequest->count()); ?>

<?php if($countRequest->count() > 1): ?>
scheduler requests
<?php else: ?> scheduler request
<?php endif; ?>

</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item dropdown-footer bg-gradient-teal">See All Notifications</a>
</div>
</li>
<?php endif; ?>
<?php else: ?>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right bg-gradient-teal" style="left: inherit; right: 0px;"  id="requesting" role="menu">
<span class="dropdown-item dropdown-header bg-gradient-teal">
Notification
</span>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item bg-gradient-teal ">No request available</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item dropdown-footer bg-gradient-teal">See All Notifications</a>
</div>
</li>


<?php endif; ?>


<?php /**PATH C:\xampp\htdocs\asms\resources\views/layouts/scheduler.blade.php ENDPATH**/ ?>