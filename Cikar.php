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
    $GiderEklemeSorgu = $DbConnect->prepare("SELECT * FROM ofiice ORDER BY id DESC");
    $GiderEklemeSorgu->execute();
    $GiderEklemeSorguSayisi = $GiderEklemeSorgu->rowCount();
    $GiderEklemeSorguKayitlari = $GiderEklemeSorgu->fetchAll();


    ?>

    <table align="center" style="width: 1065px;" border="2" cellpadding="5">
        <tbody>
            <tr align="center">
                <td>Aciklama</td>
                <td>Yontem</td>
                <td>Miktar</td>
            </tr>
            <form action="CikarSonuc.php" method="POST">
                <tr align="center">
                    <td><textarea name="Aciklama"></textarea></td>
                    <td width="500">
                        <select name="Type">
                            <option value="">Lütfen Seçiniz</option>
                            <option value="Debit">Debit</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </td>
                    <td><input type="number" name="Miktar"></td>
                    <td>
                        <input type="submit" value="Gonder">
                    </td>
                </tr>
            </form>

        </tbody>

    </table>    
</body>

</html>