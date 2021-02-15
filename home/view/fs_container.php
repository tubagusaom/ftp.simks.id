
<div id="head">
	<label for="hide_nav">
		<div class="nav fa fa-bars"></div>
	</label>
	<div id="idbaner" class="baner">
		<?php
			if (!isset($_GET['header'])) {
				echo "";
			}else {
				echo $_GET['header'];
			}
		?>
	</div>
	<!-- <div class="alert">
		<div class="users fa fa-user">
		</div>
		<div class="bell fa fa-bell">
			<div class="on_alert"></div>
		</div>
	</div> -->
	<div class="alert">
		<!-- <a href="?Logout" onclick="return confirm('Apakah anda yakin ingin keluar ?')">
			<div class="logout fa fa-sign-out"></div>
		</a> -->
		<div class="users fa fa-user"></div>
		<div class="anggota">
			<?php
				$akun=$_SESSION['id_akun'];

				$sql_a="SELECT nm_akun AS NAMA from akun WHERE id='$akun' ";
				$query_a=mysqli_query($koneksi,$sql_a);
				$dataa=mysqli_fetch_array($query_a);

				if ($akses=='superuser') {
					echo "<font style='color:yellow'>Rumah Produktif</font>";
				}else {
					echo "$dataa[NAMA]";
				}
			?>
		</div>
		<div class="ebe-content">
	    <div class="isi-content">
				<div class="aom">
					<table>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>
								<?php
									if ($akses=='superuser') {
										echo "Rumah Produktif";
									}else {
										echo "$dataa[NAMA]";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Akses</td>
							<td>:</td>
							<td>
								<u>
									<?php

										$aksesusr = array(
											'ketua' => 'Ketua Koperasi',
											'admin' => 'Sekertaris 1',
											'sekertaris' => 'Sekertaris 2',
											'akunting' => 'Bendahara 1',
											'analis' => 'Bendahara 2',
											'superuser' => 'Superuser'
										);

										if (isset($akses)) {
											echo $aksesusr[$akses];
										}else {
											echo "Tidak Ada Akses";
										}

									?>
								</u>
							</td>
						</tr>
					</table>
				</div>
				<a href="?Logout" onclick="return confirm('Apakah anda yakin ingin keluar ?')">
					<div class="logout fa fa-sign-out" title="Logout">keluar</div>
				</a>
	    </div>
	  </div>
	</div>
</div>

<div id="conten">
	<?php
		if (!empty(get_url())) {
			include_once 'controler/modul.php';
		}else {
	?>
	<iframe style="visibility: hidden;position: absolute;left: 0; top: 0;height:100%; width:100%;border: none;" src="<?=url_tb() ?>"></iframe>
	<?php } ?>
</div>
