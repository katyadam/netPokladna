<?php
 session_start();
 $dbcnt = mysqli_connect("localhost", "root", "", "netpokladna");
 echo mysqli_connect_error();
 mysqli_set_charset($dbcnt,"utf8");
 
 if (isset($_POST["login"])) {
    $dotaz = "
        SELECT *
        FROM uzivatel
        WHERE login = '{$_POST["login"]}' AND password = '".hash("sha1", $_POST["password"])."'  
    ";
    $uzivatel = mysqli_query($dbcnt, $dotaz);
    $uzivatel = mysqli_fetch_assoc($uzivatel);
    
    if ($uzivatel) {
        $_SESSION["uzivatel"] = $uzivatel;
        header("Location: plocha.php");	
        exit;
    }else{
        $chybHlaska = "Špatné přihlašovací údaje";
    }
 }
?>
<!DOCTYPE html>
<html lang='cs'>
  <head>
    <title>LOGIN</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="logReg.css" type="text/css">
    
  </head>
  <body>
        <div class="form">
         <form method="POST">
         <h1>
          Přihlásit se
         </h1>
            <div class="txt">                 
                <input type="text" name="login" required placeholder="Přihlašovací jméno">
            </div>
            <div class="txt">               
                <input type="password" name="password" required placeholder="Heslo"> 
            </div>
            <div>
                <input type="submit" value="Přihlásit se">                
            </div> 
        </form>
        </div>
        <a class="movePR" href="registrace.php">Registrovat</a>
        <a class="toHome" href="index.php">Domů</a>
        
        
  </body>
</html>