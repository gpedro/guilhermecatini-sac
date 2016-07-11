<?php

/**
 * Classe com o CRUD da tabela empresa do banco de dados.
 */
class Empresa {

    private $con;
    private $codigo;
    private $nome;
    private $cnpj;
    private $cpf;
    private $endereco;
    private $numero;
    private $complemento;
    private $cep;
    private $bairro;
    private $cidade;
    private $estado;
    private $ddd;
    private $telefone;
    private $data_cadastro;

    function __construct(\PDO $con) {
        $this->con = $con;
    }
    /**
     * 
     * @return boolean Retorna true pra caso exista um cpf cadastrado e false para caso nao exista
     */
    public function ConsultaCPF()
    {
        $query = "SELECT * FROM controle.empresa WHERE cpf = :cpf";
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(":cpf", $this->cpf);
        try {
            $stmt->execute();
            if ($stmt->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        } catch (PDOException $ex) {
            return $ex->getCode();
        }
    }
    
    /**
     * 
     * @return bool Se retornar true o registro foi inserido com sucesso, caso
     * contrario ele retorna o código do erro do sql.
     */
    public function InserirDado()
    {
        // proximo codigo de cliente
        $stmtaux = $this->con->query("SELECT COALESCE((MAX(codigo)+1),0) FROM controle.empresa");
        $ax = $stmtaux->fetch(\PDO::FETCH_NUM);
        $this->codigo = $ax[0];
        
        $query = "INSERT INTO cadastros.empresa(
                    codigo, nome, cnpj, cpf, endereco, numero, bairro, complemento, 
                    cidade, estado, cep, ddd, telefone)
                  VALUES (:codigo, :nome, :cnpj, :cpf, :endereco, :numero, :bairro, :complemento, 
                    :cidade, :estado, :cep, :ddd, :telefone);";
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(":codigo", $this->codigo);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":cnpj", $this->cnpj);
        $stmt->bindValue(":cpf", $this->cpf);
        $stmt->bindValue(":endereco", $this->endereco);
        $stmt->bindValue(":numero", $this->numero);
        $stmt->bindValue(":bairro", $this->bairro);
        $stmt->bindValue(":complemento", $this->complemento);
        $stmt->bindValue(":cidade", $this->cidade);
        $stmt->bindValue(":estado", $this->estado);
        $stmt->bindValue(":cep", $this->cep);
        $stmt->bindValue(":ddd", $this->ddd);
        $stmt->bindValue(":telefone", $this->telefone);
        
        try 
        {
            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            return "Erro: " . $ex->getCode();
        }
        
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getUf() {
        return $this->uf;
    }

    public function getDdd() {
        return $this->ddd;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getData_cadastro() {
        return $this->data_cadastro;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }

    public function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }



}
