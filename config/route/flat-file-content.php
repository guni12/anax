<?php
/**
 * Routes for flat file content.
 */
$app->router->always(function () use ($app) {
    // Get the current route and see if it matches a content/file
    $path = $app->request->getRoute();
    $app->navbar->setCurrentRoute($path);
    
    //var_dump($path); //string given in url
    $file1 = ANAX_INSTALL_PATH . "/content/${path}.md";
    $file2 = ANAX_INSTALL_PATH . "/content/${path}/index.md";

    $file = is_file($file1) ? $file1 : null;
    $file = is_file($file2) ? $file2 : $file;

    if (!$file) {
        return;
    }

    // Check that file is really in the right place
    $real = realpath($file);
    //var_dump($real); //efter sökväg tom anax: \content\index.md
    $base = realpath(ANAX_INSTALL_PATH . "/content/");
    if (strncmp($base, $real, strlen($base))) {
        return;
    }

    // Get content from markdown file
    $content = file_get_contents($file);
    $content = $app->textfilter->parse($content, ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"]);

    // Render a standard page using layout
    $app->renderPage($content->text, $content->frontmatter);
});
