---
title: "Kmom01"

region: "mainleft"

"stylesheets": ["css/style.css"]
...

###Kunskapsinventering: Mina styrkor och svagheter###

Jag är praktiskt lagd och kommer ganska långt genom envishet och "trial and error". Jag är inte lika bra på att lära mig, (komma ihåg), teori såsom mönster, standarder, högre ordning, inkappsling.

Alltså har jag mycket att träna på och tack och lov kan man googla.

Genom kurserna på BTH har jag i alla fall stött på många saker som nämns i artikeln 
["PHP The Right Way"](http://www.phptherightway.com). 
Jag installerade precis PHP Code Sniffer, SublimeLinter och ett antal testprogram till SublimeText3. Det blir en stor hjälp för kodstandard mm. 

Mycket av det jag behöver erövra kommer vi säkert att träna på under läsåret, som magiska metoder, klass-hantering med arv och namespaces. UTF-8 kan jag behöva tränga in mer i.

Jag har tidigare översatt lite med PoEdit (gettext) och vill gärna fräscha upp mig där.

Dependency Injection känns nytt och verkar komma in i kursen ganska snart.

Jag hade inte koll på att Mysql anses så förlegad. Visserligen har jag senaste installationen av Xampp med MariaDB, men ändå viktigt att veta. Jag har inte använt Mysql på ett bra tag, däremot Sqlite. Jag behöver bli mycket säkrare på all datahanering.

Jag har jobbat en del med ramverket Lydia, och använder det för två olika hemsidor i produktion. Men jag vill uppdatera mig och förbättra mig på en mängd saker, filter, säkerhet, struktur... Anax både liknar och skiljer sig åt i uppbyggnaden.

Felhantering vill jag definitivt bli bättre på (att använda).

Testning är ett så viktigt område och här är jag helt grön och utan förkunskaper.

###Mest populära ramverken 2017###

När det gäller popularitet så vinner Laravel med hästlängder. När det gäller pålitlighet, utvecklare som alltjämt förbättrar koden och möjlighet till support, kommer också Symfony2 högt upp.

Fortfarande ligger CodeIgniter bra till och därefter, men med en mindre andel användare, Yii och Nette Framework.

Några vill även placera CakePHP lite högre upp i sin rankning.

Mina källor:    
[https://www.sitepoint.com/the-state-of-php-mvc-frameworks-in-2017/](https://www.sitepoint.com/the-state-of-php-mvc-frameworks-in-2017/)
[https://medium.com/@elitechsystems/the-most-popular-php-frameworks-in-2017-a90a1189405e](https://medium.com/@elitechsystems/the-most-popular-php-frameworks-in-2017-a90a1189405e)
[https://www.dunebook.com/5-best-php-frameworks-learn-2017/](https://www.dunebook.com/5-best-php-frameworks-learn-2017/)            
[https://coderseye.com/best-php-frameworks-for-web-developers/](https://coderseye.com/best-php-frameworks-for-web-developers/)    
[http://www.archer-soft.com/en/blog/top-7-best-php-frameworks-2017](http://www.archer-soft.com/en/blog/top-7-best-php-frameworks-2017)

###Communities###

Min syn på sociala medier är komplicerad.
Jag använder frågetrådar på nätet dagligen, skulle inte ha klarat mig så här långt utan alla dessa hjälpsamma människor därute. Men så kommer det till att bidra själv. Då ska man ju dels ta sig tid, dels tycka att man kan någonting. Men om man vill få ska man också ge, det inser jag.

Min sambo är aktiv och vinner mycket på det, inte minst jobbmässigt. Han är egenföretagare, bygger ständigt communities och tjatar på mig att göra detsamma, men det hjälper inte så jättemycket. Man är olika.

Jag ska försöka använda gitter, det får bli årets utmaning – en av dem. Så klart lär man sig hur mycket som helst.

###"En ramverkslös värld" - vad tror du?###
Att inte binda upp sig på ett speciellt ramverk utan kunna plocka godbitar alltefter behov, låter i alla fall bra. Det kräver förstås att man har så stor erfarenhet att man både klarar av att välja och sätta ihop de olika delarna på ett bra sätt.

Michael Cullum trycker på att det är bibliotek vi behöver tillsammans med företagslogik och att själva ramverket är en mycket liten del, den som knyter ihop säcken på något sätt. Och det bör ju vara en fördel att kunna plocka in modul efter modul, allteftersom behov uppstår, och själv ha superkoll på vilka beroenden dessa har eller skapar.

Så jag tror att ju skickligare programmerare, ju mindre uppstyrd vill man vara. Gemensamma standarder på allt, måste vara nyckeln här. Men för egen del är detta avlägset, tror jag.

###Kommentarssystem###

Jag har som sagt använt (mina varianter av) ramverket Lydia. Gästbok, sessions, inloggning, metoder i sökvägen ingår där. Anax är inte riktigt likadant uppbyggd. Här gäller det att förstå hur man kommer åt, liksom stoppar in, informationen i `$app`. Just nu måste jag gå från `$this` till `$app` när jag är i min egen `src`. Kaske inte riktigt rätt. Jag vill kunna hantera tillägg till sökvägen, såsom ankare eller metod. Det gäller att leta vidare. Tror jag tjänar på att gå vidare till kmom02.
