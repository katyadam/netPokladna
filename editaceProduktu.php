<?php
    session_start();


    $dbcnt = mysqli_connect("localhost", "root", "", "netpokladna");
      echo mysqli_connect_error();
      mysqli_set_charset($dbcnt, "utf8");
      if(isset($_GET["odstranit"])){
        $dotazOdstraneni = "
            DELETE FROM produkt
            WHERE IDprodukt = '{$_GET["odstranit"]}'
        ";   
        mysqli_query($dbcnt, $dotazOdstraneni);
        header("Location: editaceProduktu.php");
        exit;
    }
      
      
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edituj</title>
    <style>
         .toAdd{
            position: absolute;
            top:30%;
            right: 50%;
            background-color: #A8A8A8;
            cursor: pointer;
            font-size: 30px;
            padding: 7px 13px;
            border-radius: 3px;
            text-transform: uppercase;
        }
        .toAdd a{
            color: black;
            text-decoration: none;
        }
        table{
            position: absolute;
            top: 40%;
            right: 40%;
            
            text-align: center;
            margin: 0 auto;
           
        }    
   
        table, td{
                border-bottom: 1px solid black;
        }
   
        th, td{
            padding: 10px 15px;
            font-size: 25px;
        }
        .fce{
            position: absolute;
            left: 35%;
            box-shadow: 10px 10px rgba(0, 0, 0, 0.125);  
            max-width: 400px;
            border: 2px solid black;
            
        }
        .fce, input{
            padding: 15px;
            
        }
        input[type=text]{
            border: none;
            font-size: 15px;
            border-bottom: 1px solid black;
        }
        .fce input[type=submit]{
            position: absolute; 
            right: 5%;
            background-color: white;
            border: 1px solid black;
            cursor: pointer;
            box-shadow:4px 4px rgba(0, 0, 0, 0.3);
        }
        input[type=text]:focus{
            background-color: rgba(0, 0, 0, 0.100);
            font-size: 110%;
        }
        .fce input[type=submit]:hover{
            top:51%;
            box-shadow: none;
            transition: all 0.2s;
        }
        .fce2 [type=submit]{
            font-size: 15px;
            background-color: white;
            width: 100px;
            margin-bottom: 10px;
            border: 1px solid black;
            cursor: pointer;
        }
        .fce2 input[type=submit]:hover{
            background-color: rgba(0, 0, 0, 0.100);
        }

        
    </style>
    <?php
   if(isset($_GET["editovat"])){
     $dotazProdukt = "
        SELECT *
        FROM produkt
        WHERE IDprodukt = {$_GET["editovat"]}
     ";
     $vysledekProdukt = mysqli_query($dbcnt, $dotazProdukt);
     $produkt = mysqli_fetch_assoc($vysledekProdukt);
     if (empty($produkt)) {
        echo "<p>Tento produkt neexstituje</p>";
    }
   }else
        $produkt = array(
            "IDprodukt" => "",
            "nazev_produktu" => "",
            "cena_produktu" => "",
        );
  ?>
</head>
<body>
    <div class="toAdd"><a href="addProdukt.php">Zpět</a></div>
    <form class="fce" id="zadavani" method="post">
        <input type="hidden" name="IDprodukt" value="<?= $produkt["IDprodukt"] ?>">
        
        <input type="text" name="nazev_produktu" required placeholder="Nazev" value="<?= $produkt["nazev_produktu"]?>">
        <input type="text" name="cena_produktu" required placeholder="Cena" value="<?= $produkt["cena_produktu"]?>">
        <input type="submit" value="Edituj">
           
    </form>
    <?php
    if(isset($_POST["nazev_produktu"])){
        $dotazUpdate = "
        UPDATE produkt
        SET nazev_produktu = '{$_POST["nazev_produktu"]}', 
            cena_produktu = '{$_POST["cena_produktu"]}' 
        WHERE IDprodukt = {$_POST["IDprodukt"]}
        ";
        mysqli_query($dbcnt, $dotazUpdate);
        header("Location: editaceProduktu.php");
        exit;
    }
        
    ?>
        <?php
            $dotaz = "
                SELECT *
                FROM produkt
                WHERE produkt.uzivatel = {$_SESSION["uzivatel"]["IDuzivatel"]}
            ";
            $vysledekDotazu = mysqli_query($dbcnt, $dotaz);
            echo "<table>";
            while($zaznam = mysqli_fetch_assoc($vysledekDotazu)){
                echo "<tr>";
                echo "<td>{$zaznam["nazev_produktu"]}</td>";
                echo "<td>{$zaznam["cena_produktu"]}</td>";
                echo "<td>
                    <form id='funkce' class='fce2'>
                        <input type='hidden' name='editovat' value='{$zaznam["IDprodukt"]}'>
                        <input type='submit' value='Editovat'>
                    </form>
                    <form id='funkce' class='fce2'>
                    <input type='hidden' name='odstranit' value='{$zaznam["IDprodukt"]}'>
                    <input type='submit' value='Odstranit'>
                    </form>
                    
                </td>";
                echo "</tr>";
            }
            echo "</table>";
            
        ?>

</body>
</html>