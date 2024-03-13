<?php
// Conexão com o banco de dados

require_once "conexao.php";

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_estudos";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
die("Conexão falhou: " . mysqli_connect_error());
}

// Seleciona todos os estudos do banco de dados
$sql = "SELECT * FROM estudos";
$resultado = mysqli_query($conn, $sql);

// Exibe os resultados em uma tabela
echo "<table>";
echo "<tr><th>Nome do estudo</th><th>Arquivo 1</th><th>Arquivo 2</th><th>Anotações</th></tr>";
while($linha = mysqli_fetch_assoc($resultado)) {
echo "<tr>";
echo "<td>" . $linha['nome_do_estudo'] . "</td>";
echo "<td><a href='" . $linha['arquivo_1'] . "' target='_blank'>" . basename($linha['arquivo_1']) . "</a></td>";
echo "<td><a href='" . $linha['arquivo_2'] . "' target='_blank'>" . basename($linha['arquivo_2']) . "</a></td>";
echo "<td>" . $linha['anotacoes'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Resultados do estudo</title>
	<!-- Inclusão dos arquivos CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="estilo.css">
</head>
<body>
	<!-- Cabeçalho com acesso às outras páginas
	<header class="bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h1 class="text-white">Resultados do estudo</h1>
				</div>
				<div class="col-md-4">
					<nav class="navbar navbar-expand-lg navbar-dark">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
							<ul class="navbar-nav">
								<li class="nav-item">
									<a class="nav-link" href="pagina_inicial.php">Página Inicial</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="inserir_estudo.php">Inserir Estudo</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header> -->

	<!-- Corpo da página -->
	<?php /* include('header.php'); */?>

	<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-dark fixed-top" style="height: 100vh;">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#grafico1">Gráfico 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#grafico2">Gráfico 2</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="col-md-10 offset-md-2" style="height: 100vh;">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <h1 class="text-center mt-5">Resultados do Estudo</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="explore.html" id="grafico1"></iframe>
            </div>
          </div>
          <div class="col-md-6">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="explore.html" id="grafico2"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
		
		
		<?php/* include('footer.php');*/ ?>

		<!-- SCRIPTS -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script>
		// Função para carregar o gráfico selecionado no iframe
		function carregarGrafico(iframe, url) {
			iframe.attr("src", url);
		}

		$(document).ready(function() {
			// Carrega o primeiro gráfico ao abrir a página
			var primeiroGrafico = $("#graficos-menu a:first-child").attr("href");
			carregarGrafico($("#graficos-iframe"), primeiroGrafico);

			// Define o comportamento do menu de gráficos
			$("#graficos-menu a").click(function(event) {
			event.preventDefault();
			var graficoUrl = $(this).attr("href");
			carregarGrafico($("#graficos-iframe"), graficoUrl);
			});
		});
		</script>

</body>
</html>
