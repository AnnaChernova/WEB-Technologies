<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $secondName = $email = $userType = $phone = $login = $password = "";
$name_err = $secondName_err = $email_err = $userType_err = $phone_err = $login_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    // Validate secondName
    $input_secondName = trim($_POST["secondName"]);
    if (empty($input_secondName)) {
        $secondName_err = "Please enter the second name.";
    } else {
        $secondName = $input_secondName;
    }

    // Validate address
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter an email.";
    } else {
        $email = $input_email;
    }

    // Validate user type
    $input_usertype = trim($_POST["userType"]);
    if (empty($input_usertype)) {
        $userType_err = "Please enter a user type.";
    } else {
        $userType = $input_usertype;
    }

    // Validate phone
    $input_phone = trim($_POST["phone"]);
    if (empty($input_phone)) {
        $phone_err = "Please enter a phone.";
    } else {
        $phone = $input_phone;
    }

    // Validate login
    $input_login = trim($_POST["login"]);
    if (empty($input_login)) {
        $login_err = "Please enter a login.";
    } else {
        $login = $input_login;
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Please enter a password.";
    } else {
        $password = $input_password;
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($secondName_err) && empty($email_err)
        && empty($userType_err) && empty($phone_err) && empty($login_err) && empty($password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO hoteluser (FirstName, SecondName, Email, UserType, Phone, Login, Password) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_secondName, $param_email,
                $param_userType, $phone, $param_login, $param_password);

            // Set parameters
            $param_name = $name;
            $param_secondName = $secondName;
            $param_email = $email;
            $param_userType = $userType;
            $param_phone = $phone;
            $param_login = $login;
            $param_password = $password;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo 'Вставилось';
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Создание нового пользователя</h2>
                <p>Пожалуйста, заполните форму</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" name="name"
                               class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $name; ?>">
                        <span class="invalid-feedback"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Фамилия</label>
                        <input type="text" name="secondName"
                               class="form-control <?php echo (!empty($secondName_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $secondName; ?>">
                        <span class="invalid-feedback"><?php echo $secondName_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Электронная почта</label>
                        <input type="text" name="email"
                               class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" name="phone"
                               class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $phone; ?>">
                        <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Тип</label>
                        <input type="text" name="userType"
                               class="form-control <?php echo (!empty($userType_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $userType; ?>">
                        <span class="invalid-feedback"><?php echo $userType_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Логин</label>
                        <input type="text" name="login"
                               class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $login; ?>">
                        <span class="invalid-feedback"><?php echo $login_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="text" name="password"
                               class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Создать">
                    <a href="index.php" class="btn btn-secondary ml-2">Отменить</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
