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

| Pref Termo   | Alt Termo      | Termos                            |
|--------------|----------------|-----------------------------------|
| Categoria    | Tipo           | Carnes, Vegetais, Grãos, Frutas   |
| Cozimento    | Preparação      | Grelhado, Cozido, Assado, Frito   |
| Prato        | Receita        | Massas, Saladas, Sopas, Sobremesas|
| Regional     | Culinária      | Italiana, Mexicana, Indiana, Japonesa|
| Estilo       | Modo de Servir | Churrasco, Buffet, À la carte, Fast Food|
| Dieta        | Restrições     | Vegetariano, Sem Glúten, Vegan, Low-Carb|
| Tempero      | Condimento     | Sal, Pimenta, Ervas, Molhos       |
| Textura      | Consistência   | Crocante, Macio, Cremoso, Grelhado|
| Ocasião      | Evento         | Café da manhã, Almoço, Jantar, Festa|
| Popularidade | Tendência      | Superfood, Gourmet, Comfort Food, Street Food|

## Importante!
- Utilize o WampServer (https://sourceforge.net/projects/wampserver/files/WampServer%203/WampServer%203.0.0/) para utilizar o DOC Analysis
- Utilize o cabecalho abaixo em sua planilha:

| Pref Termo   | Alt Termo      | Termos                            |
|--------------|----------------|-----------------------------------|

---

