<?php
include '../koneksi.php';
if (isset($_SESSION['user'])) {
    $check_akun = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '".$_SESSION['user']['username']."'");
    $data_akun = mysqli_fetch_assoc($check_akun);
    $sess_username = $_SESSION['user']['username'];
} else {
    header("Location : ".$url."login");
}

if (isset($_POST['tambah'])) {
    mysqli_query($koneksi, "INSERT INTO todo (username,datetime,task) VALUES ('$sess_username','".date("Y-m-d H:i:s")."', '".$_POST['task']."')");
    echo '<script>alert("Berhasil menambahkan to do list.");document.location.href="";</script>';
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>To Do List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<?php if (!isset($_POST['add'])) { ?>
					<h2 class="heading-section">Your To Do List</h2>
					<a href="<?php echo $url; ?>" class="btn btn-primary"><?php echo 'Kembali Ke Halaman Utama'; ?></a>
					<form method="POST">
					<button type="submit" name="add" class="btn">+ Tambah Todo</button>
					</form>
					<?php } else { ?>
					<form method="POST">
					<h2 class="heading-section">Isi To Do List</h2>
					<input type="text" class="form-control" name="task" placeholder="Isi dengan to do list kamu" required><br>
					<button type="submit" name="tambah" class="btn btn-info">Tambah</button>
					</form>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-primary">
						    <tr>
						      <th>#</th>
						      <th>Task</th>
						      <th>Date Time</th>
						      <th>Status</th>
						      <th>Selesaikan</th>
						      <th>Hapus</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
						  if (isset($_POST['complete'])) {
						      mysqli_query($koneksi, "UPDATE todo SET status = 'Complete' WHERE id = '".$_POST['id']."'");
						      echo '<script>alert("Berhasil diselesaikan.")</script>';
						  }
						  if (isset($_POST['delete'])) {
						      mysqli_query($koneksi, "DELETE FROM todo WHERE id = '".$_POST['id']."'");
						      echo '<script>alert("Berhasil dihapus.")</script>';
						  }
						  $no = 1;
						  $check = mysqli_query($koneksi, "SELECT * FROM todo WHERE username = '$sess_username'");
						  while($data = mysqli_fetch_assoc($check)) {
						  ?>
						    <tr>
						      <th scope="row"><?php echo $no++; ?></th>
						      <td><?php echo $data['task']; ?></td>
						      <td><?php echo $data['datetime']; ?></td>
						      <td><?php echo $data['status']; ?></td>
						      <td><?php if ($data['status'] == 'Pending') { ?><form method="POST"><input type="hidden" name="id" value="<?php echo $data['id']; ?>"><button type="submit" name="complete" class="btn btn-info">Complete</button></form><?php } else { ?>Sudah Selesai<?php } ?></td>
						      <td><form method="POST"><input type="hidden" name="id" value="<?php echo $data['id']; ?>"><button type="submit" name="delete" class="btn btn-danger">Delete</button></form></td>
						    </tr>
						    <?php } ?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

