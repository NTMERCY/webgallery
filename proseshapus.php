<?php
include '../koneksi/koneksi.php'; 
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM images WHERE id = '$id' ") or die(mysql_error());
?>

<script language="JavaScript">
    alert('HAPUS DATA SISWA BERHASIL!!!');
    document.location = 'index.php'; 
</script>
