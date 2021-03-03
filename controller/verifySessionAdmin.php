<?php

    $admin = $_SESSION['dados']['is_admin'];

    if($admin == 0){
        session_destroy();
        header("Location: ../index.php");
    }

?>