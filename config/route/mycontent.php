<?php
/**
 * Routes.
 */

$app->router->add("view/home", function () use ($app) {
    // Create default data set to send to the layout
    $data = [
        "title" => "HosGuni",
        "stylesheets" => ["css/style.css"]
    ];
    //$app->navbar->setCurrentRoute("view/home");

    // Add the layout view to its own region
    $app->view->add("view/layout", $data, "layout");

    $app->view->add("view/header", [
        "header" => ""
        ], "header", 0);
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
        "line3" => "Annat som engagerar mig är hus och renovering, små nya människor i släkten, lite vinterodling med hydroponik, vandringar i naturen, goda vänner... Och så kurserna på BTH förstås.<br />Jag har fått förmånen att hoppa in i årskurs 2 direkt. Det innebär att det kommer att fattas viss förkunskap här och där, men jag ska göra mitt yttersta för att jobba ikapp."
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
        "title" => "Ramverk1",
        "stylesheets" => ["css/style.css"]
    ];

    $app->navbar->setCurrentRoute("view/about");
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
        "line1" => "Vi ska lära oss mer om moduler, hur man tänker när man bygger ihop och integrerar dem i en MVC. Hur man strukturerar i en helhet och skapar stor flexibilitet för sig själv. Vi ska bli lite proffsigare med mer tidsbesparande automatik och testning.",
        "line3" => "<a href='https://github.com/guni12/anax'>Kolla min anax på github</a>",
        "line2" => "Vi ska också få en överblick över hela webbmiljön (stacken), något som ofta efterfrågas i jobbannonser."
        ], "mainleft", 0);
    $app->view->add("view/footer", [], "footer", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)
                  ->send();
});

$active = "";
//$app->navbar->setCurrentRoute($app->request->getRoute() . "#kmom1");
//var_dump($app->request->getMethod());
$textleft = <<<EOD
<ul class="nav nav-pills nav-stacked">
    <li class="active"><a href="#kmom1">Kmom1</a></li>
    <li><a href="#kmom2">Kmom2</a></li>
    <li><a href="#kmom3">Kmom3</a></li>
    <li><a href="#kmom4">Kmom4</a></li>
    <li><a href="#kmom5">Kmom5</a></li>
    <li><a href="#kmom6">Kmom6</a></li>
    <li><a href="#kmom7">Kmom7-10</a></li>
</ul><br>
<div class="input-group">
    <input type="text" class="form-control" placeholder="Att implementera..">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
</div>
EOD;

$textright = <<<EOD
<h4>REDOVISNINGARNA</h4>
<hr>
<a name="kmom1"></a><h2>Kmom01</h2>
<h3>Kunskapsinventering: Mina styrkor och svagheter</h3>
<p>Jag är praktiskt lagd och kommer ganska långt genom envishet och "trial and error". Jag är inte lika bra på att lära mig, (komma ihåg), teori såsom mönster, standarder, högre ordning, inkappsling.</p>
<p>Alltså har jag mycket att träna på och tack och lov kan man googla.</p>
<p>Genom kurserna på BTH har jag i alla fall stött på många saker som nämns i artikeln <a href='http://www.phptherightway.com/'>"PHP The Right Way"</a>. Jag installerade precis PHP Code Sniffer, SublimeLinter och ett antal testprogram till SublimeText3. Det blir en stor hjälp för kodstandard mm.</p>
<p>Mycket av det jag behöver erövra kommer vi säkert att träna på under läsåret, som magiska metoder, klass-hantering med arv och namespaces. UTF-8 kan jag behöva tränga in mer i.</p>
<p>Jag har tidigare översatt lite med PoEdit (gettext) och vill gärna fräscha upp mig där.</p>
<p>Dependency Injection känns nytt och verkar komma in i kursen ganska snart.</p>
<p>Jag hade inte koll på att Mysql anses så förlegad. Visserligen har jag senaste installationen av Xampp med MariaDB, men ändå viktigt att veta. Jag har inte använt Mysql på ett bra tag, däremot Sqlite. Jag behöver bli mycket säkrare på all datahanering.</p>
<p>Jag har jobbat en del med ramverket Lydia, och använder det för två olika hemsidor i produktion. Men jag vill uppdatera mig och förbättra mig på en mängd saker, filter, säkerhet, struktur... Anax både liknar och skiljer sig åt i uppbyggnaden.</p> 
<p>Felhantering vill jag definitivt bli bättre på (att använda).</p>
<p>Testning är ett så viktigt område och här är jag helt grön och utan förkunskaper.</p>

<h3>Mest populära ramverken 2017</h3>
<p>När det gäller popularitet så vinner Laravel med hästlängder. När det gäller pålitlighet, utvecklare som alltjämt förbättrar koden och möjlighet till support, kommer också Symfony2 högt upp.</p>
<p>Fortfarande ligger CodeIgniter bra till och därefter, men med en mindre andel användare, Yii och Nette Framework.</p>

<p>Några vill även placera CakePHP lite högre upp i sin rankning.<p>
<p>Mina källor:</p>
<a href="https://www.sitepoint.com/the-state-of-php-mvc-frameworks-in-2017/">https://www.sitepoint.com/the-state-of-php-mvc-frameworks-in-2017/</a>
<br />
<a href="https://medium.com/@elitechsystems/the-most-popular-php-frameworks-in-2017-a90a1189405e">https://medium.com/@elitechsystems/the-most-popular-php-frameworks-in-2017-a90a1189405e</a>
<br />
<a href="https://www.dunebook.com/5-best-php-frameworks-learn-2017/">https://www.dunebook.com/5-best-php-frameworks-learn-2017/</a>
<br />
<a href="https://coderseye.com/best-php-frameworks-for-web-developers/">https://coderseye.com/best-php-frameworks-for-web-developers/</a>
<br />
<a href="http://www.archer-soft.com/en/blog/top-7-best-php-frameworks-2017">http://www.archer-soft.com/en/blog/top-7-best-php-frameworks-2017</a>
<h3>Communities</h3>

<p>Min syn på sociala medier är komplicerad.<br />
Jag använder frågetrådar på nätet dagligen, skulle inte ha klarat mig så här långt utan alla dessa hjälpsamma människor därute. Men så kommer det till att bidra själv. Då ska man ju dels ta sig tid, dels tycka att man kan någonting. Men om man vill få ska man också ge, det inser jag.</p>
<p>Min sambo är aktiv och vinner mycket på det, inte minst jobbmässigt. Han är egenföretagare, bygger ständigt communities och tjatar på mig att göra detsamma, men det hjälper inte så jättemycket. Man är olika.</p>
<p>Jag ska försöka använda gitter, det får bli årets utmaning – en av dem. Så klart lär man sig hur mycket som helst.</p>
<h3>"En ramverkslös värld" - vad tror du?</h3>
<p>Att inte binda upp sig på ett speciellt ramverk utan kunna plocka godbitar alltefter behov, låter i alla fall bra. Det kräver förstås att man har så stor erfarenhet att man både klarar av att välja och sätta ihop de olika delarna på ett bra sätt.</p>
<p>Michael Cullum trycker på att det är bibliotek vi behöver tillsammans med företagslogik och att själva ramverket är en mycket liten del, den som knyter ihop säcken på något sätt. Och det bör ju vara en fördel att kunna plocka in modul efter modul, allteftersom behov uppstår, och själv ha superkoll på vilka beroenden dessa har eller skapar.</p> 
<p>Så jag tror att ju skickligare programmerare, ju mindre uppstyrd vill man vara. Gemensamma standarder på allt, måste vara nyckeln här. Men för egen del är detta avlägset, tror jag.</p>
<h3>Kommentarssystem</h3>
<p>Jag har som sagt använt (mina varianter av) ramverket Lydia. Gästbok, sessions, inloggning, metoder i sökvägen ingår där. Anax är inte riktigt likadant uppbyggd. Här gäller det att förstå hur man kommer åt, liksom stoppar in, informationen i <samp>&dollar;app</samp>. Just nu måste jag gå från <samp>&dollar;this</samp> till <samp>&dollar;app</samp> när jag är i min egen <samp>src</samp>. Kaske inte riktigt rätt. Jag vill kunna hantera tillägg till sökvägen, såsom ankare eller metod. Det gäller att leta vidare. Tror jag tjänar på att gå vidare till kmom02.</p>

<a href="#top">Toppen</a>
<a name="kmom2"></a><h3>Kmom2</h3>
<a href="#top">Toppen</a>
<a name="kmom3"></a><h3>Kmom3</h3>
<a href="#top">Toppen</a>
<a name="kmom4"></a><h3>Kmom4</h3>
<a href="#top">Toppen</a>
<a name="kmom5"></a><h3>Kmom5</h3>
<a href="#top">Toppen</a>
<a name="kmom6"></a><h3>Kmom6</h3>
<a href="#top">Toppen</a>
<a name="kmom7"></a><h3>Kmom7-10</h3>
<a href="#top">Toppen</a>
EOD;


$app->router->add("view/report", function () use ($app, $textleft, $textright) {
    // Create default data set to send to the layout
    $data = [
        "title" => "Report",
        "stylesheets" => ["css/style.css"]
    ];

    $app->navbar->setCurrentRoute("view/report");
    // Add the layout view to its own region
    $app->view->add("view/layout", $data, "layout");

    $app->view->add("view/header", [
        "header" => ""
        ], "header", 0);
    $app->view->add("view/navbar", [
        "navbar" => $app->navbar->getHTML()], "navbar", 0);
    $app->view->add("view/home", [
        "line1" => $textleft
        ], "blogleft", 0);
    $app->view->add("view/home", [
        "line1" => $textright
        ], "blogright", 0);

    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)
                  ->send();
});
