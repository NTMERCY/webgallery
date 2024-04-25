<?php
// index.php
require_once 'Gallery.php';
$gallery = new Gallery();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $deleteResult = $gallery->deleteImage($_GET['id']);
        if ($deleteResult === true) {
            header("Location: index.php");
            exit();
        } else {
            $error = $deleteResult;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'edit') {
        $imageId = $_POST['image_id'];
        // Redirect to edit.php with the image ID
        header("Location: edit.php?id=$imageId");
        exit();
    } elseif ($action === 'hapus_caption') {
        $imageId = $_POST['image_id'];
        $hapusCaptionResult = $gallery->hapusCaption($imageId);
        if ($hapusCaptionResult === true) {
            header("Location: index.php");
            exit();
        } else {
            $error = $hapusCaptionResult;
        }
    }
}

session_start();

// Cek apakah pengguna mencoba menambah data tanpa login
if (isset($_GET['action']) && $_GET['action'] === 'create' && !isset($_SESSION['username'])) {
    echo "<script>alert('Anda harus login terlebih dahulu untuk menambah data.'); window.location='login.php';</script>";
    exit();
}

// Cek apakah waktu session telah melewati batas timeout
if (isset($_SESSION['expire_time']) && time() > $_SESSION['expire_time']) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit();
}

// Cek apakah pengguna sudah login, jika iya, maka izinkan akses ke upload.php
if (isset($_GET['action']) && $_GET['action'] === 'create' && isset($_SESSION['username'])) {
    header("Location: upload.php");
    exit();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search) {
    $images = $gallery->getImagesByCaption($search);
} else {
    $images = $gallery->getImages();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGallery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e790a46429.js" crossorigin="anonymous"></script>
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

        <form action="index.php" method="GET">
            <div class="search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search" name="search">
            </div>
        </form>

        <div class="icons">
            <i class="fas fa-table"></i>
            <a href="komentar.php"><i class="fas fa-comment-dots"></i></a>
            <div class="icons">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton">
                        <i class="fas fa-user-circle"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Done! -->

    <!-- Container -->
    <div class="container">
        <?php foreach ($images as $image) : ?>
            <div class="box">
                <a href="gambar.php?id=<?php echo htmlspecialchars($image['id']); ?>">
                <img src="<?php echo htmlspecialchars($image['filename']); ?>" alt="<?php echo htmlspecialchars($image['caption']); ?>"></a>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Container done -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownToggle = document.querySelector('.dropdown-toggle');
            var dropdownMenu = document.querySelector('.dropdown-menu');

            dropdownToggle.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });

            // Tutup dropdown saat pengguna mengklik di luar dropdown
            window.addEventListener('click', function(e) {
                if (!dropdownToggle.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>