<?php /* C:\xampp\htdocs\claims\resources\views/backend/patients/form.blade.php */ ?>
<?php $__env->startSection('title', 'Add Patient'); ?>)

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
            <h4 class="card-title float-left"><b><i>Add Patient</i></b></h4>
            <div class="row">

                <div class="col-10">
                    <?php if(Session::has('msg')): ?><?php echo Session::get('msg'); ?><?php endif; ?>
                    <?php echo e((isset($patientData)) ? Form::model($patientData, ['url' => route('patients.update', [$patientData->id]), 'method' => 'PUT', 'files' => true]) : Form::open(['url' => route('patients.store'), 'files' => true])); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="tab-content tab-content-vertical">
                        <div class="tab-pane fade show active" id="tab_common"
                             role="tabpanel" aria-labelledby="tab_common-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <b><i><?php echo e(Form::label('national_id',  'National ID')); ?></i></b>

                                        <?php echo e(Form::text('national_id',isset($patientData) ? old('national_id', $patientData->national_id ?? null) : null, ['class' => 'form-control', 'placeholder' => 'National ID', 'required'])); ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                          <b><i><?php echo e(Form::label('name',  'Name')); ?></i></b>

                                        <?php echo e(Form::text('name',isset($patientData) ? old('name', $patientData->name ?? null) : null, ['class' => 'form-control', 'placeholder' => 'Name', 'required'])); ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <b><i><?php echo e(Form::label('phone',  'Phone')); ?></i></b>

                                        <?php echo e(Form::text('phone',isset($patientData) ? old('phone', $patientData->phone ?? null) : null, ['class' => 'form-control', 'placeholder' => 'Phone', 'required'])); ?>

                                    </div>
                                </div>



                                <div class="row">
                                    <div class="form-group col-md-6">
                                       <b><i><?php echo e(Form::label('plan',  'Plan')); ?></i></b>

                                        <select class="js-example-basic-single" style="width:100%" name="plan_id"
                                                required>
                                            <option value="">Select plan</option>
                                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($plan->id); ?>"><?php echo e($plan->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
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
