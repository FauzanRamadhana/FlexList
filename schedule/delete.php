<?php
include '../koneksi.php';
mysqli_query($koneksi, "DELETE FROM schedule WHERE event_id = '".$_GET['id']."'");
header("Location: ".$url."schedule");