<?php
$urlTest  = $app->url->create("test/test");
$urlAbout = $app->url->create("test/about");

?><navbar>
<a href="<?= $urlTest ?>">Test</a> | 
<a href="<?= $urlAbout ?>">About</a>
</navbar>
