<ul>
	<label for="laporan">
		<li><i class="fa fa-book"></i>Laporan</li>
	</label>
	<input type="checkbox" id="laporan" name="BB" value="">
		<ul id="n_laporan">
				<li><i class="fa fa-window-minimize"></i><a href="?Buku-Besar&&header=<?php echo "Laporan" ?>">Buku Besar</a></li>
				<li><i class="fa fa-window-minimize"></i><a href="?Neraca-Lajur&&header=<?php echo "Laporan" ?>">Neraca Lajur</a></li>
				<li><i class="fa fa-window-minimize"></i><a href="?Neraca&&header=<?php echo "Laporan" ?>">Neraca</a></li>
				<li><i class="fa fa-window-minimize"></i><a href="?Laba-Rugi&&header=<?php echo "Laporan" ?>">Laba-Rugi</a></li>
				<?php if ($akses=='superuser') { ?>
				<li><i class="fa fa-window-minimize"></i><a href="?Konfigurasi-Laporan&&header=<?php echo "Laporan" ?>">Konfigurasi</a></li>
				<?php }else { echo ""; } ?>
			</ul>
	</ul>
