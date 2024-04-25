<?php
require_once 'Gallery.php';
$gallery = new Gallery();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadResult = $gallery->uploadImage($_FILES['image'], $_POST['caption']);
    if ($uploadResult === true) {
        header("Location: index.php");
        exit();
    } else {
        $error = $uploadResult; 
    }
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
                <h5 class="m-0">Upload Gambar</h5>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Header Done! -->


    <!-- Main Content -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="container mt-4">
            <div class="row">
                <!-- Kolom Kiri (Area Gambar) -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Area Gambar</h5>
                            <div id="image-preview-container" class="mb-3">
                                <img src="" alt="" class="img-fluid mb-3 rounded preview-image" id="preview-image">
                                <span id="image-filename"></span>
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
                                <input type="text" class="form-control" name="caption" id="caption" placeholder="Tuliskan caption..." required>
                            </div>
                            <button type="submit" class="btn custom-btn">Post</button>
                            <?php if (isset($error)) : ?>
                                <p style="color: red;"><?php echo $error; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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