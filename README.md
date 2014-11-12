SilexAPP
========

Aplicação desenvolvida utilizando o Micro Framework SILEX

Instalação
==========
```
git clone https://github.com/walterjrp/silexapp
```

Instalando Composer e dependências
==================================

```
cd silexapp
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

Parâmetros para conexão com o banco de dados
==========================================
Os parâmetros para conexão com o banco de dados devem ser alterados no arquivo 'bootstrap.php

Utilização
===========

```
cd silexapp/
php fixtures.php
php -S 0.0.0.0:8888 -t web/
```

API Rest
========

```
GET - http://0.0.0.0:8888/produtos -> Lista todos os produtos
GET - http://0.0.0.0:8888/produtos/id -> Lista um produto de determinado ID
POST - http://0.0.0.0:8888/produtos -> Insere produto no banco de dados (nome, descricao, valor
PUT - http://0.0.0.0:8888/produtos -> Altera um determinado produto no banco de dados (id)
DELETE - http://0.0.0.0:8888/produtos/id -> Deleta um produto de determinado ID
```
