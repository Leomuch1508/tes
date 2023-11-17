<?php
    require '../function/connection.php';

    if(isset($_POST['Register'])) {
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $email = $_POST['email'];
        $noTelp = $_POST['phone'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

        if(mysqli_fetch_assoc($result)){
            echo "
                <script>
                    alert('Email telah digunakan!');
                    document.location.href = 'register.php';
                </script>
            ";
        } else {
            if($password === $cpassword){
                $password = password_hash($password, PASSWORD_DEFAULT);

                $result = mysqli_query($conn, "INSERT INTO user VALUES (' ','$first_name', '$last_name', '$email', '$noTelp', '$password')");
                if(mysqli_affected_rows($conn) > 0){
                    echo "
                        <script>
                            alert('Registrasi Berhasil!');
                            document.location.href = 'login.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Registrasi Gagal!');
                            document.location.href = 'register.php';
                        </script>
                    ";
                }
            } else {
                echo "
                    <script>
                        alert('Konfirmasi Password tidak sesuai!');
                        document.location.href = 'register.php';
                    </script>
                ";
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Limude's Ice Cream</title>
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <section class="form">
        <div class="form-box">
            <div class="form-title">
                <h1>Registration</h1>
                <hr>
            </div>
            <form action="" method="post" class="form-container">
                <label for="nama">Name</label>
                <div class="input-container">
                    <input type="text" name="fname" placeholder="First Name" required class="input-field">
                    <input type="text" name="lname" placeholder="Last name (optional)" class="input-field">
                </div><br>
                
                <label for="email">Email</label>
                <div class="input-container">
                    <input type="email" name="email" placeholder="Email Address..." required class="input-field">
                </div><br>
                
                <label for="tel">Phone Number</label>
                <div class="input-container">
                    <input type="tel" name="phone" maxlength="12" placeholder="Phone Number..." required class="input-field">
                </div><br>
                    
                <div class="input-container">
                    <label for="password">Password</label>
                    <label for="cpassword">Confirm Password</label>
                </div>

                <div class="input-container">
                    <input type="password" name="password" placeholder="Password..." required class="input-field">
                    <input type="password" name="cpassword" placeholder="Confirm Password..." required class="input-field">
                </div><br>
                
                <input type="submit" name="Register" value="Register" class="submit-btn">
            </form>
            <div class="login-with">
                <hr><br>
                <p>or</p>
                <div class="login-with-btn">
                    <button onclick="alert('TBA!')">
                        <img src="gambar/google.svg" alt="">
                        <p>Login with Google</p>
                    </button>
                    <button onclick="alert('TBA!')">
                        <img src="gambar/facebook.svg" alt="">
                        <p>Login with Facebook</p>
                    </button>
                </div>
            </div>
        </div>
    </section>
</body>
</html>