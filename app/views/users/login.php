<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <div class="row">

            <div class="col-md-6 mx-auto">

                <div class="card bg-light mt-5">

                    <div class="card-body">
                        <?php get_alert_message('register_success'); ?>
                        <h2>Login</h2>

                        <form action="<?= generateLink('users/login') ?>" method="post">
                            <div class="form-group">
                                <label for="username">Имя пользователя: <sup>*</sup></label>
                                <input type="text" name="username" id="username"
                                       class="form-control <?= (!empty($data['username_error'])) ? 'is-invalid' : ''; ?>"
                                       value="<?= $data['username'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['username_error'])) ? $data['username_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password: <sup>*</sup></label>
                                <input type="password" name="password" id="password"
                                       class="form-control <?= (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>"
                                       value="<?= $data['password'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['password_error'])) ? $data['password_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <input type="submit" value="Login" class="btn btn-primary btn-block">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once APP_PATH . '/views/footer.php'; ?>
