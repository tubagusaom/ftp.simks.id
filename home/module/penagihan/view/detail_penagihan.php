<script language="JavaScript" type="text/javascript">

    function checkform ( form ) {
			if (form.tape.value == "") {
        alert( "Tentukan Tanggal Periode Penagihan.!!" );
        form.tape.focus();
        return false ;
      }
      // else if (form.ComPany.value == "") {
      //   alert( "xxxxx.!!" );
      //   form.ComPany.focus();
      //   return false ;
      // }
      return true ;
    }

    function cetak() {

      var comP = document.getElementById("ComPany").value;
      var TaPe = document.getElementById("TaPe").value;

      var e = document.getElementById("ComPany");
      var strComp = e.options[e.selectedIndex].text;

      var vaL = 'period='+TaPe+'&&comp='+comP+'&&company='+strComp;

      if (document.forms[0][0].value=='') {
        return alert('Pastikan tanggal periode dan Company sudah terisi');
      }else {
        // return window.open('module/penagihan/view/cetak.php?Penagihan=Cetak&&period='+TaPe,'_blank');
        window.open('module/penagihan/view/cetak.php?Penagihan=Cetak&&'+vaL, '_blank');
      }
    }

    function ebe() {

      var comP = document.getElementById("ComPany").value;
      var TaPe = document.getElementById("TaPe").value;

      var e = document.getElementById("ComPany");
      var strComp = e.options[e.selectedIndex].text;

      var vaL = 'period='+TaPe+'&&comp='+comP+'&&company='+strComp;

      if (document.forms[0][0].value=='') {
        return alert('Pastikan tanggal periode dan Company sudah terisi !');
      }else {
        return window.open('module/penagihan/view/cetak.php?Penagihan=Export&&'+vaL,'_blank');
      }
    }
</script>

<form  action="?Proses-Aprove" method="post" onsubmit="return checkform(this);">
<table>
	<tr>
		<td colspan="9"><h1>Data Skema Penagihan</h1></td>
	</tr>

  <?php

  if ($akses=='superuser'){
    $acuan="";
  }elseif ($akses=='ketua'){
    $acuan="AND `schm`.`ket_schm` NOT LIKE '1'";
  }elseif ($akses=='analis'){
    $acuan="AND `schm`.`ket_schm` NOT LIKE '2'";
  }else{
    $acuan="AND ket_schm NOT LIKE '1' AND ket_schm NOT LIKE '2'";
  }

  $sql="SELECT
            `schm`.`id` AS IDSCHM,
            `akun`.`id` AS IDAKUN,
            `akun`.`kd_akun` AS NIK,
            `akun`.`nm_akun` AS nama,
            IF(MAX(`trans_simpan`.`id`) IS NULL,`schm`.`p_schm`,0) AS pokok,
            `schm`.`w_schm` AS wajib,
            `schm`.`s_schm` AS sukarela,
            IF(`pinjam`.`ket_pinjam` = '1','aktif','nonaktif'),
            IF(`pinjam`.`ket_pinjam` = '1',`pinjam`.`jumlah_pinjam` * (`jasa_pinjam` / 100) / `jangka_pinjam`,0) AS jasa,

            -- IF(`pinjam`.`ket_pinjam` = '1',`pinjam`.`jumlah_pinjam` / `pinjam`.`jangka_pinjam`,0) AS cicil,
            CASE
              WHEN `pinjam`.`ket_pinjam` = '1'
                THEN
                  `pinjam`.`jumlah_pinjam` / `pinjam`.`jangka_pinjam`
              WHEN `pinjam`.`ket_pinjam` = '2'
                THEN
                  -- IF(MAX(`trans_pinjam`.`id`) IS NULL,
                  --   `pinjam`.`jumlah_pinjam` / `pinjam`.`jangka_pinjam`,
                  --   (`pinjam`.`jumlah_pinjam` / `pinjam`.`jangka_pinjam`) * MAX(`trans_pinjam`.`angsur_pinjam`)
                  -- )

                  (`pinjam`.`jumlah_pinjam` / `pinjam`.`jangka_pinjam`) * `pinjam`.`jangka_pinjam`
              ELSE 0
            END AS cicil

        FROM
            `schm`
        LEFT JOIN `akun` ON `schm`.`id_akun` = `akun`.`id`
        LEFT JOIN `trans_simpan` ON `schm`.`id`=`trans_simpan`.`id_schm`
        LEFT JOIN `pinjam` ON `schm`.`id` = `pinjam`.`id_schm`
        LEFT JOIN `trans_pinjam` ON `pinjam`.`id`=`trans_pinjam`.`id_pinjam`
        WHERE
            `pinjam`.`id` IS NULL AND
            `schm`.`stts_schm` NOT LIKE '3' AND
            `schm`.`stts_schm` NOT LIKE '4' AND
            `schm`.`stts_schm` NOT LIKE '5' AND
            `schm`.`stts_schm` NOT LIKE '6'
            $acuan OR
            `pinjam`.`ket_pinjam` NOT LIKE '4' AND
            `schm`.`stts_schm` NOT LIKE '3' AND
            `schm`.`stts_schm` NOT LIKE '4' AND
            `schm`.`stts_schm` NOT LIKE '5' AND
            `schm`.`stts_schm` NOT LIKE '6'
            $acuan
            GROUP BY IDSCHM
          ";

  $query	  =mysqli_query($koneksi,$sql);
  $cekdata	=mysqli_num_rows($query);

  ///////////// TANGGAL PERIODE /////////////
  $sqltgl="SELECT efv_simpan AS TANGGALPERIODE FROM trans_simpan ORDER BY id DESC";
  $querytgl=mysqli_query($koneksi,$sqltgl);
  $datatgl=mysqli_fetch_array($querytgl);

  $pqr=$datatgl['TANGGALPERIODE'];

  $datepqr = mktime(0,0,0,date("m",strtotime($pqr))+1,date("d",strtotime($pqr)),date("Y",strtotime($pqr)));
  $tglakhir=date("Y-m-28", $datepqr);
  ///////////// TANGGAL PERIODE /////////////

  if ($cekdata==0) {
    echo "";
  }else {
?>

	<tr>
		<td colspan="6" style="border-bottom:2px solid #999;">Tanggal Periode :</td>
		<td colspan="3" align="left" style="border-bottom:2px solid #999">
			<input type="date" id="TaPe" name="tape" value="<?php echo $tglakhir ?>" placeholder="format Thn-Bln-Tgl ( Contoh:1945-08-17 )">
		</td>
	</tr>

  <tr>
		<td colspan="6" style="border-bottom:2px solid #999;">Company :</td>
		<td colspan="3" align="left" style="border-bottom:2px solid #999">
      <select id="ComPany" name="comp">
        <option value="" selected>-</option>
        <?php
          $sql_c="select * from company WHERE stts_comp NOT LIKE '3'";
          $query_c=mysqli_query($koneksi,$sql_c);
          while($datac=mysqli_fetch_array($query_c))
          {
            echo "<option value='$datac[0]'>$datac[1]</option>";
          };
        ?>
      </select>
		</td>
	</tr>

	<tr>
		<td colspan="3">
      <?php
        if ($akses=='superuser' OR $akses=='ketua') {
          echo "* Harap dicetak dahulu sebelum di aprove";
        }else {
          echo "* Harap export dahulu sebelum di kirim";
        }
      ?>
    </td>
		<td colspan="6">
      <?php if ($akses=='superuser') { ?>

      <input type="submit" name="aprove" value="Aprove" onclick="return confirm('Data akan diaprove! Apakah data sudah dicetak ???')">

      <input type="submit" name="kirim" value="Kirim" onclick="return confirm('Data akan dikirim! Apakah data sudah diexport ???')" style="margin-right:5px">

      <a onclick="ebe()">
				<input type="button" name="export" value="export" class="export">
			</a>

      <a onclick="cetak()">
				<input type="button" name="cetak" value="Cetak">
			</a>

      <?php }elseif ($akses=='ketua') { ?>

			<input type="submit" name="aprove" value="Aprove" onclick="return confirm('Data akan diaprove! Apakah data sudah dicetak ???')">

      <a onclick="cetak()">
				<input type="button" name="cetak" value="Cetak">
			</a>

    <?php }elseif ($akses=='analis') { ?>

      <input type="submit" name="kirim" value="Kirim" onclick="return confirm('Data akan dikirim! Apakah data sudah diexport ???')">

      <a onclick="ebe()">
				<input type="button" name="export" value="export" class="export">
			</a>

    <?php }else {echo "Tera_Byte_";}?>
		</td>
	</tr>

  <?php } ?>

	<tr align="center">
		<th rowspan="2">No</th>
		<th rowspan="2">Kode Anggota</th>
		<th rowspan="2">Nama</th>
		<th rowspan="2">Simpanan Pokok</th>
		<th colspan="2">Simpanan</th>
		<th colspan="2">Pinjaman</th>
		<th rowspan="2">Total</th>
	</tr>
	<tr align="center">
		<th>Wajib</th>
		<th>Sukarela</th>
		<th>Pokok</th>
		<th>Jasa Koperasi</th>
	</tr>

	<?php
		$no		  =1;
		$sb			=0;
    $SUM['pokok']     = 0;
    $SUM['wajib']     = 0;
    $SUM['sukarela']  = 0;
    $SUM['cicil']     = 0;
    $SUM['jasa']      = 0;
		while($data=mysqli_fetch_array($query))
		{
			if(fmod($no,2)==1)
			   {$warna="ghostwhite";}
			else
			   {$warna="whitesmoke";}
	?>

  <tr class="hover" bgcolor="<?=$warna?>">
		<td><?=$no?>.</td>
		<td width="10%"><?=$data['NIK']?></td>
		<td>
      <?=$data['nama']?>
    </td>
		<td align="right" width="13%"><?=number_format($data['pokok'],0,',','.')?></td>
    <?php $SUM['pokok']+=$data['pokok'] ?>
		<td align="right" width="10%"><?=number_format($data['wajib'],0,',','.')?></td>
    <?php $SUM['wajib']+=$data['wajib'] ?>
		<td align="right" width="10%"><?=number_format($data['sukarela'],0,',','.')?></td>
    <?php $SUM['sukarela']+=$data['sukarela'] ?>
    <td align="right" width="10%"><?=number_format($data['cicil'],0,',','.')?></td>
    <?php $SUM['cicil']+=$data['cicil'] ?>
    <td align="right" width="10%"><?=number_format($data['jasa'],0,',','.')?></td>
    <?php $SUM['jasa']+=$data['jasa'] ?>
    <td align="right">
      <?php
        $jumlah=$data['pokok']+$data['wajib']+$data['sukarela']+$data['cicil']+$data['jasa'];

        echo number_format($jumlah,0,',','.');

        $sb += $jumlah;
      ?>
    </td>
	</tr>

	<?php
		$no++;};
    if ($cekdata==0) {
	?>

  <tr align="center" bgcolor="whitesmoke" style="color:darkblue">
    <td colspan="9">
      <i style="font-size:13px; text-shadow:0px 1px 0px red">
        TUNGGU DATA PENAGIHAN PERIODE BERIKUTNYA !
      </i>
    </td>
  </tr>

<?php }else{ ?>

	<tr align="right" bgcolor="#ddd" style="color:darkblue">
    <td>&nbsp;</td>
		<td colspan="2"><i>Sub Total :</i></td>
    <td>
			<i>
				<?=number_format($SUM['pokok'],0,',','.')?>
			</i>
		</td>
    <td>
			<i>
				<?=number_format($SUM['wajib'],0,',','.')?>
			</i>
		</td>
    <td>
			<i>
				<?=number_format($SUM['sukarela'],0,',','.')?>
			</i>
		</td>
    <td>
			<i>
				<?=number_format($SUM['cicil'],0,',','.')?>
			</i>
		</td>
    <td>
			<i>
				<?=number_format($SUM['jasa'],0,',','.')?>
			</i>
		</td>
    <td>
			<i>
				<?php
					$rupiahh=number_format($sb,0,',','.');
					echo "$rupiahh";
				?>
			</i>
		</td>
	</tr>

  <?php } ?>

</table>
</form>
