<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon" />
    <title><?php echo $__env->yieldContent('title', 'Home'); ?> &bull; <?php echo $__env->yieldContent('app', env('APP_NAME')); ?></title>

    <!-- Fonts -->
    <?php echo $__env->yieldPushContent('fonts'); ?>

    <!-- Styles -->
    <link href="<?php echo e(asset('assets/bootstrap/bootstrap.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/font-awesome/css/all.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/uicons/uicons-regular-straight.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet" />
    <?php echo $__env->yieldPushContent('styles'); ?>

    <!-- Scripts -->
    <script src="<?php echo e(asset('assets/jquery/jquery-3.5.1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('js/polaris.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            autofill(0);
            togglePassword();
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</head>

<body>
    <?php if ($__env->exists('shared.header')) echo $__env->make('shared.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main style="padding:0 40px; min-height:640px;">
        <?php if ($__env->exists('shared.nav', ['nav_h1' => $data->title, 'nav_i' => $data->icon])) echo $__env->make('shared.nav', ['nav_h1' => $data->title, 'nav_i' => $data->icon], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->yieldContent('body'); ?>
    </main>

    <div class="container">
        <?php if ($__env->exists('shared.footer')) echo $__env->make('shared.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script src="<?php echo e(asset('assets/bootstrap/bootstrap.bundle.min.js')); ?>"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <?php echo $__env->yieldPushContent('scripts_'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\binec\resources\views/layouts/index.blade.php ENDPATH**/ ?>