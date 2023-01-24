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
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Polling Unit</th>
                <th class="text-nowrap"><?= '<abbr title="Polling Unit">PU</abbr>' ?> Number</th>
                <th class="text-nowrap"><?= '<abbr title="Polling Unit">PU</abbr>' ?> Description</th>
                <th>Ward</th>
                <th>LGA</th>
                <th>State</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th class="text-nowrap">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                        <?php echo e(sprintf('%s (Unit %s)', $fx->asCity($item->polling_unit_name), $item->polling_unit_id)); ?>

                    </td>
                    <td class="text-nowrap"><?php echo e($item->polling_unit_number); ?></td>
                    <td class="text-nowrap"><?php echo e($fx->asCity($item->polling_unit_description)); ?></td>
                    <td>
                        <?php
                            $ward_name = $mx->getWard($item->uniquewardid, 'ward_name');
                            $ward_name_f = $fx->asCity($ward_name);
                            echo sprintf('%s (Ward %s)', $ward_name_f, $item->ward_id);
                        ?>
                    </td>
                    <td>
                        <?php echo e($mx->getLga($item->lga_id, 'lga_name')); ?>

                    </td>
                    <td>
                        <?php
                            $lga = $mx->getLga($item->lga_id);
                            if ($lga) {
                                echo $mx->getState($lga->state_id, 'state_name');
                            } else {
                                echo 'N/A';
                            }
                        ?>
                    </td>
                    <td><?php echo e($item->lat); ?></td>
                    <td><?php echo e($item->long); ?></td>
                    <td class="text-nowrap">
                        <a href="/unit/<?php echo e($item->uniqueid); ?>" class="btn btn-sm btn-primary">
                            View Result
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\binec\resources\views/unit.blade.php ENDPATH**/ ?>