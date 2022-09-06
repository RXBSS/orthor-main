<div class="version mt-auto">
    <small>
        <i class="fa-solid fa-code-branch"></i> Version
        <?php   
        

        if ($_SESSION['___settings']['system']['version']) {    

            echo $_SESSION['___settings']['system']['version'];

            // Orthor Version
            if(isset($_SESSION['___settings']['system']['version_orthor'])) {
                echo "<small> | <a target='_blank' href='https://github.com/BurosystemhausSchafer/orthor/blob/dev/Changelog.md'>".$_SESSION['___settings']['system']['version_orthor']."</a></small>";
            }   

        } else {
            echo "<a target='_blank' href='https://github.com/BurosystemhausSchafer/orthor/blob/dev/Changelog.md'>".$_SESSION['___settings']['system']['version_orthor']."</a>";
        }
        
        ?>
        <br><a href="https://www.buerosystemhaus.de" target="_blank"><i class="fa-solid fa-copyright"></i> Bürosystemhaus Schäfer</a>
    </small>
</div>