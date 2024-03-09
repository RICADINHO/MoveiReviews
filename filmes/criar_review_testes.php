<?php 
session_start();
echo empty($_SESSION['user_name']);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
.modal-content input[type=text], .modal-content textarea {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.modal-content textarea {
  resize: none;
}

/* Set a style for all buttons */
.modal-content button, #botao_criar_review {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

.modal-content button:hover, #botao_criar_review:hover {
  opacity: 0.8;
}



/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
.estrela{
  display: inline-block;
  font-size: 30px;
  transition: color 0.2s;
  cursor: pointer;
}
</style>
</head>
<body>
<h2>nova review</h2>
<?php 
require_once "conf.php";

if(isset($_POST['submit'])){
  $titulo = $_POST['titulo'];
  $pontuacao = $_POST['rating'];
  $review = $_POST['review'];
  $email = $_SESSION['email'];

  $sql2 = "SELECT * FROM user WHERE email='$email'"; 
  $result = $conn->query($sql2); 
  $row = $result->fetch_assoc();
  $id = $row['id'];


      $sql = "INSERT INTO review(id_filme,review,titulo,id_user,pontuacao,likes,dislikes) VALUE('813','$review','$titulo','$id','$pontuacao','0','0');";

      if ($conn->query($sql) === TRUE) {
          echo "ta criado :)";
      }else{
          echo "Error: ";
      }
  $conn->close();
  echo "<meta http-equiv='refresh' content='0'>";
}
?>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" id="botao_criar_review">criar review</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="POST">
    <div id="sessao">
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>

      <div class="container">
        <label for="uname"><b>Rating</b></label>
        <table>
          <tr>
            <td class="estrela" onclick="fogo(0)" onmouseover="preto(0)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(1)" onmouseover="preto(1)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(2)" onmouseover="preto(2)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(3)" onmouseover="preto(3)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(4)" onmouseover="preto(4)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(5)" onmouseover="preto(5)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(6)" onmouseover="preto(6)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(7)" onmouseover="preto(7)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(8)" onmouseover="preto(8)" onmouseout="branco()">★</td>
            <td class="estrela" onclick="fogo(9)" onmouseover="preto(9)" onmouseout="branco()">★</td>
          </tr>
        </table><br>

        <input type="number" style="display: none;" name="rating" id="rating" value="0">

        <label for="titulo"><b>Titulo</b></label><br>
        <input type="text" placeholder="titulo" name="titulo" required><br>  

        <label for="review"><b id="review_titulo">Review (letras restantes: 3000)</b></label><br>
        <textarea placeholder="fazer review aqui, maximo de 3000 letras" name="review" id="review" cols="60" rows="10" maxlength="3000" required></textarea><br>
          
        <button type="submit" name="submit">Fazer review</button>
      </div>
    </div>
    <div id="sessao2" style="display: none">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          </div>
          <div class="container">
                <a href="/projeto/login.php">criar conta</a>
          </div>
    </div>
  </form>
</div>
<script>
  var f1 =document.getElementById("sessao");
  var f2 =document.getElementById("sessao2");
  var r =document.getElementById("rating");
  <?php 
  if(empty($_SESSION['user_name'])){
    echo "f1.style.display = 'none';";
    echo "f2.style.display = 'inline-block';";
  }
  ?>
  document.getElementById('review').onkeyup = function () {
  document.getElementById('review_titulo').innerHTML = "Review (letras restantes: " + (3000 - this.value.length)+")";
};
var check = 0;
const estrelas = document.getElementsByClassName("estrela");
console.log(navigator.userAgentData.mobile);
  function preto(numero){
    check = 0;
      for (var i = 0; i <= numero; i++) {
        //estrelas[i].innerHTML = "★";
        estrelas[i].style.color = "gold";
      }
  }
  function branco(numero){
      if(check == 0){
        for (var i = 0; i < estrelas.length; i++) {
          //estrelas[i].innerHTML = "★";
          estrelas[i].style.color = "black";
        }
      }else{
        check = 1;
      }
  }
  function fogo(numero){
    for (var i = 0; i < estrelas.length; i++) {
          estrelas[i].style.color = "black";
        }
        for (var i = 0; i <= numero; i++) {
        estrelas[i].style.color = "gold";
        r.value = numero+1;
      }
      check = 1;
  }
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
</html>