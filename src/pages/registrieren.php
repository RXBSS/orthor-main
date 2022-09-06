<?php include('01_init.php');

$_page = [
    'title' => 'Login'
];
?>

<!doctype html>
<html lang="de">

<head>

    <?php include('02_header.php'); ?>
</head>

<body>

    <div class="container">
        <br><br><br>

        <div class="row justify-content-center">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-body">

                        <!-- Login Block -->
                        <div class="card card-primary bg-primary text-white text-center login__block__header">
                            <div class="card-body">
                                <i class="fa-solid fa-user-circle fa-3x mb-1"></i>
                                <h6>Hallo, bitte registrieren Sie sich!</h6>
                            </div>
                        </div>

                        <form id="registration-form">

                            <!-- E-Mail -->
                            <div class="form-group form-floating">
                                <input type="text" name="email" class="form-control editable" placeholder="E-Mail">
                                <label>E-Mail</label>
                            </div>

                            <!-- Vorname -->
                            <div class="form-group form-floating">
                                <input type="text" name="vorname" class="form-control editable" placeholder="Vorname">
                                <label>Vorname</label>
                            </div>

                            <!-- Nachname -->
                            <div class="form-group form-floating">
                                <input type="text" name="nachname" class="form-control editable" placeholder="Nachname">
                                <label>Nachname</label>
                            </div>

                            <!-- Passwort -->
                            <div class="form-group form-floating">
                                <input type="password" name="password" class="form-control editable" placeholder="Passwort">
                                <label>Passwort</label>
                            </div>

                            <!-- Passwort bestätigen -->
                            <div class="form-group form-floating mb-3">
                                <input type="password" name="password-confirm" class="form-control editable" placeholder="Passwort wiederholen">
                                <label>Passwort wiederholen</label>
                            </div>


                            <div class="row mb-4">
                                <div class="col d-grid"><button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-sign-in-alt"></i> Registrieren</button></div>
                                <div class="col d-grid"><button type="button" class="btn btn-secondary"><i class="fa-solid fa-undo"></i> Reset</button></div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="login.php" class="btn-login-registrieren"><i class="fa-solid fa-user-plus"></i> zum Login</a>
                                </div>
                                <div class="text-end">
                                    <a href="javascript:void(0);" class="btn-login-hilfe"><i class="fa-solid fa-question"></i> Hilfe</a><br><span class="text-muted">Version 1.0</span>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>



    </div>


</body>

<?php include('04_scripts.php'); ?>

<script>
    var form = new Form('#registration-form', true);

    var fields = {
        email: {
            validators: {
                notEmpty: {
                    message: 'Das Feld darf nicht leer sein'
                },
                emailAddress: {
                    message: 'Es muss eine valide E-mail Adresse sein'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'das Feld darf nicht leer sein'
                }

                // TODO: eigententlich eher Registrierung?
                // TODO: Mindestens 8 Zeichen
                // TODO: Mindestens Sondernzeichen, Zahl

            }
        }

    }


    form.initValidation(fields);

    form.on('valid', function() {
        console.log('on valid');
        //form.save('login','../src/handle/user-handle.php');
    });

    $('.btn-login-registrieren').on('click', function() {

        // Fire
        app.alert.error.fire({
            title: 'Registrieren nicht möglich!',
            html: 'Es ist leider nicht möglich, dass Sie sich registrieren. Bitte wenden Sie sich an Ihren Administrator!'
        });
    });

    // Login Hilfe
    $('.btn-login-hilfe').on('click', function() {

        // Fire
        app.alert.info.fire({
            title: 'Informationen zum Login',
            html: 'Hier kommen die Infos zum Login'
        });


    });
</script>

</html>