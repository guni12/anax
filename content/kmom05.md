---
title: "Kmom05"

region: "mainleft"

"stylesheets": ["css/style.css"]
...

###Kmom05###

####Hur gick arbetet med att lyfta ut koden ur me-sidan och placera i en egen modul?####

Det gick förvånansvärt bra att lyfta ut och stoppa tillbaka kommentarsmodulen. Det fungerar tom att byta namespace och låta den ligga under Anax.

När jag nu körde composer update fick jag tag i nya funktioner till Active Record och integrerade en av dem, i stället för min egen `findAllWhere` som fungerar en aning annorlunda.

(Jag vill passa på att nämna att jag lät en kodfil från kmom03 `Comments.php` ligga kvar till kmom04, bara för mitt eget minnes skull, fast den inte längre användes. Så ska man förstås inte göra, det blir otydligt i rättningen.)

####Flöt det på bra med GitHub och kopplingen till Packagist?####

Av någon anledning fungerade inte den automatiska uppdateringen från GitHub till Packagist först. Men nästa dag hade jag tydligen ett nytt token och kunde göra om. Och nu fungerar det.

Jag förstod inte hur jag skulle tänka först runt detta med anax. Vi jobbar ju i en annan utvecklares ramverk med en egen modul. Men det gick ju inte att publicera under anax, så då gjorde jag mitt eget space - guni12.

####Hur gick det att åter installera modulen i din me-sida med composer, kunde du följa din installationsmanual?####

Jag tycker att det gick bra med installationen. Men jag vet förstås hur jag själv har tänkt.

Eftersom mitt space, guni12, lade sig på egen plats under vendor, var jag orolig över konsekvenserna, men det blev nästan inga alls. Composer verkar lösa dessa saker.

####Hur väl lyckas du enhetstesta din modul och hur mycket kodtäckning fick du med?####

Enhetstesting är helt och hållet nytt för mig. Jag känner verkligen att jag borde haft mer förkunskaper.

Jag har försökt gå igenom lite av materialet för oophp-kursen, men det behövs mer tid och arbete här.

Jag fick till en mycket enkel test och några assertions. Mina tester som jag försökte göra fick väldigt många beroenden. Sökvägarna stämde inte heller, vilket de nog borde kunna göra. Jag blev osäker på hur mycket av di jag skulle mata in, helt enkelt. Till slut skulle ju hela anax kunna ligga i test och det var väl inte meningen tänker jag.

Jag hoppas på mer klarhet i nästa kursmoment.

####Några reflektioner över skillnaden med och utan modul?####

Jag tror att detta med tester och att erövra förståelse för dem kommer att göra att man skriver smartare moduler också.

Nu var det kul att det ändå fungerade att lyfta ut en definierad bit kod och stoppa in den igen.


