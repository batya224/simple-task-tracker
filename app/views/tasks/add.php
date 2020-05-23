<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">

        <div class="row">

            <div class="col">

                <a href="<?= generateLink('tasks') ?>" class="btn btn-secondary"> <i
                            class="fas fa-long-arrow-alt-left"></i></i>
                    Back to
                    Tasks</a>

                <div class="card bg-light mt-5">

                    <div class="card-body">
                        <?php get_alert_message('register_success'); ?>
                        <h2 class="mb-5">Add Task</h2>
                        <form action="<?= generateLink('tasks/add') ?>" method="post">

                            <div class="form-group">
                                <label for="task_title">Assignee: <sup>*</sup></label>
                                <input type="text" name="username" id="username"
                                       class="form-control <?= (!empty($data['username_error'])) ? 'is-invalid' : ''; ?>"
                                       value="<?= $data['username'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['username_error'])) ? $data['username_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="task_title">Email: <sup>*</sup></label>
                                <input type="text" name="email" id="email"
                                       class="form-control <?= (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>"
                                       value="<?= $data['email'] ?>">

                                <div class="invalid-feedback">
                                    <?= (!empty($data['email_error'])) ? $data['email_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="task_content">Текст задачи: <sup>*</sup></label>
                                <textarea type="text" name="description" id="description"
                                          class="form-control <?= (!empty($data['description_error'])) ? 'is-invalid' : ''; ?>"
                                          rows="10"><?= $data['description'] ?></textarea>

                                <div class="invalid-feedback">
                                    <?= (!empty($data['description_error'])) ? $data['description_error'] : ''; ?>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <input type="submit" value="Save" class="btn btn-success btn-block">
                                </div>

                                <div class="col">
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
