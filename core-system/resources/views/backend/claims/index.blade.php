<?php /* C:\xampp\htdocs\claims\resources\views/backend/claims/index.blade.php */ ?>
<?php $__env->startSection('title', 'Claims'); ?>

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
            <h4 class="card-title float-left"><b><i>Claims</i></b></h4>
            <a href="<?php echo e(route('claims.create')); ?>" class="btn btn-info btn-sm float-right">
            <i class="mdi mdi-note-plus"> </i> <b><i> Create New </i></b></a>
            <div class="clearfix"></div>
            <!-- -->
        <div class="row">
            <form action="{{ route('claims.index') }}" class="form-inline offset-2">
                <h6>From</h6>
                <div class="form-group mx-sm-3 mb-2">
                    <input name="dateFrom" type="date"  value="{{ $dateFrom }}" class="form-control" id="dateFrom" placeholder="From">
                </div>
                <h6>To</h6>
                <div class="form-group mx-sm-3 mb-2" >
                    <input name="dateTo" type="date"  value="{{ $dateTo }}" class="form-control" id="dateTo" placeholder="To">
                </div>
                <button type="submit" class="btn btn-info btn-sm float-right"><i><b>Filter</b></i></button>
                <a href="<?php echo e(route('claims.index')); ?>" class="btn btn-info btn-sm float-right"><i><b>Refresh</b></i></a>
            </form>
        </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><b><i>Patient</i></b></th>
                                <th><b><i>Service</i></b></th>
                                <th><b><i>Cost</i></b></th>
                                <th><b><i>Timestamp</i></b></th>
                                <th><b><i>Status</i></b></th>
                                <th><?php echo e(trans('actions.actions')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $claims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($claim->id); ?></td>
                                    <td><?php echo e($claim->patient->name); ?></td>

                                    <td><?php echo e($claim->service->service); ?></td>
                                    <td style="color:red;"><?php echo e($claim->service->cost); ?> EGP</td>
                                    <td style="color:red;" ><?php echo e($claim->created_at); ?></td>
                                    <td><?php echo e($claim->status); ?></td>
                                    <td>
                                        <?php if($claim->status != 'transferred'): ?>
                                            <form action="<?php echo e(route('claims.destroy', $claim->id)); ?>" method="post"
                                                  class="">
                                                <?php echo e(csrf_field()); ?>

                                                <input type="hidden" name="_method" value="delete">
                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm destroyBtn"><?php echo e(trans('actions.remove')); ?></button>
                                            </form>
                                        <?php else: ?>
                                            No Action
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo e(trans('common.no-items')); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/admin/js/alerts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/data-table.js')); ?>"></script>
    <script>
        (function ($) {
            $('.destroyBtn').on('click', function (e) {
                e.preventDefault();
                showSwal($(this));
            });

            function showSwal(btn) {
                swal({
                    title: '<?php echo e(trans("actions.confirm")); ?>',
                    text: '<?php echo e(trans("actions.confirm_text")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3f51b5',
                    cancelButtonColor: '#ff4081',
                    confirmButtonText: 'Great ',
                    buttons: {
                        cancel: {
                            text: '<?php echo e(trans("actions.cancel")); ?>',
                            value: false,
                            visible: true,
                            className: "btn btn-danger",
                            closeModal: true,
                        },
                        confirm: {
                            text: '<?php echo e(trans("actions.ok")); ?>',
                            value: true,
                            visible: true,
                            className: "btn btn-primary",
                            closeModal: true
                        }
                    }
                }).then((value) => {
                    if (value) {
                        btn.parent('form').submit();
                    }
                })
            }
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.common.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
