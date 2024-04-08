# readme

# docAnalysis

Repositório do projeto sistema DOC Analysis

### Instalação no diretório

Salve o conteúdo zip em uma pasta no diretório file:///C:/wamp64/www/

### Criar banco de dados

Acesse o link http://localhost/phpmyadmin/ e crie os bancos de dados usando os esquemas sql

- estudos.sql (presente na pasta files)
- script.sql (presente na pasta files/model)

### Atualize o arquivo config

Acesse o arquivo config.properties (files/config) e atualize o nome do usuário (user) e a senha (password) do banco de dados mysql

---

# Exemplo de utilização

https://github.com/tatitozzi/docAnalysis/assets/18054573/ae80128a-315d-42ad-8207-f1c58cd73f4c

---

## Permitir WampServer execute um arquivo BAT

Para permitir que o WampServer execute um arquivo BAT, você pode seguir estas etapas:

1. Configure o Apache para permitir execução de scripts:
- Abra o arquivo de configuração do Apache (httpd.conf). Você pode encontrá-lo no diretório \wamp\bin\apache\apacheX.X.X\conf, onde X.X.X é a versão do Apache.
- Localize a seção <Directory> que corresponde ao diretório onde seus scripts estão localizados (provavelmente o diretório www).

Dentro dessa seção, adicione ou verifique se a opção ExecCGI está habilitada. Deve se parecer com isso:

```jsx
Options Indexes FollowSymLinks ExecCGI
AddHandler cgi-script .cgi .pl .exe
```

2. Configurar o PHP para permitir execução de comandos shell:

Abra o arquivo de configuração do PHP (php.ini). Você pode encontrá-lo no diretório \wamp\bin\php\phpX.X.X\.
Localize a diretiva disable_functions e remova exec dela, ou adicione exec se não estiver presente. Certifique-se de que a linha não está comentada (sem ponto e vírgula no início).

```jsx
disable_functions =
```
Reinicie o Apache após fazer essas alterações para que as configurações tenham efeito.

3. Configurar permissões no arquivo BAT:

Certifique-se de que o usuário do Apache tenha permissões para executar o arquivo BAT. Isso pode envolver ajustar as permissões de arquivo no sistema operacional.

---

# Exemplo de taxonomia

Você pode criar uma taxonomia conforme esta estrutura usando uma planilha (xls ou xlsx):

| Dimensão          | Nome do Fator          | Pref Termo       | Alt Termo        | Termos                                                                                      |
|-------------------|------------------------|------------------|------------------|---------------------------------------------------------------------------------------------|
| **Categorias**    | **Tipo de Culinária**  | Internacional    | Global           | Cozinhas do mundo, culinária internacional, pratos globais                                   |
|                   |                        | Regional         | Tradicional      | Culinária regional, pratos tradicionais, comida típica                                       |
|                   |                        | Vegetariana      | Vegana           | Comida vegetariana, opções veganas, alimentação baseada em plantas                            |
| **Ingredientes**  | **Origem dos Ingredientes** | Orgânico   | Natural          | Ingredientes orgânicos, produtos naturais, alimentos sem pesticidas                            |
|                   |                        | Local            | Sazonal          | Ingredientes locais, produtos da estação, alimentos frescos                                   |
|                   |                        | Exótico          | Especialidade    | Ingredientes exóticos, produtos de outras regiões, itens raros                                |
| **Métodos de Culinária** | **Técnica de Preparo** | Assar        | Grelhar          | Assar no forno, grelhar na churrasqueira, cozinhar sobre fogo aberto                         |
|                   |                        | Cozinhar         | Ferver           | Cozinhar em água fervente, ferver os ingredientes, preparar ensopados                         |
|                   |                        | Refogar          | Saltear          | Refogar na frigideira, saltear os alimentos, cozinhar rapidamente com pouca gordura            |
| **Pratos**        | **Tipo de Refeição**   | Entrada          | Aperitivo        | Pratos de entrada, aperitivos, petiscos                                                       |
|                   |                        | Prato Principal  | Prato Principal  | Pratos principais, refeições principais, pratos de destaque                                   |
|                   |                        | Sobremesa        | Doce             | Sobremesas, doces, guloseimas                                                                |
|                   | **Estilo de Servir**  | Buffet           | Self-service     | Serviço de buffet, autoatendimento, refeições servidas em bancadas                            |
|                   |                        | À La Carte       | Menu Fixo        | Serviço à la carte, menu fixo, escolha individual de pratos                                    |
|                   |                        | Família          | Compartilhado    | Refeições em estilo familiar, pratos compartilhados, comida de conforto                        |
| **Ferramentas**   | **Equipamentos de Cozinha** | Panelas     | Frigideira       | Panelas de cozimento, frigideiras, utensílios para fritar e cozinhar                           |
|                   |                        | Forno            | Microondas       | Fornos convencionais, micro-ondas, aparelhos de cozimento                                      |
|                   |                        | Utensílios       | Colher de pau    | Utensílios de cozinha, colheres de pau, ferramentas de preparo                                  |
|                   |                        | Acessórios       | Processador de Alimentos | Acessórios de cozinha, processadores de alimentos, aparelhos auxiliares de preparo        |
|                   |                        | Talheres         | Faca             | Talheres de cozinha, facas, utensílios para cortar e servir                                     |
|                   |                        | Equipamentos Especiais | Churrasqueira | Equipamentos especiais, churrasqueiras, aparelhos para técnicas específicas de cozimento       |


## Importante!
- Utilize o WampServer (https://sourceforge.net/projects/wampserver/files/WampServer%203/WampServer%203.0.0/) para utilizar o DOC Analysis
- Utilize o cabecalho abaixo em sua planilha:


| Dimensão          | Nome do Fator          | Pref Termo       | Alt Termo        | Termos                                                                                      |
|-------------------|------------------------|------------------|------------------|---------------------------------------------------------------------------------------------|

---

