<?php
/**
 * Add and configure services and return the $app object.
 */

// Add all resources to $app
$app                = new \Guni\App\App();
$app->request       = new \Anax\Request\Request();
$app->response      = new \Anax\Response\Response();
$app->url           = new \Anax\Url\Url();
$app->router        = new \Anax\Route\RouterInjectable();
$app->view          = new \Anax\View\ViewContainer();
$app->textfilter    = new \Anax\TextFilter\TextFilter();
$app->session       = new \Anax\Session\SessionConfigurable();
$app->navbar        = new \Guni\Navbar\Navbar();
$app->rem           = new \Guni\RemServer\RemServer();
$app->remController = new \Guni\RemServer\RemServerController();
$app->comm          = new \Guni\Comments\Comments();

// Configure request
$app->request->init();

// Configure router
$app->router->setApp($app);

// Configure session
$app->session->configure("session.php");

// Configure url
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());

$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();

// Configure view
$app->view->setApp($app);
$app->view->configure("view.php");

$app->navbar->setApp($app);
$app->navbar->setCurrentRoute($app->request->getRoute());
$app->navbar->configure("navbar.php");

// Init REM Server
$app->rem->configure("remserver.php");
$app->rem->inject(["session" => $app->session]);

// Init controller for the REM Server
$app->remController->setApp($app);

$app->comm->setApp($app);
$app->comm->configure("comments.php");
$app->comm->inject(["session" => $app->session]);

// Return the populated $app
return $app;
