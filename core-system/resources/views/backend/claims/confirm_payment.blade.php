<?php /* C:\xampp\htdocs\claims\resources\views/backend/claims/confirm_payment.blade.php */ ?>
<?php $__env->startSection('title', 'Confirm Payment'); ?>)

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

    <div   class="card">
    
        <div  class="card-body">
            <div class="clearfix"></div>
            <h4 class="card-title float-left"><b><i>Receipt Details</i></b></h4>
            <div class="row">
                <div style="color:blue;" class="col-lg-8">
                    <table style="color:blue;" class="table table-striped">
                        <tbody>
                        <tr>
                            <td class="py-1">#</td>
                            <td><?php echo e(str_pad($claim->id, 5, "0", STR_PAD_LEFT)); ?></td>
                        </tr>

                        <tr>
                            <td class="py-1"><b><i>Patient Name</i></b></td>
                            <td><?php echo e($claim->patient->name); ?></td>
                        </tr>

                        <tr>
                            <td class="py-1"><b><i>Patient Credit</i></b></td>
                            <td style="color:red;" ><?php echo e($claim->patient->credit); ?> EGP</td>
                        </tr>



                        <tr>
                            <td class="py-1"><b><i>HP_Type</i></b></td>
                            <td><?php echo e($claim->provider->type); ?></td>
                        </tr>
                        <tr>
                            <td class="py-1"><b><i>HP_Name</i></b></td>
                            <td><?php echo e($claim->provider->name); ?></td>
                        </tr>

                        <tr>
                            <td class="py-1"><b><i>Service</i></b></td>
                            <td><?php echo e($claim->service->service); ?></td>
                        </tr>

                        <tr>
                            <td class="py-1"><b><i>Service Cost</i></b></td>
                            <td style="color:red;" ><?php echo e($claim->service->cost); ?> EGP</td>
                        </tr>
                        </tbody>
                    </table>
                    <br/>
                    <?php if($claim->status != 'transferred' && ($claim->patient->credit >= $claim->service->cost )): ?>
                        <div class="col-10">
                            <?php if(Session::has('msg')): ?><?php echo Session::get('msg'); ?><?php endif; ?>
                            <?php echo e(Form::open(['url' => route('admin.saveTransaction'), 'files' => true])); ?>

                            <?php echo e(csrf_field()); ?>

                            <?php echo e(Form::hidden('claim_id', $claim->id)); ?>

                            <div class="box-footer">
                                <?php echo e(Form::submit('Confirm Payment', array('class' => 'btn btn-primary'))); ?>

                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    <?php elseif($claim->patient->credit < $claim->service->cost): ?>
                        <h4 style="color: red;"><b><i>Patient Credit less than service cost</i></b></h4>
                        <?php echo e(Form::open(['url' => route('admin.rejectTransaction'), 'files' => true])); ?>

                        <?php echo e(csrf_field()); ?>

                        <?php echo e(Form::hidden('claim_id', $claim->id)); ?>

                        <div class="box-footer">
                            <?php echo e(Form::submit('Reject Payment', array('class' => 'btn btn-danger'))); ?>

                        </div>
                        <?php echo e(Form::close()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/select2.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.common.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
