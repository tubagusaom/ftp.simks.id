<style media="screen">
  .input_blocked{
    font-weight:600;
    font-size: 12px;
    background:transparent;
    border: 1px solid transparent!important;
  }
</style>

<form action="?Proses-Edit-Akses" method="post" class="form_input">
	<table>
		<tr>
			<td colspan="2"><h1>Edit Akses</h1></td>
		</tr>
		<tr>
			<td> User </td>
			<td>
				<input type="hidden" name="acuan_kode" value="<?= $_GET['id']; ?>">
        <input type="hidden" name="id_user" value="<?= $id_user = $_GET['user']; ?>">
        <input type="hidden" name="url_get" value="<?=get_url() ?>">
        <!-- <i class='fa fa-ban'></i> -->
        <input type="text" name="nm_user" class="input_blocked" value="<?= $_GET['nmuser']; ?>" readonly>
			</td>
		</tr>
    <tr>
      <td>Divisi</td>
      <td>
        <select name="id_divisi">
          <?= $iddv=$_GET['divisi'] ?>
          <option value="<?= $iddv; ?>"><?= $_GET['nmdivisi']; ?></option>
          <?php
            $sqlc_akses="SELECT
                        a.id,
                        a.id_user,
                        a.id_divisi
                      FROM conf_akses a
                      JOIN user b ON b.id = a.id_user
                      WHERE
                            a.id_divisi NOT LIKE $iddv AND
                            a.id_user NOT LIKE $id_user
                    ";

  	          $queryc_akses=mysqli_query($koneksi,$sqlc_akses);
              while($datac_akses=mysqli_fetch_array($queryc_akses)){

              $sql_d="SELECT
                    divisi.id,
                    divisi.nm_divisi
                  FROM divisi
                  WHERE
                        -- divisi.id NOT LIKE $iddv AND
                        divisi.id = $datac_akses[id_divisi] AND
                        divisi.stts_divisi NOT LIKE '3'
              ";
              $query_d=mysqli_query($koneksi,$sql_d);
  	          while($data_d=mysqli_fetch_array($query_d))
  	          {
                echo "<option value='$data_d[id]'>$data_d[nm_divisi]</option>";
  	          };

            };
	        ?>
        </select>
      </td>
		</tr>

	</table>
  <table>
    <tr>
      <td>
        <a href="?Hak-Akses&&header=Konfigurasi">
  			   <input style="width:100%" type="button" class="bback" name="ubah" value="Kembali">
        </a>
  		</td>
      <td>
				<input style="width:100%" type="submit" name="ubah" value="Edit Akses">
			</td>
		</tr>
  </table>
</form>
