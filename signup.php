<?php
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="barra.css">
    <style>
        body{ 
            font: 14px sans-serif; 
            background-color: whitesmoke;
        }
    </style>
</head>
<body>

<div class="topnav">
  <a href="index.php">Pagina inicial</a>
  <a href="recomendacoes.php">Recomendaçoes</a>
  <a href="filmes/filmes2.php?filme=<?php echo $filme_random; ?>">Filme random</a>
  <a class="active" href="login.php">login</a>
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
    $nome = $_POST['user'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];

    $url = "http://localhost/projeto/API_BD.php?email=$email";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($curl_response);

    if ($data!= null) {
        echo "<script>alert('ja existe um utilizador com esse email');</script>";
    }else{
        $sql = "INSERT INTO user(nome,email,pass,tipo) VALUE('$nome','$email','$pass','normal');";
        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            session_start();
            $_SESSION['user_name'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['admin'] = "normal";
            header("Location: conta.php");
            die();
        }else{
            echo "Error: ";
        }
    }
    $conn->close();
}
?>
<br><br><br>
<div id = "frm" style="width: 25%;background-color: lightgray;margin: auto;padding: 1%;">  
        <center><h1>Signup</h1>  </center><br>
        <form name="f1" action = "" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> UserName: </label>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type = "text" id ="user" name  = "user" />  
            </p>  
            <p>  
                <label> Email:   </label>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type = "email" id ="email" name  = "email" />  
            </p>  
            <p>  
                <label> Password: </label>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type = "password" id ="pass" name  = "pass" />  
            </p>  
            <p>  
                <label> Confirmar Password: </label>  
                <input type = "password" id ="pass2" name  = "pass2" />  
            </p>  
            <p>     
                <center><input type =  "submit" id = "btn" value = "Signup" name="submit" />  </center>
            </p>  
        </form>  
</div>  

</body>
<script>  
function validation(){  
    var id=document.f1.user.value;  
    var ps=document.f1.pass.value;  
    var ps2=document.f1.pass2.value;
    if(id.length=="" || ps.length=="" || ps2.length=="") {  
        alert("Nome e campos nao podem estar vazios");  
        return false;  
    }else if(ps!=ps2){  
        alert("n sao iguais");
        return false;
    }                             
}
</script>  
</html>