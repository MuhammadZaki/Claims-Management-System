<?php /* C:\xampp\htdocs\claims\resources\views/backend/auth/login.blade.php */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e(trans('auth.continue-signin')); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendors/css/vendor.bundle.base.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendors/css/vendor.bundle.addons.css')); ?>">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vertical-layout-light/style.css')); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/admin/images/favicon.jpg')); ?>"/>
    <!-- Scripts -->
    <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?></script>
</head>
<body  class="sidebar-dark">
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row w-100">
                <div style="color:blue;" class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="<?php echo e(asset('assets/admin/images/logo-medical.jpeg')); ?>" alt="logo">
                        </div>
                        <h4><b><i><?php echo e(trans('auth.lets-start')); ?></i></b></h4>
                        <h6  class="font-weight-light"><b><i><?php echo e(trans('auth.continue-signin')); ?></i></b></h6>
                        <form class="pt-3" role="form" method="POST" action="<?php echo e(route('admin.login')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                <input type="email" name="email"
                                       class="form-control form-control-lg <?php echo e($errors->has('email') ? ' form-control-danger' : ''); ?>"
                                       id="inputEmail" placeholder="<?php echo e(trans('users.email')); ?>"
                                       value="<?php echo e(old('email')); ?>" required autofocus>
                                <?php if($errors->has('email')): ?>
                                    <label id="inputEmail-error" class="error mt-2 text-danger"
                                           for="inputEmail"><?php echo e($errors->first('email')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                                <input type="password" name="password"
                                       class="form-control form-control-lg <?php echo e($errors->has('password') ? ' form-control-danger' : ''); ?>"
                                       id="inputPassword" placeholder="<?php echo e(trans('users.password')); ?>" required>
                                <?php if($errors->has('password')): ?>
                                    <label id="inputPassword-error" class="error mt-2 text-danger"
                                           for="inputPassword"><?php echo e($errors->first('password')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"><?php echo e(trans('auth.signin')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?php echo e(asset('assets/admin/vendors/js/vendor.bundle.base.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendors/js/vendor.bundle.addons.js')); ?>"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?php echo e(asset('assets/admin/js/off-canvas.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/hoverable-collapse.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/template.js')); ?>"></script>
<!-- endinject -->
</body>
</html>
