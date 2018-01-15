<?php foreach ($jobs as $url => $job): ?>
-
  url: <?= $url ?>

<?php foreach ($job as $key => $value): ?>
    <?= $key ?>: <?= sfYaml::dump($value) ?>
<?php endforeach ?>

<?php endforeach ?>