Listagem de produtos - Silex + Doctrine
========

Aplicação desenvolvida utilizando Silex e Doctrine ORM.

Instalação
==================================

```
git clone https://github.com/walterjrp/doctrine
cd doctrine
curl -sS https://getcomposer.org/installer | php
php composer.phar install
bin/doctrine orm:schema-tool:create
php -S 0.0.0.0:8888 -t web/
```

API Rest
========

```
GET - http://0.0.0.0:8888/api/produtos -> Lista todos os produtos
GET - http://0.0.0.0:8888/api/produtos/id -> Lista um produto de determinado ID
POST - http://0.0.0.0:8888/api/produtos -> Insere produto no banco de dados (nome, descricao, valor)
Atenção: O separador decimal é vírgula.
PUT - http://0.0.0.0:8888/api/produtos -> Altera um determinado produto no banco de dados (id)
DELETE - http://0.0.0.0:8888/api/produtos/id -> Deleta um produto de determinado ID
```
