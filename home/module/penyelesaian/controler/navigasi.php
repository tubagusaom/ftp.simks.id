	<ul>
		<label for="penyelesaian">
			<li><i class="fa fa-external-link-square"></i>Penyelesaian</li>
		</label>
		<input type="checkbox" id="penyelesaian" name="rad" value="">
			<ul id="n_penyelesaian">
				<?php
	        $akses=$_SESSION['akses_user'];

	        if ($akses=='superuser') {
	      ?>

					<li><i class="fa fa-window-minimize"></i><a href="?Data-Anggota-Keluar&&header=<?php echo "Penyelesaian" ?>">Data</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Penyelesaian&&header=<?php echo "Penyelesaian" ?>">Detail</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Penyelesaian&&header=<?php echo "Penyelesaian" ?>">Aprove</a></li>

				<?php }elseif ($akses=='ketua' OR $akses=='analis') { ?>

					<li><i class="fa fa-window-minimize"></i><a href="?Data-Anggota-Keluar&&header=<?php echo "Penyelesaian" ?>">Data</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Penyelesaian&&header=<?php echo "Penyelesaian" ?>">Aprove</a></li>

				<?php }elseif ($akses=='admin' OR $akses=='sekertaris') { ?>

					<li><i class="fa fa-window-minimize"></i><a href="?Penyelesaian&&header=<?php echo "Penyelesaian" ?>">Detail</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Anggota-Keluar&&header=<?php echo "Penyelesaian" ?>">Data</a></li>

				<?php }else{?>

					<li><i class="fa fa-window-minimize"></i><a href="?Data-Anggota-Keluar&&header=<?php echo "Penyelesaian" ?>">Data</a></li>

				<?php }?>
			</ul>
	</ul>
