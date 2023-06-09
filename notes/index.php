<?php
include '../koneksi.php';
if (isset($_SESSION['user'])) {
    $check_akun = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '".$_SESSION['user']['username']."'");
    $data_akun = mysqli_fetch_assoc($check_akun);
    $sess_username = $_SESSION['user']['username'];
}else {
    header("Location : ".$url."login");
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Notes</title>
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
					<h2 class="heading-section">Your Notes</h2>
					<a href="<?php echo $url; ?>" class="btn btn-primary"><?php echo 'Kembali ke Halaman Utama'; ?></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-primary">
						    <tr>
						      <th>#</th>
						      <th>Content</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
						  $no = 1;
						  $check = mysqli_query($koneksi, "SELECT * FROM note WHERE username = '$sess_username'");
						  while($data = mysqli_fetch_assoc($check)) {
						  ?>
						    <tr>
						      <th scope="row"><?php echo $no++; ?></th>
						      <td><?php echo $data['content']; ?></td>
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

