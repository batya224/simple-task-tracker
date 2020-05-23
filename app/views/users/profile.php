<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php get_alert_message('register_success'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>
                    <?= get_user_meta('username') ?>, welcome to profile
                </h2>

                <p>
                    <a class="btn btn-info" href="<?= generateLink('users/logout'); ?>">Logout</a>
                </p>

                <p> Now you will be able to change task data from <a href="<?= generateLink('tasks'); ?>">Tasks list</a></p>
            </div>
        </div>
    </div>
</div>
<?php require_once APP_PATH . '/views/footer.php'; ?>
