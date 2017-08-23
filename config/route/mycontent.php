<?php
/**
 * Routes.
 */

$app->router->add("test/test", function () use ($app) {
    $app->view->add("test/test");

    $app->renderPage([
        "title" => "Test",
    ]);
});

$app->router->add("test", function () use ($app) {
    $app->view->add("test/index");

    $app->renderPage([
        "title" => "TestIndex",
    ]);
});

$app->router->add("test/about", function () use ($app) {
    $app->view->add("test/header", ["title" => "About"]);
    $app->view->add("test/navbar");
    $app->view->add("test/about");

    $app->response->setBody([$app->view, "render"])
              ->send();
});
