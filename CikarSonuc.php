<?php
try {
    $DbConnect = new PDO("mysql:host=localhost;dbname=office_app;charset=UTF8", "root", "");
} catch (PDOException $hata) {
    echo "Baglanti hatasi <br />" . $hata->getMessage();
    die();
}
$ZamanDamgasi       = time();
$TarihSaat          = date("d/m/Y H:i:s", $ZamanDamgasi);


if (isset($_POST["Aciklama"])) {
    $GelenAciklama     =    $_POST["Aciklama"];
} else {
    $GelenAciklama     =    "";
}

if (isset($_POST["Type"])) {
    $GelenType     =    $_POST["Type"];
} else {
    $GelenType     =    "";
}
if (isset($_POST["Miktar"])) {
    $GelenMiktar     =    $_POST["Miktar"];
} else {
    $GelenMiktar     =    "";
}

if ($GelenType == "Debit") {
    $Ekle = $GelenType;
} elseif ($GelenType == "Credit") {
    $Ekle = $GelenType;
}


$GelirEklemeSorgu = $DbConnect->prepare("SELECT * FROM ofiice ORDER BY id DESC LIMIT 1");
$GelirEklemeSorgu->execute();
$GelirEklemeSorguKayitlari = $GelirEklemeSorgu->fetchAll();
foreach ($GelirEklemeSorguKayitlari as $SonBakiye ) {
  
}
$Yenibakiye = $SonBakiye["Ballance"] - $GelenMiktar;

if (($GelenAciklama != "") and ($GelenType != "") and ($GelenMiktar != "") ) {

    $EklemeSorgusu     = $DbConnect->prepare("INSERT INTO ofiice (Information, $Ekle, Ballance, Date) values(?, ?, ?, ?) LIMIT 1");
    $EklemeSorgusu->execute([$GelenAciklama, $GelenMiktar, $Yenibakiye, $TarihSaat]);
    $KayitKontrol         = $EklemeSorgusu->rowCount();
    if ($KayitKontrol > 0) {

        header("Location:index.php"); //TAMAM
        exit();
    } else {
        header("Location:Hata.php"); //HATA
        exit();
    }
} else {
    header("Location:EksikAlan.php"); //Eksik Alan
    exit();
}
