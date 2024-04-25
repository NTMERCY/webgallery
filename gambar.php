<?php
require_once 'Gallery.php';

$gallery = new Gallery();

$imageInfo = null;
$comments = array(); // Inisialisasi variabel $comments

if (isset($_GET['id'])) {
    $imageId = $_GET['id'];
    $imageInfo = $gallery->getImageInfo($imageId);
    // Ambil komentar menggunakan metode getComments()
    $comments = $gallery->getComments($imageId);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <style>
        .post-card {
            position: relative;
            max-width: 1000px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            display: flex;
            margin-top: 90px;
        }

        .post-image {
            width: 500px;
            height: auto;
            border-radius: 10px 0px 0px 10px;
        }

        .post-info {
            flex: 1;
            padding: 10px;
            max-height: 300px;
            overflow-y: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-info {
            display: flex;
            align-items: center;
        }


        .profile-pic {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .username {
            font-weight: bold;
        }

        .divider {
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }

        .divider2 {
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }

        .like-comment {
            margin-left: 300px;
            font-size: 20px;
        }

        .likes {
            margin-right: 5px;
        }

        .likes i {
            cursor: pointer;
        }

        .description {
            line-height: 1.5;
        }

        .comment-form {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .comment-input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-right: 10px;
            width: 360px;
        }

        .comment-button {
            background-color: #3897f0;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 10px;
            cursor: pointer;
        }

        .bullets {
            margin-top: 5px;
            margin-left: 15px;
            font-size: 25px;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(130, 130, 130, 0.7);
            z-index: 999;
        }

        .dropdown-content {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            z-index: 1000;
        }

        .dropdown-content button {
            display: block;
            padding: 10px 0;
            width: 350px;
            background-color: white;
            text-align: center;
            font-size: 15px;
            border: none;
            font-weight: 800;
        }

        .dropdown-content button:hover {
            cursor: pointer;
        }

        .heart {
            cursor: pointer;
            color: grey;
            transition: color 0.3s;
        }

        .liked {
            color: red;
            animation: likeAnimation 0.3s;
        }

        .area {
            max-height: 300px;
            /* Atur ketinggian maksimum */
            overflow-y: auto;
            /* Tambahkan overflow-y: auto; */
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

        @keyframes likeAnimation {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
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

    <div id="overlay"></div>
    <?php if ($imageInfo) : ?>
        <div class="post-card">
            <img class="post-image" src="<?php echo $imageInfo['filename']; ?>" alt="Post Image">
            <div class="post-info">
                <div class="user-info">
                    <div class="profile-info">
                        <img class="profile-pic" src="images/profile.jpg" alt="Profile Picture">
                        <span class="username">example_user</span>
                    </div>
                    <div class="like-comment">
                        <div class="likes">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                            <div class="dropdown-content">
                                <form action="edit.php" method="get">
                                    <input type="hidden" name="id" value="<?php echo $imageInfo['id']; ?>">
                                    <button type="submit" class="dropdown-btn">Edit</button>
                                </form>
                                <form action="index.php" method="post">
                                    <input type="hidden" name="action" value="hapus_caption">
                                    <input type="hidden" name="image_id" value="<?php echo $imageInfo['id']; ?>">
                                    <button type="submit" class="dropdown-btn">Hapus caption</button>
                                </form>
                                <button onclick="hapusGambar(<?php echo $imageInfo['id']; ?>)" class="dropdown-btn">Hapus gambar</button>
                                <button type="button" style="color: red;" class="cancel-btn">Cancel</button> <!-- Tombol Cancel -->
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="divider">
                <div class="description">
                    <p><?php echo $imageInfo['caption']; ?></p>
                </div>
                <hr class="divider2">
                <div class="area">
                    <!-- Looping untuk menampilkan setiap komentar -->
                    <?php foreach ($comments as $comment) : ?>
                        <div class="comment">
                            <div class="comment-profile">
                                <img src="<?php echo $comment['profile_picture']; ?>" alt="Profile Picture">
                                <div>
                                    <div class="name"><?php echo $comment['username']; ?></div>
                                    <div class="time"><?php echo $comment['time']; ?></div>
                                    <div class="comment-content"><?php echo $comment['comment']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php else : ?>
                <!-- Tampilkan pesan jika gambar tidak ditemukan -->
                <p>Gambar tidak ditemukan.</p>
            <?php endif; ?>
            </div>
            <form class="comment-form" method="post" action="submit_coment.php">
                <input type="hidden" name="image_id" value="<?php echo $imageInfo['id']; ?>">
                <input type="text" name="comment" placeholder="Add a comment..." class="comment-input">
                <button type="submit" class="comment-button">Post</button>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ellipsisIcon = document.querySelector('.likes i');
                var dropdownContent = document.querySelector('.dropdown-content');
                var overlay = document.getElementById('overlay');
                var dropdownBtns = document.querySelectorAll('.dropdown-btn'); // Ambil semua tombol dropdown
                var cancelBtn = document.querySelector('.cancel-btn'); // Ambil tombol Cancel

                ellipsisIcon.addEventListener('click', function() {
                    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
                    overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
                });

                // Tambahkan event listener untuk setiap tombol dropdown
                dropdownBtns.forEach(function(btn) {
                    btn.addEventListener('click', function(event) {
                        // Tindakan yang sesuai saat tombol dropdown diklik
                        // Misalnya, Anda dapat menambahkan logika untuk setiap opsi dropdown di sini
                        console.log('Dropdown item clicked:', btn.textContent);
                    });
                });

                // Tambahkan event listener untuk tombol Cancel
                cancelBtn.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah tindakan default dari link
                    dropdownContent.style.display = 'none'; // Tutup dropdown
                    overlay.style.display = 'none'; // Sembunyikan overlay
                });
            });

            function hapusGambar(imageId) {
                if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log('Gambar dengan ID ' + imageId + ' berhasil dihapus.');
                                // Setelah gambar dihapus, arahkan pengguna ke halaman index.php
                                window.location.href = 'index.php';
                            } else {
                                console.error('Gagal menghapus gambar.');
                            }
                        }
                    };
                    xhr.open('GET', 'index.php?action=delete&id=' + imageId, true);
                    xhr.send();
                } else {
                    console.log('Penghapusan gambar dibatalkan.');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Ambil ikon like
                var likeIcon = document.getElementById('like-icon');

                // Tambahkan event listener untuk klik pada ikon like
                likeIcon.addEventListener('click', function() {
                    // Periksa apakah ikon sudah memiliki kelas 'liked'
                    var isLiked = likeIcon.classList.contains('liked');

                    // Jika belum disukai, tambahkan kelas 'liked' untuk mengubah warna ikon menjadi merah
                    // Jika sudah disukai, hapus kelas 'liked' untuk mengembalikan warna ikon menjadi abu-abu
                    if (!isLiked) {
                        likeIcon.classList.add('liked');
                    } else {
                        likeIcon.classList.remove('liked');
                    }
                });
            });
        </script>

</body>

</html>