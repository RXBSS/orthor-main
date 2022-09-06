# NPM - Befehle
Hier stehen einige Befehle zum arbeiten in der Entwicklungsumgebung mit NPM.

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Inhalt</summary>
  <ol>
    <li>
      <a href="#version-überprüfen">Npm Version</a>
    </li> 
      <li>
      <a href="#packages-auflisten">Packages auflisten</a>
    </li> 
     <li>
      <a href="#package-beschreibung">Package Beschreibung</a>
    </li> 
     <li>
      <a href="#package-installieren">Abhängigkeiten installieren</a>
    </li> 
    <li>
      <a href="#entwicklungsabhängigkeiten">Entwicklung Abhängigkeiten installieren</a>
       <li>
      <a href="#shrinkwrap">Shrinkwrap</a>
    </li>
    <li>
      <a href="#veraltete-packages" >Veraltete Packages</a>
    </li>
    <li>
      <a href="#update" >Update</a>
    </li>  
  </ol>
</details>

<br>
<br>
<br>

#### Version überprüfen
Es sollte immer die aktuellste Version installiert sein. Die Version prüft man mit:

```sh
npm --version
```

#### Packages auflisten
Die installierten Packages anzeigen lassen. ``` --prod```, ``` --dev``` oder ```--global``` um Umgebungspackages auszuwählen.
``` --depth=0``` hinzufügen um Packages Abhängigkeiten.

```sh
npm list --dev --depth=0
```

#### Package Beschreibung

CLI Einleitung eines bestimmten Packages:

```sh
npm help test
```


#### Package Installieren
Installieren eines NPM Package

```sh
# Die empfohlne Version installieren
npm install <my-package>

# Eine bestimmte Version installieren
npm install <my-package>@1.2.3

# Immer die aktuellste Version installieren
npm install <my-package>@latest
```

<br>

#### Entwicklungsabhängigkeiten

Um Module als devDependency zu installieren:

```sh
npm install <package> --save-dev
```

Achtung: Mit dem `--production`  Flag (oder wenn die NODE_ENV Umgebungsvariable auf production gesetzt ist), wird npm keine Module installieren, die in devDependencies aufgelistet sind. 
<br>
<br>
#### Shrinkwrap
Genauen Versionen der Abhängigkeiten festlegen.

Es generiert eine aus dem package-lock.json ein npm-shrinkwrap.json, die nicht nur die genauen Versionen der auf Ihrem Rechner installierten Module enthält, sondern auch die Version ihrer Abhängigkeiten und so weiter. Damit wird `npm install` sie verwenden, um denselben Abhängigkeitsbaum zu reproduzieren.

Die Nutzung von shrinkwrapped Packages ist nicht anders als andere Packages. Mann kann manuell ```npm install```  ausführen oder eine Abhängigkeit in package.json hinzufügen. 

```sh
npm shrinkwrap
```
<br>

#### Veraltete Packages

Veraltete Versionen von Packages ausgeben lassen:

```sh
npm outdated
```

#### Update

Um NPM-Modules abzudaten oder neu zu installieren

```sh
npm install
```

oder 

```sh
npm  update
```

