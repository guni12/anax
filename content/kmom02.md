---
title: "Kmom02"

region: "mainleft"

"stylesheets": ["css/style.css"]
...

###Erfarenheter av MVC?###

Jag gick den "gamla" phpmvc-kursen och har arbetat en hel del med Lydia. Eftersom jag missade att lämna in på rätt ställe och få slutbetyg på kursen, av olika skäl, är det dubbel anledning att sätta mig in i Ramverk1.

Lydia har jag använt "i produktion" i två fall och kanske fått ett litet grepp, i viss mån, om vad man lägger i controller respektive model och view. Jag lyckades stoppa in lite av varje - översättingar, inlogg för olika grupper, grafer, algoritmer och annan hantering av mätdata, en liten editor för texterna som sparas till databas mm.

Men jag har inte varit konsekvent. För mycket kodning i kontroller-klasserna ibland, för långa och många funktioner. Det är hög tid att bättra sig.

Fördelen med MVC är bl.a. överskådlighet. Om man blir helt klar över sin egen logik, så blir det effektivare att både skriva och uppdatera kod. Men alldeles helt klart var olika saker bäst ska vara - det får mogna nu...

###Kan du förklara SOLID på ett par rader med dina egna ord?###

[Enkelt och bra om SOLID](https://scotch.io/bar-talk/s-o-l-i-d-the-first-five-principles-of-object-oriented-design)

Jag har mycket lång väg för att bli duktig på detta. Men...                      
klasser bör vara korta (med små begränsade ansvar) som man kan nyttja, inte förändra. Om man använder arv, ska klassen ersätta sin förälder-klass. Interface ska upprättas så att ingen klass har beroende av något den inte använder och interfacet ska styra mot ett begrepp, inte ett hårdkodat innehåll.

###Gick arbetet med REM servern bra? Och berätta om din kommentarsmodul.###

Eftersom jag inte gjort de moderna kurserna som använder Anax, så har jag nu försökt komma ikapp lite. Efter några veckor med design-kursen här för mig själv, har jag förstått mer om markdown.

Jag har alltså byggt om sidan en del sedan förra kursmomentet. Nu har jag tagit bort den router som jag då lade till. Jag klarar mig med `flat-file-content.php`. Jag har stoppat in mer saker i App-klassens `renderPage()`.

För att hantera kommentarer har jag gjort en klass `Comments` som är allt annat än SOLID. Men det är en början att få ihop saker i alla fall.

Det har varit trixigt för mig att förstå var allt ligger. Det finns kanske andra sätt som man bör göra saker på, som jag har missat. Liksom jag hade missat markdown.

Jag har provat med att lägga kommentarer i både remservern, i md-filer under `content/comments` och till slut även i sessions. Detta med sessions har jag inte helt grepp på. Nu har jag en if-sats som startar sessions väldigt ofta. Men när jag startade bara i index-filen i roten, så ville det sig inte riktigt. 

Jag har varit inne och påverkat något i `RemServer`. För att vara säker på att id:t alltid är int, har jag förtydligat det. Jag kollar att inte inlägget är en upprepning mot tidigare. Jag har också gjort en egen funktion - `saveToFile` - som klarar av att spara inlägg till min `comments.json`. Men just nu kan man bara påverka inläggen som ligger i sessions. Tolkade uppgiften som att vi bara skulle skriva till sessions.

Man ser inlägg från de tre olika inläggs-sätten på Artikel-sidan.

Jag skulle vilja göra en länk från t.ex. varje inläggs email-adress. Denna länk ska leda till ett ifyllt formulär. Detta har jag försökt lösa, men inte klurat ut ännu. Så min tillsvidare-lösning är att besökaren får skriva in id, klicka på `EttId` och redigera sitt inlägg där. Då är det också bäst om man klickar på `Ändra` och inte `Spara`. Det finns mycket kvar att förbättra.

Jag ligger lite efter så jag väntar med inloggningen just nu.

Snygg responsivitet med mediastorlekar har jag inte tagit tag i ännu.
