<?php 
session_start();
session_destroy();
include("filme_random_teste.php");
$filme_random = $movieidAAA;
error_reporting(E_ALL ^ E_WARNING); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="barra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{ font: 14px sans-serif; background-color: whitesmoke;}
    </style>
</head>
<body>

<div class="topnav">
  <a href="index.php">Pagina inicial</a>
  <a href="recomendacoes.php">Recomendaçoes</a>
  <a href="filmes/filmes2.php?filme=<?php echo $filme_random; ?>">Filme random</a>
  <a class="active" href="signup.php">Sign up</a>
  <div class="search-container">
    <form action="filmes/procurar.php" method="GET">
      <input type="text" placeholder="Pesquisar..." name="filme" id="pesquisar">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
<?php
require_once "conf.php";
if(isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $url = "http://localhost/projeto/API_BD.php?email=$email";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($curl_response);
  //FAZER MELHOR ISTO QUE PODE TER PESSOAS COM NOMES IGUAIS E PASS IGUAIS OU ENTAO METER SO O EMAIL
 echo $data==null;
 
    if($data == null){
      echo "<script>alert('utilizador nao existe!')</script>";
    }else{
      foreach($data as $a){
        if($a->pass != $pass){
          echo "<script>alert('Palavra passe incorreta!')</script>";
        }else{
            session_start();
            $_SESSION['user_name'] =$a->nome;// $row['nome'];
            $_SESSION['email'] = $a->email;//$row['email'];
            $_SESSION['admin'] = $a->tipo;//$row['tipo'];
            $_SESSION['id'] = $a->id;//$row['id'];
            $_SESSION['pass'] = $a->pass;//$row['pass'];
            //echo $_SESSION['user_name'];
            header("Location: conta.php");
            die();
        }
      }
    }
  }
?>
<br><br><br>
<div id="frm" style="width: 20%;background-color: lightgray;margin: auto;padding: 1%;">  
        <center><h1>Login</h1>  </center><br>
        <form name="f1" action=""  onsubmit="return validation()" method ="POST">  
            <p>  
                <label> Email: </label>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type = "email" id ="email" name  = "email" />  
            </p>  
            <p>  
                <label> Password: </label>  
                <input type = "password" id ="pass" name  = "pass" />  
            </p>  
            <p>     
               <center> <input type =  "submit" id = "btn" value = "Login" name="submit" /> </center> 
            </p>  
        </form>  
</div>  
</body>
<script>  
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }   
                //alert("user nao existe");
                //return false;                          
            }  
</script>  
</html>