<?php
$server_bd = "localhost";
$user_bd = "root";
$pass_bd = "sans1234";
$nome_bd = "projeto";

$conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
header("Content-Type:application/json");

if(isset($_GET['id_review']) && isset($_GET['id_user']) && isset($_GET['estado'])){//ver se user deu like
    $sql = "SELECT * FROM relacao WHERE iduser=".$_GET['id_user']." AND idreview=".$_GET['id_review'];
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else if(isset($_GET['id_user']) && isset($_GET['id_filme'])){//todas as reviews de um user num certo filme
    $sql = "SELECT * FROM review WHERE id_user=".$_GET['id_user']." AND id_filme=".$_GET['id_filme'];
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else if(isset($_GET['id_filme'])){//todas as reviews de um certo filme
    $sql = "SELECT * FROM review WHERE id_filme=".$_GET['id_filme'];
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else if(isset($_GET['id_user'])&&isset($_GET['review'])){//todas as reviews dum certo user
    $sql = "SELECT * FROM review WHERE id_user=".$_GET['id_user'];
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else if(isset($_GET['ids'])){//todos os ids de todos os users
    $sql = "SELECT * FROM user";
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else if(isset($_GET['ids_rev'])){//todos os ids de todas as reviews
    $sql = "SELECT * FROM review";
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else if(isset($_GET['id_review'])){//tudo de uma certa review
    $sql = "SELECT * FROM review WHERE id_review=".$_GET['id_review'];
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else if(isset($_GET['email'])){//tudo do user com o email
    $sql = "SELECT * FROM user WHERE email='".$_GET['email']."';";
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else if(isset($_GET['email']) && isset($_GET['pass'])){//tudo do user com o email e passe
    echo $_GET['pass'];
    echo $_GET['email'];
    $sql = "SELECT * FROM user WHERE email='".$_GET['email']."' AND pass='".$_GET['pass']."';";
    $r=$conn->query($sql);
    $re = array();
    while($row = $r->fetch_assoc()){
        $re[] = $row;
    }
}else{
    $re[] = "Nao foi pesquisado nada";
}

echo json_encode($re);
exit;
?>