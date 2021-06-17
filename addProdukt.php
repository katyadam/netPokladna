<?php
session_start();


  $dbcnt = mysqli_connect("localhost", "root", "", "netpokladna");
    echo mysqli_connect_error();
    mysqli_set_charset($dbcnt, "utf8"); // nastavení znakové sady pro komunikaci s DB serverem // přidal KAC 2021-01-22
    
  if (isset($_GET["odstranit"])) { 
   
     $dotazOdstraneni = "
       DELETE FROM produkt
       WHERE IDprodukt = {$_GET["odstranit"]}
     ";
     mysqli_query($dbcnt, $dotazOdstraneni); 
     echo mysqli_error($dbcnt);
     header("Location: addProdukt.phpa");
     exit;
  } 
?>
<!DOCTYPE html>
<html lang='cs'>
  <head>
  
    <title>Přidej</title>
    <meta charset='utf-8'>
                <style>
                *{
                  padding: 0;
                  margin: 0;
                  text-decoration: none;
                  list-style: none;
                  box-sizing: border-box;
                }
                body{
                  font-family: montserrat;
                }
                
                form{
                  position: absolute;
                  top: 50%;
                  left: 50%;
                  transform: translate(-50%,-50%);
                  text-align: center;
                  font-size: 30px;
                  background-color: white;
                  border: 2px solid #A8A8A8; 
                  padding:  30px; 
                  box-shadow: 10px 10px rgba(0, 0, 0, 0.125);  
                  border-radius: 1.25rem;       
                }
                input[type=text]{
                  font-size: 35px;
                  
                }
                div{
                  margin-bottom: 10px;
                }
                
                label{
                  font-size: 30px;    
                }     
                .ulozit{
                  color: black;
                  border:  2px solid white;
                  cursor: pointer;
                  font-size: 30px;
                  text-decoration: none;
                  padding: 7px 13px;
                  border-radius: 3px;
                  text-transform: uppercase;
                }
                nav{
                  background-image: url(circle-blues.png);
                  top: 20%;
                  width: 100%;
                }
                label.logo{
                  color: white;
                  font-size: 35px;
                  line-height: 80px;
                  padding: 0 100px;
                  font-weight: bold;
                }
                nav ul{
                  float: right;
                  margin-right: 20px;
                }
                nav ul li{
                  display: inline-block;
                  line-height: 80px;
                  margin: 0 5px;
                }
                nav ul li a{
                  color: white;
                  font-size: 17px;
                  padding: 7px 13px;
                  border-radius: 3px;
                  text-transform: uppercase;
                }
                nav a:hover{
                  background: #1b9bff;
                  transition: .5s;
                }
                .toEdit{
                  position: absolute;
                  top:80%;
                  right: 10%;
                  background-color: #A8A8A8;
                  cursor: pointer;
                  font-size: 30px;
                  text-decoration: none;
                  padding: 7px 13px;
                  border-radius: 3px;
                  text-transform: uppercase;
                }
                .toEdit a{
                  color: black;
                }
                  
          
                </style>
  </head>
  <body>
  <?php
   $dotazUzivatel = "
     SELECT *
     FROM uzivatel
     ORDER BY prijmeni
   ";
   $vysledekUzivatel = mysqli_query($dbcnt, $dotazUzivatel);
   
  if (isset($_GET["editovat"])) {
   
   $dotazProdukt = "
      SELECT *
      FROM produkt
      WHERE IDprodukt = {$_GET["editovat"]}
   ";
   $vysledekProdukt = mysqli_query($dbcnt, $dotazProdukt);
   $produkt = mysqli_fetch_assoc($vysledekProdukt);
   
   if (empty($produkt)) {
     echo "<p>Produktk neexistuje !</p>";
   }
   
  }
  else
    $produkt = array(
      "IDprodukt" => "",
      "uzivatel" => "",
      "nazev_produktu" => "",
      "cena_produktu" => "",
    ); 

?>
    <nav>
        
        <label class="logo">PŘIDAT PRODUKT</label>
        <ul>
            <li><a href="plocha.php">Pracovní plocha</a></li>
            <li><a href="statistika.php">Statistiky</a></li>
            <li><a href="addProdukt.php">Přidat produkt</a></li>
            <li><a href="logout.php">Odhlásit se</a></li>
        </ul>
   </nav>
   <section>
     <div class="toEdit"><a href="editaceProduktu.php">Edituj</a></div>
   
    <form method="post">
    <input type="hidden" name="IDprodukt"
           value="<?= $produkt["IDprodukt"] ?>">

    <div>
      <label for="nazev">Název</label>
      <input type="text" id="nazev" name="nazev_produktu" required
      value="<?= $produkt["nazev_produktu"] ?>"></div>      
    <div>
      <label for="cena">Cena</label>
      <input id="cena" type="text" name="cena_produktu" required  
      value="<?= $produkt["cena_produktu"] ?>">
    </div>
    <div>
    <input class="ulozit" type="submit" value="Uložit">
    </div>
</form>
<?php

    if (isset($_POST["nazev_produktu"])) {
        if (!empty($_POST["nazev_produktu"]) && !empty($_POST["cena_produktu"])) {
        
          if (empty($_POST["IDprodukt"])) {
        
            $dotazVlozeni = "
                INSERT INTO produkt
                (nazev_produktu, cena_produktu, uzivatel)
                VALUES
                ('{$_POST["nazev_produktu"]}', '{$_POST["cena_produktu"]}','{$_SESSION["uzivatel"]["IDuzivatel"]}')
            ";
            mysqli_query($dbcnt, $dotazVlozeni);
            
          }  
        
        } else {
            echo "Vyplňte údaje správně prosím !";
        }
    }
?>
   
   </section>

  </body>
</html>