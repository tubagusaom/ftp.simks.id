	<ul>
		<label for="lokasi">
			<li><i class="fa fa-building"></i>Lokasi</li>
		</label>
		<input type="checkbox" id="lokasi" name="rad" value="">
			<ul id="n_lokasi">
				<?php if ($akses=='superuser' OR $akses=='ketua') { ?>
				<li><i class="fa fa-window-minimize"></i><a href="?Input-Lokasi&&header=<?php echo "Lokasi" ?>">Tambah</a></li>
				<li><i class="fa fa-window-minimize"></i><a href="?Data-Lokasi&&header=<?php echo "Lokasi" ?>">Data</a></li>
				<?php }else { ?>
				<li><i class="fa fa-window-minimize"></i><a href="?Data-Lokasi&&header=<?php echo "Lokasi" ?>">Data</a></li>
				<?php } ?>
			</ul>
	</ul>
