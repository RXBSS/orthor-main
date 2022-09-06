# Dokumentation
Beim Skripten ist es sehr wichtig, dass die Skripte ordentlich Dokumentiert sind.
Dazu nutzen wir in Orthor zwei verschiedene Librarys: 

- <a href="https://docs.phpdoc.org/" target="_blank">PHP Documentor 3</a> - Für die PHP API
- <a href="https://jsdoc.app/" target="_blank">JS Doc</a> - Für das JavaScript


### Installation
Für <strong>PHP Documentor</strong> muss auf dem PC das Tool hinterlegt werden. 
Es kann hier heruntergeladen werden: <a href="https://www.buerosystemhaus.de/data/downloads/phpdocumentor.zip">Download</a>
Den Entpackten Ordner kann man dann zum Beispiel unter `C:\phpdocumentor` hinterlegen.
ACHTUNG! Es dürfen keine Leerzeichen im Namen sein, sonst funktioniert es nicht.
Dann muss man nur noch den Pfad `C:\phpdocumentor\bin` in die Path-Variable einfügen.


Für <strong>JS Doc</strong>
... folgt noch


### Im Skript
Die Syntax der beiden ist ähnlich unterscheidet sich nur leicht, wie hier in den Beispielen gezeigt:


<strong>PHP Dokumentation</strong>
```php
<?php

/**
 * Das ist meine Test-Funktion 
 * Hier schreibe ich alles hin, was es wichtiges gibt zur Funktion
 * 
 * @param string $myArgument Eine *Beschreibung* des Arguments,
 *                           kann mehrere Zeilen betreffen.
 *
 * @return integer Gibt einen Integer Wert zurück 
 */
function test($myArgument) {

    // Do something
    return 0;
}

?>
```





