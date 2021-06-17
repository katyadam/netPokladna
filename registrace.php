<?php
 $dbcnt = mysqli_connect("localhost", "root", "", "netpokladna");
 echo mysqli_connect_error();
 mysqli_set_charset($dbcnt,"utf8");
?>
<!DOCTYPE html>
<html lang='cs'>
  <head>
    <title>Registrace</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="logReg.css" type="text/css">
    
  </head>
  <body>
  <div class="form">
        
         <form method="POST">
         <h1>
         Registrace
        </h1>
            <div> 
                <input type="text" name="jmeno" required placeholder="Jméno">
            </div>
            <div> 
                <input type="text" name="prijmeni" required placeholder="Příjmení">
            </div>
            <div> 
                <input type="text" name="login" required placeholder="Přihlašovací jméno">
            </div>
            <div>
                <input type="text" name="email" required placeholder="E-Mail">                
            </div>
            <div>               
                <input type="password" name="password" required placeholder="Heslo"> 
            </div>
            <div>               
                <input type="password" name="Ppassword" required placeholder="Znovu Heslo"> 
            </div>
            <div>
                <input type="submit" value="Registrovat se">
                
            </div> 
        </form>
        <?php
         if (isset($_POST["login"])){
            if (!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["Ppassword"]) && !empty($_POST["jmeno"]) && !empty($_POST["prijmeni"])) {
                if ($_POST["password"] == $_POST["Ppassword"]) {
                    $dotazRegistrace = "
                    INSERT INTO uzivatel
                    (jmeno, prijmeni, login, password,email)
                    VALUES
                    ('{$_POST["jmeno"]}', '{$_POST["prijmeni"]}','{$_POST["login"]}', '".hash("sha1", $_POST["password"])."','{$_POST["email"]}')
                     ";
                    mysqli_query($dbcnt, $dotazRegistrace);
                    echo "Ušpěšně zaregistrován";  	
                }else{
                    echo "Špatně zadané heslo";
                }	
        }else
            echo "Zkuste to znovu";    
         }
        ?>
        </div>
        <a class="movePR" href="login.php">Přihlásit se</a>
        <a class="toHome" href="index.php">Domů</a>
  </body>
</html>