En remserver skapad av Mikael Roos
===========================================

Detta är en liten server-modell för BTH-kurserna i dbwebb. Den arbetar med ett REST API, frågar och svarar, lagrar och uppdaterar data. Allt just nu skött genom sessioner.

Det finns några filer/dataset att testa mot:

`api/users`
`api/reports`
`api/comments`

Du kan påverka dem med `api/[datasets]`.



Testa {#try}
-------------------------------------------

* [Alla users](api/users)
* [User med `id=1`](api/users/1)
* [Alla report](api/report)
* [Report med `id=3`](api/report/3)
* [Alla comments](api/comments)
* [Comment med `id=2`](api/comments/2)



API {#api}
-------------------------------------------

###Get datasetet {#all}

Get - hela datasetet, eller en del.

```text
GET /api/[dataset]
GET /api/users
GET /api/test
```

Resultat.

```json
{
    "data": [],
    "offset": 0,
    "limit": 25,
    "total": 0
}

{
    "data": [
        {
            "id": "1",
            "firstName": "Phuong",
            "lastName": "Allison"
        },
        ...
    ],
    "offset": 0,
    "limit": 25,
    "total": 12
}
```

Optionell  frågesträng med parametrar.

* `offset` default är 0.
* `limit` default är 25.

```text
GET /api/users?offset=0&limit=25
```



###Get - en post {#one}

Få fram en post med visst id.

```text
GET /api/users/7
```

Resultat.

```json
{
    "id": "7",
    "firstName": "Etha",
    "lastName": "Nolley"
}
```



###Lägg till en ny post {#create}

Lägg till en ny post till datasetet, skapa setet om det inte redan finns. Ett id kommer att läggas till.

```text
POST /api/[dataset]
{"some": "thing"}

POST /api/users
{"firstName": "Mikael", "lastName": "Roos"}
```

Results.

```json
{
    "some": "thing",
    "id": 1
}

{
    "firstName": "Mikael",
    "lastName": "Roos",
    "id": 13
}
```



###Uppdatera en post {#upsert}

Uppdatera en post. Skapa den om den inte finns.

```text
PUT /api/[dataset]/1
{"id": 1, "other": "thing"}

PUT /api/users/13
{"id": 13, "firstName": "MegaMic", "lastName": "Roos"}
```

Värdet för id-fältet har uppdaterats för att matcha PUT requesten.

Resultat.

```json
{
    "other": "thing",
    "id": 1
}

{
    "id": 13,
    "firstName": "MegaMic",
    "lastName": "Roos"
}
```



###Delete a entry {#delete}

Släng en post.

```text
DELETE /api/[dataset]/1

DELETE /api/users/13
```

Resultatet blir alltid `null`.



Andra REM servrar {#other}
-------------------------------------------

Det finns fler servrar att välja på.

* [REM REST API](http://rem-rest-api.herokuapp.com/)



Källa {#source}
-------------------------------------------

Källkoden finns på GitHub: [dbwebb-se/rem-server](https://github.com/dbwebb-se/rem-server).
