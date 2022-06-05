<?php 
error_reporting(E_ALL);
include_once 'koneksi.php'; 

if (isset($_POST['submit'])) 
{     
	$id = $_POST['id'];     
	$nama = $_POST['nama'];     
	$kategori = $_POST['kategori'];     
	$harga_jual = $_POST['harga_jual'];     
	$harga_beli = $_POST['harga_beli'];     
	$stok = $_POST['stok'];     
	$file_gambar = $_FILES['file_gambar'];     
	$gambar = null;          
	
	$sql = "SELECT gambar FROM data_barang WHERE id_barang = '{$id}'"; 
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($result);

	if ($file_gambar['error'] == 0)     
	{         
		// Cek apakah file fotonya ada di folder images
		if(is_file("gambar/".$data['gambar'])) // Jika foto ada
			unlink("gambar/".$data['gambar']); // Hapus foto yang telah diupload dari folder images

		$filename = str_replace(' ', '_', $file_gambar['name']);         
		$destination = dirname(__FILE__) . '/gambar/' . $filename;         
		if (move_uploaded_file($file_gambar['tmp_name'], $destination))         
		{             
			$gambar = $filename;
		} 
	} 

	$sql = 'UPDATE data_barang SET ';     
	$sql .= "nama = '{$nama}', kategori = '{$kategori}', ";     
	$sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";   

	if (!empty($gambar))         
		$sql .= ", gambar = '{$gambar}' ";     

	$sql .= "WHERE id_barang = '{$id}'";     
	$result = mysqli_query($conn, $sql); 

	header('location: index.php'); 
} 

$id = $_GET['id']; 
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'"; 
$result = mysqli_query($conn, $sql); 
if (!$result) die('Error: Data tidak tersedia'); 
$data = mysqli_fetch_array($result);

function is_select($var, $val) {     
	if ($var == $val) return 'selected="selected"';     
	return false; 
} 

require('header.php');
?>   
		<h1>Ubah Barang</h1>     
		<div class="main">         
			<form method="post" action="ubah.php" enctype="multipart/form-data">             
				<div class="input">                 
					<label>Nama Barang</label>                 
					<input type="text" name="nama" value="<?php echo $data['nama'];?>" />             
				</div>             
				<div class="input">                 
					<label>Kategori</label>                 
					<select name="kategori"> 
						<option <?php echo is_select ('Kendaraan', $data['kategori']);?> value="Kendaraan">Kendaraan</option>                     
						<option <?php echo is_select ('Elektronik', $data['kategori']);?> value="Elektronik">Elektronik</option>                     
						<option <?php echo is_select ('Hand Phone', $data['kategori']);?> value="Hand Phone">Hand Phone</option>                 
					</select>             
				</div>             
				<div class="input">                 
					<label>Harga Jual</label>                 
					<input type="text" name="harga_jual" value="<?php echo $data['harga_jual'];?>" />        
				</div>             
				<div class="input">                 
					<label>Harga Beli</label>                 
					<input type="text" name="harga_beli" value="<?php echo $data['harga_beli'];?>" />    
				</div>             
				<div class="input">                 
					<label>Stok</label>                 
					<input type="text" name="stok" value="<?php echo $data['stok'];?>" />             
				</div>             
				<div class="input">                 
					<label>File Gambar</label>   
					<label class='custom-file-upload'>
						<img src="gambar/<?php echo $data['gambar'];?>" id='gambar_display' style='width:100%'>
						<input type='file' onchange='readURL(this)' name="file_gambar" style='display: none;'>
					</label>
				</div>             
				<div class="submit">             
					<input type="hidden" name="id" value="<?php echo $data['id_barang'];?>" />    
					<input type="submit" name="submit" value="Simpan" />             
				</div>         
			</form>     
		</div> 
	</div>
	<?php require('footer.php'); ?>
<script>
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#gambar_display').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>