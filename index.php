<?php

require "Pessoa.php";
require "PessoaService.php";
require "Conexao.php";

$pessoa = new Pessoa();
$pessoa->__set('id', 12);
$conexao = new Conexao();
$pessoaService = new PessoaService($conexao, $pessoa);
//$pessoaService->inserir();

$pessoas = $pessoaService->recuperar();

foreach ($pessoas as $p) {
   echo $p->__get('nome').'</br>';
}


