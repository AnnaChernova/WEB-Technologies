<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $email = $secondName = "";
$name_err = $email_err = $secondName_err = "";

// Processing form data when form is submitted
if (isset($_POST["UserId"])) {
    // Get hidden input value
    $UserId = $_POST["UserId"];

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
        $secondName_err = "Please enter the secondName.";
    } else {
        $secondName = $input_secondName;
    }

    // Validate email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email.";
    } else {
        $email = $input_email;
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($secondName_err) && empty($email_err)) {
        // Prepare an update statement
        $sql = "UPDATE hoteluser SET FirstName=?, SecondName=?, Email=? WHERE UserId=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi",$param_name,$param_secondName, $param_email, $param_id);

            // Set parameters
            $param_id = $UserId;
            $param_name = $name;
            $param_secondName = $secondName;
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
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
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["UserId"]) && !empty(trim($_GET["UserId"]))) {
        // Get URL parameter
        $UserId = trim($_GET["UserId"]);

        // Prepare a select statement
        $sql = "SELECT * FROM hoteluser WHERE UserId = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $UserId;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $name = $row["FirstName"];
                    $secondName = $row["SecondName"];
                    $email = $row["Email"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                <h2 class="mt-5">Обновить запись</h2>
                <p>Здесь можно изменить данные о пользователе.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                    <input type="hidden" name="UserId" value="<?php echo $UserId; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Сохранить изменения">
                    <a href="index.php" class="btn btn-secondary ml-2">Отменить изменения</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>