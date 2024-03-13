<!DOCTYPE html>
<html lang="en">
<head>
    <title>Criar estudo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><i class="fas fa-file-alt"></i> DOC Analysis</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar.php"><i class="fas fa-folder"></i> Meus estudos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>
<div class="container">
    <h1>Criar estudo</h1>
    <h5>Inclua os dados:</h5>
    <form id="estudoForm" action="salvar.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome_do_estudo">Nome do Estudo:</label>
            <input type="text" name="nome_do_estudo" class="form-control">
        </div>
        <div class="form-group">
            <label for="arquivo_1">Arquivo de texto:</label>
            <input type="file" name="arquivo_1" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="arquivo_2">Arquivo da taxonomia:</label>
            <input type="file" name="arquivo_2" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="anotacoes">Anotações:</label>
            <textarea name="anotacoes" class="form-control"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
        <button type="button" id="processarBtn" class="btn btn-success" disabled>Processar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<!-- Modal para exibir resultado -->
<div class="modal" id="resultadoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Resultado do Script BAT</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="window.location.href='listar.php'">&times;</button>
            </div>
            <div class="modal-body">
                <pre id="resultadoOutput"></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='listar.php'">Fechar</button>
            </div>
        </div>
    </div>
</div>

<footer class="bg-light text-center py-3" style="position: fixed; bottom: 0; width: 100%;">
    <p>&copy; 2023 - Todos os direitos reservados - DOC Analysis</p>
</footer>

<!-- Adicione esta div para exibir mensagens -->
<div id="mensagem-container" class="container"></div>

<script>
 function validarTiposArquivo() {
        var arquivo1 = document.querySelector('input[name="arquivo_1"]');
        var arquivo2 = document.querySelector('input[name="arquivo_2"]');
        var tiposPermitidosArquivo1 = ['txt', 'docx', 'doc', 'pdf'];
        var tiposPermitidosArquivo2 = ['xls', 'xlsx'];

        if (arquivo1.files.length > 0) {
            var extensao1 = arquivo1.files[0].name.split('.').pop().toLowerCase();
            if (tiposPermitidosArquivo1.indexOf(extensao1) === -1) {
                toastr.error('Tipo de arquivo não permitido para o Arquivo de Texto.');
                return false;
            }
        }

        if (arquivo2.files.length > 0) {
            var extensao2 = arquivo2.files[0].name.split('.').pop().toLowerCase();
            if (tiposPermitidosArquivo2.indexOf(extensao2) === -1) {
                toastr.error('Tipo de arquivo não permitido para o Arquivo da Taxonomia.');
                return false;
            }
        }

        return true;
    }

    $(document).ready(function () {
        $("#estudoForm").submit(function (e) {
            e.preventDefault();

            // Verificar tipos de arquivo antes de enviar
            if (!validarTiposArquivo()) {
                return;
            }

            // Restante do código...
        });
        
        // Restante do código...
    });







    $(document).ready(function () {
        $("#estudoForm").submit(function (e) {
            e.preventDefault();

            // Execute a lógica de salvar no banco aqui
            // ...

            $.ajax({
                url: 'salvar.php',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    // Verificar a resposta do backend
                    if (response === 'success') {
                        // Se o estudo foi salvo com sucesso
                        toastr.success('Estudo salvo no banco de dados');

                        // Desativar o botão Executar e habilitar o botão Processar
                        $("button[name='submit']").prop("disabled", true);
                        $("#processarBtn").prop("disabled", false);

                        // Mostrar notificação na página criar.php
                        $("#mensagem-container").html('<div class="alert alert-success" role="alert">Estudo salvo com sucesso. Clique em "Processar" para continuar.</div>');

                        // Restante do seu código...
                    } else {
                        // Se houve um erro ao salvar o estudo
                        toastr.error('Erro ao salvar estudo no banco de dados');
                    }
                },
                error: function () {
                    toastr.error('Erro ao salvar estudo no banco de dados');
                    
                    // Habilitar o botão Processar em caso de erro
                    $("#processarBtn").prop("disabled", false);
                }
            });
        });

        $("#processarBtn").click(function () {
            toastr.info('Processamento iniciado', { timeOut: 3000 }); // Notificação de início de processamento

            // Caminho para o script BAT
            var batScriptPath = "C:\\wamp64\\www\\DOC_Analysis\\AccidentInvestigation.bat";

            // Realizar a chamada assíncrona usando AJAX
            $.ajax({
                url: 'executar_script.php', // Arquivo PHP para executar o script BAT de forma assíncrona
                type: 'POST',
                data: { batScriptPath: batScriptPath },
                success: function (output) {
                    // Exibir o resultado no modal
                    $("#resultadoOutput").text(output);

                    // Ativar os botões processar e executar
                    $("button[name='submit'], #processarBtn").prop("disabled", false);

                    // Mostrar o modal
                    $("#resultadoModal").modal('show');

                    toastr.success('Processamento concluído'); // Notificação de conclusão de processamento
                },
                error: function () {
                    toastr.error('Erro ao processar'); // Notificação de erro
                }
            });
        });
    });
</script>

</body>
</html>
