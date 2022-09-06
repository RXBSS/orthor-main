<?php session_start();

// if (is_file('./config.json')) {
//     echo "Mit Config Datei fortfahren!";
// } else {
//     echo "Neue Konfig Datei erstellen!";
// }










?>
<!doctype html>
<html lang="de">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS muss dann noch Stand Alone eingefügt werden! -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 ">Installation</span>
            </div>
        </nav>

        <div class="mt-3">
            <p>
                Es konnte keine Konfigurationsdatei gefunden werden oder die Konfigurationsdatei ist beschädigt!<br>
                Füllen Sie das folgende Formular aus und drücken Sie anschließend auf Konfiguration erstellen
            </p>






            <form>

                <h3>Datenbank</h3>


                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="db-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="db-name" placeholder="orthor">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="db-url" class="form-label">URL</label>
                        <input type="text" class="form-control" id="db-url" placeholder="localhost">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="db-user" class="form-label">User</label>
                        <input type="text" class="form-control" id="db-user" placeholder="root">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="db-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="db-password" placeholder="">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="db-name" class="form-label">Salt</label>
                        <input type="text" class="form-control" id="db-name" placeholder="">
                    </div>
                </div>


                <hr>

                <h3>E-Mail</h3>


                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="db-name" class="form-label">Server</label>
                        <input type="text" class="form-control" id="email-server" placeholder="mail.firma.de">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="db-url" class="form-label">Port</label>
                        <input type="text" class="form-control" id="email-port" placeholder="587">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="email-user" class="form-label">User</label>
                        <input type="text" class="form-control" id="email-user" placeholder="">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="email-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="email-password" placeholder="">
                    </div>

                   
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="email-sender-name" class="form-label">Sender Name</label>
                        <input type="text" class="form-control" id="email-sender-name" placeholder="Firmenname">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email-sender-email" class="form-label">Sender E-Mail</label>
                        <input type="email" class="form-control" id="email-sender-email" placeholder="sender@firma.de">
                    </div>                   
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="email-sender-name" class="form-label">Antwort Name</label>
                        <input type="text" class="form-control" id="email-sender-name" placeholder="Firmenname">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email-sender-email" class="form-label">Antwort E-Mail</label>
                        <input type="email" class="form-control" id="email-sender-email" placeholder="reply@firma.de">
                    </div>                   
                </div>

                <hr>

                
               


                <button type="submit" class="btn btn-primary">Konfiguration Erstellen</button>
            </form>

        </div>



    </div>






    <!-- JavaScript muss dann noch Stand Alone eingetragen weredn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>