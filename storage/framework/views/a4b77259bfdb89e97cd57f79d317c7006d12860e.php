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

<?php $__env->startPush('scripts_'); ?>
    <script type="text/javascript">
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('body'); ?>

    <?php echo $__env->renderWhen(session('alert'), 'shared.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

    <div class="container">

        <form action="<?php echo e(url('/')); ?>" method="POST" autocomplete="off" class="needs-validation" novalidate>
            <?php echo csrf_field(); ?>

            <div class="row g-3">
                <div class="col-md-3">
                    <label for="state_id" class="form-label">State</label>
                    <select name="state_id" id="state_id" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select State --</option>
                        <?php $__currentLoopData = $data->lists->state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(request()->query('state_id') == $item->state_id): ?>
                                <option value="<?php echo e($item->state_id); ?>" selected>
                                    <?php echo e($item->state_name); ?>

                                </option>
                            <?php else: ?>
                                <option value="<?php echo e($item->state_id); ?>">
                                    <?php echo e($item->state_name); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `State`.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="lga_id" class="form-label">Local Government</label>
                    <select name="lga_id" id="lga_id" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select LGA --</option>
                        <?php $__currentLoopData = $data->lists->lga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="invalid-feedback">
                        Please select a valid `Local Government`.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="ward_uniqueid" class="form-label">Ward</label>
                    <select name="ward_uniqueid" id="ward_uniqueid" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select Ward --</option>
                        <?php $__currentLoopData = $data->lists->ward; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(request()->query('ward_uniqueid') == $item->uniqueid): ?>
                                <option value="<?php echo e($item->uniqueid); ?>" selected>
                                    <?php echo e($item->ward_name); ?>

                                    (Ward <?php echo e($item->ward_id); ?>)
                                </option>
                            <?php else: ?>
                                <option value="<?php echo e($item->uniqueid); ?>">
                                    <?php echo e($item->ward_name); ?>

                                    (Ward <?php echo e($item->ward_id); ?>)
                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `Ward`.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="polling_unit_uniqueid" class="form-label">Polling Unit (PU)</label>
                    <select name="polling_unit_uniqueid" id="polling_unit_uniqueid" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select Polling Unit --</option>
                        <?php $__currentLoopData = $data->lists->polling_unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(request()->query('polling_unit_uniqueid') == $item->uniqueid): ?>
                                <option value="<?php echo e($item->uniqueid); ?>" selected>
                                    <?php echo e(ucwords($item->polling_unit_name)); ?>

                                    (<?php echo e($item->polling_unit_number); ?>)
                                </option>
                            <?php else: ?>
                                <option value="<?php echo e($item->uniqueid); ?>">
                                    <?php echo e(ucwords($item->polling_unit_name)); ?>

                                    (<?php echo e($item->polling_unit_number); ?>)
                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `Polling Unit`.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="party_id" class="form-label">Political Party</label>
                    <select name="party_id" id="party_id" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select Political Party --</option>
                        <?php $__currentLoopData = $data->lists->party; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(request()->query('party_id') == $item->id): ?>
                                <option value="<?php echo e($item->id); ?>" selected>
                                    <?php echo e($item->partyname); ?>

                                </option>
                            <?php else: ?>
                                <option value="<?php echo e($item->id); ?>">
                                    <?php echo e($item->partyname); ?>

                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `Political Party`.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="party_score" class="form-label">Party Score</label>
                    <input type="number" name="party_score" id="party_score" min="0" value="0"
                        class="form-control" required />
                    <div class="invalid-feedback">
                        `Party Score` is required.
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="text-end">
                <button class="btn btn-outline-secondary btn-md" type="reset">
                    <i class="fas fa-times-circle px-1"></i>
                    Clear
                </button> &nbsp;
                <button class="btn btn-primary btn-md" type="submit">
                    <i class="fas fa-save px-1"></i>
                    Save
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\binec\resources\views/create.blade.php ENDPATH**/ ?>