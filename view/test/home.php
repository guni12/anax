<?php
$linkGuni = $this->asset("img/gunvor.jpg");
$link = $this->asset($guni);
echo $guni;
var_dump($link);
?>
<h1><?= $headline ?></h1>
<p>Lite text <?= $linkGuni ?></p>
<?= var_dump($link) ?>
<p><img src="<?= $linkGuni ?>"></p>
<p><?= $message ?></p>
