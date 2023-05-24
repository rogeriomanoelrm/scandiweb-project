
<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require './Conn2.php';
    require './User.php';

    $deleteUsers = new User();
    $deleted = 0;
    foreach ($_POST['delete'] as $id) {
        if ($deleteUsers->delete($id)) {
            $deleted++;
        }
    }

    
}

header('Location: index.php');
exit;


