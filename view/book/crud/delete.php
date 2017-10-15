<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Create urls for navigation
$urlToView = url("book");



?><h1>Ta bort en bok</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">Till Alla Böcker</a>
</p>
