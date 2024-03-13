<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_estudos";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Função para exibir mensagens de erro ou sucesso e redirecionar para criar.php
function exibirMensagem($mensagem, $sucesso = false) {
    echo '<script>';
    echo 'alert("' . $mensagem . '");';
    echo 'window.location.href = "criar.php";';
    echo '</script>';
    exit;
}

// Verifica se o formulário foi enviado corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba os dados do formulário
    $nome_do_estudo = isset($_POST['nome_do_estudo']) ? mysqli_real_escape_string($conn, $_POST['nome_do_estudo']) : '';
    $arquivo_1 = isset($_FILES['arquivo_1']) ? $_FILES['arquivo_1'] : '';
    $arquivo_2 = isset($_FILES['arquivo_2']) ? $_FILES['arquivo_2'] : '';
    $anotacoes = isset($_POST['anotacoes']) ? mysqli_real_escape_string($conn, $_POST['anotacoes']) : '';

    // Verifica o tipo de arquivo para o arquivo_1
    $allowed_types_1 = array('txt', 'docx', 'doc', 'pdf');
    $file_type_1 = pathinfo($arquivo_1['name'], PATHINFO_EXTENSION);
    if (!in_array($file_type_1, $allowed_types_1)) {
        exibirMensagem("Tipo de arquivo não permitido para o arquivo 1.");
    }

    // Verifica o tipo de arquivo para o arquivo_2
    $allowed_types_2 = array('xls', 'xlsx');
    $file_type_2 = pathinfo($arquivo_2['name'], PATHINFO_EXTENSION);
    if (!in_array($file_type_2, $allowed_types_2)) {
        exibirMensagem("Tipo de arquivo não permitido para o arquivo 2.");
    }

   // Trata o upload do arquivo 1
    if ($arquivo_1['error'] == UPLOAD_ERR_OK) {
        $target_dir_1 = "files/input/";
        $file_extension_1 = pathinfo($arquivo_1["name"], PATHINFO_EXTENSION);
        $target_file_1 = $target_dir_1 . "doc." . $file_extension_1;
        if (!move_uploaded_file($arquivo_1["tmp_name"], $target_file_1)) {
            exibirMensagem("Erro ao enviar o arquivo de texto.");
        }
    }

    // Trata o upload do arquivo 2
    if ($arquivo_2['error'] == UPLOAD_ERR_OK) {
        $target_dir_2 = "files/taxonomy/";
        $file_extension_2 = pathinfo($arquivo_2["name"], PATHINFO_EXTENSION);
        $target_file_2 = $target_dir_2 . "tax." . $file_extension_2;
        if (!move_uploaded_file($arquivo_2["tmp_name"], $target_file_2)) {
            exibirMensagem("Erro ao enviar o arquivo da taxonomia.");
        }
    }

    // Insere os dados no banco de dados
    $arquivo_1 = isset($target_file_1) ? mysqli_real_escape_string($conn, $target_file_1) : '';
    $arquivo_2 = isset($target_file_2) ? mysqli_real_escape_string($conn, $target_file_2) : '';

    $sql = "INSERT INTO estudos (nome_do_estudo, arquivo_1, arquivo_2, anotacoes) VALUES ('$nome_do_estudo', '$arquivo_1', '$arquivo_2', '$anotacoes')";
    $result = $conn->query($sql);

    if ($result) {
        echo 'success';
    } else {
        echo 'Erro ao salvar estudo no banco de dados: ' . $conn->error;
    }

    mysqli_close($conn);
}
?>
