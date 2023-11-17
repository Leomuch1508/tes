<?php
    session_start();
    require '../Admin/admin_config.php';
    require '../function/connection.php';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Periksa apakah login admin
        $admin_found = false;
        foreach ($admins as $admin) {
            if ($email === $admin['email'] && password_verify($password, $admin['passwordHash'])) {
                $admin_found = true;
                break;
            }
        }

        if ($admin_found) {
            $_SESSION['admin_login'] = true;
            $_SESSION['admin_email'] = $email;
            header('Location: ../Admin/admin.php');
            exit;
        }

        $result = mysqli_query($conn, "SELECT * FROM `user` WHERE `email` = '$email'");

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $last_email = $row['email'];
            $_SESSION["email"] = $last_email;
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['email'] = $row['email'];
                header('Location: ../User/dashboardUser.php');
                exit;
            }
        }

        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Limude's Ice Cream</title>
    <link rel="stylesheet" href="../css/form.css">
    <script src="https://kit.fontawesome.com/effd3867de.js" crossorigin="anonymous"></script>
    <script src="../javascript/pw.js"></script>
    <script src="../javascript/script.js"></script>
</head>
<body>
    <section class="form">
        <div class="form-box">
            <div class="form-title">
                <h1>Login</h1>
                <hr>
            </div>
            <form action="" method="post" class="form-container">
                <label for="email">Email</label>
                <div class="input-container">
                    <input type="email" name="email" placeholder="Email Address..." required class="input-field">
                </div><br>
                
                <label for="password">Password</label>
                <div class="input-container">
                    <input type="password" name="password" id="passwordInput1" placeholder="Password..." required class="input-field">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i id="passwordToggle1" class="fa fa-eye"></i>
                    </span>
                </div><br>

                <input type="submit" name="login" value="Login" class="submit-btn">
                <br>
                <br>
                <label for="register">Don't Have Any Account?</label>
                <a href="register.php">Sign Up


                
                </a>
            </form>
            <div class="login-with">
                <hr><br>
                <p>or</p>
                <div class="login-with-btn">
                    <button onclick="alert('TBA!')">
                        <img src="../gambar/google.svg" alt="">
                        <p>Login with Google</p>
                    </button>
                    <button onclick="alert('TBA!')">
                        <img src="../gambar/facebook.svg" alt="">
                        <p>Login with Facebook</p>
                    </button>
                </div>
            </div>
        </div>
    </section>
</body>
</html>