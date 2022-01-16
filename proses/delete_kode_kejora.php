<?php

include "../include/config.php";

if(isset($_GET['id'])){
	$id_user	= $_GET['id'];
	$sql		= mysqli_query($connect, "DELETE FROM kode_kejora WHERE id_kejora = '$id_user'");
	header("location:../view_kode_kejora.php");
    echo "<script>
    alert('Berhasil Dihapus!')
    </script>";
}
?>