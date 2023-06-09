<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM schedule WHERE event_id = '$id'"));
?>

<?php
echo $data['event_name'].'<br>'.$data['event_location'].'<br><a href="delete.php?id='.$id.'">delete</a>';
?>