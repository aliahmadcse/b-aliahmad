<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141108427-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-141108427-2');
    </script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('images/favicon/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('images/favicon/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('images/favicon/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('images/favicon/site.webmanifest')); ?>">
    <link rel="mask-icon" href="<?php echo e(asset('images/favicon/safari-pinned-tab.svg')); ?>" color="#5bbad5">
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon/favicon.ico')); ?>">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="<?php echo e(asset('images/favicon/browserconfig.xml')); ?>">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title','Home'); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>

    <!-- Styles -->
    <link href="<?php echo e(mix('css/app.css')); ?>" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand text-gray" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php echo e(request()->is('/') ? 'active':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('about')); ?>">About</a>
                        </li>
                        <li class="nav-item <?php echo e(request()->is('portfolio') ? 'active':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('portfolio')); ?>">Portfolio</a>
                        </li>
                        <li class="nav-item <?php echo e(request()->is('blog') || request()->is('blog/*') ? 'active':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('blog')); ?>">Blog</a>
                        </li>
                        <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item <?php echo e(request()->is('login') ? 'active':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
                                class="nav-link dropdown-toggle <?php echo e(request()->is('home/*') || request()->is('home') || request()->is('user/*')  ? 'active':''); ?>"
                                href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                v-pre>
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item <?php echo e(request()->is('home') ? 'active':''); ?>"
                                    href="<?php echo e(route('home')); ?>">
                                    <?php echo e(__('Home')); ?>

                                </a>

                                

                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>
    <?php echo $__env->yieldContent('footer'); ?>
</body>

</html><?php /**PATH C:\laragon\www\b-aliahmad\resources\views\layouts\app.blade.php ENDPATH**/ ?>