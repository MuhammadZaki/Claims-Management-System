<?php /* C:\xampp\htdocs\claims\resources\views/backend/admins/form.blade.php */ ?>
<?php $__env->startSection('title', 'Add Health Providers'); ?>)

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

    <div style="color:blue;" class="card">
        <div class="card-body">
            <h4 class="card-title float-left"><b><i>Add Health Provider</i></b></h4>
            <div class="row">

                <div class="col-10">
                    <?php if(Session::has('msg')): ?><?php echo Session::get('msg'); ?><?php endif; ?>
                    <?php echo e((isset($adminData)) ? Form::model($adminData, ['url' => route('admins.update', [$adminData->id]), 'method' => 'PUT', 'files' => true]) : Form::open(['url' => route('admins.store'), 'files' => true])); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="tab-content tab-content-vertical">
                        <div class="tab-pane fade show active" id="tab_common"
                             role="tabpanel" aria-labelledby="tab_common-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                     <b><i><?php  echo e(Form::label('name',  'Provider Name')); ?>
                                     </i></b>
                                        <?php echo e(Form::text('name',isset($adminData) ? old('name', $adminData->name ?? null) : null, ['class' => 'form-control', 'placeholder' => 'Provider Name', 'required'])); ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                       <b><i><?php echo e(Form::label('phone',  'Phone')); ?></i></b>

                                        <?php echo e(Form::text('phone',isset($adminData) ? old('phone', $adminData->phone ?? null) : null, ['class' => 'form-control', 'placeholder' => 'Provider phone', 'required'])); ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                       <b><i><?php echo e(Form::label('email',  'Email')); ?></i></b>

                                        <?php echo e(Form::email('email',isset($adminData) ? old('email', $adminData->email ?? null) : null, ['class' => 'form-control', 'placeholder' => 'email', 'required'])); ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                      <b><i><?php echo e(Form::label('password',  'Password')); ?></i></b>

                                        <input type="password" name="password"
                                               class="form-control form-control-lg <?php echo e($errors->has('password') ? ' form-control-danger' : ''); ?>"
                                               id="inputPassword" placeholder="<?php echo e(trans('admins.password')); ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                       <b><i><?php echo e(Form::label('type',  'Provider Type')); ?></i></b>

                                        <select class="js-example-basic-single" style="width:100%" name="type" required>
                                            <option value="hospital">hospital</option>
                                            <option value="clinic">clinic</option>
                                            <option value="laboratory">laboratory</option>
                                            <option value="pharmacy">pharmacy</option>
                                            <option value="radiology">radiology</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                       <b><i><?php echo e(Form::label('avatar',  'Provider Logo')); ?></i></b>

                                        <?php echo e(Form::file('avatar', ['class' => 'form-control', 'placeholder' => trans('admins.avatar')])); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <img src="<?php echo e((isset($adminData) && $adminData->avatar) ? route('image.show', ['images', $adminData->avatar]) : asset('assets/admin/images/no-image-found.jpg')); ?>" class="img-thumbnail">
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
