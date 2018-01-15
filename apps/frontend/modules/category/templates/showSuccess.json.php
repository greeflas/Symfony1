{
  "feed": {
    "title": "<?= $category ?>",
    "subtitle": "Latest Jobs",
    "link": "<?= url_for('category', ['sf_subject' => $category, 'sf_format' => 'json'], true) ?>",
    "updated": "<?= gmstrftime('%Y-%m-%dT%H:%M:%SZ', $latestPost->getDateTimeObject('created_at')->format('U')) ?>",
    "author": {
      "name": "Jobeet"
    },
    "id": "<?= sha1(url_for('category', array('sf_subject' => $category), true)) ?>",

    "entry": [
      <?php include_partial('job/list', ['jobs' => $pager->getResults()]) ?>
    ]
  }
}