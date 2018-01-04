<?php use_stylesheet('jobs.css') ?>

<div id="jobs">
    <?php foreach ($categories as $category): ?>
        <div class="category_<?= Jobeet::slugify($category->getName()) ?>">
            <div class="category">
                <div class="feed">
                    <a href="">Feed</a>
                </div>
                <h1><?= $category ?></h1>
            </div>

            <table class="jobs">
                <?php foreach ($category->getActiveJobs(sfConfig::get('app_max_jobs_on_homepage')) as $i => $job): ?>
                    <tr class="<?= fmod($i, 2) ? 'even' : 'odd' ?>">
                        <td class="location"><?= $job->getLocation() ?></td>
                        <td class="position"><?= link_to($job->getPosition(), 'job_show_user', $job) ?></td>
                        <td class="company"><?= $job->getCompany() ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endforeach; ?>
</div>
