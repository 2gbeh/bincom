<?php $mx = app('App\Services\BladeModelService'); ?>
<?php $fx = app('App\Services\StringFormatService'); ?>



<?php $__env->startSection('title', $data->title); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('assets/bootstrap/dataTables.bootstrap5.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/jquery/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bootstrap/dataTables.bootstrap5.min.js')); ?>"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('body'); ?>
    <form action="<?php echo e(url('search')); ?>" method="GET" autocomplete="off" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        
        <table border="0" class="w-100">
            <tr>
                <td>
                    <select name="lga_id" id="lga_id" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select LGA --</option>
                        <?php $__currentLoopData = $data->list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(request()->query('lga_id') == $item->lga_id): ?>
                                <option value="<?php echo e($item->lga_id); ?>" selected>
                                    <?php echo e($item->lga_name); ?>

                                </option>
                            <?php else: ?>
                                <option value="<?php echo e($item->lga_id); ?>">
                                    <?php echo e($item->lga_name); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <td class="text-end" style="max-width:5px; padding-left:10px;">
                    <button type="submit" role="button" class="btn btn-primary" title="Search">
                        <i class="fas fa-search"></i>
                    </button>
                </td>
            </tr>
        </table>
    </form>

    <p>&nbsp;</p>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Political Party</th>
                <th>
                    <i class="fas fa-calculator me-1"></i>
                    Computed Score
                </th>
                <th>
                    <i class="fas fa-bullhorn me-1"></i>
                    Announced Score
                </th>
                <th>
                    <i class="fas fa-user-alt me-1"></i>
                    Recorded By
                </th>
                <th class="text-nowrap">Date Recorded</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                        <?php echo $fx->asPartyAvatar($item->party_abbreviation); ?>

                        <?php echo e($item->party_abbreviation); ?>

                    </td>
                    <td class="text-danger">
                        <?php
                            $scores = $mx->stackTraceLga($item->lga_name);
                            $score = isset($scores[$item->party_abbreviation]) ? $scores[$item->party_abbreviation] : 0;
                            echo $fx->asCash($score);
                        ?>
                    </td>
                    <td class="text-success"><?php echo e($fx->asCash($item->party_score)); ?></td>
                    <td>
                        <?php echo e($fx->asEmpty($item->entered_by_user)); ?> <br />
                        <?php echo $fx->asBadge($item->user_ip_address, 'secondary'); ?>

                    </td>
                    <td class="text-nowrap"><?php echo $fx->asDate($item->date_entered); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\binec\resources\views/search.blade.php ENDPATH**/ ?>