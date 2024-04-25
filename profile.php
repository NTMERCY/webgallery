<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e790a46429.js" crossorigin="anonymous"></script>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            height: 100vh;
        }

        .circle {
            width: 135px;
            height: 135px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .circle img {
            width: 100%;
            height: auto;
            cursor: pointer;
        }

        .profile-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 30px;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-upload {
            font-size: 20px;
            cursor: pointer;
            position: relative;
            transition: color 0.3s ease-in-out;
        }

        .profile-upload::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #333;
            transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
        }

        .profile-upload:hover::after {
            width: 0;
            left: 50%;
        }

        .layout-upload {
            max-width: 1400px;
            margin: 20px auto;
            padding: 0 20px;
            column-count: 5;
            column-gap: 20px;
        }

        .layout-upload .box {
            width: 100%;
            margin-bottom: 10px;
            break-inside: avoid;
        }

        .layout-upload .box img {
            max-width: 100%;
            border-radius: 15px;
        }

        .layout-upload .box:hover img {
            filter: grayscale(100%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div id="top" class="header">
        <div class="links">
            <a href="index.php">PaiGallery.</a>
        </div>
        <div class="links">
            <a href="#top">Home</a>
            <a href="index.php?action=create">Create <i class="fas fa-plus"></i></a>
        </div>
        <div class="search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search">
        </div>
        <div class="icons">
            <i class="fas fa-table"></i>
            <a href="komentar.php"><i class="fas fa-comment-dots"></i></a>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <!-- Header Done! -->

    <!-- Container -->
    <div class="container">
        <div class="circle"><img src="holduplethimcook.jpg" alt=""></div>
        <div class="profile-name">mancingmania.id</div>
        <div class="profile-upload">Dibuat</div>
    </div>

    <!-- Layout Upload -->
    <div class="layout-upload">
        <div class="box"><img src="images/scara.jpg" alt=""></div>
        <div class="box"><img src="images/profile.jpg" alt=""></div>
        <div class="box"><img src="images/Porsche 911 Turbo S (991).jpg" alt=""></div>
        <div class="box"><img src="images/download (8).jpg" alt=""></div>
        <div class="box"><img src="images/download (7).jpg" alt=""></div>
        <div class="box"><img src="images/download (5).jpg" alt=""></div>
        <div class="box"><img src="images/download (4).jpg" alt=""></div>
        <div class="box"><img src="images/download (3).jpg" alt=""></div>
        <div class="box"><img src="images/download (2).jpg" alt=""></div>
        <div class="box"><img src="images/download (1).jpg" alt=""></div>
        <div class="box"><img src="images/customer-support.jpg" alt=""></div>
    </div>

    <script>
        // JavaScript untuk menangani klik pada "Dibuat"
        const profileUpload = document.querySelector('.profile-upload');

        profileUpload.addEventListener('click', () => {
            // Tambahkan logika atau kode yang diinginkan ketika "Dibuat" diklik
            console.log('Dibuat diklik');
        });
    </script>
</body>

</html>