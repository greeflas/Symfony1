<?php use_stylesheet('jobs.css') ?>

<div id="jobs">
    <table class="jobs">
        <?php foreach ($jobeet_jobs as $i => $job): ?>
            <tr class="<?= fmod($i, 2) ? 'even' : 'odd' ?>">
                <td><?= $job->getLocation() ?></td>
                <td>
                    <a href="<?= url_for('job/show?id=' . $job->getId()) ?>">
                        <?= $job->getPosition() ?>
                    </a>
                </td>
                <td><?= $job->getCompany() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

