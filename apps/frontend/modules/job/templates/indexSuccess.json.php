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
<?php foreach ($categories as $category): ?>
    <?php include_partial('job/list', ['jobs' => $category->getActiveJobs(sfConfig::get('app_max_jobs_on_homepage'))]) ?>
<?php endforeach; ?>
    ]
  }
}