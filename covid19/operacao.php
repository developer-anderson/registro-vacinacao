<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Credentials", "true");
require_once('Vacina.php');
require_once('Pacientes.php');
require_once('Vacinacao.php');
$vacina = new Vacina();
$pacientes = new Pacientes();
$vacinacao = new Vacinacao();
$data = json_decode(file_get_contents("php://input"), true);
// cadastro de vacinas
if(!empty($data['fabricante']) and !empty($data['lote']))
{
    $vacina->setNomeFabricante($data['fabricante']);
    $vacina->setLote($data['lote']);
    $vacina->setDataValidade($data['datavalidade']);
    $vacina->setNumeroDoses($data['numerodoses']);
    $vacina->setIntervaloMinimoDoses($data['intervalominimodoses']);
    $vacina->novaVacina();
}
if(!empty($data['nome_paciente']) and !empty($data['rg']))
{
    $pacientes->setNomePaciente($data['nome_paciente']);
    $pacientes->setRg($data['rg']);
    $pacientes->setCpf($data['cpf']);
    $pacientes->setDataNascimento($data['dt_nascimento']);
    $pacientes->setTelefone($data['telefone']);
    $pacientes->novoPaciente();
}
if(!empty($data['nome_paciente']) and !empty($data['nome_fabricante']))
{
    //verificar se existe  paciente com dose aplicada e quantas doses foram aplicada 
    $pacientes->setNomePaciente($data['nome_paciente']);
    $dados_paciente = $pacientes->getPacientePorNome();
    $vacina->setNomeFabricante($data['nome_fabricante']);
    $dados_vacina = $vacina->getVacinaPorFabricante();
    $intervalo = $dados_vacina['intervalo_minimo_doses'];
    $vacinacao->setIdPaciente($dados_paciente['id_paciente']);
    if(empty($vacinacao->getDose()))
    {
        $vacinacao->setIdVacina($dados_vacina['id_vacina']);
        $vacinacao->setIdDose($dados_vacina['id_vacina']);
        $vacinacao->setControleDose(1);
        $vacinacao->setDataAplicacao(date("Y-m-d"));
        $vacinacao->setDataSEgundaAplicacao("0000-00-00");
        $vacinacao->aplicarDoses();
        $retorno = array("situacao" => 1, "msg" => "Primeira dose aplicada");
        echo(json_encode(($retorno)));
    }
    else
    {
        $dados_dose = $vacinacao->getDose();
        if($dados_dose['fl_controle_dose'] == $dados_vacina['numero_doses'])
        {
            $retorno = array("situacao" => 0, "msg" => "O paciente ".$data['nome_paciente']." já recebeu todas as doses, logo você não poderá aplicar mais uma dose.");
            echo(json_encode(($retorno)));
        }
        elseif($dados_dose['id_vacina'] <> $dados_vacina['id_vacina'])
        {
            $retorno = array("situacao" => 0, "msg" => "A vacina da segunda dose não poderá ser diferente da primeira dose.");
            echo(json_encode(($retorno)));
        }
        elseif(date("Y-m-d") < date('Y-m-d', strtotime($dados_dose['fl_data_aplicacao']. " + $intervalo days")))
        {
            $retorno = array("situacao" => 0, "msg" => "O intervalo minimo entre doses não foi atendido.");
            echo(json_encode(($retorno)));
        }
        else
        {
            $vacinacao->setControleDose(2);
            $vacinacao->setDataSEgundaAplicacao(date("Y-m-d"));
            $vacinacao->atualizarDose();
            $retorno = array("situacao" => 1, "msg" => "Segunda dose aplicada");
            echo(json_encode(($retorno)));
        }
    }
    //verificar quantas doses o fabricante permite
    //verificar se o fabricante da segunda dose é diferente da primeira 
}
if(!empty($_GET['listarvacinas']))
{
    echo json_encode($vacina->getVacinas());
}
if(!empty($_GET['listarpacientes']))
{
    echo json_encode($pacientes->getPacientes());
}

if(!empty($_GET['listarvacinados']))
{
    echo json_encode($vacinacao->getAplicacoesDeDoses());
}