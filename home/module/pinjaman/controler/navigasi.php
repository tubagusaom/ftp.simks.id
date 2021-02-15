	<ul>
		<label for="pinjaman">
			<li><i class="fa fa-money"></i>Pinjaman</li>
		</label>
		<input type="checkbox" id="pinjaman" name="rad" value="">
			<ul id="n_pinjaman">

				<?php
	        $akses=$_SESSION['akses_user'];

	        if ($akses=='superuser' OR $akses=='admin'OR $akses=='sekertaris') {
	      ?>

					<li><i class="fa fa-window-minimize"></i><a href="?Pinjaman-Anggota&&header=<?php echo "Pinjaman" ?>">Tambah</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Peminjaman&&header=<?php echo "Pinjaman" ?>">Formulir</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Pinjaman&&header=<?php echo "Pinjaman" ?>">Data</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Pelunasan&&header=<?php echo "Pinjaman" ?>">Pelunasan</a></li>

				<?php }elseif ($akses=='ketua') { ?>

					<li><i class="fa fa-window-minimize"></i><a href="?Data-Peminjaman&&header=<?php echo "Pinjaman" ?>">Formulir</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Pinjaman&&header=<?php echo "Pinjaman" ?>">Data</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Pelunasan&&header=<?php echo "Pinjaman" ?>">Pelunasan</a></li>

				<?php }elseif ($akses=='analis') { ?>

					<li><i class="fa fa-window-minimize"></i><a href="?Data-Peminjaman&&header=<?php echo "Pinjaman" ?>">Formulir</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Data-Pinjaman&&header=<?php echo "Pinjaman" ?>">Data</a></li>

				<?php }else{?>

					<li><i class="fa fa-window-minimize"></i><a href="?Data-Pinjaman&&header=<?php echo "Pinjaman" ?>">Data</a></li>

				<?php }?>
			</ul>
	</ul>
