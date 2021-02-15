<script type="text/javascript">
	function validasi_tarik( form ){
		if (form.anggota.value == "") {
			alert( "Silahkan pilih anggota.!!" );
			form.anggota.focus();
			return false ;
		}
		else if (form.user.value == "") {
			alert( "Tentukan Username.!!" );
			form.user.focus();
			return false ;
		}
		else if (form.pws.value == "") {
			alert( "Tentukan Password.!!" );
			form.pws.focus();
			return false ;
		}
		else if (form.pws.value.length < 5) {
			alert( "Password minimal 5 karakter" );
			form.pws.focus();
			return false ;
		}
		else if (form.pws.value.length > 20) {
			alert( "Password maximal 20 karakter" );
			form.pws.focus();
			return false ;
		}
		else if (form.akses.value == "") {
			alert( "Tentukan Hak Akses.!!" );
			form.akses.focus();
			return false ;
		}
  }

	function ShowHide() {
		if (document.getElementById('cek').checked) {
			document.getElementById('password').type = 'text';
		} else {
			document.getElementById('password').type = 'password';
		}
	}
</script>

<form action="?Proses-Tambah-User" onSubmit="return validasi_tarik(this)" method="post" class="form_input">
	<table>
		<tr>
			<td colspan="2"><h1>Tambah User</h1></td>
		</tr>
		<tr>
			<td>Nama Anggota</td>
			<td>
				<select name="anggota">
					<option selected value="">-</option>
					<?php
	          $sql_a="SELECT akun.id,akun.nm_akun from akun LEFT JOIN user ON akun.id = user.id_akun WHERE akun.stts_akun NOT LIKE '3' AND akun.stts_akun NOT LIKE '4' AND akun.stts_akun NOT LIKE '5' AND akun.stts_akun NOT LIKE '6' AND user.id is NULL OR user.stts_user='3' ";
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
			<td><input type="text" name="user" value=""></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<input type="password" name="pws" value="" id="password" class="password">
				<label for="cek" class="input-box fa fa-eye">
					<input type="checkbox" id="cek" name="radio2" value="on" onchange="ShowHide();"> Tampil / Sembunyikan Password
				</label>
			</td>
		</tr>
		<tr>
			<td>Hak Akses</td>
			<td>

				<select name="akses">
					<option selected value="">-</option>
					<?php
	          $sql_r="SELECT t_role.id,t_role.nama_peran,t_role.keterangan from t_role WHERE t_role.id > '3' ";
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
