<?php

$linkCar = $this->asset("img/car.png");
$linkGuni = $this->asset("img/gunvor.jpg");
$linkViewTest1 = $this->url("view/test1");
$linkViewTest2 = $this->url("view/test2");
$linkGoogle = $this->url("https://google.se");
$copyright = "Guni";

$this->renderView("view/header", [
    "title" => $title,
]);
?>
<p><?= $message ?></p>

<p>Here is a link to a static asset <a href="<?= $linkCar ?>">car.png</a>.</p>

<p>Here is the same car within a paragraph as an image <img src="<?= $linkGuni ?>">, the image source is linked as a asset.</p>

<p>Here are two links to the test routes: <a href="<?= $linkViewTest1 ?>">view/test1</a> | <a href="<?= $linkViewTest2 ?>">view/test2</a></p>

<p>Here is a link to another site, like <a href="<?= $linkGoogle ?>">Google</a>.

<?= $this->renderView("view/footer", [
    "copyright" => $copyright,
]) ?>
