<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_estudos";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifica se o ID do estudo foi fornecido como parâmetro GET
if (!isset($_GET['id'])) {
   // header("Location: index.php");
   // exit();
}

$id = $_GET['id'];

// Exclui o estudo do banco de dados
$sql = "DELETE FROM estudos WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo '<script>alert("Estudo excluído com sucesso!"); window.location.href="listar.php";</script>';
    } else {
    echo "Erro ao excluir estudo: " . mysqli_error($conn);
}
?>
