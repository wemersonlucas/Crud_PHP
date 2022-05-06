<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'bdaula07');

    $banco = new PDO('mysql:host='.HOST.';dbname='.DB_NAME, USER, PASSWORD);

    if($banco){
        echo("<br> Conexão OK!");
    }

    $nome = 'Hérica';
    $departamento = 'TI';
    $unidade = 'Mogi Guaçu';
    
    //Inserir funcionario  

    $novo_funcionario = array($nome, $departamento, $unidade);
    $gravar = $banco->prepare("insert into funcionarios (nome, departamento, unidade) values (?,?,?)");

    if($gravar->execute($novo_funcionario)){
        echo("<br> Cadastro realizado com sucesso!");
    }else{
        echo("<br> Erro ao cadastrar funcionário!");
    }


    //Consultar tabela funcionario
    $consulta = $banco->prepare("select * from funcionarios");
    $consulta->execute();
    $linha = $consulta->fetchAll(PDO::FETCH_OBJ);

    foreach($linha as $func){
        echo("<br>Nome = ". $func->nome.
        "<br> Departamento = ". $func->departamento.
        "<br> Unidade = ". $func->unidade);
        echo("<br>---------------------------");
    }

    //Atualizar (editar) um funcionario
    $editar = $banco->prepare("update funcionarios set unidade=? where nome=?");
    $nome = "Hérica";
    $unidade = "Canadá";

    $editar->execute(array($unidade,$nome));
    if($editar){
        echo ("<br> Atualização feita com sucesso!");
    }else{
        echo("<br> Erro ao atualizar funcionário!");
    }

    //Excluir funcionario
    $nome = "Corbanezi";
    $deletar = $banco->prepare("delete from funcionarios where nome=?");
    $deletar->execute(array($nome));

    if($deletar){
        echo("<br> Funcionário excluído com sucesso!");
    }else{
        echo("<br> Erro ao excluir funcionário!");
    }

    $banco = null;

?>