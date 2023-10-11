<?php  
// conexão à base de dados
$conn = mysqli_connect('localhost:3307', 'root', '', 'coffeeshop_db');
if(!$conn) {
    echo ('Não foi possivel conectar:' . mysqli_connect_error());
 }

?>