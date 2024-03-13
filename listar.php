<!DOCTYPE html>
<html>
<head>
	<title>Listar estudos</title>
	<!-- Links para os arquivos CSS do Bootstrap -->
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Link para o arquivo CSS personalizado -->
	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><i class="fas fa-file-alt"></i> DOC Analysis</a>
          </div>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
              </li>
<!--               <li class="nav-item">
                <a class="nav-link" href="listar.php"><i class="fas fa-folder"></i> Meus estudos</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="criar.php"><i class="fas fa-plus"></i> Criar estudo</a>
              </li>

            </ul>
          </div>
        </div>
    </nav>

<br>
<br>
<br>
<br>
	<div class="container mt-4">
	<h2 class="mb-4">Meus estudos</h2>
	<div class="row">
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

		// Seleciona todos os estudos cadastrados no banco de dados
		$sql = "SELECT * FROM estudos";
		$result = mysqli_query($conn, $sql);

		// Verifica se existem estudos cadastrados
		if (mysqli_num_rows($result) > 0) {
			// Exibe cada estudo como um card
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<div class="col-md-4 mb-4">';
				echo '<div class="card">';
				echo '<div class="card-body">';
				echo '<h5 class="card-title">' . $row["nome_do_estudo"] . '</h5>';
				echo '<a href="resultado_geral.html?id=' . $row["id"] . '" class="btn btn-primary mr-2">Resultado</a>';
				echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluirModal' . $row["id"] . '">Excluir</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
			// Modal para confirmar exclusão do estudo
			echo '<div class="modal fade" id="excluirModal' . $row["id"] . '" tabindex="-1"" role="dialog" aria-labelledby="excluirModalLabel' . $row["id"] . '" aria-hidden="true">';
			echo '<div class="modal-dialog" role="document">';
			echo '<div class="modal-content">';
			echo '<div class="modal-header">';
			echo '<h5 class="modal-title" id="excluirModalLabel' . $row["id"] . '">Confirmar exclusão</h5>';
			echo '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
			echo '<span aria-hidden="true">×</span>';
			echo '</button>';
			echo '</div>';
			echo '<div class="modal-body">';
			echo '<p>Tem certeza de que deseja excluir o estudo "' . $row["nome_do_estudo"] . '"?</p>';
			echo '</div>';
			echo '<div class="modal-footer">';
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>';
			echo '<a href="deletar.php?id=' . $row["id"] . '" class="btn btn-danger">Excluir</a>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			}
			} else {
			echo '<p>Nenhum estudo encontrado.</p>';
			}
			mysqli_close($conn);
			?>
			</div>
			
			</div>

			<footer class="bg-light text-center py-3" style= " position: fixed; bottom: 0; width: 100%;">
		<p>&copy; 2023 - Todos os direitos reservados - DOC Analysis</p>
	</footer>

