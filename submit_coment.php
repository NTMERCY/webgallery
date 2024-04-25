<?php
require_once 'Gallery.php';

$gallery = new Gallery();

// Pastikan $_POST['image_id'] dan $_POST['comment'] telah diset sebelum menggunakan
$imageId = $_POST['image_id'];
$comment = $_POST['comment'];

// Panggil method addComment dari objek Gallery
if ($gallery->addComment($imageId, $comment)) {
    echo "Komentar berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan komentar.";
}
?>