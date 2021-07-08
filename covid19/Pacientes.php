<?php

class Pacientes extends Sql
{
  private $id_paciente;
  private $nome_paciente;
  private $rg;
  private $cpf;
  private $dt_nascimento;
  private $telefone;
  private $email;


  public function getIdPaciente()
  {
      return $this->id_paciente;
  }

  public function setIdPaciente($id_paciente)
  {
      $this->id_paciente = $id_paciente;
  }

  public function getNomePaciente()
  {
      return $this->nome_paciente;
  }

  public function setNomePaciente($nome_paciente)
  {
      $this->nome_paciente = $nome_paciente;
  }

  public function getRg()
  {
      return $this->rg;
  }

  public function setRg($rg)
  {
      $this->rg = $rg;
  }

  public function getCpf()
  {
      return $this->cpf;
  }

  public function setCpf($cpf)
  {
      $this->cpf = $cpf;
  }

  public function getDataNascimento()
  {
      return $this->dt_nascimento;
  }

  public function setDataNascimento($dt_nascimento)
  {
      $this->dt_nascimento = $dt_nascimento;
  }

  public function getTelefone()
  {
      return $this->telefone;
  }

  public function setTelefone($telefone)
  {
      $this->telefone = $telefone;
  }

  public function getEmail()
  {
      return $this->email;
  }

  public function setEmail($email)
  {
      $this->email = $email;
  }

  public function getPaciente()
  {
    $sql = "select * from `pr_paciente` where id_paciente =".$this->getIdPaciente();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getPacientePorNome()
  {
    $sql = "select * from `pr_paciente` where nome_paciente ='".$this->getNomePaciente()."'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function getPacientes()
  {
    $sql = "select nome_paciente, rg, cpf, telefone ,DATE_FORMAT(dt_nascimento,'%d/%m/%Y')  as data_nascimento from `pr_paciente`";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function novoPaciente()
  {
    $sql = "insert into `pr_paciente` set `nome_paciente` = '".$this->getNomePaciente()."', `rg` = '".$this->getRg()."', `cpf` = '".$this->getCpf()."', `dt_nascimento` = '".$this->getDataNascimento()."', `telefone` = '".$this->getTelefone()."'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $sql;
  }
  public function atualizarPaciente()
  {
    $sql = "update `pr_paciente` set `nome_paciente` = '".$this->getNomePaciente()."', `rg` = '".$this->getRg()."', `cpf` = '".$this->getCpf()."', `dt_nascimento` = '".$this->getDataNascimento()."', `telefone` = '".$this->getTelefone()."' where id_paciente =".$this->getIdPaciente();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function deletePaciente()
  {
    $sql = "delete from `pr_paciente` where id_paciente =".$this->getIdPaciente();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
