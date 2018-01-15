<?php use_helper('Text') ?>
<?php foreach ($jobs as $job): ?>
{
    "title": "<?= $job->getPosition() ?> (<?= $job->getLocation() ?>)",
    "link": "<?= url_for('job_show_user', $job, true) ?>",
    "id": "<?= sha1($job->getId()) ?>",
    "updated": "<?= gmstrftime('%Y-%m-%dT%H:%M:%SZ', $job->getDateTimeObject('created_at')->format('U')) ?>",
    "summary": "<?= simple_format_text($job->getDescription()) ?>",
    "author": {
        "name": "<?= $job->getCompany() ?>"
    }
},
<?php endforeach; ?>