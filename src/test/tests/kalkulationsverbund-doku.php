<?php include('01_init.php');

$_page = [
    'title' => "Kalkulationsverbund Doku"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Die Rollen</h4>


                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Rolle</th>
                                        <th>Vorrausetzung</th>
                                        <th>Beschreibung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>menge</th>
                                        <td></td>
                                        <td>Die Menge</td>
                                    </tr>
                                    <tr>
                                        <th>ek</th>
                                        <td></td>
                                        <td>Der Einkaufspreis</td>
                                    </tr>
                                    <tr>
                                        <th>ek_gesamt</th>
                                        <td>ek</td>
                                        <td>Der Einkaufspreis als Summe</td>
                                    </tr>
                                    <tr>
                                        <th>vk</th>
                                        <td></td>
                                        <td>Verkaufspreis</td>
                                    </tr>
                                    <tr>
                                        <th>vk_inkl_rabatt</th>
                                        <td>vk, rabatt</td>
                                        <td>Verkaufspreis inklusive Rabatt</td>
                                    </tr>
                                    <tr>
                                        <th>rabatt_aktiv</th>
                                        <td></td>
                                        <td>Gibt an ob der Rabatt aktiv sein muss</td>
                                    </tr>
                                    <tr>
                                        <th>rabatt_prozent</th>
                                        <td></td>
                                        <td>Der Rabatt in Prozent</td>
                                    </tr>
                                    <tr>
                                        <th>rabatt_wert</th>
                                        <td></td>
                                        <td>Der Wert des Rabatts</td>
                                    </tr>
                                    <tr>
                                        <th>netto_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>netto_inkl_rabatt_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>rabatt_wert_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>steuer_satz</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>steuer_wert</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>steuer_wert_inkl_rabatt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>steuer_wert_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>steuer_wert_inkl_rabatt_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>brutto</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>brutto_inkl_rabatt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>brutto_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>brutto_inkl_rabatt_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>marge</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>marge_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>marge_prozent</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>marge_wert_inkl_rabatt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <th>marge_inkl_rabatt_gesamt</th>
                                        <td></td>
                                        <td>x</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        // Do Something
    });
</script>

</html>