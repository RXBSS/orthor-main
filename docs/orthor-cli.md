# Orthor Steuerung via Node
 
🚨🚨 ACHTUNG - Seite ist nicht Up-to-Date 🚨🚨


In dieser Readme geht es um die Datei `orthor.js` mit deren Hilfe man diverse Funktionen der Testumgebung durchführen kann. Ansteuerung erfolt über die Kommandozeile mit `node orthor <bereich> <option> [<option>]`.

### Datenbank Funktionen (db)
<table>
<thead>
    <tr>
        <th>Befehl</th>
        <th>Beschreibung</th>
    </tr>
</thead>
<tbody>
<tr>
    <td>node orthor db option [option]</td>
    <td>Datenbank Funktionen</td>
</tr>
<tr>
    <td>create [dbOnly|structure|data|demoData]</td>
    <td>Erstellt die Datenbank. Je nach auswahl nur die Datenbank, Datenbank und Struktur, Datenbank, Struktur und essentielle Daten oder alles zusammen inklusive Demo Daten.</td>
</tr>
<tr>
    <td>delete</td>
    <td>Löscht die Datenbank vollständig</td>
</tr>
<tr>
    <td>reset</td>
    <td>Löscht und erstellt die Datenbank neu. Es können die gleichen Parameter wie bei create angegeben werden.</td>
</tr>
<tr>
    <td>update</td>
    <td><em>TODO</em></td>
</tr>
</tbody>
</table>

### Template Funktionen (template)
<table>
<thead>
    <tr>
        <th>Befehl</th>
        <th>Beschreibung</th>
    </tr>
</thead>
<tbody>
<tr>
    <td>node orthor template option</td>
    <td>Template Funktionen</td>
</tr>
<tr>
    <td>pickliste</td>
    <td><em>TODO</em>  Soll eine neue Pickliste mit allem notwendigen dazu erstellen</td>
</tr>
<tr>
    <td>page</td>
    <td><em>TODO</em>  Soll eine neue Seite erstellen</td>
</tr>
</tbody>
</table>
