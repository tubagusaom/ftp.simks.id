<script type="text/javascript">
	function ShowHide() {
		if (document.getElementById('cek').checked) {
			document.getElementById('password').type = 'text';
		} else {
			document.getElementById('password').type = 'password';
		}
	}
</script>

<form action="?Proses-Edit-User" method="post" class="form_input">
	<table>
		<tr>
			<td colspan="2"><h1>Ubah User</h1></td>
		</tr>
		<tr>
			<td>Nama Anggota</td>
			<td>
				<select name="anggota" required>
					<option value='<?php echo $_GET['akun'] ?>' selected>
						<?php
							$idakun=$_GET['akun'];
							$sql_aa="SELECT id,nm_akun FROM akun WHERE id='$idakun'";
							$query_aa=mysqli_query($koneksi,$sql_aa);
							$dataaa=mysqli_fetch_array($query_aa);

							echo "$dataaa[1]";
						?>
					</option>
					<?php
	          $sql_a="SELECT akun.id,akun.nm_akun from akun LEFT JOIN user ON akun.id = user.id_akun WHERE akun.stts_akun NOT LIKE '3' AND user.id is NULL  ";
	          $query_a=mysqli_query($koneksi,$sql_a);
	          while($dataa=mysqli_fetch_array($query_a))
	          {
	            echo "<option value='$dataa[0]'>$dataa[1]</option>";
	          };
	        ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Username</td>
			<td>
				<input type="hidden" name="acuan" value="<?php echo $_GET['id']; ?>">
				<input type="hidden" name="akun" value="<?php echo $_GET['akun']; ?>">
				<input type="text" name="user" value="<?php echo $_GET['user']; ?>" required>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<input type="password" name="pws" value="<?php echo $_GET['pw']; ?>" required id="password">
				<label for="cek" class="input-box fa fa-eye">
					<input type="checkbox" id="cek" name="radio2" value="on" onchange="ShowHide();"> Tampil / Sembunyikan Password
				</label>
			</td>
		</tr>
		<tr>
			<td>Hak Akses</td>
			<td>
				<select name="akses" required>

					<?php
						$akses = $_GET['aks'];

						$kdakses = array(
							'ketua' => '4',
							'admin' => '5',
							'sekertaris' => '16',
							'akunting' => '17',
							'analis' => '18',
							'anggota' => '19'
						);
					?>

					<option value="<?php echo $kdakses[$akses]; ?>" selected>
						<?php
							$aksesuser = array(
								'ketua' => 'Ketua Koperasi',
								'admin' => 'Sekretaris 1',
								'sekertaris' => 'Sekretaris 2',
								'akunting' => 'Bendahara 2',
								'analis' => 'Bendahara 1',
								'anggota' => 'Anggota Koperasi'
							);

							if (isset($aksesuser[$akses])) {
								echo $aksesuser[$akses];
							}else {
								echo "Tidak Ada Akses";
							};
						?>
					</option>

					<?php
	          $sql_r="SELECT t_role.id,t_role.nama_peran,t_role.keterangan FROM `t_role`
											WHERE t_role.id > '3' AND t_role.nama_peran NOT LIKE '$akses'
									 ";
	          $query_r=mysqli_query($koneksi,$sql_r);
	          while($datar=mysqli_fetch_array($query_r))
	          {
	            echo "<option value='$datar[0]'>$datar[2]</option>";
	          };
	        ?>

				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="simpan" value="Simpan">
			</td>
		</tr>
	</table>
</form>
