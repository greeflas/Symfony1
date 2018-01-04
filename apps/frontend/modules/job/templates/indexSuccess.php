<?php use_stylesheet('jobs.css') ?>

<div id="jobs">
    <table class="jobs">
        <?php foreach ($jobeet_jobs as $i => $job): ?>
            <?php $url = url_for([
                'module'    => 'job',
                'action'    => 'show',
                'id'        => $job->getId(),
                'company'   => $job->getCompany(),
                'location'  => $job->getLocation(),
                'position'  => $job->getPosition(),
            ]) ?>
            <tr class="<?= fmod($i, 2) ? 'even' : 'odd' ?>">
                <td><?= $job->getLocation() ?></td>
                <td>
                    <?= link_to($job->getPosition(), 'job_show_user', $job) ?>
                </td>
                <td><?= $job->getCompany() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

