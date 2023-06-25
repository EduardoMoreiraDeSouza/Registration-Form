<?php

/* All Codes By https://github.com/EduardoMoreiraDeSouza */

require_once "../funcoes.php";

if (isset($_POST['create_database'])) {

    create_database();

    echo "<script>

        alert('Database Created Successfully!')
        window.location.href = './index.html'

    </script>";

} elseif (isset($_POST['drop_database'])) {

    drop_database();

    echo "<script>

        alert('Database Deleted Successfully!')
        window.location.href = './index.html'

    </script>";
    
}

/* All Codes By https://github.com/EduardoMoreiraDeSouza */

?>