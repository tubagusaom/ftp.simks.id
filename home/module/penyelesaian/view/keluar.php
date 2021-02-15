<form class="" action="" method="post">
<table>
	<tr>
		<td colspan="8"><h1>Data Anggota Keluar</h1></td>
	</tr>

	<tr>
		<td colspan="8">
			<?php
				if (isset($_POST['submit'])) {
					if ($_POST['search']=='') {
						echo "";
					}
					else{
						echo "Pencarian berdasarkan <b>$_POST[search]</b>";
					}
				}
			?>
			<button type="submit" name="submit" class="cari">
				<i class="fa fa-search"></i>
			</button>
			<input type="text" name="search" placeholder="Nama Anggota" class="acount">
		</td>
	</tr>

	<tr align="center">
		<th>No</th>
		<th>Kode Anggota</th>
		<th>Nama</th>
		<th>Mail</th>
		<th>No Tlp</th>
		<th>dept</th>
		<th>Lokasi</th>
		<th>-</th>
	</tr>

	<?php
		if (isset($_POST['submit'])) {
			$cari=$_POST['search'];
		}else {
			$cari='';
		}

		if ($akses == "admin") {
			$wheredivisi = "AND `schm`.`id_divisi` IN ('1','2')";
		}elseif($akses == "sekertaris"){
				$wheredivisi = "AND `schm`.`id_divisi` IN ('3','4')";
		}else {
			$wheredivisi = "";
		}

		$no		  =1;
		$sql="SELECT
              `schm`.`id` AS IDSCHM,
							`schm`.`stts_schm` AS STATUS,
              `akun`.`id` AS IDAKUN,
              `akun`.`kd_akun` AS NIK,
              `akun`.`nm_akun` AS NAMA,
              `akun`.`almt_akun` AS ALAMAT,
              `akun`.`tlp_akun` AS TLP,
              `dept`.`nm_dept` AS DEPT,
              `lokasi`.`nm_lokasi` AS LOKASI
          FROM
              `schm`
          LEFT JOIN `akun` ON `schm`.`id_akun` = `akun`.`id`
          LEFT JOIN `dept` ON `schm`.`id_dept`=`dept`.`id`
          LEFT JOIN `lokasi` ON `schm`.`id_lokasi`=`lokasi`.`id`
          WHERE
              `akun`.`nm_akun` LIKE '%$cari%' AND
							`schm`.`stts_schm` LIKE '5'
							$wheredivisi
              GROUP BY IDSCHM
              ORDER BY `schm`.`id` ASC
            ";

    $query	=mysqli_query($koneksi,$sql);
    while($data=mysqli_fetch_array($query))
		{
			if(fmod($no,2)==1)
			{$warna="ghostwhite";}
			else
			{$warna="whitesmoke";}
	?>

	<tr class="hover" bgcolor="<?php echo $warna ?>">
		<td><?php echo "$no"; ?>.</td>
		<td><?=$data['NIK']?></td>
		<td><?=$data['NAMA']?></td>
		<td><?=$data['ALAMAT']?></td>
		<td><?=$data['TLP']?></td>
		<td><?=$data['DEPT']?></td>
		<td><?=$data['LOKASI']?></td>
		<td width="5%">
			<a href="?Detail-Anggota_Keluar&&statusschm=<?php echo "$data[STATUS]" ?>&&header=<?php echo "Penyelesaian" ?>&&aprove=noright&&id=<?php echo "$data[IDAKUN]" ?>&&ids=<?php echo "$data[IDSCHM]" ?>&&kodeanggota=<?php echo "$data[NIK]" ?>&&nm=<?php echo "$data[NAMA]" ?>">Detail</a>
		</td>
	</tr>

	<?php
		$no++;};
	?>

</table>
</form>
