### Quality of Code
In dieser Dokumentation sind ein paar Beispiele vermerkt, an welche Formatierungen, Syntax und Schreibweisen man sich halten soll. 
Außerdem sind ebenfalls Best-Pratice für verschiedene Dinge beschrieben.

<span style="color: red;">Dokument ist noch nicht vollständig</span>

<hr>

##### HTML
- Alle Attribute bitte immer mit Double Quotes angeben:<br>
`<input type="text" name="fieldname">`<br>
~~`<input type="text" name='fieldname'>`~~<br>

- Namen und Ids von Input Feldern bitte immer Lowercase und mit _ getrennt schreiben<br>
`<input type="text" id="my_id" name="some_fieldname">`<br>
~~`<input type="text" id="MyId" name="SomeFieldname">`~~<br>
~~`<input type="text" id="My-Id" name="Some-Fieldname">`~~<br>

<hr>

##### JS

<strong>Arbeiten mit großen Dateien</strong><br>
Auf den Detail-Seiten kann es schnell mal vorkommen, dass man mit großen JavaScript-Dateien umgehen muss. 
Man kann sich diese Dateien übersichtlicher gestalten, wenn man wie folgt vorgeht:

Dateistruktur
```
seite-details.php
seite-details.js
seite-details-teila.js
seite-details-teilb.js
seite-details-tailc.js
```

Auf jeder Seite legt man ein Objekt an

seite-details.js
```JS
var seite = {
    init: () {
        var me = this;
        me.initTeilA();
        me.initTeilB();
        ...
    },

    ...
}
```

seite-details-a.js (und b,c)
```JS
var seiteTeilA = {
    initTeilA: () {
        var me = this;
        ...
    },

    ...
}
```

Wichtig ist, dass man keine Funktionen doppelt benennt, da sich diese sonst überschreiben würden.

Auf der seite-details.php bettet man nun zunächst die Skripte ein, die nicht automatisch eingebettet werden.
Das Skript `seite-detail.js` wird ja automatisch eingebettet.
```HTML
<script src="js/pagelevel/seite-details-teila.js"></script>
<script src="js/pagelevel/seite-details-teilb.js"></script>
<script src="js/pagelevel/seite-details-teilc.js"></script>
```

Nun führt man die Objekte zusammen.
Dazu nutzt man Objekt Assign.

```JS
seite = Object.assign(seite, seiteTeilA);
seite = Object.assign(seite, seiteTeilB);
seite = Object.assign(seite, seiteTeilC);
```

Schon ist es so, als hätte man ein großes Objekt. 
Man kann jetzt in jeder Funktion über `this` auf alle anderen Funktionen der Datei zugreifen.



<hr>

##### PHP
<em>Weiter Angaben folgen</em>

##### SQL
- Tabellen und Feldnamen bitte immer in \` einbetten: <br>
<code>SELECT \`field\` FROM \`table\` WHERE \`id\` = '1';</code> <br>
~~<code>SELECT field FROM table WHERE id = '1';</code>~~ <br>

- SQL Befehle grundsätzlich groß schreiben: <br>
<code>SELECT \`field\` FROM \`table\` WHERE \`id\` = '1';</code> <br>
~~<code>select \`field\` from \`table\` where \`id\` = '1';</code>~~ <br>

- Benennung von Datenbanken und Tabellen
- - Immer lowercase
- - Grundsätzlich keine Bindestriche oder sonstige Sonderzeichen wie !?äöü usw. (außer unterstrich)
- - Die Tabellen und Felder werden grundsätzlich deutsch benannt
- - Tabellen aus Orthor (Standard-Tabellen) haben immer den Prefix Unterstich (z.B. _laender)
- - Das erste Feld heißt immer ID (außer ist eine Tabelle ohne Primärschlüssel)
- - Wird ein Feld in mehreren Tabellen verwendet, dann ist darauf zu achten, dass die Namen identisch sind
```
Tabelle A - Kunden
id | name | strasse | plz | ort | ...

Tabelle B - Aufträge
id | kunden_id | ...
```