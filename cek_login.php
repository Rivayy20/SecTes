<?php
include "koneksi.php";

$pass = md5($_POST['password']);
$username = mysqli_escape_string($koneksi, $_POST['username']);
$password = mysqli_escape_string($koneksi, $pass);
$status = mysqli_escape_string($koneksi, $_POST['status']);

$cek_user = mysqli_query($koneksi, "SELECT * FROM tuser WHERE username = '$username' AND LEVEL = '$status'");
$user_valid = mysqli_fetch_array($cek_user);

if($user_valid){
    if($password == $user_valid['password']){
        session_start();
        $_SESSION['username'] = $user_valid['username'];
        $_SESSION['nama_pengguna'] = $user_valid['nama_pengguna'];
        $_SESSION['status'] = $user_valid['status'];

        if($status == "admin"){
            header('location:admin.php');
        }else if($status == "siswa"){
            header('location:admin.php');
        }
        
    }else{
        echo "<script>alert('Maaf, Login Gagal, Password Anda Tidak Sesuai!');document.location='index.php'</script>";
    }
}else{
    echo "<script>alert('Maaf, Login Gagal, Username Anda Tidak Terdaftar!');document.location='index.php'</script>";
}
?>