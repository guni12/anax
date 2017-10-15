<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$item = isset($item) ? $item : null;
//var_dump($item);

// Create urls for navigation
$urlToView = url("book");



?><p>
    <a href="<?= $urlToView ?>">Till Alla Böcker</a>
</p>

<h1>Redigera bokinfo</h1>

<?= $form ?>
