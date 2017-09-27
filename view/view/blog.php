<?php ?>
<hr />
<?php if (isset($headline)) : ?>
    <p><span class='headline'><?= $headline ?> </span>
<?php endif; ?>
<?php if (isset($id)) : ?>
    <span class='id'>Id: <?= $id ?></span></p>
<?php endif; ?>    
<?php if (isset($content)) : ?>
    <p><?= $content ?></p>
<?php endif; ?>
<?php if (isset($gravatar)) : ?>
    <p><span class='gravatar'><img src='<?= $gravatar ?>' alt='' /></span>
<?php endif; ?>
<?php if (isset($email)) : ?>
    <span class='email'><?= $email ?></span></p>
<?php endif; ?>
