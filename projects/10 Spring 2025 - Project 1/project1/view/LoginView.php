<?php
    session_name('login');
    session_start();

    // Grabbing Controllers
    require_once '../controller/BugController.php';
    require_once '../controller/StaffController.php';

    //CONNECTION TO THE DATABASE
    $staffDB = new StaffController();
    $bugDB = new BugController();

    $validUsers = $staffDB->getValidUsernames();
    $usernames = array_column($validUsers, 'Username');

    //Sanitizing
    function validate($input) {
        $input = trim($input);
        $input = strip_tags($input);
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }

    //Validation
    function validatePassword($username, $password) {
        global $staffDB;
        global $usernames;
        if (in_array($username, $usernames)){
            $hashedPassword = $staffDB->getValidPasswords($username);
            if (password_verify($password, $hashedPassword)) {
                return True;
            }
        }
        return False;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = validate($_POST['username'] ?? '');
        $password = validate($_POST['password'] ?? '');

        if (validatePassword($username, $password)) {
            $_SESSION['user'] = $username;
            $roleId = $staffDB->getRoleId($username);

            switch ($roleId) {
                case 1:
                    header("Location: AdminView.php?username=$username");
                    exit();
                case 2:
                    header("Location: ManagerView.php?username=$username");
                    exit();
                case 3:
                    header("Location: UserView.php?username=$username");
                    exit();
            }   
        } else {
            echo "<script>alert('Invalid username or password')</script>";
        }
    }

    //If returning from admin page, manager page, or user page using logout
    //Unset and destroy session
    if(isset($_SESSION)) {
        session_unset();
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bug Tracker Application Login Page</title>
    </head>
    <body>
        <h1>Bug Tracker Application Login Page</h1>
        <form action="LoginView.php" method="post">
            <label for="username">Username: </label>
            <input type="text" name="username" placeholder="Username"><br />
            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Password"><br />
            <input type="submit" value="Login">
        </form>
    </body>
</html>