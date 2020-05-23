<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="<?= BASE_URL; ?>">
            <?= SITE_NAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?=generateLink('tasks'); ?>">Tasks</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (is_logged_in()) : ?>

                <li class="nav-item">

                    <a class="nav-link active" href="<?=generateLink('users/profile'); ?>">Welcome,
                        <?= get_user_meta('username'); ?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?=generateLink('users/logout'); ?>">Logout</a>
                </li>

                <?php else : ?>


                <li class="nav-item">

                    <a class="nav-link" href="<?=generateLink('users/login'); ?>">Login</a>
                </li>

                <?php endif; ?>


            </ul>
        </div>

    </div>

</nav>
