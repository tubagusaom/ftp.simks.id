<form class="" action="" method="post">
<table>
	<tr>
		<td colspan="11"><h1>Data Formulir Peminjaman</h1></td>
	</tr>

	<tr align="center">
		<th rowspan="2">No</th>
		<th rowspan="2">Kode Anggota</th>
		<th rowspan="2">Nama</th>
		<th rowspan="2">Jumlah Uang</th>
		<th rowspan="2">Tanggal Transfer</th>
		<th colspan="3">Rekening</th>
		<th rowspan="2">Dilunasi Selama</th>
		<th rowspan="2">Jasa Koprasi</th>
		<th rowspan="2" align="center">-</th>
	</tr>
	<tr align="center">
		<th>Bank</th>
		<th>Norek</th>
		<th>Pemilik</th>
	</tr>

	<?php
		$no		  =1;

    if ($akses=='superuser') {
      $ketentuan_where="";
    }elseif ($akses=='ketua') {
      $ketentuan_where="WHERE a.ket_pinjam NOT LIKE '1' AND a.ket_pinjam NOT LIKE '2'";
    }elseif ($akses=='analis') {
      $ketentuan_where="WHERE a.ket_pinjam NOT LIKE '1' AND a.ket_pinjam NOT LIKE '3'";
    }else if ($akses=="admin") {
			$ketentuan_where="WHERE b.id_divisi IN ('1','2')";
		}elseif ($akses=="sekertaris"){
			$ketentuan_where="WHERE b.id_divisi IN ('3','4')";
		}else {
			$ketentuan_where="WHERE a.ket_pinjam NOT LIKE '1' AND a.ket_pinjam NOT LIKE '2' AND a.ket_pinjam NOT LIKE '3' AND schm.id_divisi IN ('0')";
		}

		$sql	  ="SELECT
								a.*
							FROM
								pinjam_them a
							JOIN schm b ON b.id = a.id_schm
							$ketentuan_where
							ORDER BY a.id DESC";
		$query	=mysqli_query($koneksi,$sql);
		while($data=mysqli_fetch_array($query))
		{
			if(fmod($no,2)==1)
			{$warna="ghostwhite";}
			else
			{$warna="whitesmoke";}

			$sqla	  ="SELECT * FROM schm WHERE id=$data[11] AND stts_schm NOT LIKE '3'";
			$querya	=mysqli_query($koneksi,$sqla);
			$dataa	=mysqli_fetch_array($querya);

			$sqlb	  ="SELECT * FROM akun WHERE id=$dataa[11] AND stts_akun NOT LIKE '3'";
			$queryb	=mysqli_query($koneksi,$sqlb);
			$datab	=mysqli_fetch_array($queryb);
	?>

	<tr class="hover" bgcolor="<?php echo $warna ?>">
		<td><?php echo "$no"; ?>.</td>
		<td><?php echo "$datab[1]"; ?></td>
		<td><?php echo "$datab[2]"; ?></td>
		<td align="right">
			<?php
				$rupiah1=number_format($data[1],0,',','.');
				echo "$rupiah1";
			?>
		</td>
		<td align="center">
			<?php
				$a=substr($data[3],8);
				$b=substr($data[3],5,2);
				$c=substr($data[3],0,4);

				echo "$a-$b-$c";
			?>
		</td>
		<td><?php echo "$data[4]"; ?></td>
		<td><?php echo "$data[5]"; ?></td>
		<td><?php echo "$data[6]"; ?></td>
		<td align="right"><?php echo "$data[7]"; ?> Bulan</td>
		<td align="right"><?php echo "$data[8]"; ?> %</td>
		<td align="center">
			<?php if ($akses=='superuser') { ?>

      <a href="?Edit-Pinjaman&&header=<?php echo "Pinjaman" ?>&&idp=<?php echo "$data[0]" ?>&&kda=<?php echo "$datab[1]" ?>&&nm=<?php echo "$datab[2]" ?>&&sp=<?php echo "$data[1]" ?>&&sw=<?php echo "$data[2]" ?>&&sr=<?php echo "$data[3]" ?>&&bank=<?php echo "$data[4]" ?>&&norek=<?php echo "$data[5]" ?>&&an=<?php echo "$data[6]" ?>&&jangka=<?php echo "$data[7]" ?>&&jasa=<?php echo "$data[8]" ?>">Edit</a> |
      <a href="?Hapus-Pinjaman&&header=<?php echo "Pinjaman" ?>&&kode=<?php echo "$data[0]" ?>&&kodes=<?php echo "$dataa[0]" ?>" onclick="return confirm('Data peminjaman <?php echo "$datab[2]"; ?> akan dihapus ???')">Hapus</a> |
			<a href="?Detail-Peminjaman&&header=<?php echo "Pinjaman" ?>&&kode=<?php echo "$data[0]" ?>">Detail</a>

      <?php
        }elseif ($akses=='admin') {
          if ($data[9]!=1) {
            echo "";
          }else{
      ?>

      <a href="?Edit-Pinjaman&&header=<?php echo "Pinjaman" ?>&&idp=<?php echo "$data[0]" ?>&&kda=<?php echo "$datab[1]" ?>&&nm=<?php echo "$datab[2]" ?>&&sp=<?php echo "$data[1]" ?>&&sw=<?php echo "$data[2]" ?>&&sr=<?php echo "$data[3]" ?>&&bank=<?php echo "$data[4]" ?>&&norek=<?php echo "$data[5]" ?>&&an=<?php echo "$data[6]" ?>&&jangka=<?php echo "$data[7]" ?>&&jasa=<?php echo "$data[8]" ?>">Edit</a> |
      <a href="?Hapus-Pinjaman&&header=<?php echo "Pinjaman" ?>&&kode=<?php echo "$data[0]" ?>&&kodes=<?php echo "$dataa[0]" ?>" onclick="return confirm('Data peminjaman <?php echo "$datab[2]"; ?> akan dihapus ???')">Hapus</a> |

      <?php
        }
      ?>

      <a href="?Detail-Peminjaman&&header=<?php echo "Pinjaman" ?>&&kode=<?php echo "$data[0]" ?>">Detail</a>

      <?php
        }else{

      ?>
      <a href="?Detail-Peminjaman&&header=<?php echo "Pinjaman" ?>&&kode=<?php echo "$data[0]" ?>&&kodea=<?php echo "$datab[1]"?>&&namaa=<?php echo "$datab[2]"?>&&jp=<?php echo "$data[1]"?>&&angsur=<?php echo "$data[7]"?>&&jasa=<?php echo "$data[8]"?>&&ketpinjam=<?php echo "$data[9]"?>">Detail</a>

      <?php } ?>
		</td>
	</tr>

	<?php
		$no++;};
	?>

</table>
</form>
