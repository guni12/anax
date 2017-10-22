---
title: "Kmom06"

region: "mainleft"

"stylesheets": ["css/style.css"]
...

###Kmom06###

####Har du någon erfarenhet av automatiserade testar och CI sedan tidigare?####

Testning är helt nya saker för mig. Där har jag stora hål i min kunskap.

####Hur ser du på begreppen, bra, onödigt, nödvändigt, tidskrävande?####

Jag har sett att det efterfrågas i jobbannonser och förstått, av personer som arbetar med kod, att det är jätteviktigt. 

Eftersom jag inte har några förkunskaper har detta och föregående kursmoment tagit tid och ändå har jag inte nått så långt som jag velat och som jag behöver nå. Det blir då oproportionerligt tidskrävande.

Jag läste någonstans om utvecklare som skrev testkoden först och själva koden därefter. Det kanske är smart, för då vet man att det verkligen går att testa allting.

Nu fungerade inte alla moment enligt plan, t.ex. fungerade inte symlänken mellan min modul och min testmiljö. Detta skapade jättemånga buggar. Helt i onödan. Och man kan inte lösa allting samtidigt. Men nu har jag erfarenhet av att den där kopplingen måste finnas, blir ohanterligt annars.

####Hur stor kodtäckning lyckades du uppnå i din modul?####

Jag klarade inte av att hantera beroenden som nu fattades, dvs `User`klassen. Jag kunde kanske skrivit koden annorlunda och inte stoppat in beroendena i precis varenda funktion, såsom i min `CommController`klass. Att mocka en klass som är beroende av `di`, där gick jag bet.

Jag lyckades inte heller klara av att skriva till databasen. Då blev svaret att den var låst. Det gick bra att hämta, tack och lov.

Jag hittade en funktion som skulle hjälpa till med att nå `protected/private` metoder, men det ville sig inte. Lokalt hade jag nytta av en `pageRender.php` för att se vad som hämtades, men den fick jag inte skicka med för Scrutinizer, som påstod att filen inte fanns, trots ändrade rättigheter mm.

Jag har nu låtit några av mina ej fungerande funktioner ligga kvar i testerna, ifall jag framöver kanske lär mig mer om yttre beroenden och kan hantera `User`. Enligt Scrutinizer har jag 36% kodtäckning.

Helt utan förkunskaper har detta varit ett tungt moment för mig, vilket ju är helt och hållet mitt eget fel som ville hoppa in i årskurs två direkt.

Jag tror att tester är superviktigt och måste försöka komma ikapp kunskapsmässigt så fort som möjligt.

####Berätta hur det gick att integrera mot de olika externa tjänsterna?####

Själva registreringen gick snabbt och lätt, liksom att komma igång eftersom `yml`filerna till stor del redan fanns. Innan jag hade så många testklasser gick bedömningen också fint. Jag fick fina tips om när jag fortfarande hade för stor komplexitet, eller borde försöka bli av med funktioner som gjorde samma saker. 

När jag försökte öka test-täckningen fick jag fler problem. Bl.a. behövde jag ändra vissa rättigheter och så blev det buggar eftersom jag utvecklade i min testmiljö och inte i min modul, se ovan. 

Jag läste också i forumet, diskussion mellan mos och lrc, om hur Scrutinizer har förändrat sin behandling av phpunit. Jag stal koden därifrån, (från lrc), rättav och det skulle jag inte ha gjort för det hindrade byggandet helt och hållet. Man ska inte göra saker som man inte förstår, och jag har haft för många saker att sätta mig in i samtidigt just nu. Tillbaka till ursprungs-filen gick byggandet bättre, men jag måste ju också lösa den där förändringen.

Även om det är jobbigt när man inte lyckas, så är detta fantastiskt. Jag är redan taggad att bli en bättre programmerare med dessa hjälpmedel.

####Vilken extern tjänst uppskattade du mest, eller har du förslag på ytterligare externa tjänster att använda?####

Just nu kanske jag uppskattade Scrutinizer mest. Där fick jag så mycket hjälp med min kod. Men när jag blir mer varm i kläderna kring modulbyggande kommer jag säkert att växla preferenser.
