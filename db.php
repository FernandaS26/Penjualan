<?php
    $hostname = 'db';
    $username = 'php_docker';
    $password = 'password';
    $dbname   = 'db_catering_uas';

    $conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('gagal koneksi');
?>