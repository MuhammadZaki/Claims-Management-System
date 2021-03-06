<?php /* C:\xampp\htdocs\claims\resources\views/backend/admins/index.blade.php */ ?>
<?php $__env->startSection('title', 'Health Providers'); ?>

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
            <h4 class="card-title float-left"><b><i>Health Providers</i></b></h4>
            <a href="<?php echo e(route('admins.create')); ?>" class="btn btn-info btn-sm float-right"><i class="mdi mdi-note-plus"></i><i><b> Add New</b></i></a>
            <div class="clearfix"></div>
            
            <!-- -->
        <div class="row">
            <form action="{{ route('admins.index') }}" class="form-inline offset-2">
                <h6>From</h6>
                <div class="form-group mx-sm-3 mb-2">
                    <input name="dateFrom" type="date"  value="{{ $dateFrom }}" class="form-control" id="dateFrom" placeholder="From">
                </div>
                <h6>To</h6>
                <div class="form-group mx-sm-3 mb-2" >
                    <input name="dateTo" type="date"  value="{{ $dateTo }}" class="form-control" id="dateTo" placeholder="To">
                </div>
                <button type="submit" class="btn btn-info btn-sm float-right"><i><b>Filter</b></i></button>
                <a href="<?php echo e(route('admins.index')); ?>" class="btn btn-info btn-sm float-right"><i><b>Refresh</b></i></a>
                
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
                                <th><b><i>Provider Name</i></b></th>
                                <th><?php echo e(trans('common.email')); ?></th>
                                <th><b><i>Phone</i></b></th>
                                <th><?php echo e(trans('common.type')); ?></th>
                                <th><b><i>Credit</i></b></th>
                                <th><b><i>TimeStamp</i></b></th>
                                <th><b><i>Logo</i></b></th>
                                <th><?php echo e(trans('actions.actions')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($admin->id); ?></td>
                                    <td><?php echo e($admin->name); ?></td>
                                    <td><?php echo e($admin->email); ?></td>
                                    <td><?php echo e($admin->phone); ?></td>
                                    <td><?php echo e($admin->type); ?></td>
                                    <td style="color:red;" ><?php echo e($admin->credit); ?></td>
                                    <td><?php echo e($admin->created_at); ?></td>

                                    <td><img src="<?php echo e(($admin->avatar) ? route('image.show', ['images', $admin->avatar]) : asset('assets/admin/images/favicon.png')); ?>" height="60"></td>
                                    <td>
                                        <form action="<?php echo e(route('admins.destroy', $admin->id)); ?>" method="post" class="">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="_method" value="delete">
                                            <?php if($admin->id > 1): ?>
                                               <button type="button" class="btn btn-outline-danger btn-sm destroyBtn"><?php echo e(trans('actions.remove')); ?></button>
                                            <?php endif; ?>
                                        </form>
                                        <br>
                                        <a href=' <?php echo e(route('admins.edit', $admin->id)); ?>' class="btn btn-outline-primary"> <?php echo e(trans('actions.edit')); ?></a>
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
        (function($) {
            $('.destroyBtn').on('click', function (e) {
                e.preventDefault();
                showSwal($(this));
            });

            function showSwal(btn){
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
                    if(value) {
                        btn.parent('form').submit();
                    }
                })
            }
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.common.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>