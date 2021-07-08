<?php

class Vacinacao extends Sql
{
  private $pr_cadastro_vacina_id_vacina ;
  private $pr_paciente_id_paciente ;
  private $id_dose;
  private $fl_controle_dose;
  private $fl_data_aplicacao;  
  private $fl_data_aplicacao_segunda_dose;  
  public function getIdVacina()
  {
      return $this->pr_cadastro_vacina_id_vacina;
  }

  public function setIdVacina($pr_cadastro_vacina_id_vacina)
  {
      $this->pr_cadastro_vacina_id_vacina = $pr_cadastro_vacina_id_vacina;
  }

  public function getIdPaciente()
  {
      return $this->pr_paciente_id_paciente;
  }

  public function setIdPaciente($pr_paciente_id_paciente)
  {
      $this->pr_paciente_id_paciente = $pr_paciente_id_paciente;
  }

  public function getIdDose()
  {
      return $this->id_dose;
  }

  public function setIdDose($id_dose)
  {
      $this->id_dose = $id_dose;
  }

  public function getControleDose()
  {
      return $this->fl_controle_dose;
  }

  public function setControleDose($fl_controle_dose)
  {
      $this->fl_controle_dose = $fl_controle_dose;
  }
  public function getDataAplicacao()
  {
      return $this->fl_data_aplicacao;
  }

  public function setDataAplicacao($fl_data_aplicacao)
  {
      $this->fl_data_aplicacao = $fl_data_aplicacao;
  }

  public function getDataSegundaAplicacao()
  {
      return $this->fl_data_aplicacao_segunda_dose;
  }

  public function setDataSEgundaAplicacao($fl_data_aplicacao_segunda_dose)
  {
      $this->fl_data_aplicacao_segunda_dose = $fl_data_aplicacao_segunda_dose;
  }
  public function getDose()
  {
    $sql = "select * from `pr_vacinacao` where id_paciente =".$this->getIdPaciente();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function getAplicacoesDeDoses()
  {
    $sql = "SELECT nome_paciente, cpf, cv.nome_fabricante  as nome_vacina ,DATE_FORMAT(dt_nascimento,'%d/%m/%Y')  as data_nascimento, v.fl_controle_dose as doses_aplicadas, DATE_FORMAT(v.fl_data_aplicacao,'%d/%m/%Y') as data_aplicação, DATE_FORMAT(v.fl_data_aplicacao_segunda_dose,'%d/%m/%Y') as data_segunda_aplicacao FROM `pr_vacinacao` v left join pr_paciente p on p.id_paciente = v.id_paciente 
    left join pr_cadastro_vacina cv on cv.id_vacina = v.id_vacina order by fl_data_aplicacao desc ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function aplicarDoses()
  {
    $sql = "insert into `pr_vacinacao` set `id_vacina` = '".$this->getIdVacina()."', `id_paciente` = '".$this->getIdPaciente()."', `id_dose` = '".$this->getIdDose()."', `fl_controle_dose` = '".$this->getControleDose()."', `fl_data_aplicacao` = '".$this->getDataAplicacao()."', `fl_data_aplicacao_segunda_dose` = '".$this->getDataSegundaAplicacao()."'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $sql;
  }
  public function atualizarDose()
  {
    $sql = "update `pr_vacinacao` set `fl_data_aplicacao_segunda_dose` = '".$this->getDataSegundaAplicacao()."', `fl_controle_dose` = ".$this->getControleDose()." where id_paciente =".$this->getIdPaciente();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $sql;
  }
  public function buscarAplicacaoDosePorPaciente()
  {
    $sql = "SELECT nome_paciente, rg, cpf, telefone ,DATE_FORMAT(dt_nascimento,'%d/%m/%Y')  as data_nascimento, v.fl_controle_dose as doses_aplicadas, v.fl_data_aplicacao as data_aplicação FROM `pr_vacinacao` v left join pr_paciente p on p.id_paciente = v.pr_paciente_id_paciente 
    left join pr_cadastro_vacina cv on cv.id_vacina = v.pr_cadastro_vacina_id_vacina order by fl_data_aplicacao desc ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
