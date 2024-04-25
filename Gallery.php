<?php
// Gallery.php: Class untuk mengelola galeri gambar

class Gallery
{ 
    private $db;
    private $conn;

    // Constructor untuk inisialisasi koneksi ke database
    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "", "ukk2024_naufal_dzaky_rachmat");
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }



    // Method untuk mengambil semua gambar dari database
    public function getImages()
    {
        $images = [];
        $query = "SELECT * FROM images";
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
        return $images;
    }

    // Method untuk mengunggah gambar ke server dan menyimpan informasi di database
    public function uploadImage($file, $caption)
    {
        $targetDir = "images/";
        $targetFile = $targetDir . basename($file['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Periksa apakah file adalah gambar yang valid
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            return "File is not an image.";
        }

        // Periksa ukuran file
        if ($file['size'] > 10000000) { 
            return "Sorry, your file is too large.";
        }

        // Periksa format file yang diperbolehkan
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedFormats)) {
            return "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }

        // Pindahkan file ke direktori target
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $this->saveToDatabase($targetFile, $caption);
            return true;
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }

    // Method untuk menyimpan informasi gambar ke database
    private function saveToDatabase($filename, $caption)
    {
        $query = "INSERT INTO images (filename, caption) VALUES ('$filename', '$caption')";
        $this->db->query($query);
    }

    // Method untuk menghapus gambar dari server dan database
    public function deleteImage($id)
    {
        // Dapatkan informasi tentang gambar
        $imageInfo = $this->getImageInfo($id);

        if (!$imageInfo) {
            return "Foto tidak ditemukan.";
        }

        // Periksa apakah file ada sebelum mencoba penghapusan
        if (file_exists($imageInfo['filename'])) {
            // Hapus file dari direktori
            if (unlink($imageInfo['filename'])) {
                // Hapus rekaman dari database
                $query = "DELETE FROM images WHERE id = $id";
                if ($this->db->query($query)) {
                    return true;
                } else {
                    return "Gagal menghapus data dari database.";
                }
            } else {
                return "Gagal menghapus foto dari direktori.";
            }
        } else {
            // Jika file tidak ada, hapus rekaman yang sesuai dari database
            $query = "DELETE FROM images WHERE id = $id";
            if ($this->db->query($query)) {
                return true;
            } else {
                return "Gagal menghapus data dari database.";
            }
        }
    }

    // Method untuk mengedit informasi gambar (termasuk penggantian file)
    public function editImage($id, $file, $newCaption)
    {
        $imageInfo = $this->getImageInfo($id);

        if (!$imageInfo) {
            return "Foto tidak ditemukan.";
        }

        // Jika tidak ada file yang diunggah, hanya edit caption
        if (empty($file['name'])) {
            $query = "UPDATE images SET caption = '$newCaption' WHERE id = $id";
            $this->db->query($query);
            return true;
        }

        // Jika ada file yang diunggah, proses seperti biasa
        $targetDir = "images/";
        $targetFile = $targetDir . basename($file['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Hapus file lama
        unlink($imageInfo['filename']);

        // Pindahkan file baru
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            // Update caption di database
            $query = "UPDATE images SET filename = '$targetFile', caption = '$newCaption' WHERE id = $id";
            $this->db->query($query);
            return true;
        } else {
            return "Gagal mengupload file.";
        }
    }

    // Method untuk menghapus caption gambar dari database
    public function hapusCaption($id)
    {
        $imageInfo = $this->getImageInfo($id);

        if (!$imageInfo) {
            return "Foto tidak ditemukan.";
        }

        // Hapus caption dari database
        $query = "UPDATE images SET caption = NULL WHERE id = $id";
        $this->db->query($query);

        return true;
    }

    public function getImagesByCaption($caption)
    {
        $query = "SELECT * FROM images WHERE caption LIKE '%$caption%'";
        $result = $this->db->query($query);

        $images = array();
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
        return $images;
    }

    public function addComment($imageId, $comment) {
        // Koneksi ke database
        require_once 'koneksi.php';

        // Escape string untuk mencegah SQL injection
        $imageId = $koneksi->real_escape_string($imageId);
        $comment = $koneksi->real_escape_string($comment);

        // Waktu saat ini
        $time = date('Y-m-d H:i:s');

        // Query untuk menyimpan komentar ke dalam database
        $query = "INSERT INTO comments (image_id, comment, time) VALUES ('$imageId', '$comment', '$time')";

        // Eksekusi query
        if ($koneksi->query($query)) {
            return true; // Komentar berhasil disimpan
        } else {
            return false; // Komentar gagal disimpan
        }
    }

    public function getComments($imageId) {
        // Implementasi untuk mendapatkan komentar dari database atau sumber data lainnya
        // Misalnya:
        $comments = array(
            array(
                'username' => 'user1',
                'profile_picture' => 'profile1.jpg',
                'time' => '2024-04-24 10:00:00',
                'comment' => 'Komentar pertama.'
            ),
            array(
                'username' => 'user2',
                'profile_picture' => 'profile2.jpg',
                'time' => '2024-04-24 10:05:00',
                'comment' => 'Komentar kedua.'
            )
            // dan seterusnya
        );

        return $comments;
    }

    // Method untuk mendapatkan informasi gambar berdasarkan ID
    public function getImageInfo($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM images WHERE id = $id";
        $result = $this->db->query($query);

        return $result->fetch_assoc();
    }
}
