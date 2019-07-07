<?php /* C:\xampp\htdocs\claims\resources\views/backend/change_password.blade.php */ ?>
<?php $__env->startSection('title', 'Change Password'); ?>)

<?php $__env->startSection('content'); ?>
    <?php if(Session::has('msg')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo Session::get('msg'); ?>

        </div>
    <?php endif; ?>
    <?php if(!empty($errors->all())): ?>
        <ul class="alert alert-danger">
            <?php $__currentLoopData = $errors->all('<li>:message</li>'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo $message; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <div style="color:blue;"  class="card">
        <div class="card-body">
            <h4 class="card-title float-left"><b><i>Change Password</i></b></h4>
            <div class="row">

                <div class="col-10">
                    <?php if(Session::has('msg')): ?><?php echo Session::get('msg'); ?><?php endif; ?>
                    <?php echo e(Form::open(['url' => route('change.pass'), 'files' => true])); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="tab-content tab-content-vertical">
                        <div class="tab-pane fade show active" id="tab_common"
                             role="tabpanel" aria-labelledby="tab_common-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                      <b><i><?php echo e(Form::label('email',  'Email')); ?></i></b>

                                        <?php echo e(Form::text('', auth()->guard('admin')->user()->email , ['class' => 'form-control', 'placeholder' => 'HIC Name', 'readonly'])); ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                    <b><i> <?php echo e(Form::label('pass',  'New Password')); ?></i></b>

                                        <input type="password" name="password"
                                               class="form-control form-control-lg <?php echo e($errors->has('password') ? ' form-control-danger' : ''); ?>"
                                               id="inputPassword" placeholder="new password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo e(Form::submit(trans('actions.save'), array('class' => 'btn btn-primary'))); ?>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/select2.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.common.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
