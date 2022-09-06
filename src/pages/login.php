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
                                <h6>Hallo, bitte loggen Sie sich ein!</h6>
                            </div>
                        </div>
                        
                        <form id="login">    

                            <!-- E-Mail -->
                            <div class="form-group form-floating">
                                <input type="text" name="email" class="form-control editable" placeholder="E-Mail">
                                <label>E-Mail</label>
                            </div>

                            <!-- Passwort -->
                            <div class="form-group form-floating mb-3">
                                <input type="password" name="password" class="form-control editable" placeholder="Passwort">
                                <label>Passwort</label>
                            </div>

                            <!-- Angemeldet bleiben -->
                            <div class="mb-4">

                                <div class="form-check form-switch mb-1">
                                    <input class="form-check-input" type="checkbox" name="stay-logged-in" checked>
                                    <label class="form-check-label" for="stay-logged-in">Angemeldet bleiben</label>
                                </div>                                
                            </div>


                            <div class="row mb-4">
                                <div class="col d-grid"><button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-sign-in-alt"></i> Login</button></div>
                                <div class="col d-grid"><button id="reset-form-button" type="button" class="btn btn-secondary"><i class="fa-solid fa-undo"></i> Reset</button></div>
                            </div>    
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>   
                                    <a href="javascript:void(0);" class="btn-login-passwort-vergessen"><i class="fa-solid fa-key"></i> Passwort vergessen</a><br>
                                    <a href="registrieren" class="btn-login-registrieren"><i class="fa-solid fa-user-plus"></i> Jetzt registrieren</a> 
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



    <div style="position: fixed; bottom: 0%; left: 0px;background: red;padding: 5px;color: white;">Das Standard-Passwort ist <strong>password</strong></div>


    </div>


</body>

<?php include('04_scripts.php'); ?>

<script>

    var form = new Form('#login');

    // Felder die Validiert werden sollen
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
            }
        }
    }

    // Form Validation initalisieren
    form.initValidation(fields);

    // Form on Valid
    form.on('valid', function() {
        
        form.save('login','login-handle.php', function(data) {
            
            // Wenn der Login Erfolgreich war
            if(data.success) {

                // 
                app.alert.loader.fire();

                window.location.href = "index.php";

            } else {
                app.notify.error.fire("Fehler","Es gab einen Fehler beim einloggen!");
                $('input[name=password]').val('');
                form.reset(2);
            }
        });


    });

    
    // Login vergessen
    $('.btn-login-passwort-vergessen').on('click', function() {

        // E-Mail
        var email = $('input[name=email]').val();
        
        // Fire
        app.alert.question.fire({
            title: 'Passwort zurücksetzen',
            text: 'Bitte tragen Sie hier Ihre E-Mail Adresse ein. Wir setzen Ihr Passwort dann zurück und Sie erhalten es automatisch per E-Mail',
            input: 'email',
            inputPlaceholder: 'Ihre E-Mail Adresse',
            validationMessage: 'Die E-Mail Adresse ist ungültig',
            inputValue: email,
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

    $('#reset-form-button').on('click', function() {
        form.reset(1);
    });


</script>

</html>