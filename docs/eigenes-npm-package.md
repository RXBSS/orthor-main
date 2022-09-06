  <h3 align="center">Erstellen und hochladen eines eigenen NPMs</h3>

  <p align="center">
    Docs für Npm Befehle
</p>

<br>

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Inhalt</summary>
  <ol>
    <li>
      <a href="#initialisieren">Initialisieren</a>
    </li> 
    <li>
      <a href="#veröffentlichung">Veröffentlichung</a>
    </li> 
     <li>
      <a href="#testen">Testen</a>
    </li> 
    <li>
      <a href="#update-version">Update Version</a>
    </li>
  </ol>
</details>

<br>
<br>
<br>

## Initialisieren
Einen Ordner anlegen. In diesen hinein navigieren und NPM Initialisieren

```sh
npm init

```

Zunächst muss ein Account auf NPM erstellt werden: https://www.npmjs.com/signup

**Email Verifzieren!** 

Dein Account muss über die command line autorisiert werden. Es kann auch geteste werden ob man angemeldet ist
```sh
npm login

```
```sh
npm whoami

```
<br>
<br>

## Veröffentlichung

Mit einem Befehl wird das Package dann auf NPM hochgeladen
```sh
npm publish

```



<br>
<br>

## Testen
Einen neuen Ordner erstellen, dort hinein navigieren und das Module runterladen
```sh
npm install random_filename --save
```

oder 

```sh
npm i random_filename
```

<br>
<br>

## Update Version
**Die Version muss geändert werden.**<br>
**Die Version muss höher sein als die vorhandene. Aktuelle Version 1.0.3 dann muss die nächste z.B. 1.0.4 sein!**<br>
Die Version kann händisch umgeändert werden in den Dateien: `package.json` und `package-lock.json`
<br>
oder
<br>
Per Command Line auf der Konsole
```sh
npm version x.x.x
```

Version muss wieder veröffentlicht werden
```sh
npm publish
```

