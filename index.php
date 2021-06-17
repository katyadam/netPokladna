<!DOCTYPE html>
<!--
 TO DO LIST:
 - udělat homepage
 - udělat databázi
 - vyřešit login/registraci
 - produkt plocha (přidání produktů, fotek, atd...)
 - 
-->
<html lang='cs'>
  <head>
    <title>HOME</title>
    <meta charset='utf-8'>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
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
                  height: 80px;
                  width: 100%;
                }
                nav h1{
                  color: white;
                  position: absolute;
                  left: 43%;
                  font-size: 40px;
                  font-family: monospace;
                  margin-top: 10px;
                  
                }
                /*.checkbtn{
                  font-size: 30px;
                  color: white;
                  float: right;
                  line-height: 80px;
                  margin-right: 40px;
                  cursor: pointer;
                  display: none;
                }
                #check{
                  display: none;
                }
                @media (max-width: 952px){
                  label.logo{
                    font-size: 30px;
                    padding-left: 50px;
                  }
                  nav ul li a{
                    font-size: 16px;
                  }
                }
                @media (max-width: 858px){
                  .checkbtn{
                    display: block;
                  }
                  ul{
                    position: fixed;
                    width: 100%;
                    height: 100vh;
                    background: #2c3e50;
                    top: 80px;
                    left: -100%;
                    text-align: center;
                    transition: all .5s;
                  }
                  nav ul li{
                    display: block;
                    margin: 50px 0;
                    line-height: 30px;
                  }
                  nav ul li a{
                    font-size: 20px;
                  }
                  a:hover,a.active{
                    background: none;
                    color: #0082e6;
                  }
                  #check:checked ~ ul{
                    left: 0;
                  }
                }*/
                section{
                  height: calc(100vh - 80px);
                }
           .main{
                position: relative;
                top: 50%;
           }
           .right{
             position: relative;
             float: right;
             right: 20%;
             top: 50%;
             
             
           }
           .left{
             position: relative;
             float: left;
             left: 20%;
             top: 10%;
             
           }
           .left, .right{
             font-size: 35px;
             
              
           }
           .left a, .right a{
              text-decoration: none;
              font-family: monospace;
              color: black; 
              text-transform: uppercase;
              padding: 120px 60px;
              background-color: rgba(0, 0, 0, 0.1); 
              text-shadow: 1px 1px black;
           }
    </style>
  </head>
  <body>

   <nav>      
        <h1>Net-Pokladna</h1>
   </nav>
<section>
    <div class="main">
     <div class="right">
        <a href="registrace.php">Jsem nový</a>
     </div>
     
     <div class="left">
      <a href="login.php">Přihlásit se</a>
     </div>
    </div>
</section>  
     
  </body>
</html>