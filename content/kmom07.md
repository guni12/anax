---
title: "Kmom07"

region: "mainleft"

"stylesheets": ["css/style.css"]
...

##Kmom07-10##

Kunden WGTOTW har önskat ett medlemsforum för Ny Smart Teknik och med El och IoT som huvudfokus. Forumet har fått namnet ”dELa” därför att man ska dela erfarenheter och målet är att medverka till att fördela den gemensamma samhällsresursen El på ett så smart sätt som möjligt.

#### Grunden – 1, 2, 3 ####

Medlems-sighten låter var och en läsa allt som är skrivet, men man måste registrera sig och logga in för att få kommentera och rösta. Den som är admin kan redigera, uppdatera och kasta allting. Den som enbart är medlem kan redigera eller ta bort sin egen profil. Genom att klicka på sin avatar uppe till höger kommer man åt att redigera sig själv. Om man inte är medlem ännu uppmanas man istället att bli det med hjälp av en pekande hand och en tooltip-text.

Jag lånade några epost-adresser som förekommit på gitter-chatten för att få mer trovärdiga medlemmar. Jag lånade också inlägg från hemautomationsgruppen på facebook.
Om man vill logga in som admin använder man `guni/guni`. För att logga in med Mikael Roos avatar använder man `Nestor/Nestor`.

Förstasidan presenterar de fem senaste frågorna och de fem mest aktiva medlemmarna. I nuläget finns fyra taggar att välja på vilka visas i turordning och anger hur ofta de använts. Enbart frågorna kan taggas. Frågor, medlemmar och taggar är klickbara. Medlemmarnas antal inlägg visas. På små skärmar göms två kolumner.

Fråge-sidan visar alla frågor och med den senaste överst. Avatar, publiceringsdatum och antal eventuella svar eller kommentarer kan man se. Om man är admin får man också info om id-nummer och en länk till att kasta, vilket ska underlätta moderering. Admin kastar via en droplista med alla inlägg, medan medlemmar bara kan kasta sitt eget inlägg.

När man klickar på en fråga kommer man till en sida med eventuella svar och kommentarer. Se mera under övriga krav.

Den generella taggsidan ska beskriva mer om varje ämne, men WGTOTW ska återkomma med den texten. Härifrån kan man klicka på varje tagg som visar en tabell med de frågor som ställts och de svar och kommentarer som frågan fått. Röd färg betyder fråga, blå färg svar och grön färg kommentar. Man ser vem som ställt frågan och inläggen är klickbara.

Medlemssidan visar avatarerna i lite större format och på varje medlems sida kan man se alla inlägg denne gjort, till vilka taggar, frågor eller svar inläggen är kopplade och vilket rykte hen har.

Om man är admin får man mer info på medlemssidan och kan därifrån redigera alla medlemmarna.
På about-sidan står en enkel beskrivning om webbplatsen, poängräkningen och en länk till github.

#### Krav 4 ####

Den som skrivit en fråga kan också acceptera ett svar. När man gjort detta val är det sedan "kört". Jag har inte gjort det möjligt att ändra sig i detta skede. Man accepterar genom att klicka på en röd smiley. En tooltip berättar om svaret har accepterats. På samma sätt kan man klicka på en gul tumme upp eller ner för att rösta. När man röstat blir tummarna grå för man kan bara rösta en gång per inlägg. Man kan inte heller rösta på sitt eget inlägg. Tooltip berättar mer när man hovrar.

Svaren kan sorteras enligt datum eller rank genom att klicka på en länk. Rank syns på svarssidan, på den unika medlemssidan och om en fråga fått poäng så syns det på fråge-sidan.

#### Krav 5 ####

Mitt poängsystem fungerar som följer:

Ställa fråga - 3p, Svara på fråga - 4p, Om svaret accepteras - ytterligare 4p samt Kommentera - 1p. Medlemmar kan rösta - plus eller minus 1 poäng - på frågor, svar och kommentarer. Det går bara att rösta en gång per inlägg. Detta värde (plus 0.5 poäng) multipliceras med poängen ovan.

På den personliga medlemssidan ser man all aktivitet, de röster man fått och gett, det rykte man har (ovan summa), vilka inlägg man gjort av varje slag och hur många.

#### Krav 6 ####

Det valfria kravet innehåller lite av varje.

__Utseende:__ Då jag jobbade mycket med less i designkursen för en månad sedan valde jag nu att använda bootstrap. Jag har försökt göra sidan intuitiv med hjälp av färger som betyder olika saker och genom att hålla sidan ren. Ljusblå färg är baslänkar, röd färg är frågor, blå färg svar och grön färg kommentarer. Font awesome-ikoner visar tumme upp, tumme ner och accepterad fråga. Login i högra övre hörnet har också fått ikoner. Tooltip-texter bidrar med information. Sidan är förstås responsiv.

__Editor:__ Jag undersökte om det kunde finnas en editor för markdown (medlemmarna i dELa är inte främst programmerare, men kanske vill kunna styla sin text en aning). Det fanns ett bra tips på [stackoverflow]( https://stackoverflow.com/questions/13013315/how-to-use-pagedown-markdown-editor), men det krävde att jag stoppade in `Form.php` i min `src`-katalog. Denna editor är kanske inte helt pålitlig för produktion, men den har fungerat för mig helt utan problem.

__Form:__ Med `Form.php` i mitt namespace ökade mängden kod remarkabelt och jag fick mycket klagomål från scrutinizer bl.a. Därför gjorde jag ett försök med att refaktorera filen och det blev ett bra resultat till slut. Plus att jag lärde mig mycket om beroenden och samband i koden. Istället för en fil är det nu tre filer, `Form.php, FormHelper.php och FormHelper2.php`. Formulärhanteringen är ju väldigt stor och det blir lätt komplext. Det verkar som att man ska plocka ut allt som är möjligt till nya små funktioner. Det som krävde sin man/kvinna var att minnas om `this` och om `session` fortfarande hade tillgång till den flyttade koden. Men till slut är det inga "issues" kvar. Och jag hoppas inga missade buggar heller. Jag har försökt hitta det mesta.

__Testning__: Testning ingick inte nu utan i kmom06. Jag gjorde dock ett tappert försök här och fick ihop 18% täckning. Inte mycket att skryta med. Jag har inte knäckt koden ännu, hur man mockar di-beroenden inne i mina funktioner. Men jag har kämpat på och lärt mig lite om att stoppa in ett objekt i varje av mina två databastabeller. Dessa objekt kunde jag sedan referera till något. Lokalt är det också lättare att skapa `assertEquals` eftersom jag har korrekt adress att jämföra med. Ett stort antal sådana fick jag ta bort för att bli godkänd av travis/scrutinizer.

Jag försökte också stoppa in dbunit in i build med hjälp av Makefilen, med `.phpunit.xml` och med `.dbunit.xml`. Jag fick ge upp denna gång och får ta tag i det igen senare.

#### Allmänt ####

Jag har kämpat en del med denna inlämning. Själva koden, rösträkning etc. var inte så svårt, men hjälpmedlen har krånglat lite för mig. Cygwin vill inte förstå de binära filerna så alla nedladdade verktyg via Makefilen fungerar inte. En del ledtrådar (att skriva bättre) får jag från min editor, Sublime Text, men inte tillräckligt.

Jag har inte heller lärt mig skriva `yml`-filerna helt rätt tror jag. Nu fick jag ju en viss kod-täckning, men kontroll på sökvägarna lokalt och på testplatsen..., detta måste gå att göras bättre. Det finns alltid mer att lära...

`phpunit` och `coverage.clover` har i alla fall fungerat och jag har kunnat se hur testningen har utvecklats. Men - jag har publicerat till github alltför många gånger för att få svaren från scrutinizer. En superbra hjälp är det dock.

Jag har fått problem med dbwebb också. Det går inte att publicera med `dbwebb publish` längre. Den säger att jag har för mycket kod trots att jag verkligen slängt nästan allting överflödigt. Så det kan inte vara orsaken. Nu går det ju tack och lov att skicka med Filezilla. Jag hoppas få tid i sommar att helt avinstallera cygwin och börja om från början.

#### Betyg ####

Som vanligt är det jättekul att göra kurserna på dbwebb, så också denna gång. Det har ingått väldigt många bra begrepp som man fått suga på och som man kanske kan börja inlemma i sitt eget tänk så småningom. Det har också börjat ställas krav på egna beslut, "hur vill du göra", "varför"...

För att helt erövra allt krävs mer tid för mig, mer tid att skriva och testa saker. Men så länge dbwebb finns kvar går det ju ypperligt att gå tillbaka och hitta svar på sina frågor. Det är guld värt. Chatten har också betytt mycket för mig, även om jag inte varit i fas med de andra. Jättebra frågeställningar och svar har framkommit där.

Och lärarkåren är aktiv, superkunnig och trevlig. Jag är full av beundran och mycket nöjd. Brukar ge det höga betyget 8, men varför inte 10. Det är egentligen så jag brukar skryta om er.
