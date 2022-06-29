

            <!-- Right navbar links -->
            <li class="nav-item dropdown user-menu">

                <a href="#profile" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img   src="../../dist/img/user.png"
                         class="user-image img-circle elevation-2" alt="User Image">

                    <span class="d-none d-md-inline"><?php echo e(Auth::user()->firstName); ?></span>

                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="profile">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img  src="../../dist/img/user.png"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                        <?php echo e(Auth::user()->lastName); ?> , <?php echo e(Auth::user()->firstName); ?>

                            <small>Member since <?php echo e(Auth::user()->created_at->format('M. Y')); ?></small>


                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <?php if(Auth::user()->role == 'IISTFACULTY' && Auth::user()->status == 'accept'): ?>

                        <?php elseif(Auth::user()->role == 'IISTFACULTY' && Auth::user()->status == 'requesting'): ?>
                        <p class=" float-left ">
                            Already sent a request!
                        </p>
                        <?php elseif(Auth::user()->role == 'IISTFACULTY' && Auth::user()->status == 'null'): ?>
                        <a href="<?php echo e(route('faculty.profile')); ?>" class="btn btn-default btn-flat float-left btn-xs">
                            Request as scheduler
                        </a>
                        <?php endif; ?>

                        <a href="#" class="btn btn-default btn-flat float-right btn-xs"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                </ul>
            </li>
<?php /**PATH C:\xampp\htdocs\asms\resources\views/layouts/nav.blade.php ENDPATH**/ ?>