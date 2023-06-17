<?php
    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }

    function is_user_looged_in($status){
        if($status != 1){
            echo '<script> document.location.href = "./login.php" </script>';
        }
    }
?>