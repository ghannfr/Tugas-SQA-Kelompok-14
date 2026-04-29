<?php
    // panggil file
    include '../model/koneksi.php';
    include '../model/crud.php';
    
    // cara panggil class di koneksi php
    $db = new koneksi();
    // cara panggil koneksi di fungsi Connection()
    $koneksi =  $db->connection();
    //panggil class crud
    $proses = new crud($koneksi);
    // menghilangkan pesan error
    // error_reporting(0);

?>