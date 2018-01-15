{
  "feed": {
    "title": "Jobeet",
    "subtitle": "Lates Jobs",
    "link": <?= url_for('job', ['sf_format' => 'json'], true) ?>,
    "updated": "<?= gmstrftime('%Y-%m-%dT%H:%M:%SZ', $latestPost->getDateTimeObject('created_at')->format('U')) ?>",
    "author": {
      "name": "Jobeet"
    },
    "id": "<?= sha1(url_for('job', array('sf_format' => 'json'), true)) ?>",

    "entry": [
<?php use_helper('Text') ?>
<?php foreach ($categories as $category): ?>
<?php foreach ($category->getActiveJobs(sfConfig::get('app_max_jobs_on_homepage')) as $job): ?>
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
<?php endforeach; ?>
    ]
  }
}