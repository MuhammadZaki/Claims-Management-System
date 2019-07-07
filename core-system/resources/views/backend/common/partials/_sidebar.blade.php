<?php /* C:\xampp\htdocs\cms\resources\views/backend/common/partials/_sidebar.blade.php */ ?>
<nav class="sidebar sidebar-offcanvas"  id="sidebar">
    <ul style="color:Tomato;"   class="nav ">
           


        <?php if(auth()->guard('admin')->user()->type == 'HIA'): ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="admin">
                    <i class="mdi mdi-hospital menu-icon"></i>
                    <span style="#000000;" class="menu-title"><b><i>Health Providers</i></b></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="admin">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a style="color:blue;" class="nav-link" href="<?php echo e(route('admins.create')); ?>"><b><i> Add HP</i></b> </a>
                        </li>
                        <li class="nav-item"><a style="color:#6495ED;" class="nav-link" href="<?php echo e(route('admins.index')); ?>"><b><i> View HPs</i></b> </a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#patient" aria-expanded="false" aria-controls="patient">
                    <i class="mdi mdi-account-circle menu-icon"></i>
                    <span class="menu-title"><b><i>Patients</i></b></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="patient">
                    <ul class="nav flex-column sub-menu">
                        <li  class="nav-item"><a style="color:blue;"  class="nav-link" href="<?php echo e(route('patients.create')); ?>"> <b><i> Add Patient</i></b> </a>
                        </li>
                        <li class="nav-item"><a style="color:#6495ED;"   class="nav-link" href="<?php echo e(route('patients.index')); ?>"> <b><i>View Patients</i></b> </a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#plan" aria-expanded="false" aria-controls="plan">
                    <i class="mdi mdi-calendar-plus menu-icon"></i>
                    <span class="menu-title"><b><i>Plans</i></b></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="plan">
                    <ul class="nav flex-column sub-menu">
                        <li  class="nav-item"><a style="color:blue;"  class="nav-link" href="<?php echo e(route('plans.create')); ?>"> <b><i> Add Plan</i></b> </a>
                        </li>
                        <li class="nav-item"><a style="color:#6495ED;"   class="nav-link" href="<?php echo e(route('plans.index')); ?>"> <b><i>View Plans</i></b> </a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#service" aria-expanded="false" aria-controls="service">
                    <i class="mdi mdi-code-string menu-icon"></i>
                    <span class="menu-title"><b><i>Medical Services</i></b></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="service">
                    <ul class="nav flex-column sub-menu">
                        <li  class="nav-item"><a style="color:blue;"  class="nav-link" href="<?php echo e(route('services.create')); ?>"> <b><i> Add Service</i></b> </a>
                        </li>
                        <li class="nav-item"><a style="color:#6495ED;"   class="nav-link" href="<?php echo e(route('services.index')); ?>"> <b><i>View Services</i></b> </a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a  class="nav-link"    href="<?php echo e(route('admin.claims.money')); ?>">
                    <i class="mdi mdi-currency-usd menu-icon"></i>
                    <span   class="menu-title" ><b><i style="color:red;">Claims For Money</i></b></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.transactions')); ?>">
                    <i class="mdi mdi-arrow-down-bold-circle menu-icon"></i>
                    <span class="menu-title"><b><i>Transactions</i></b></span>
                </a>
            </li>
           

        <?php endif; ?>

        <?php if(auth()->guard('admin')->user()->type != 'HIA'): ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="admin">
                    <i class="mdi mdi-hospital menu-icon"></i>
                    <span class="menu-title"><b><i>Claims</i></b></span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="admin">
                    <ul class="nav flex-column sub-menu">
                        <li   class="nav-item"><a style="color:red;" class="nav-link" href="<?php echo e(route('claims.create')); ?>"> <b><i>Create Claim</i></b> </a>
                        </li>
                        <li  class="nav-item"><a style="color:blue;" class="nav-link" href="<?php echo e(route('claims.index')); ?>"> <b><i>View Claims</i></b> </a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('hp.transactions')); ?>">
                    <i class="mdi mdi-arrow-down-bold-circle menu-icon"></i>
                    <span class="menu-title"><b><i>Transactions</i> </b></span>
                </a>
            </li>

        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('change.password')); ?>">
                <i class="mdi mdi-textbox-password menu-icon"></i>
                <span class="menu-title"><b><i>Change Password</i></b></span>
            </a>
        </li>
    </ul>
</nav>
