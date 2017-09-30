---
title: "Kmom03"

region: "mainleft"

"stylesheets": ["css/style.css"]
...

###Hur känns det att jobba med begreppen kring dependency injection, service locator och lazy loading?###
Det verkar mycket lovande och effektivt att komma in i tänkandet runt beroenden. Det blir också mera tydligt för mig själv vilken klass som behövs. Har jag glömt en koppling så ger ramverket besked om det.

Det är ju också fantastiskt att en massa kod bara är klar och inte behöver skrivas. Lite mystiskt och magiskt är det allt ännu. Men inte värre än att man snabbt kan härleda metoderna. 

Vi berättar att beroendet ska finnas och så använder vi koden som skapar förbindelsen. Smart! Att vara lat är smart.

###Hur känns det att göra dig av med beroendet till `$app`, blir `$di` bättre?
Jag tycker, som sagt, att det blir renare och tydligare med `$di`. Delvis kanske det beror på att jag börjar komma in i ramverket bättre, såklart. Hur som helst, tycker jag att det är mera överskådligt och lättare att hitta i koden nu, mera lättläst.

Det sägs ju också att det kommer att bli enklare att testa. Testning har jag ännu inte trängt in i, så det får bli en senare insikt. Ett par kmom längre fram.

###Lyckades du införa begreppen kring DI?###

Såvitt jag förstår har jag nu byggt om min kod till att använda `$di`. Det var inte så svårt, tycker jag, om jag nu har förstått uppgiften rätt. Jag har stoppat in beroendena i mina två egenskapade klasser. Kanske borde jag göra fler klasser av min Comments-klass. För att klara av begreppet "single responsibility".

###Påbörjade du arbetet med databasmodellen?###

Jag känner en viss stress av att försöka komma ikapp med mina åk.2 kurskamrater. Jag har också gjort några databaser i mina två hemsidor baserade på "Lydia". I dessa finns inloggning och ganska många admin-funktioner. Men nu vill jag ju lära mig det nya. Så jag väljer att gå direkt till kmom4.

Jag har i alla fall funderat något på vilka kolumner som bör finnas. I nuläget tänker jag: användarnamn, lösenord, email, text-id, text, rubrik, datum, förälder-text-id (om det är en kommentar till kommentar). Möjligen behövs fler kolumner för lösenordet - någon backup-funktion. Möjligtvis kan man ha hela sitt riktiga namn också. Kanske ingår det i kursen att lära sig koppla mot facebook och liknande.

###Allmänt###

Den här gången är det bara sessions-kommentarer som finns och syns. (Inte från json-filer eller md-filer.) Återigen fick jag se till att id:t alltid är `int` för att jämföras.

Att hitta aktuell `route` för navbaren fick samma kod som övriga: `$req->getRoute();` - snyggt!

Valideringen gav två fel:
`method renderPage() contains an exit expression.` och
`... FlatFileController ... Avoid unused local variables such as '$path'.`

Eftersom de följer med anax tog jag snabbvägen och undertryckte de varningarna.

Jag slet mitt hår mycket till förra kursmomentet. Detta gick lättare och jag hoppar snabbt vidare till nästa som kanske blir svårare igen.
