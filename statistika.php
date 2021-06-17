<?php
session_start();
  $dbcnt = mysqli_connect("localhost", "root", "", "netpokladna");
  echo mysqli_connect_error();
  mysqli_set_charset($dbcnt,"utf8");
?>

<!DOCTYPE html>
<html lang='cs'>
  <head>
    <title>STATISTIKA</title>
    <meta charset='utf-8'>
    <style>
    <!--
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
                nav{
                  background-image: url(circle-blues.png);
                  height: 80px;
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
                /*section{
                  background: url(bg1.jpg) no-repeat;
                  background-size: cover;
                  height: calc(100vh - 80px);
                }*/
                
              .panel{
                position: absolute;
                top: 40%;
                left: 10%;
                transform: transition(-50%, 50%);
                background-color: #D3D3D3;
                padding: 50px ;
                
              }
              table, th, td{
                border: 1px solid black;
                border-collapse: collapse; 
              }
              th, td{
                padding: 20px ;
              }
              th{
                font-size: 40px;
                font-weight: bolder;  
              }
              td{
                font-size: 40px;
              }

    //-->
    </style>
  </head>
  <body>
     <nav>
        
        <label class="logo">STATISTIKY</label>
        <ul>
            <li><a href="plocha.php">Pracovní plocha</a></li>
            <li><a href="statistika.php">Statistiky</a></li>
            <li><a href="addProdukt.php">Přidat produkt</a></li>
            <li><a href="logout.php">Odhlásit se</a></li>
        </ul>
   </nav>
   
   <section>
        
        <div class="panel">
            <table>
                <tr>
                    <th>Počet dokončených objednávek</th>
                    <th>Výdělek</th>
                    <th>Počet produktů</th>
                </tr>
                <tr>
                    <td><?php
                      $dotazPocet = "
                        SELECT count(IDobjednavka) as pocet
                        FROM objednavka
                        WHERE objednavka.uzivatel = {$_SESSION["uzivatel"]["IDuzivatel"]}
                      ";
                      $vysledekPocet = mysqli_query($dbcnt, $dotazPocet);
                      $vys = mysqli_fetch_assoc($vysledekPocet);
                      echo $vys["pocet"];
                      echo "x";
                    ?></td>

                     <td><?php
                      $dotazSoucet = "
                        SELECT sum(cena) as celk_cena
                        FROM objednavka
                        WHERE objednavka.uzivatel = {$_SESSION["uzivatel"]["IDuzivatel"]}
                      ";
                      $vysledekSoucet = mysqli_query($dbcnt, $dotazSoucet);
                      $vys2 = mysqli_fetch_assoc($vysledekSoucet);
                      echo $vys2["celk_cena"];
                      echo " Kč";
                    ?></td>

                     <td><?php
                      $dotazPocetProd = "
                        SELECT count(IDprodukt) as pocetProd
                        FROM produkt
                        WHERE produkt.uzivatel = {$_SESSION["uzivatel"]["IDuzivatel"]}
                      ";
                      $vysledekPocetProd = mysqli_query($dbcnt, $dotazPocetProd);
                      $vys3 = mysqli_fetch_assoc($vysledekPocetProd);
                      echo $vys3["pocetProd"];
                      echo "x";
                    ?></td>
                </tr> 
            </table>                
        </div>     
        
   </section>
  </body>
</html>