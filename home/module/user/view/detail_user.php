<table>
	<tr>
		<td colspan="5"><h1>Data User</h1></td>
	</tr>

	<tr>
		<th>No</th>
		<th>Nama User</th>
		<th>Username</th>
		<th>Hak Akses</th>
		<th align="center">-</th>
	</tr>

	<?php

		$no=1;
		$akses=$_SESSION['akses_user'];

		if ($akses=='superuser') {
			$limit = "";
		}
		elseif ($akses=='ketua') {
			$limit = "limit 1,1000";
		}

		$sql	= mysqli_query($koneksi,"SELECT
				a.*,
				b.kd_user AS id_user,
				b.kd_role AS akses,
				c.keterangan AS namaakses
			FROM user a
			JOIN t_user_role b ON b.kd_user = a.id
			JOIN t_role c ON c.id = b.kd_role
			WHERE stts_user NOT LIKE '3' AND a.stts_user NOT LIKE '4' AND a.stts_user NOT LIKE '5' AND a.stts_user NOT LIKE '6'
			ORDER BY akses ASC $limit
		");

		while($data=mysqli_fetch_array($sql))
		{
			if(fmod($no,2)==1)
			{$warna="ghostwhite";}
			else
			{$warna="whitesmoke";}

			$sqls	  ="SELECT * FROM akun where id=$data[6]";
			$querys	=mysqli_query($koneksi,$sqls);
			$datas	=mysqli_fetch_array($querys);
	?>

	<tr class="hover" bgcolor="<?php echo $warna ?>">
		<td><?php echo $no; ?>.</td>
		<td>
			<?php
				if ($data[3]=='superuser') {
					echo "Rumah Produktif";
				}else {
					echo "$datas[2]";
				}
			?>
		</td>
		<td><?php echo "$data[1]"; ?></td>
		<td>
			<?php

				if (isset($data['akses'])) {
					echo $data['namaakses'];
				}else {
					echo "Tidak Ada Akses";
				}

			?>
		</td>
		<td align="center" width="14%">
			<?php if ($data[3]=='superuser') { ?>
			<font style="color:red; font-weight:700">No Action</font>
			<?php }else{ ?>
			<a href="?Edit-User&&header=<?php echo "User" ?>&&id=<?php echo "$data[0]" ?>&&user=<?php echo "$data[1]" ?>&&pw=<?php echo "$data[7]" ?>&&aks=<?php echo "$data[3]" ?>&&akun=<?php echo "$data[6]" ?>">Edit</a> |
			<a href="?Hapus-User&&id=<?php echo "$data[0]" ?>" onclick="return confirm('apakah anda yakin ?')">Hapus</a> |
			<a href="?Reset-Password&&id=<?php echo "$data[0]" ?>" onclick="return confirm('Password akan direset ?')">Reset</a>
			<?php } ?>
		</td>
	</tr>

	<?php
		$no++;};
	?>

</table>
