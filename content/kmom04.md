---
title: "Kmom04"

region: "mainleft"

"stylesheets": ["css/style.css"]
...

###Kmom04###

####Hur gick det att integrera formulärhantering och databashantering i ditt kommentarssystem?####

Det gick både bra och dåligt för mig med uppgiften. Att följa artiklarna var enkelt och gick ganska snabbt. Men sedan har jag lyckats/unnat mig fastna på en mängd saker. Allt har jag inte dokumenterat, men har ändå fått mer insikt om hur koden hänger ihop.



####Berätta om din syn på Active record och liknande upplägg, ser du fördelar och nackdelar?####

Jag tror att alla de här mönstren vi lär oss kommer att göra koden mera logisk och tydlig. För att göra Active record till mitt har jag mer att sätta mig in i.

Men nu när vi gjort några liknande databastabeller, så blir förfarandet mycket snabbare. Att man kan använda `findAll()` och `find()` direkt, utan att behöva göra en "UserModel-klass" med specifika sql-frågor t.ex.

Jag borde ha en bättre struktur för att leta i olika databas-tabeller med "join sql-frågor". Jag har i alla fall skrivit en egen sql-fråga som jag stoppat in i ActiveRecordModel-klassen med funktionen `findAllWhere()`.



####Utveckla din syn på koden du nu har i ramverket och din kommentars- och användarkod. Hur känns det?####

Det finns många frågor och ställningstaganden. Jag har stoppat in, tagit bort och lagt tillbaka kolumner i databas-tabellerna.

Först skrev jag för mycket kod i vyerna och jag hade inga filter på mina kommentarsfält. 

När de relativa länkarna skulle ligga i modell-lagret fick samma princip användas som i navbaren.

Nu sparas textarea-inmatningen som markdown och jag skulle kunna lägga in fler saker där, som t.ex. taggar.

Om ett inlägg som har kommentarer slängs så slängs också kommentarerna. På samma sätt kanske man bör göra om en användare tas bort - att alla relaterade inlägg då tas bort. Alternativt att admin får meddelande om att "user" har lämnat och kan se över inläggen, innan de kastas.

Information på redigeringssidorna kan nog bli mer intuitiv. Jag gav admin tillgång till id på inläggs-första-sidan, för att lättare kunna slänga. Mer sådant finns att göra.

Jag gjorde snygga omdirigeringar som fungerade lokalt, men som gav felmeddelande på skolans server - headers already sent. Inte heller `addOutput` fungerar alltid rätt, utan skickas för sent - omdirigering tidigare borde då ske. Nu fungerar redirect, tror jag, men riktigt hundra koll på detta har jag ännu inte.

Att skriva snygg minimalistisk kod är ett ideal att sträva efter. Jag har mycket mer att lära där. Valideringen tycker ofta att jag har för stor komplexitet. Jag har tvättat så gott jag kunnat.



####Vad tror du om begreppet scaffolding, kan det vara något att kika mer på?####

Allt som sparar tid på lång sikt är ju väl använd tid nu. Jag tycker mycket om hur enkelt vi har kunnat tanka hem de nya webbplatserna allteftersom.

Ser fram emot att lära mer om detta.
