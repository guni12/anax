<?php
/**
 * Routes.
 */

$app->router->add("view/home", function () use ($app) {
    // Create default data set to send to the layout
    $data = [
        "title" => "Home",
        "stylesheets" => ["css/style.css"]
    ];

    // Add the layout view to its own region
    $app->view->add("view/layout", $data, "layout");

    $app->view->add("view/navbar", [
        "navbar" => $app->navbar->getHTML()], "navbar", 0);
    $app->view->add("view/img", [
        "img" => "img/gunvor.jpg",
        "imgtext" => '<div class="post-content"><p>photo(c)Mats Bäcker</p></div>'
        ], "mainleft", 0);
    $app->view->add("view/home", [
        "headline" => "Hejsan!",
        "line1" => "Så trevligt att råkas så här, via gemensamma intressen och ettor och nollor i etern.",
        "line2" => "Till yrket är jag sångerska och jobbar (ännu) på GöteborgsOperan. Men jag planerar att sadla om. Det här med programmering är ju, som du också tycker, väldigt roligt.",
        "line3" => "Annat som engagerar mig är hus och renovering, små nya människor i släkten, lite vinterodling med hydroponik, vandringar i naturen, goda vänner... Och så kurserna på BTH förstås."
        ], "mainright", 0);
    $app->view->add("view/footer", [
        "footeradd" => "<br /><br />"
        ], "mainright", 1);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)
                  ->send();
});

$app->router->add("view/about", function () use ($app) {
    // Create default data set to send to the layout
    $data = [
        "title" => "HosGuni",
        "stylesheets" => ["css/style.css"]
    ];

    // Add the layout view to its own region
    $app->view->add("view/layout", $data, "layout");

    $app->view->add("view/header", [
        "header" => ""
        ], "header", 0);
    $app->view->add("view/navbar", [
        "navbar" => $app->navbar->getHTML()], "navbar", 0);
    $app->view->add("view/home", [
        "headline" => "Nu gäller kursen Ramverk1",
        "line1" => "",
        "line2" => "",
        "line3" => ""
        ], "main", 0);
    $app->view->add("view/img", [
        "img" => "img/fullstack.jpg",
        "imgtext" =>'<div class="post-content"><a href="https://www.packtpub.com/books/content/devops-engineering-and-full-stack-development">img-source</a></div>'
        ], "mainright", 0);
    $app->view->add("view/home", [
        "headline" => "",
        "line1" => "Vi ska lära oss mer om moduler, hur man tänker runt dem, integrerar dem, strukturerar i en helhet. Vi ska bli lite proffsigare med mer tidsbesparande automatik och testning.",
        "line3" => "<a href='https://github.com/guni12/anax'>Kolla min anax på github</a>",
        "line2" => "Vi ska också få en överblick över hela webbmiljön (stacken), något som ofta efterfrågas i jobbannonser."
        ], "mainleft", 0);
    $app->view->add("view/footer", [], "footer", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)
                  ->send();
});

$test = "<h3>Kmom01</h3>";

$app->router->add("view/report", function () use ($app, $test) {
    // Create default data set to send to the layout
    $data = [
        "title" => "All",
        "stylesheets" => ["css/style.css"]
    ];

    // Add the layout view to its own region
    $app->view->add("view/layout", $data, "layout");

    $app->view->add("view/header", [
        "header" => ""
        ], "header", 0);
    $app->view->add("view/navbar", [
        "navbar" => $app->navbar->getHTML()], "navbar", 0);
    $app->view->add("view/home", [
        "headline" => "Redovisningarna",
        "line1" => $test,
        "line2" => "",
        "line3" => ""
        ], "main", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)
                  ->send();
});
