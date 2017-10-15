<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

?>

<?php if (!$items) : ?>
    <p>Inga böcker i databasen.</p>
<?php
    return;
endif;
?>

<?= $items ?>
