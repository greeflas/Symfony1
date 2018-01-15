<?xml version="1.0" encoding="utf-8"?>
<jobs>
<?php foreach ($jobs as $url => $job): ?>
    <job url="<?= $url ?>">
    <?php foreach ($job as $key => $value): ?>
        <<?= $key ?>>
            <?= $value ?>
        </<?= $key ?>>
    <?php endforeach; ?>
    </job>
<?php endforeach; ?>
</jobs>
