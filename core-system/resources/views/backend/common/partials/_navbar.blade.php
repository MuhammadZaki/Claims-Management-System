<?php /* C:\xampp\htdocs\claims\resources\views/backend/common/partials/_navbar.blade.php */ ?>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-light">
    <div   class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo e(route('admin.dashboard')); ?>"><img src="<?php echo e(asset('assets/admin/images/logo-medical.jpeg')); ?>"  alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo e(route('admin.dashboard')); ?>"><img src="<?php echo e(asset('assets/admin/images/logo-medical.jpeg')); ?>"  alt="logo"/></a>

    </div>
    <div  class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="<?php echo e((auth('admin')->user()->avatar) ? route('image.show', ['images', auth('admin')->user()->avatar]) : asset('assets/admin/images/favicon.png')); ?>" alt="profile"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">


                    <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>
                        <?php echo e(trans('auth.logout')); ?>

                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
