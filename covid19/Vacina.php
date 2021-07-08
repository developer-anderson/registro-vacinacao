<?php
require_once("Sql.php");
class Vacina extends Sql
{
  private $id_vacina;
  private $nome_fabricante;
  private $lote;
  private $dt_validade;
  private $numero_doses;
  private $intervalo_minimo_doses;


  public function getIdVacina()
  {
      return $this->id_vacina;
  }

  public function setIdVacina($id_vacina)
  {
      $this->id_vacina = $id_vacina;
  }

  public function getNomeFabricante()
  {
      return $this->nome_fabricante;
  }

  public function setNomeFabricante($nome_fabricante)
  {
      $this->nome_fabricante = $nome_fabricante;
  }

  public function getLote()
  {
      return $this->lote;
  }

  public function setLote($lote)
  {
      $this->lote = $lote;
  }

  public function getDataValidade()
  {
      return $this->dt_validade;
  }

  public function setDataValidade($dt_validade)
  {
      $this->dt_validade = $dt_validade;
  }


  public function getNumeroDoses()
  {
      return $this->numero_doses;
  }

  public function setNumeroDoses($numero_doses)
  {
      $this->numero_doses = $numero_doses;
  }

  public function getIntervaloMinimoDoses()
  {
      return $this->intervalo_minimo_doses;
  }

  public function setIntervaloMinimoDoses($intervalo_minimo_doses)
  {
      $this->intervalo_minimo_doses = $intervalo_minimo_doses;
  }

  public function getVacina()
  {
    $sql = "select * from `pr_cadastro_vacina` where id_vacina =".$this->getIdVacina();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getVacinaPorFabricante()
  {
    $sql = "select * from `pr_cadastro_vacina` where nome_fabricante = '".$this->getNomeFabricante()."'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function getVacinas()
  {
    $sql = "select nome_fabricante, lote, numero_doses, intervalo_minimo_doses, DATE_FORMAT(dt_validade,'%d/%m/%Y')  as data_validade from `pr_cadastro_vacina`";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function novaVacina()
  {
    $sql = "insert into `pr_cadastro_vacina` set `nome_fabricante` = '".$this->getNomeFabricante()."', `lote` = '".$this->getLote()."', `dt_validade` = '".$this->getDataValidade()."', `numero_doses` = '".$this->getNumeroDoses()."', `intervalo_minimo_doses` = '".$this->getIntervaloMinimoDoses()."'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $sql;
  }
  public function atualizarVacina()
  {
    $sql = "update `pr_cadastro_vacina` set `nome_fabricante` = '".$this->getNomeFabricante()."', `lote` = '".$this->getLote()."', `dt_validade` = '".$this->getDataValidade()."', `numero_doses` = '".$this->getNumeroDoses()."', `intervalo_minimo_doses` = '".$this->getIntervaloMinimoDoses()."' where id_vacina =".$this->getIdVacina();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function deleteVacina()
  {
    $sql = "delete from `pr_cadastro_vacina` where id_vacina =".$this->getIdVacina();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
