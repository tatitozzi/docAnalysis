<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Conexão falhou: " . mysqli_connect_error());
}

// Recebe os dados do formulário via POST
$nome_do_estudo = $_POST['nome_do_estudo'];
$anotacoes = $_POST['anotacoes'];

// Upload do arquivo 1
if ($_FILES['arquivo_1']['size'] > 0) {
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["arquivo_1"]["name"]);
	if (move_uploaded_file($_FILES["arquivo_1"]["tmp_name"], $target_file)) {
		$arquivo_1 = $target_file;
	} else {
		echo "Erro ao fazer upload do arquivo 1.";
		exit();
	}
} else {
	$arquivo_1 = "";
}

// Upload do arquivo 2
if ($_FILES['arquivo_2']['size'] > 0) {
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["arquivo_2"]["name"]);
	$file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
	if (strtolower($file_extension) == "pdf") {
		if (move_uploaded_file($_FILES["arquivo_2"]["tmp_name"], $target_file)) {
			$arquivo_2 = $target_file;
		} else {
			echo "Erro ao fazer upload do arquivo 2.";
			exit();
		}
	} else {
		echo "O arquivo 2 deve ser um arquivo PDF.";
		exit();
	}
} else {
	$arquivo_2 = "";
}

// Insere os dados no banco de dados
$sql = "INSERT INTO estudos (nome_do_estudo, arquivo_1, arquivo_2, anotacoes) VALUES ('$nome_do_estudo', '$arquivo_1', '$arquivo_2', '$anotacoes')";
if (mysqli_query($conn, $sql)) {
	$id = mysqli_insert_id($conn);
	echo "<div class='container'><h1>Estudo salvo com sucesso!</h1>";
	echo "<p><a href='resultados.php' class='btn btn-primary'>Visualizar estudos</a></p></div>";
} else {
	echo "<div class='container'><h1>Erro ao salvar o estudo.</h1>";
	echo "<p><a href='index.php' class='btn btn-secondary'>Voltar</a></p></div>";
}

mysqli_close($conn);
?>
