<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $password_hash = md5($password);

    $check_query = "SELECT * FROM admin WHERE username='$username'";
    $check_result = $koneksi->query($check_query);

    if ($check_result->num_rows > 0) {
        echo '<script>alert("Username sudah digunakan!"); window.location.href = "register.php";</script>';
        exit;
    }

    $insert_query = "INSERT INTO admin (username, password, email, jenis_kelamin) VALUES ('$username', '$password_hash', '$email', '$jenis_kelamin')";

    if ($koneksi->query($insert_query)) {
        echo '<script>alert("Membuat akun berhasil!"); window.location.href = "login.php";</script>';
        exit;
    } else {
        echo "Registration failed. Please try again. Error: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        .box-area {
            width: 930px;
        }

        .btn-custom {
            background-color: #CF0A0A;
            color: white;
            font-weight: 500;
        }

        .btn-custom:hover {
            background-color: #c40101;
        }

        .right-box {
            padding: 40px 30px 40px 40px;
        }

        ::placeholder {
            font-size: 16px;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        .rounded-5 {
            border-radius: 30px;
        }

        @media only screen and (max-width: 768px) {

            .box-area {
                margin: 0 10px;

            }

            .left-box {
                height: 100px;
                overflow: hidden;
            }

            .right-box {
                padding: 20px;
            }

        }
    </style>
</head>

<body>
    <form method="post">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row border rounded-5 p-3 bg-white shadow box-area">
                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #CF0A0A;">
                    <div class="featured-image mb-3">
                        <img src="2.png" class="img-fluid" style="width: 225px;">
                    </div>
                    <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Pai
                        Gallery</p>
                    <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Find new ideas to try</small>
                </div>

                <div class="col-md-6 right-box">
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                            <h2>Hello,Again</h2>
                        </div>
                        <form method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Username" name="username" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password" required>
                            </div>

                            <div class="input-group mb-4">
                                <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email" name="email" required>
                            </div>
                            <div class="input-group mb-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L" required>
                                    <label class="form-check-label" for="L">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P" required>
                                    <label class="form-check-label" for="P">Female</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button type="submit" class="btn btn-lg btn-custom w-100 fs-6">Continue</button>
                            </div>
                            <div class="row">
                                <small>Go back to the previous page? <a href="login.php">Log in</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>