<form class="" action="?Proses-Akses" method="post" class="form_input">
  <table>
  	<tr>
  		<td colspan="4"><h1>HAK AKSES</h1></td>
  	</tr>

    <tr>
  		<td colspan="4">
        <?php if (isset($_GET['Akses'])=='Addakses') {echo "";}else{ ?>
          <a href="?Hak-Akses&&header=Akses&&Akses=Addakses">
            <input type="button" name="simpan" value="TAMBAH" style="width: 100%;">
          </a>
        <?php } ?>
  		</td>
  	</tr>

    <?php if (isset($_GET['Akses'])=='Addakses') { ?>
    <tr>
      <td colspan="8">
        <table style="margin-top:0px;margin-bottom:15px">
          <tr>
      			<td>User</td>
      			<td>
      				<select name="akses" required oninvalid="this.setCustomValidity('Silahkan Pilih User')" oninput="setCustomValidity('')">
      					<option value="" selected>-</option>
      					<?php
                  $sql_a=
                      "SELECT
                        user.id,
                        user.akses_user,
                        user.id_akun,
                        akun.nm_akun
                        FROM user
                        JOIN akun ON akun.id = user.id_akun
                        WHERE user.stts_user NOT LIKE '3' AND
                              user.stts_user NOT LIKE '5' AND
                              user.akses_user NOT LIKE 'superuser'
                      ";
      	          $query_a=mysqli_query($koneksi,$sql_a);
      	          while($dataa=mysqli_fetch_array($query_a))
      	          {
                    if ($dataa[1]=='ketua'){
              				$akses_user = "Ketua Koperasi";}
              			elseif ($dataa[1]=='admin'){
              				$akses_user =  "Sekretaris 1";}
              			elseif ($dataa[1]=='sekertaris'){
              				$akses_user =  "Sekretaris 2";}
              			elseif ($dataa[1]=='akunting'){
              				$akses_user =  "Bendahara 2";}
              			elseif ($dataa[1]=='analis'){
              				$akses_user =  "Bendahara 1";}
              			elseif ($dataa[1]=='superuser'){
              				$akses_user =  "Superuser";}
              			else{
              				$akses_user =  "Tidak Ada Akses";}

      	            echo "<option value='$dataa[0]'>$akses_user</option>";
      	          };
      	        ?>
      				</select>
      			</td>
      		</tr>
      		<tr>
      			<td>Divisi</td>
      			<td>
              <select name="divisi" required oninvalid="this.setCustomValidity('Silahkan Pilih Divisi')" oninput="setCustomValidity('')">
      					<option value="" selected>-</option>
                <?php
                  $sql_b=
                      "SELECT
                        divisi.id,
                        divisi.nm_divisi
                        FROM divisi
                        WHERE divisi.stts_divisi LIKE '1' OR
                              divisi.stts_divisi LIKE '2'
                      ";
                  $query_b=mysqli_query($koneksi,$sql_b);
                  while($datab=mysqli_fetch_array($query_b))
                  {
                    echo "<option value='$datab[0]'>$datab[1]</option>";
      	          };
                ?>
      				</select>
      			</td>
      		</tr>
      		<tr>
      			<td colspan="2">
      				<input type="submit" name="simpan" value="Simpan">
              <a href="?Hak-Akses&&header=<?php echo "Account" ?>">
                <input type="button" name="simpan" value="Batal" class="bback">
              </a>
      			</td>
      		</tr>
      	</table>
      </td>
    </tr>
    <?php }else{echo "";} ?>
  </table>
</form>

<table>
  <tr>
    <th>No</th>
    <th>User</th>
    <th>Divisi</th>
    <th align="center">-</th>
  </tr>

  <?php

		$no		  =1;
    // SELECT a.id, a.name,b.id FROM tutorials_inf a
		$sql_ca	  =
              "SELECT
                  a.id,
                  a.id_user,
                  a.id_divisi,
                  b.akses_user as nmuser,
                  c.nm_divisi as nmdivisi
                FROM conf_akses a
                JOIN user b ON b.id = a.id_user
                JOIN divisi c ON c.id = a.id_divisi
                WHERE a.stts_akses NOT LIKE '3'
                ORDER BY id ASC
              ";
		$query_ca	=mysqli_query($koneksi,$sql_ca);
		while($data_ca=mysqli_fetch_array($query_ca)){

			if(fmod($no,2)==1)
			{$warna="ghostwhite";}
			else
			{$warna="whitesmoke";}

      if ($data_ca['nmuser']=='ketua'){
        $aksesuser = "Ketua Koperasi";}
      elseif ($data_ca['nmuser']=='admin'){
        $aksesuser =  "Sekretaris 1";}
      elseif ($data_ca['nmuser']=='sekertaris'){
        $aksesuser =  "Sekretaris 2";}
      elseif ($data_ca['nmuser']=='akunting'){
        $aksesuser =  "Bendahara 2";}
      elseif ($data_ca['nmuser']=='analis'){
        $aksesuser =  "Bendahara 1";}
      elseif ($data_ca['nmuser']=='superuser'){
        $aksesuser =  "Superuser";}
      else{
        $aksesuser =  "Tidak Ada Akses";}
	?>

  <tr class="hover" bgcolor="<?php echo $warna ?>">
		<td><?php echo $no; ?>.</td>
		<td><?php echo "$aksesuser"; ?></td>
		<td>
			<?php
				echo "$data_ca[nmdivisi]";
        $nmdivisi = str_replace('&', 'and', $data_ca['nmdivisi']);
			?>
		</td>

		<?php if ($akses=='admin'){echo "";}else { ?>
		<td align="center">
			<a
        href=
          "?Edit-Akses&&header=<?='Akses'?>&&id=<?=$data_ca['id']?>&&user=<?=$data_ca['id_user']?>&&nmuser=<?=$aksesuser?>&&divisi=<?=$data_ca['id_divisi']?>&&nmdivisi=<?=$nmdivisi?>"
      >
        Edit
      </a>
		</td>
		<?php } ?>
	</tr>

	<?php
		$no++;};
	?>
</table>
