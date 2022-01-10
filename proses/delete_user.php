<?php

include "../include/config.php";
include "../include/auth.php";



if(isset($_GET['id'])){
	$id_user	= $_GET['id'];
	$query = mysqli_query($connect,"SELECT * FROM user WHERE id_user = '$id_user'");
	$cek = mysqli_fetch_array($query);
	$id = $cek['akses'];
	if($id == 0){
		echo "<script>
		alert('Admin Tidak Bisa Menghapus Admin Lainnya')
		</script>

		<script>
		location.href='../users.php'
		</script>";
	}
	else{
		$sql		= mysqli_query($connect, "DELETE FROM user WHERE id_user = '$id_user'");
		header("location:../users.php");
	}
}
?>