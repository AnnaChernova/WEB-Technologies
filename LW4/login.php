<?php
session_start();

session_unset();

include "config.php";
echo 'started';
if (isset($_POST['uname']) && isset($_POST['password'])) {
    echo 'in IF';
    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }
    echo 'validation';
    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    echo 'ended';
    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{
        echo 'sql';
        $sql = "SELECT * FROM hoteluser WHERE Login='$uname' AND Password='$pass'";

        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['Login'] === $uname && $row['Password'] === $pass) {

                echo "Logged in!";

                $_SESSION['user_name'] = $row['Login'];

                $_SESSION['name'] = $row['Login'];

                $_SESSION['id'] = $row['UserId'];

                echo 'sdlkjas;ldkjad';
                header("Location: index.php");

                exit();
            }else{
                echo 'sdlkjas;ldkjad';
                header("Location: index.php");
            }

        }else{
            echo 'bo user';
            header("Location: index.php");
            exit();

        }

    }

}else{
    echo 'IN ESLE';
    header("Location: index.php");


}