<?php 
  require_once "core/init.php"; 
  require_once "view/sidebar.php";

  if(!isset($_SESSION['admin'])){
    header('Location: login.php');
  }

  $error = '';
  $id = $_GET['id'];
  if(isset($_GET['id'])){
  	$data = tampilkan_per_id($id);
  	while ($row = mysqli_fetch_assoc($data)) :
  		$nama_awal   = $row['nama'];
  		$course_awal = $row['course'];
  		$alamat_awal = $row['alamat'];
  		$telpon_awal = $row['telpon'];
  		$asal_awal   = $row['asal_daerah'];
  	endwhile;
  }

  if (isset($_POST['submit'])){
  	$nama   = $_POST['nama'];
  	$course = $_POST['course'];
  	$alamat = $_POST['alamat'];
  	$telpon = $_POST['notelp'];
  	$asal   = $_POST['asal'];

  	if(!empty(trim($nama)) && !empty(trim($course))){
  		if(edit_user($nama, $course, $alamat, $telpon, $asal, $id)){
  			header('Location: index.php');
  		} else {
  			$error = "Ada Masalah saat mengedit";
  		}
  	} else {
  		$error = "Nama dan Course tidak Boleh kosong";
  	}
  }
?>
<div class="container">
	<h1 class="text-center">FORM PENDAFTARAN PESERTA COURSE</h1>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">	
			<br>
		<form action="" method="post">
		  <div class="form-group">
		    <label for="nama">Nama Lengkap</label>
		    <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama" value="<?= $nama_awal; ?>">
		  </div>
		  <div class="form-group">
		    <label for="course">Program Course</label>
		    <select id="course" name="course" class="form-control">
		    	<option selected><?= $course_awal; ?></option>
		    	<option>Paket Efast 1</option>
		    	<option>Paket Efast 2</option>
		    	<option>Paket Efast 3</option>
		    	<option>Paket Efast 4</option>
		    	<option>Therapy 1</option>
		    	<option>Therapy 2</option>
		    	<option>Pronunciation</option>
		    	<option>Vocab 1</option>
		    </select>
		  </div>
		   <div class="form-group">
		  	<label for="course">Alamat Lengkap</label>
		  	<textarea class="form-control" placeholder="Alamat Lengkap.." name="alamat"><?= $alamat_awal; ?></textarea>
		  </div>
		   <div class="form-group">
		    <label for="notelp">No. Telepon</label>
		    <input type="text" class="form-control" id="notelp" placeholder="No. Telepon" name="notelp" value="<?= $telpon_awal; ?>">
		  </div>
		  <div class="form-group">
		    <label for="asal">Asal Daerah</label>
		    <input type="text" class="form-control" id="asal" placeholder="Asal Daerah" name="asal" value="<?= $asal_awal; ?>">
		  </div>

		  <!-- <div class="form-group">
		    <label for="exampleInputFile">File input</label>
		    <input type="file" id="exampleInputFile">
		    <p class="help-block">Example block-level help text here.</p>
		  </div>
		  <div class="checkbox">
		    <label>
		      <input type="checkbox"> Check me out
		    </label>
		  </div> -->

		  <br>
		  <?php if ($error){ ?>
		  	<div id="error"><?php echo $error; ?></div>
		  <?php } ?>
		  <br>

		  <button type="submit" class="btn btn-success" name="submit">Simpan</button>
		</form>
		</div>
	</div>
</div>
<?php require_once "view/footer.php"; ?>
