	<ul>
		<label for="reff">
			<li><i class="fa fa-wrench"></i>Konfigurasi</li>
		</label>
		<input type="checkbox" id="reff" name="rad" value="">
			<ul id="n_reff">
				<?php if ($akses=='superuser') { ?>
					<li><i class="fa fa-window-minimize"></i><a href="?Detail-Akun&&header=<?php echo "Konfigurasi" ?>">Profil</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Refferensi&&header=<?php echo "Konfigurasi" ?>">General</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Hak-Akses&&header=<?php echo "Konfigurasi" ?>">HAK AKSES</a></li>
				<?php }elseif ($akses == 'ketua') { ?>
					<li><i class="fa fa-window-minimize"></i><a href="?Detail-Akun&&header=<?php echo "Konfigurasi" ?>">Profil</a></li>
					<li><i class="fa fa-window-minimize"></i><a href="?Refferensi&&header=<?php echo "Konfigurasi" ?>">General</a></li>
				<?php }else { ?>
				<li><i class="fa fa-window-minimize"></i><a href="?Detail-Akun&&header=<?php echo "Konfigurasi" ?>">Profil</a></li>
				<?php } ?>
			</ul>
	</ul>
