<?php
/*
KELOMPOK    : 1
ANGGOTA     : RIZKY BAYU OKTAVIAN < 3411161124 >
              RAYZHA RAKA PUTRA < 3411161XXX >
              IKA RAHMAH PUTRI  < 3411161XXX >
*/

class Bayes
{
  private $bibit = 'data.json';
  // private $jumTrue = 0;
  // private $jumFalse = 0;
  // private $jumData = 0;

  function __construct()
  {

  }

  /*================================================================
  FUNCTION SUM TRUE DAN FALSE
  =================================================================*/
  function sumTrue()
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['status'] == 1){
        $t += 1;
      }
    }

    return $t;
  }

  function sumFalse()
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['status'] == 0){
        $t += 1;
      }
    }
    return $t;
  }

  function sumData()
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);
    return count($hasil);
  }

  // function getSumTrue()
  // {
  //   $data = file_get_contents($this->pegawai);
  //   $hasil = json_decode($data,true);
  //
  //   $t = 0;
  //   foreach($hasil as $hasil)
  //   {
  //     if($hasil['status'] == 1){
  //       $t += 1;
  //     }
  //   }
  //
  //   $this->jumTrue = $t;
  //   return $this->jumTrue;
  // }
  //
  // function getSumFalse()
  // {
  //   $data = file_get_contents($this->pegawai);
  //   $hasil = json_decode($data,true);
  //
  //   $t = 0;
  //   foreach($hasil as $hasil)
  //   {
  //     if($hasil['status'] == 0){
  //       $t += 1;
  //     }
  //   }
  //
  //   $this->jumFalse = $t;
  //   return $this->jumFalse;
  // }
  //
  // function getSumData()
  // {
  //   $data = file_get_contents($this->pegawai);
  //   $hasil = json_decode($data,true);
  //   return count($hasil);
  //
  //   $this->jumData = count($hasil);
  //   return $this->jumData;
  // }
  //=================================================================

  /*================================================================
  FUNCTION PROBABILITAS
  =================================================================*/
  function probjenis($jenis,$status)
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['jenis'] == $jenis && $hasil['status'] == $status){
        $t += 1;
      }else if($hasil['jenis'] == $jenis && $hasil['status'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probciridaun($ciri_daun,$status)
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['ciri_daun'] == $ciri_daun && $hasil['status'] == $status){
        $t += 1;
      }else if($hasil['ciri_daun'] == $ciri_daun && $hasil['status'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probciribatang($ciri_batang,$status)
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['ciri_batang'] == $ciri_batang && $hasil['status'] == $status){
        $t += 1;
      }else if($hasil['ciri_batang'] == $ciri_batang && $hasil['status'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probtinggibibit($tinggi_bibit,$status)
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['tinggi_bibit'] == $tinggi_bibit && $hasil['status'] == $status){
        $t += 1;
      }else if($hasil['tinggi_bibit'] == $tinggi_bibit && $hasil['status'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probumurbibit($umur_bibit,$status)
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['umur_bibit'] == $umur_bibit && $hasil['status'] == $status){
        $t += 1;
      }else if($hasil['umur_bibit'] == $umur_bibit && $hasil['status'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probakar($akar,$status)
  {
    $data = file_get_contents($this->bibit);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['akar'] == $akar && $hasil['status'] == $status){
        $t += 1;
      }else if($hasil['akar'] == $akar && $hasil['status'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

//=================================================================

  /*=================================================================
  MARI BERHITUNG
  keterangan parameter :
  $sT   : jumlah data yang bernilai true ( sumTrue )
  $sF   : jumlah data yang bernilai false ( sumFalse )
  $sD   : jumlah data pada data latih ( sumData )
  $pJ   : jumlah probabilitas Jenis ( probJenis )
  $pD   : jumlah probabilitas Daun (probDaun)
  $pB   : jumlah probabilitas batang ( probBatang )
  $pTB  : jumlah probabilitas tinggi bibit ( probtinggibibit )
  $UK   : jumlah probabilitas umur bibit ( probUmur )
  $A   : jumlah probabilitas akar (probAkar )
  ==================================================================*/

  function hasilTrue($sT = 0 , $sD = 0 , $pJ = 0 ,$pB = 0, $pTB = 0,$UK = 0, $A = 0)
  {
    $paTrue = $sT / $sD;
    $p1 = $pJ / $sT;
    $p2 = $pB / $sT;
    $p3 = $pTB / $sT;
    $p4 = $UK / $sT;
    $p5 = $A / $sT;
    $hsl = $paTrue * $p1 * $p2 * $p3 * $p4 * $p5;
    return $hsl;
  }

  function hasilFalse($sF = 0 , $sD = 0 , $pJ = 0 ,$pB = 0, $pTB = 0,$UK = 0, $A = 0)
  {
    $paFalse = $sF / $sD;
    $p1 = $pJ / $sF;
    $p2 = $pB / $sF;
    $p3 = $pTB / $sF;
    $p4 = $UK / $sF;
    $p5 = $A / $sF;
    $hsl = $paFalse * $p1 * $p2 * $p3 * $p4 * $p5;
    return $hsl;
  }

  function perbandingan($pATrue,$pAFalse)
  {
    if($pATrue > $pAFalse){
      $stt = "Bibit Berkualitas";
      $hitung = ($pATrue / ($pATrue + $pAFalse)) * 100;
      $diterima = 100 - $hitung;
    }elseif($pAFalse > $pATrue)
    {
      $stt = "Bibit Tidak Berkualitas";
      $hitung = ($pAFalse / ($pAFalse + $pATrue)) * 100;
      $diterima = 100 - $hitung;
    }

    $hsl = array($stt,$hitung,$diterima);
    return $hsl;
  }
  //=================================================================
}

?>