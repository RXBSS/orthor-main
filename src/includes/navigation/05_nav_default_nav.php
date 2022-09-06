<?php

$i = 1;

if(isset($_navigation)) {

    // Für jedes  
    foreach ($_navigation as $headlines => $headlineData) {

        echo '
        <li class="mb-2">
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#navigation-id-' . $i . '">
                <i class="' . $headlineData['icon'] . '"></i> ' . $headlines . '
            </button>
            <div class="collapse" id="navigation-id-' . $i . '">
                <ul class="btn-toggle-nav list-unstyled">';
                
                $j = 0;

                // Nächste foreach Schleife
                foreach ($headlineData['links'] AS $key => $value) {
                    

                    // Prüfen ob es eine weitere Ebene gibt
                    if(isset($value['links'])) {
            
                       
                        echo '<li>
                            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#navigation-id-' . $i . '-'.$j.'">
                                ' . $key . '
                            </button>
                            <div class="collapse" id="navigation-id-' . $i . '-'.$j.'">
                                <ul class="btn-toggle-nav list-unstyled">';
    
                                    foreach($value['links'] AS $submenu) {
                                        echo ' <li><a href="' . $submenu[0] . '" target="'.((isset($submenu[3])) ? $submenu[3] : '_self').'">' . $submenu[1] . '</a></li>';
                                        
                                    }

                            echo '
                                    </ul>
                                </div>
                            </li>';
                        
                       

                    } else {
                        echo ' <li><a href="' . $value[0] . '" target="'.((isset($value[3])) ? $value[3] : '_self').'">' . $value[1] . '</a></li>';
                    }

                    $j++;
                }

        echo '
                </ul>
            </div>
        </li>';

        $i++;
    }
}

?>