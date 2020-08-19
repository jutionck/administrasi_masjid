<?php

$kdb = @mysqli_connect("localhost", "root", "", "mipdevpc_masjid");
if (!$kdb) {
    trigger_error('Tidak dapat terkoneksi ke Database : ' . mysqli_connect_error());
}
?>