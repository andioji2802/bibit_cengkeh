<?php
require_once 'autoload.php';

$obj = new Bayes();

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = "Zanzibar 1";
$a2 = "Tegak & tidak layu";
$a3 = "Kulit batang mulus tanpa luka";
$a4 = "90 cm";
$a5 = "18 bulan";
$a6 = "Banyak & Bercabang";

//TRUE
$jenis = $obj->probJenis($a1,1);
$ciri_daun = $obj->probciridaun($a2,1);
$ciri_batang = $obj->probciribatang($a3,1);
$tinggi_bibit = $obj->probtinggibibit($a4,1);
$umur_bibit = $obj->probumurbibit($a5,1);
$ciri_akar = $obj->probakar($a6,1);

//FALSE
$jenis2 = $obj->probJenis($a1,0);
$ciri_daun2 = $obj->probciridaun($a2,0);
$ciri_batang2 = $obj->probciribatang($a3,0);
$tinggi_bibit2 = $obj->probtinggibibit($a4,0);
$umur_bibit2 = $obj->probumurbibit($a5,0);
$ciri_akar2 = $obj->probakar($a6,0);

//result
$paT = $obj->hasilTrue($jumTrue,$jumData,$jenis,$ciri_daun,$ciri_batang,$tinggi_bibit,$umur_bibit,$ciri_akar);
$paF = $obj->hasilFalse($jumTrue,$jumData,$ciri_daun2,$ciri_batang2,$tinggi_bibit2,$umur_bibit2,$ciri_akar2);

echo "
======================================<br>
jenis : $a1<br>
ciri_daun : $a2<br>
ciri_batang : $a3<br>
tinggi_bibit : $a4<br>
umur_bibit : $a5<br>
ciri_akar : $a6<br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan true : <br>
jumlah true : $jumTrue <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan false : <br>
jumlah false : $jumFalse <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
pATrue : $jumTrue / $jumData<br>
jenis true : $jenis <br>
ciri_daun true : $ciri_daun <br>
ciri_batang true : $ciri_batang <br>
tinggi_bibit true : $tinggi_bibit <br>
umur_bibit true : $umur_bibit <br>
ciri_akar true : $ciri_akar <br><br>
=======================================<br><br>
";

echo "
======================================<br>
pAFalse : $jumFalse / $jumData<br>
jenis false : $jenis2 <br>
ciri_daun false : $ciri_daun2 <br>
ciri_batang false : $ciri_batang2 <br>
tinggi_bibit false : $tinggi_bibit2 <br>
umur_bibit false : $umur_bibit2 <br>
ciri_akar false : $ciri_akar2 <br>
=======================================<br><br>
";

echo "
======================================<br>
presentasi yes : $paT<br>
presentasi no : $paF<br>
=======================================<br><br>
";

if($paT > $paF){
  echo "
  ======================================<br>
  PRESENTASI YES LEBIH BESAR DARI PADA PRESENTASI NO<br>
  =======================================
  <br><br>";
}else if($paF > $paT){
  echo "
  ======================================<br>
  PRESENTASI NO LEBIH BESAR DARI PADA PRESENTASI YES<br>
  =======================================
  <br><br>";
}

$result = $obj->perbandingan($paT,$paF);
echo " Status : $result[0] <br>Presentasi Bibit Berkualitas sebanyak : ".round($result[1],2)." % <br>Presentasi Bibit Tidak Berkualitas sebanyak : ".round($result[2],2)." % ";
?>
