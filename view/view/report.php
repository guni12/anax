<?php if (isset($headline)) : ?>
    <?= $headline ?>
<?php endif; ?>
<?php if (isset($list)) : ?>
    <?= $list ?>
<?php endif; ?>
<?php if (isset($reports)) : ?>
    <?php foreach ($reports as $val) : ?>
        <h3><?= $val['headline'] ?></h3>
        <article><?= $val['text'] ?></article>
    <?php endforeach; ?>
<?php endif; ?>
