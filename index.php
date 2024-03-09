<?php
session_start();
include("filme_random_teste.php");
$filme_random = $movieidAAA;
error_reporting(E_ALL ^ E_WARNING); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Pagina inicial</title>
</head> 
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: whitesmoke;
}

h1,h2{
  margin: 10px;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 985px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
@media screen and (max-width: 985px){
  #td1{
    display: none; 
  }
}
@media screen and (max-width: 750px){
  #td2{
    display: none;
  }
}
@media screen and (max-width: 510px){
  #td3{
    display: none;
  }
}
.imagens{
background-image: url();

}
</style>
<?php include('teste_jquerry.php'); include('jquerry2.php'); include('topfilmes.php');?>
<body>
<div class="topnav">
  <a class="active" href="index.php">Pagina inicial</a>
  <a href="recomendacoes.php">Recomendaçoes</a>
  <a href="filmes/filmes2.php?filme=<?php echo $filme_random; ?>">Filme random</a>
  <!--<a href="login.php">--><?php if($_SESSION==null){echo "<a href='login.php'>login</a>";}else{echo "<a href='conta.php'>".$_SESSION['user_name']."</a>"; } ?>
  <?php if($_SESSION['admin']=="admin"){ echo "<a href='adm.php'>Conta admin</a>"; }?>
  <div class="search-container">
    <form action="filmes/procurar.php" method="GET">
      <input type="text" placeholder="Pesquisar..." name="filme" id="pesquisar">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
<br><br>
<div id="contudo" style="background-color: lightgray;width:80%;margin: 0 auto">
<br><br>
<div id="cenas_centro" style="width: 80%;margin: auto;">
<a style="float: left;" href="filmes/filmes2.php?filme=<?php echo $movieIdp ?>"><img src='<?php echo $posterUrl2; ?>' alt='Movie Poster' id="poster" width='290px' height='410px'></a>
<br><center><h1>Filme mais popular de 2023</h1><br><br>
<h1>&nbsp;<?php echo $titl; ?></h1>
<h2 style="font-size:130%;padding: 3%;"><?php echo $desc; ?></h2></center><br><!--width='225' height='318'-->
</div><br><br><br><br><br><br><br><br><br>



<center><h2>Filmes que estao para lançar este ano:</h2></center><br><br> 
<center><table  width="85%">
  <tr>
    <td style="border-right: 2px solid black" width='2%' id="esquerda"><img src="tig.png" width="20px" height="20px"></td>

      <td id="td1">
      <a style="padding-left: 4%;" id="ref1" href="filmes/filmes2.php?filme=<?php echo $ids[0] ?>"><img src='<?php echo $fotos[0]?>' width='225px' height='325px' id='img1' class='imagens'></a>
      </td >
      <td id="td2">
      <a style="padding-left: 4%;" id="ref2" href="filmes/filmes2.php?filme=<?php echo $ids[1] ?>"><img src='<?php echo $fotos[1]?>' width='225px' height='325px' id='img2' class='imagens'></a>
      </td>
      <td id="td3">
      <a style="padding-left: 4%;" id="ref3" href="filmes/filmes2.php?filme=<?php echo $ids[2] ?>"><img src='<?php echo $fotos[2]?>' width='225px' height='325px' id='img3' class='imagens'></a>
      </td>
      <td id="td4">
      <a style="padding-left: 4%;" id="ref4" href="filmes/filmes2.php?filme=<?php echo $ids[3] ?>"><img src='<?php echo $fotos[3]?>' width='225px' height='325px' id='img4' class='imagens'></a>
      </td>

    <td style="border-left: 2px solid black" id="direita"><img src="tig2.png" width="20px" height="20px"></td>
  </tr>
</table><br><br>
</center>

<center><h2>Filmes que ja sairam este ano:</h2><br><br>
<table width="85%">
  <tr>
    <td style="border-right: 2px solid black" width='2%' id="esquerda2"><img src="tig.png" width="20px" height="20px"></td>

      <td id="td12">
      <a style="padding-left: 4%;" id="ref12" href="filmes/filmes2.php?filme=<?php echo $ids2[0] ?>"><img src='<?php echo $fotos2[0]?>' width='225px' height='325px' id='img12' class='imagens'></a>
      </td >
      <td id="td22">
      <a style="padding-left: 4%;" id="ref22" href="filmes/filmes2.php?filme=<?php echo $ids2[1] ?>"><img src='<?php echo $fotos2[1]?>' width='225px' height='325px' id='img22' class='imagens'></a>
      </td>
      <td id="td32">
      <a style="padding-left: 4%;" id="ref32" href="filmes/filmes2.php?filme=<?php echo $ids2[2] ?>"><img src='<?php echo $fotos2[2]?>' width='225px' height='325px' id='img32' class='imagens'></a>
      </td>
      <td id="td42">
      <a style="padding-left: 4%;" id="ref42" href="filmes/filmes2.php?filme=<?php echo $ids2[3] ?>"><img src='<?php echo $fotos2[3]?>' width='225px' height='325px' id='img42' class='imagens'></a>
      </td>

    <td style="border-left: 2px solid black" id="direita2"><img src="tig2.png" width="20px" height="20px"></td>
  </tr>
</table></center><br><br>  <br>
</div><br><br><br>


































<!--
<footer style="background-color: black;width: 100%;color: white;padding: 0.5%;bottom: 0;position: absolute;"><center><a href='https://ricadinho.eu/'><img src='eu real.jpg' width='2%' height="2%" style='float: left;'></a>Propriedade de RICADINHO&#8482;</center></footer>
-->

</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
var fotos = [];
var ids = [];
<?php 
  for($i=0;$i<count($fotos);$i++){
    echo "fotos.push('".$fotos[$i]."');";
  }   
  for($i=0;$i<count($ids);$i++){
    echo "ids.push('".$ids[$i]."');";
  }     
?>
var t1 =document.getElementById("td1");
var t2 =document.getElementById("td2");
var t3 =document.getElementById("td3");
var a1 = document.getElementById("ref1");
var a1 = document.getElementById("ref2");
var a1 = document.getElementById("ref3");
var a1 = document.getElementById("ref4");

var i1= document.getElementById("img1");
var i2= document.getElementById("img2");
var i3= document.getElementById("img3");
var i4= document.getElementById("img4");
var indma = 3;
var indme = 0;

var quantos = 0;
if(t1.style.fontSize==1){
  quantos++;
}
if(t2.style.fontSize==1){
  quantos++;
}
if(t3.style.fontSize==1){
  quantos++;
}
console.log(t1.style.fontSize);

  /*console.log($('.imagens').length);
  var apag = document.getElementsByClassName("imagens");
  console.log(apag.length);
  for(var i=4;i<apag.length;i++){
    console.log(apag[i].id);
    $("#"+apag[i].id).hide();
  }*/
  $('#direita').click(function (){
    console.log(t1.style.fontSize);
    //console.log("\nentrei direita: indma-"+indma+" indme-"+indme);
    console.log("\nentrei direita: ref1 "+ref1.href+"  ref2 "+ref2.href+"  ref3 "+ref3.href+"  ref4 "+ref4.href);
    setTimeout(function (){
        ref1.href = ref2.href;
        ref2.href = ref3.href;
        ref3.href = ref4.href;
        i1.src = i2.src;
        i2.src = i3.src;
        i3.src = i4.src;
        if(indma==fotos.length-1){
          i4.src = fotos[0]; 
          ref4.href = "filmes/filmes2.php?filme="+ids[0];
          indma = 0;
          indme ++;
        }else{
          i4.src = fotos[indma+1];
          ref4.href = "filmes/filmes2.php?filme="+ids[indma+1];
          indma++;
          if(indme==19){
            indme =0;
          }else{
            indme++;
          }
        }
        //console.log("depois direita: indma-"+indma+" indme-"+indme);
        console.log("depois direita: ref1 "+ref1.href+"  ref2 "+ref2.href+"  ref3 "+ref3.href+"  ref4 "+ref4.href);
        if(quantos == 0){
          $("#img1").fadeIn();
        }else if(quantos == 1){
          $("#img2").fadeIn();
        }else if(quantos == 2){
          $("#img3").fadeIn();
        }else if(quantos == 3){
          $("#img4").fadeIn();
        }
        //console.log("aa");
    },400);
    //console.log("ola");
    if(quantos == 0){
      $("#img1").fadeOut();
    }else if(quantos == 1){
      $("#img2").fadeOut();
    }else if(quantos == 2){
      $("#img3").fadeOut();
    }else if(quantos == 3){
      $("#img4").fadeOut();
    }
  });
  $('#esquerda').click(function (){
    //console.log("\nentrei esquerda: indma-"+indma+" indme-"+indme);
    console.log("\nentrei esquerda: ref1 "+ref1.href+"  ref2 "+ref2.href+"  ref3 "+ref3.href+"  ref4 "+ref4.href);
    setTimeout(function (){
        ref4.href = ref3.href;
        ref3.href = ref2.href;
        ref2.href = ref1.href;
        i4.src = i3.src;
        i3.src = i2.src;
        i2.src = i1.src;
        if(indme==0){
          i1.src = fotos[fotos.length-1];
          ref1.href = "filmes/filmes2.php?filme="+ids[fotos.length-1];
          indme = fotos.length-1;
          indma --;
        }else{
          i1.src = fotos[indme-1];
          ref1.href = "filmes/filmes2.php?filme="+ids[indme-1];
          indme--;
          if(indma == 0){
            indma = fotos.length-1;
          }else{
            indma--;
          }
        }
        //console.log("depois esquerda: indma-"+indma+" indme-"+indme);
        console.log("depois esquerda: ref1 "+ref1.href+"   ref2 "+ref2.href+"  ref3 "+ref3.href+"  ref4 "+ref4.href);
        $("#img4").fadeIn();
        //console.log("aa");
    },400);
    //console.log("ola");

    $("#img4").fadeOut();
  });

































  var fotos2 = [];
  var ids2 = [];
  <?php 
    for($i=0;$i<count($fotos2);$i++){
      echo "fotos2.push('".$fotos2[$i]."');";
    }   
    for($i=0;$i<count($ids2);$i++){
      echo "ids2.push('".$ids2[$i]."');";
    }     
  ?>
  var t12 =document.getElementById("td12");
  var t22 =document.getElementById("td22");
  var t32 =document.getElementById("td32");
  var a12 = document.getElementById("ref12");
  var a12 = document.getElementById("ref22");
  var a12 = document.getElementById("ref32");
  var a12 = document.getElementById("ref42");

  var i12= document.getElementById("img12");
  var i22= document.getElementById("img22");
  var i32= document.getElementById("img32");
  var i42= document.getElementById("img42");
  var indma2 = 3;
  var indme2 = 0;


    $('#direita2').click(function (){
      //console.log("\nentrei direita: indma2-"+indma2+" indme2-"+indme2);
      console.log("\nentrei direita: ref1 "+ref1.href+"  ref2 "+ref2.href+"  ref3 "+ref3.href+"  ref4 "+ref4.href);
      setTimeout(function (){
          ref12.href = ref22.href;
          ref22.href = ref32.href;
          ref32.href = ref42.href;
          i12.src = i22.src;
          i22.src = i32.src;
          i32.src = i42.src;
          if(indma2==fotos2.length-1){
            i42.src = fotos2[0]; 
            ref42.href = "filmes/filmes2.php?filme="+ids2[0];
            indma2 = 0;
            indme2 ++;
          }else{
            i42.src = fotos2[indma2+1];
            ref42.href = "filmes/filmes2.php?filme="+ids2[indma2+1];
            indma2++;
            if(indme2==19){
              indme2 =0;
            }else{
              indme2++;
            }
          }
          //console.log("depois direita: indma2-"+indma2+" indme2-"+indme2);
          console.log("depois direita: ref1 "+ref1.href+"  ref2 "+ref2.href+"  ref3 "+ref3.href+"  ref4 "+ref4.href);
          $("#img12").fadeIn();
          //console.log("aa");
      },400);
      //console.log("ola");
      $("#img12").fadeOut();
    });
    $('#esquerda2').click(function (){
      //console.log("\nentrei esquerda: indma2-"+indma2+" indme2-"+indme2);
      console.log("\nentrei esquerda: ref1 "+ref1.href+"  ref2 "+ref2.href+"  ref3 "+ref3.href+"  ref4 "+ref4.href);
      setTimeout(function (){
          ref42.href = ref32.href;
          ref32.href = ref22.href;
          ref22.href = ref12.href;
          i42.src = i32.src;
          i32.src = i22.src;
          i22.src = i12.src;
          if(indme2==0){
            i12.src = fotos2[fotos2.length-1];
            ref12.href = "filmes/filmes2.php?filme="+ids2[fotos2.length-1];
            indme2 = fotos2.length-1;
            indma2 --;
          }else{
            i12.src = fotos2[indme2-1];
            ref12.href = "filmes/filmes2.php?filme="+ids2[indme2-1];
            indme2--;
            if(indma2 == 0){
              indma2 = fotos2.length-1;
            }else{
              indma2--;
            }
          }
          //console.log("depois esquerda: indma2-"+indma2+" indme2-"+indme2);
          console.log("depois esquerda: ref1 "+ref1.href+"   ref2 "+ref2.href+"  ref3 "+ref3.href+"  ref4 "+ref4.href);
          $("#img42").fadeIn();
          //console.log("aa");
      },400);
      //console.log("ola");

      $("#img42").fadeOut();
    });

  

});
</script>
</html>