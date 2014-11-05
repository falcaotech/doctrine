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
Os parâmetros para conexão com o banco de dados devem ser alterados no arquivo 'bootstrap.php'

Utilização
===========

```
php -S 0.0.0.0:8888 -t web/
```

Rotas
===============================

- Listagem dos produtos -> /produto/listagem
- Inserção dos produtos -> /produto/inserir/nome/descricao/valor
