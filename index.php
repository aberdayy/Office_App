<?php
try {
    $DbConnect = new PDO("mysql:host=localhost;dbname=office_app;charset=UTF8", "root", "");
} catch (PDOException $hata) {
    echo "Baglanti hatasi <br />" . $hata->getMessage();
    die();
}

?>

<!doctype html>
<html lang="tr-TR">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="content-language" content="tr">
    <meta charset="utf-8">
    <title>My_Ofiice</title>
</head>

<body>

    <?php
    $Sorgu = $DbConnect->prepare("SELECT * FROM ofiice ORDER BY id DESC");
    $Sorgu->execute();
    $SorguSayisi = $Sorgu->rowCount();
    $SorguKayitlari = $Sorgu->fetchAll();


    ?>

    <table align="center" style="width: 1065px;" border="3" cellpadding="5">
        <tbody>
            <tr align="center">
                <td>Tarih</td>
                <td>Aciklama</td>
                <td>Debit</td>
                <td>Credit</td>
                <td>Kalan Bakiye</td>
            </tr>

            <?php
            foreach ($SorguKayitlari as $Kayitlar) {
            ?>
                <tr align="center">
                    <td><?php echo $Kayitlar["Date"] ?></td>
                    <td><?php echo $Kayitlar["Information"] ?></td>
                    <td><?php echo $Kayitlar["Debit"] ?></td>
                    <td><?php echo $Kayitlar["Credit"] ?></td>
                    <td><?php echo $Kayitlar["Ballance"] ?></td>
                </tr>

            <?php
            }
            ?>
            <table align="center" style="width: 1065px;" border="2" cellpadding="5">

                <tr width="1065" align="center">
                    <td><a href="Ekle.php" style="text-decoration: none; color:black;">Gelir Ekle + </a></td>
                    <td><a href="Cikar.php" style="text-decoration: none; color:black;">Gider Ekle - </a></td>
                </tr>
            </table>
        </tbody>
    </table>
</body>

</html>