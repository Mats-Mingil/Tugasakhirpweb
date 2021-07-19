<?php

session_start();
//memuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stockbarang");
// if ($conn) {
//     echo 'berhasil';
// } else {
//     echo 'gagal';
// }

//menambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "insert into stok (namabarang, deskripsi, stok) values('$namabarang','$deskripsi','$stok')");

    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambah = $stoksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "INSERT into masuk (idbarang, keterangan, qty) values('$barangnya','$penerima','$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok set stok='$tambah' where idbarang='$barangnya'");
    
    if($addtomasuk&&$updatestokmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $kurang = $stoksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "INSERT into keluar(idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok SET stok='$kurang' where idbarang='$barangnya'");
    
    if($addtokeluar&&$updatestokmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}

//update info barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "UPDATE stok set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//hapus barang dari stok
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "DELETE from stok where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}


?>

