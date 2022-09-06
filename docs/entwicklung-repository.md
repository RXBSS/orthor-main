# Repositorys hinzufügen
Sofern man die [Entwicklungsumgebung](entwicklung-umgebung.md) hergestellt hat, muss man für jedes Repository eine eigenen Umgebung schaffen. 

### Subdomain hinzufügen
Jedes Repository sollte in einer eigenen Subdomain laufen. 
Dabei sollte dies immer `<repository>.localhost` sein.

Dies hat folgende Vorteile:

- Eigene Session für jedes Repository
- Root Verzeichnis kann fest vorgegeben werden

Folgende Schritte sind dafür notwendig:

#### Anpassung an der host-Datei
Damit die Namensauflösung ordentlich funktioniert muss dies in die Host-Datei des PCs auf dem man entwicklert eingetragen werden. 
Dazu geht man wie folgt vor: 

1. Öffnen des Verzeichnis `C:\Windows\System32\drivers\etc`
2. Dort öffnen man die Datei `hosts` als Administrator
3. Dort fügt man die Zeile `127.0.0.1  <repository>.localhost` wobei man `<repository>` durch das gewünschte ersetzt. 

```
# Beispiel
127.0.0.1           orthor.localhost
127.0.0.1           aule.localhost
...
```

#### Subdomain in Apache hinterlegen
Damit Apache die Subdomain ebenfalls kennt muss man noch folgende Einstellungen vornehmen.

1. Apache Dienst stoppen.
2. Datei `C:\xampp\apache\conf\extra\httpd-vhosts.conf` öffnen.
3. Hier fügt man dann einen virtuellen Host hinzufügen.
4. Im Beispiel unten das ganze für orthor. Orthor entspricht dem Namen des Repositorys. Das Dokument Root sollte in der Regel der dist-Ordner sein. Bei Orthor ist es standardmäßig der Test-Ordner.

```
# Orthor
<VirtualHost *:80>
  DocumentRoot "C:/xampp/htdocs/orthor/test"
  ServerName orthor.localhost
  ServerAlias orthor.localhost
  ErrorLog "logs/orthor-error.log"
  CustomLog "logs/orthor-access.log" common
</VirtualHost>
```

5. Speichern und Apache Dienst wieder starten
