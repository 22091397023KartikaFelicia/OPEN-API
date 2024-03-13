<?php
header('Content-Type: application/json; charset=utf8');

$koneksi = mysqli_connect("localhost", "root", "", "kel1_tugasapi1"); // Membuat koneksi PHP dengan database MySQL

// Perintah GET
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $sql = "SELECT * FROM makeup";
    $query = mysqli_query($koneksi, $sql);
    $array_data = array();
    while($data = mysqli_fetch_assoc($query)){
        $array_data[] = $data;
    }
    echo json_encode($array_data);

// Perintah POST
}else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $tipe_produk = $_POST['tipe_produk'];
    $stok = $_POST['stok'];
    $sql = "INSERT INTO makeup (nama_produk, harga_produk, tipe_produk, stok) VALUES('$nama_produk', '$harga_produk', '$tipe_produk', '$stok')";
    $cek = mysqli_query($koneksi, $sql);

    if($cek){
        $data = [
            'status' => "Data berhasil disimpan"
        ];
        echo json_encode([$data]);
    }else{
        $data = [
            'status' => "Data gagal disimpan"
        ];
        echo json_encode([$data]);
    }

// Perintah DELETE
}else if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $id_makeup = $_GET['id_makeup'];
    $sql = "DELETE FROM makeup WHERE id_makeup='$id_makeup'";
    $cek =  mysqli_query($koneksi, $sql);

    if($cek){
        $data = [
            'status' => "Data berhasil dihapus"
        ];
        echo json_encode([$data]);
    }else{
        $data = [
            'status' => "Data gagal dihapus"
        ];
        echo json_encode([$data]);
    }

// Perintah PUT
}else if ($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $id_makeup = $_GET['id_makeup'];
    $nama_produk = $_GET['nama_produk'];
    $harga_produk = $_GET['harga_produk'];
    $tipe_produk = $_GET['tipe_produk'];
    $stok = $_GET['stok'];

    $sql = "UPDATE makeup SET nama_produk='$nama_produk', harga_produk='$harga_produk', tipe_produk='$tipe_produk', stok='$stok' WHERE id_makeup='$id_makeup'";
    $cek = mysqli_query($koneksi, $sql);

    if($cek){
        $data = [
            'status' => "Data berhasil diupdate"
        ];
        echo json_encode([$data]);
    }else{
        $data = [
            'status' => "Data gagal diupdate"
        ];
        echo json_encode([$data]);
    }
}
