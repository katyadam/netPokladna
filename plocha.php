<?php
session_start();
  $dbcnt = mysqli_connect("localhost", "root", "", "netpokladna");
 echo mysqli_connect_error();
 mysqli_set_charset($dbcnt,"utf8");
 
 /*$uzDotaz = "
    SELECT *
    FROM uzivatel
    WHERE login = '{$_POST["login"]}'
    AND password = '".hash("sha1", $_POST["password"])."' 
 ";*/
?>
<!DOCTYPE html>
<html lang='cs'>
  <head>
  <script src="plochaJS.js"></script>
    <title>PRACOVNÍ PLOCHA</title>
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
              
           .produkty{
                position: absolute;
                top:25%;
                right: 5%;
                background-color: white;
                border: 1px solid black;
                box-shadow:2px 2px #3A393A;
           }
           .btn{
              border: none;
              background-color:rgba(0,0,0, 0%);
              color: #3A393A;
              padding: 5px 8px;
              font-size: 30px;
              margin: 10px 10px;
              cursor: pointer;
           }
           .btn:hover{
              text-shadow: 1px 1px #3A393A;
             border-bottom: 2px solid black;
           }
           .vedPlocha{
                position: absolute;
                top: 22.5%;
                left: 15%;
                font-size: 20px;
                background-color: white;
                color: #3A393A;
                padding: 10px 10px; 
                border: 1px solid black;
                box-shadow:2px 2px #3A393A;
                font-size: 30px;
                margin-top: 15px;

           } 
           .showDocCena{
             font-size: 35px;
             font-weight: bold;
             position: absolute;
             top: 15%; 
             left: 50%;
             padding: 0px 5px;
             max-width: 100px;
             text-align: center;
             background-color: white;
             color: #3A393A;
           }
           .sendBtn{
             position: absolute;
             top: 15%;
             left: 80%;
             border: none;
             background-color: white;
             cursor: pointer;
             font-size: 30px;
             color: #3A393A;
             border: 1px solid black;
             padding: 10px 20px;
             border-radius: 5px;
             box-shadow:0px 4px #3A393A;
           }
           .sendBtn:hover{
            box-shadow:0px 1px #3A393A;
            top:15.2%;
            transition: all 0.2s;
           }

    </style>
  </head>
  <body>

  <nav>
        
        
        <label class="logo">PRACOVNÍ PLOCHA</label>
        <ul>
            <li><a href="plocha.php">Pracovní plocha</a></li>
            <li><a href="statistika.php">Statistiky</a></li>
            <li><a href="addProdukt.php">Přidat produkt</a></li>
            <li><a href="logout.php">Odhlásit se</a></li>
        </ul>
   </nav>
   <section>
           <div class="showDocCena" id="docCena"></div>
    
    
      <div class="produkty">
        <?php
     $dotaz = "
            SELECT *
            FROM produkt
            WHERE produkt.uzivatel = {$_SESSION["uzivatel"]["IDuzivatel"]}
        ";
        
        $vysdotaz = mysqli_query($dbcnt,$dotaz);
         while($zaznam = mysqli_fetch_assoc($vysdotaz)){
            echo "<input type='button' class='btn' value='{$zaznam["cena_produktu"]} {$zaznam["nazev_produktu"]}'>";  
            echo "<br>" ;   
         }
        
    ?> 
      </div>
  
    <div class="vedPlocha" id="show">
    
    </div>
    
    <form method="post">
      <input type="hidden" name="finCena" id="showFinCena">
      <input type="submit" class="sendBtn" value="Zaplatit">
  </form>
  <?php
    if(isset($_POST["finCena"])){
        $dotazObjednavka = "
          INSERT INTO objednavka
          (uzivatel, cena)
          VALUES
          ('{$_SESSION["uzivatel"]["IDuzivatel"]}', '{$_POST["finCena"]}')
        ";
        mysqli_query($dbcnt, $dotazObjednavka);
    }
  ?>

   
   </section>
  </body>
</html>