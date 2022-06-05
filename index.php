<?php include("koneksi.php");

$sql = 'SELECT * FROM data_barang'; 
$result = mysqli_query($conn, $sql); 

require('header.php');
?> 
		<h1>Data Barang</h1> 
		<a class="link" href="tambah.php"> Tambah Barang</a>        
		<div class="main">             
			<table border="1" cellpadding="4" cellspacing="0">             
				<tr>                 
					<th>Gambar</th>                 
					<th>Nama Barang</th>                 
					<th>Katagori</th>                 
					<th>Harga Beli</th>                 
					<th>Harga Jual</th>                 
					<th>Stok</th>                 
					<th>Aksi</th>           
				</tr>             
				<?php if($result): ?>             
					<?php while($row = mysqli_fetch_array($result)): ?>             
						<tr>                 
							<td style="width: 30%;"><img src="gambar/<?= $row['gambar'];?>" alt="<?= $row['nama'];?>" style="width: 100%;"></td>       
							<td><?= $row['nama'];?></td>                 
							<td><?= $row['kategori'];?></td>                 
							<td><?= $row['harga_beli'];?></td>                 
							<td><?= $row['harga_jual'];?></td>                 
							<td><?= $row['stok'];?></td>                 
							<td><a href="ubah.php?id=<?php echo $row['id_barang']
							; ?>"> Ubah</a>
							<a href="hapus.php?id=<?php echo $row['id_barang']
							; ?>" >Hapus</a></td>
						</tr>         
					<?php endwhile; else: ?>             
					<tr>                 
						<td colspan="7">Belum ada data</td>             
					</tr>             
				<?php endif; ?>             
			</table>         
		</div>     
	</div>
<?php require('footer.php'); ?>