<?php
require_once 'Gallery.php';

$gallery = new Gallery();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] === 'edit') {
        $id = $_POST['id'];
        // Pastikan ID adalah bilangan bulat positif
        if (!is_numeric($id) || $id <= 0) {
            $error = "ID foto tidak valid.";
        } else {
            $image = $gallery->getImageInfo($id);
            if (!$image) {
                $error = "Foto dengan ID tersebut tidak ditemukan.";
            } else {
                $editResult = $gallery->editImage($id, $_FILES['image'], $_POST['newCaption']);

                if ($editResult === true) {
                    header("Location: index.php");
                    exit();
                } else {
                    $error = $editResult;
                }
            }
        }
    } else {
        $error = "ID foto atau tindakan tidak valid.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Pastikan ID adalah bilangan bulat positif
    if (!is_numeric($id) || $id <= 0) {
        $error = "ID foto tidak valid.";
    } else {
        $image = $gallery->getImageInfo($id);
        if (!$image) {
            $error = "Foto dengan ID tersebut tidak ditemukan.";
        }
    }
} else {
    $error = "Metode tidak valid.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e790a46429.js" crossorigin="anonymous"></script>
    <style>
        .custom-header {
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-right: 10px;
        }

        .container {
            max-width: 960px;
        }

        .card {
            border-radius: 8px;
        }

        /* Custom CSS untuk input file */
        .custom-file-label::after {
            content: "Pilih File";
        }

        .custom-file-input:focus~.custom-file-label::after {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        /* Custom CSS untuk area preview gambar */
        #image-preview-container {
            border: 2px dashed #ccc;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            min-height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            /* Untuk memposisikan teks nama file */
            overflow: hidden;
            /* Menghindari munculnya scrollbar */
        }

        #image-preview-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
            /* Efek transisi saat hover */
        }

        #image-preview-container:hover img {
            transform: scale(1.05);
            /* Efek zoom saat hover */
        }

        #image-filename {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 16px;
            color: #333;
            /* Warna teks nama file */
            opacity: 0;
            /* Mulai dengan tidak terlihat */
            transition: opacity 0.3s ease;
            /* Efek transisi saat hover */
            font-family: 'Poppins', sans-serif;
            /* Menggunakan font Poppins */
        }

        #image-preview-container:hover #image-filename {
            opacity: 1;
            /* Tampilkan nama file saat hover */
        }

        /* Menggunakan tampilan default untuk input file */
        .custom-file-input {
            display: none;
        }

        .custom-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

        .img {
            width: 80px;
        }

        .custom-btn {
            background-color: #ff0000;
            color: white;
        }

        .custom-btn:hover {
            background-color: #8d0000;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="custom-header p-3 bg-light">
        <div class="container">
            <div class="d-flex align-items-center">
                <!-- Tombol kembali ke halaman index.php -->
                <a href="index.php" class="btn btn-light me-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h5 class="m-0">Edit Gambar</h5>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Header Done! -->


    <!-- Main Content -->
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <div class="container mt-4">
            <div class="row">
                <!-- Kolom Kiri (Area Gambar) -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Area Gambar</h5>
                            <div id="image-preview-container" class="mb-3">
                                <?php if (!empty($image)) : ?>
                                    <img src="<?php echo $image['filename']; ?>" alt="<?php echo $image['caption']; ?>" class="img-fluid mb-3 rounded preview-image" id="preview-image">
                                    <span id="image-filename"></span>
                                <?php endif; ?>
                            </div>
                            <!-- Menggunakan tampilan default untuk input file -->
                            <label for="image" class="btn custom-btn custom-file-button">Pilih Gambar</label>
                            <input type="file" id="image" onchange="previewImage()" name="image" accept="image/*" required hidden>
                        </div>
                    </div>
                </div>
                <!-- Kolom Kanan (Input Teks & Button Post) -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Masukkan caption</h5>
                            <div class="mb-3">
                                <?php if (!empty($image)) : ?>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="action" value="edit">
                                    <input type="text" class="form-control" name="newCaption" id="newCaption" value="<?php echo $image['caption']; ?>" required>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn custom-btn">Post</button>
                            <?php if (!empty($error)) : ?>
                                <p style="color: red;"><?php echo $error; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript untuk preview gambar -->
    <script>
        function previewImage() {
            const preview = document.getElementById('preview-image');
            const fileInput = document.getElementById('image').files[0];
            const filenameSpan = document.getElementById('image-filename');

            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                filenameSpan.textContent = fileInput.name;
            }

            if (fileInput) {
                reader.readAsDataURL(fileInput);
            } else {
                preview.src = "";
                filenameSpan.textContent = "";
            }
        }
    </script>


</body>

</html>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Photo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
    <style>
        .custom-header {
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-right: 10px;
        }

        .container {
            max-width: 960px;
        }

        .card {
            border-radius: 8px;
        }

        .custom-file-label::after {
            content: "Pilih File";
        }

        .custom-file-input:focus~.custom-file-label::after {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        #image-preview-container {
            border: 2px dashed #ccc;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            min-height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        #image-preview-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
            /* Efek transisi saat hover */
        }

        #image-preview-container:hover img {
            transform: scale(1.05);
            /* Efek zoom saat hover */
        }

        #image-filename {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 16px;
            color: #333;
            opacity: 0;
            transition: opacity 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        #image-preview-container:hover #image-filename {
            opacity: 1;
        }

        .custom-file-input {
            display: none;
        }

        .custom-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

        .img {
            width: 80px;
        }

        .custom-btn {
            background-color: #ff0000;
            color: white;
        }

        .custom-btn:hover {
            background-color: #8d0000;
            color: white;
        }
    </style>
</head>

<body>
     Header 
    <div class="custom-header p-3 bg-light">
        <div class="container">
            <div class="d-flex align-items-center">
                <a href="index.php" class="btn btn-light me-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h5 class="m-0">Edit Image</h5>
            </div>
        </div>
    </div>
     Header Done! 

     Main Content 
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Image Area</h5>
                            <div id="image-preview-container" class="mb-3">
                                <?php if (!empty($image)) : ?>
                                    <img src="<?php echo $image['filename']; ?>" alt="<?php echo $image['caption']; ?>" class="img-fluid mb-3 rounded preview-image" id="preview-image">
                                    <span id="image-filename"></span>
                                <?php endif; ?>
                            </div>
                            <label for="image" class="btn custom-btn custom-file-button">Choose Image</label>
                            <input type="file" id="image" onchange="previewImage()" name="image" accept="image/*" required hidden>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Text Input & Post Button</h5>
                            <div class="mb-3">
                                <?php if (!empty($image)) : ?>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="action" value="edit">
                                    <input type="text" class="form-control" name="newCaption" id="newCaption" value="<?php echo $image['caption']; ?>" required>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn custom-btn">Post</button>
                            <?php if (!empty($error)) : ?>
                                <p style="color: red;"><?php echo $error; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
     Content done 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <script>
        function previewImage() {
            const preview = document.getElementById('preview-image');
            const fileInput = document.getElementById('image').files[0];
            const filenameSpan = document.getElementById('image-filename');

            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                filenameSpan.textContent = fileInput.name;
            }

            if (fileInput) {
                reader.readAsDataURL(fileInput);
            } else {
                preview.src = "";
                filenameSpan.textContent = "";
            }
        }
    </script>
</body>

</html> -->