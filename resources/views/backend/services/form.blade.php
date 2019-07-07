<?php /* C:\xampp\htdocs\claims\resources\views/backend/services/form.blade.php */ ?>
<?php $__env->startSection('title', 'Add Service'); ?>)

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
            <h4 class="card-title float-left"><b><i>Add Service</i></b></h4>
            <div class="row">

                <div class="col-10">
                    <?php if(Session::has('msg')): ?><?php echo Session::get('msg'); ?><?php endif; ?>
                    <?php echo e((isset($serviceData)) ? Form::model($serviceData, ['url' => route('services.update', [$serviceData->id]), 'method' => 'PUT', 'files' => true]) : Form::open(['url' => route('services.store'), 'files' => true])); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="tab-content tab-content-vertical">
                        <div class="tab-pane fade show active" id="tab_common"
                             role="tabpanel" aria-labelledby="tab_common-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <b><i><?php echo e(Form::label('service',  'Service')); ?></i></b>

                                        <?php echo e(Form::text('service',isset($serviceData) ? old('service', $serviceData->service?? null) : null, ['class' => 'form-control', 'placeholder' => 'Service', 'required'])); ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                          <b><i><?php echo e(Form::label('cost',  'Cost')); ?></i></b>

                                        <?php echo e(Form::text('cost',isset($serviceData) ? old('cost', $serviceData->cost ?? null) : null, ['class' => 'form-control', 'placeholder' => 'Cost', 'required'])); ?>

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
