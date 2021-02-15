<?php
  date_default_timezone_set('Asia/Jakarta');
  $date	=date("Y-m-d H:i:s");

  if (isset($_POST['simpan'])){
    $akses = $_POST['akses'];
    $divisi = $_POST['divisi'];

    $sql_cd="SELECT conf_akses.id
        FROM conf_akses
        WHERE
              conf_akses.id_user = $akses AND
              conf_akses.id_divisi = $divisi
    ";

    $query_cd=mysqli_query($koneksi,$sql_cd);
    $data_cd=mysqli_fetch_array($query_cd);
    $datatotal = count($data_cd['id']);

    if ($datatotal == 0) {
      echo $data_cd['id'];
      $sql="INSERT INTO `conf_akses`(`id`, `id_user`, `id_divisi`, `stts_akses`, `c_akses`)VALUES('','$akses','$divisi',1,'$date')";
      $query=mysqli_query($koneksi,$sql);

      if ($query){
        echo "<script>alert('Akses User Berhasil Ditambahkan'); location.href='?Hak-Akses&&header=Akses';</script>";
      }else{
        echo "<script>alert('Akses Gagal Ditambahkan'); location.href='?Hak-Akses&&header=Akses'</script>";
      }
    }else {
      echo "<script>alert('Akses User Sudah Ada'); location.href='?Hak-Akses&&header=Akses';</script>";
    }

  }elseif (isset($_POST['ubah'])) {

    $hidden     = $_POST['acuan_kode'];
    $nmuser     = $_POST['nm_user'];
    $id_divisi  = $_POST['id_divisi'];
    $url_get    = $_POST['url_get'];

    $sqld="SELECT
          a.id,
          a.nm_divisi
          FROM divisi a
          WHERE a.id = $id_divisi";
    $queryd=mysqli_query($koneksi,$sqld);
    $datad=mysqli_fetch_array($queryd);

    $url_array  = explode('&&', $url_get);
    // echo $url_array[5];
    $r_url      = str_replace($url_array[5], 'divisi='.$id_divisi, $url_get);

    // echo "<br><br>";
    // echo $datad['nm_divisi'];
    // echo "<br><br>";

    $sql="UPDATE conf_akses SET id_divisi='$id_divisi' where id='$hidden'";
		$query=mysqli_query($koneksi,$sql);

		if ($query){
      $url_get	=  merge_get_url($r_url);
      echo "<script>alert('Akses $nmuser berhasil diubah'); location.href='$url_get';</script>";
    }else {
      echo "<script>alert('Akses $nmuser gagal diubah'); location.href='$url_get'</script>";
    }
  }
?>
