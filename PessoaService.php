<?php

class PessoaService
{
    private $conexao;
    private $pessoa;

    public function __construct(Conexao $conexao, Pessoa $pessoa)
    {
        $this->conexao = $conexao->conectar();
        $this->pessoa = $pessoa;
    }

    public function inserir()
    {
        try {
            $query = 'INSERT INTO pessoa (nome, idade) VALUES (:nome, :idade)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->pessoa->__get('nome'));
            $stmt->bindValue(':idade', $this->pessoa->__get('idade'));
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao inserir: ' . $e->getMessage();
        }
    }

    public function recuperar()
    {
        try {
            $query = 'SELECT id, nome, idade FROM pessoa';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Pessoa');
        } catch (PDOException $e) {
            echo 'Erro ao recuperar: ' . $e->getMessage();
        }
    }

    public function atualizar()
    {
        try {
            $query = 'UPDATE pessoa SET nome = ?, idade = ? WHERE id = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->pessoa->__get('nome'));
            $stmt->bindValue(2, $this->pessoa->__get('idade'));
            $stmt->bindValue(3, $this->pessoa->__get('id'));
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao atualizar: ' . $e->getMessage();
        }
    }

    public function remover()
    {
        try {
            $query = 'DELETE FROM pessoa WHERE id = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->pessoa->__get('id'));
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao remover: ' . $e->getMessage();
        }
    }
}
