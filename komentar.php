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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,800&display=swap');

        * {
            font-family: "Poppins", sans-serif;
        }
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
            overflow-y: auto;
            max-height: 400px;
        }

        .card::-webkit-scrollbar {
            width: 10px;
        }

        .card::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .card::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        .comment-profile {
            position: relative;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            color: #808080;
        }

        .comment-profile img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .comment-profile .name {
            font-weight: 500;
            margin-right: 10px;
            color: black;
        }

        .comment-profile .time {
            font-size: 12px;
            color: #808080;
            margin-left: auto;
        }

        .comment-content {
            font-weight: normal;
            color: #000000;
            margin-left: auto;
            font-size: 13px;
        }

        .comment-profile .name,
        .comment-profile .time {
            display: inline-block;
        }

        .area-komentar {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: #fff;
            padding: 10px 0;
        }

        .poppins-regular {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .poppins-extrabold-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 800;
            font-style: italic;
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
                <h5 class="m-0">Area komentar</h5>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Header Done! -->


    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card d-flex flex-column justify-content-center">
                    <div class="card-body">
                        <!-- Teks "Area komentar" dipindahkan ke sini -->
                        <h5 class="card-title text-center area-komentar">Area komentar</h5>
                        <!-- Isi konten komentar di sini -->
                        <div class="comment"> <!-- Hapus style="overflow-y: auto; max-height: 300px;" -->
                            <div class="comment-profile">
                                <img src="images/profile.jpg" alt="Profile Picture">
                                <div>
                                    <div class="name">mancingmania.id</div>
                                    <div class="time">10:00 AM</div>
                                    <div class="comment-content">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec ex sed justo condimentum fermentum ac vel lectus.
                                        <!-- Contoh isi komentar yang panjang -->
                                    </div>
                                </div>
                            </div>

                            <div class="comment-profile">
                                <img src="images/profile.jpg" alt="Profile Picture">
                                <div>
                                    <div class="name">mania.id</div>
                                    <div class="time">10:00 AM</div>
                                    <div class="comment-content">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec ex sed justo condimentum fermentum ac vel lectus.
                                        <!-- Contoh isi komentar yang panjang -->
                                    </div>
                                </div>
                            </div>

                            <div class="comment-profile">
                                <img src="images/profile.jpg" alt="Profile Picture">
                                <div>
                                    <div class="name">mantapmancing.id</div>
                                    <div class="time">10:00 AM</div>
                                    <div class="comment-content">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec ex sed justo condimentum fermentum ac vel lectus.
                                        <!-- Contoh isi komentar yang panjang -->
                                    </div>
                                </div>
                            </div>

                            <div class="comment-profile">
                                <img src="images/profile.jpg" alt="Profile Picture">
                                <div>
                                    <div class="name">mantap.id</div> 
                                    <div class="time">10:00 AM</div>
                                    <div class="comment-content">
                                        Mantap euy euy euy
                                        <!-- Contoh isi komentar yang panjang -->
                                    </div>
                                </div>
                            </div>

                            <!-- Tambahkan komentar lainnya di sini -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content Done -->

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>