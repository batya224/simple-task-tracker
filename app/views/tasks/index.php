<?php require_once APP_PATH . '/views/header.php'; ?>

<div class="main-contaier container-fluid py-5">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php get_alert_message('task_message'); ?>
            </div>
        </div>

        <div class="row mb-5">

            <div class="col-md-6">
                <h1>
                    Tasks
                </h1>
            </div>
            <!--            --><?php //if (is_logged_in()) : ?>

            <div class="col-md-6 text-right">

                <a href="<?= generateLink('tasks/add') ?>" class="btn btn-primary pull-right">
                    <i class="fas fa-pencil-alt"></i>
                    Add Task
                </a>

            </div>
            <!--            --><?php //endif; ?>
        </div>


        <?php if (empty($data['list'])): ?>
            <p>Tasklist is empty.</p>
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <table id="taskList" class="table table-striped table-bordered dataTable" cellspacing="0"
                           width="100%" role="grid" style="width: 100%;">
                        <thead>
                        <tr>
                            <?php
                            $headers = [
                                ['field' => 'username', 'label' => 'Имя пользователя', 'sortable' => true],
                                ['field' => 'email', 'label' => 'Email', 'sortable' => true],
                                ['field' => 'description', 'label' => 'Текст задачи', 'sortable' => false],
                                ['field' => 'status', 'label' => 'Статус', 'sortable' => true],
//                                ['field' => 'is_modified', 'label' => 'Modified at', 'sortable' => false],
                            ];

                            foreach ($headers as $header) {
                                $field = isset($header['field']) ? $header['field'] : '';
                                $label = isset($header['label']) ? $header['label'] : '';
                                ?>
                                <?php if (isset($header['sortable']) && $header['sortable']) {
                                    $sort = 'ASC';
                                    $sortOrder = ' &#8593';
                                    if ((isset($_GET['sort_order']) && $_GET['sort_order'] == 'ASC') && (isset($_GET['sort_by']) && $_GET['sort_by'] == $field)) {
                                        $sort = 'DESC';
                                        $sortOrder = ' &#8595';
                                    }
                                    $label = $label . " " . $sortOrder;
                                    ?>
                                    <th>
                                        <a href="<?= generateLink('tasks', ['sort_by' => $field, 'sort_order' => $sort], true) ?>"><?= $label ?></a>
                                    </th>
                                <?php } else { ?>
                                    <th><?= $label ?></th>
                                <?php } ?>
                            <?php } ?>

                            <?php if (is_logged_in()) { ?>
                                <th colspan="2"></th>
                            <?php } ?>
                        </thead>
                        <tbody>
                        <?php foreach ($data['list'] as $task): ?>
                            <tr>
                                <td><?= $task->username; ?></td>
                                <td><?= $task->email; ?></td>
                                <td><?= $task->description; ?></td>
                                <td><?php
                                    echo format_status($task->status);
                                    if (!empty($task->modified_time)) {
                                        echo format_modified($task->modified_time);
                                    }
                                    ?>
                                </td>
                                <!--                                <td>-->
                                <?php //echo format_modified($task->modified_time); ?><!--</td>-->
                                <?php if (is_logged_in()) { ?>
                                    <td>
                                        <a href="<?= generateLink('tasks/edit/' . $task->id) ?>">
                                            Update
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Are you sure?');"
                                           href="<?= generateLink('tasks/delete/' . $task->id) ?>">
                                            Delete
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <?php
                    $totalPages = $data['pagecount'];
                    $active_page = isset($_GET["page"]) ? $_GET["page"] : 1;
                    if ($totalPages > 1) { ?>
                        <ul class="pagination">
                            <?php
                            for ($counter = 1; $counter <= $totalPages; $counter++) {
                                if ($counter == $active_page) {
                                    echo "<li><a class='page-link active'>$counter</a></li>";
                                } else {
                                    echo "<li><a  class='page-link' href=" . generateLink('tasks', ['page' => $counter], true) . ">$counter</a></li>";
                                }
                            } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <?php require_once APP_PATH . '/views/footer.php'; ?>
