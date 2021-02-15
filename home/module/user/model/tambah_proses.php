<?php //*fungsi simpan
	if (isset($_POST['simpan']))
	{
		date_default_timezone_set('Asia/Jakarta');
		$agt		=$_POST['anggota'];
		$usr		=$_POST['user'];
		$pw			=$_POST['pws'];
		$aks		=$_POST['akses'];
		$date	=date("Y-m-d H:i:s");
		$pwmd5 = md5($pw);

		$aksesr = array(
			'4' => 'ketua',
			'5' => 'admin',
			'16' => 'sekertaris',
			'17' => 'akunting',
			'18' => 'analis',
			'19' => 'anggota'
		);

		$akses = $aksesr[$aks];

		// echo $agt;
		// echo "$pwmd5";

		$sqluser="SELECT id FROM user WHERE id_akun='$agt' ORDER BY id DESC";
		$queryuser=mysqli_query($koneksi,$sqluser);
		$datauser=mysqli_fetch_array($queryuser);

		$sql="INSERT INTO user (`id`, `kd_user`, `pw_user`, `akses_user`, `stts_user`, `c_user`, `id_akun`, `pw_asli`) VALUES('','$usr','$pwmd5','$akses',1,'$date','$agt','$pw')";
		$query=mysqli_query($koneksi,$sql);


		if ($query === TRUE) {
			$id_user = $koneksi->insert_id;
			$sqlr="INSERT INTO t_user_role (`id`, `kd_user`, `kd_role`, `stts_ur`, `c_ur`) VALUES('','$id_user','$aks',1,'$date')";
			$queryr=mysqli_query($koneksi,$sqlr);

			if (isset($datauser)) {
				$sqls="UPDATE user SET stts_user='4' where id='$datauser[0]'";
				$querys=mysqli_query($koneksi,$sqls);
			}else {echo "";}

			echo "<script>alert('User Berhasil Ditambahkan'); location.href='?Data-User&&header=User';</script>";
		}else {
			echo "<script>alert('User Gagal Ditambahkan, pastikan username belum pernah digunakan sebelumnya.!'); location.href='?Input-User&&header=User'</script>";
		}
	};
?>
