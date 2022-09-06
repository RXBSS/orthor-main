<?php include('01_init.php'); ?>
<!doctype html>

<!-- Head -->

<head>
  <title>Welcome to Orthor</title>
  <?php include('02_header.php'); ?>

  <style>
    .choose {
      text-align: center;
    }

    .choose a:hover i{
      color: #333;
    }

  </style>

</head>


<body>

  <div class="container">

    <br>
    <br>


    <center>
      <img src="https://i.ibb.co/r2prGcD/Hobbits.png" alt="Hobbits" border="0" width="200px" />
      <h3>'orthor' (besiegen, bezwingen)</h3>
      <p>Ein Framework, sie zu knechten, sie alle zu finden, ins Dunkel zu treiben und ewig zu binden</p>
    </center>


    <?php


    // Für jedes  
    foreach ($_navigation as $headlines => $headlineData) {
      if ($headlines != 'Multidimensional') {
        echo '
      <div class="card"><div class="card-body">
          <h3 class="mb-4" style="text-align: center;"><i class="' . $headlineData['icon'] . '"></i> ' . $headlines . '</h3>
          <div class="d-flex align-content-start flex-wrap choose">
          ';




        foreach ($headlineData['links'] as $value) {

   
          $i = 0;


          if (isset($value[1])) {
            echo '
              <div class="py-3" style="width: 10%;">
                <a href="' . $value[0] . '" >
                  <i class="' . $value[2] . ' fa-3x"></i><br>
                  ' . $value[1] . '
                </a>
              </div>';
          }
        }
      }

      echo '</div></div>
        </div><br>';
    }



    ?>





  </div>
</body>

<?php include('04_scripts.php'); ?>

</html>