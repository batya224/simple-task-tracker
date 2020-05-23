<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <div class="row">

            <div class="col-md-6 mx-auto">

                <div class="card bg-light mt-5">

                    <div class="card-body">
                        <h2>Create Account</h2>
                        <p>Please fill out form to register.</p>
                        <form action="<?=generateLink('users/register'); ?>" method="post">

                            <div class="form-group">
                                <label for="name">Fullname: <sup>*</sup></label>
                                <input type="name" name="name" id="" class="form-control <?= (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>"
                                       value="<?= $data['name'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['name_error'])) ? $data['name_error'] : ''; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="name">Имя пользователя: <sup>*</sup></label>
                                <input type="text" name="username" id="" class="form-control <?= (!empty($data['username_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['username'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['username_error'])) ? $data['username_error'] : ''; ?>
                                </div>
                            </div>

                          
                            <div class="form-group">
                                <label for="password">Password: <sup>*</sup></label>
                                <input type="password" name="password" id="" class="form-control <?= (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['password'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['password_error'])) ? $data['password_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confrim_password">Confirm Password: <sup>*</sup></label>
                                <input type="password" name="confrim_password" id="" class="form-control <?= (!empty($data['confrim_password_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?= $data['confrim_password'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['confrim_password_error'])) ? $data['confrim_password_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <input type="submit" value="Register" class="btn btn-primary btn-block">
                                </div>

                                <div class="col">

                                    <a href="<?=generateLink('users/login'); ?>" class="btn btn-white btn-block">Have an
                                        account? Login</a>
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
