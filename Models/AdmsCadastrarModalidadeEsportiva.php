<?php


namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsCadastrarModalidadeEsportiva
{
    private $Resultado;
    private $Dados;
    private $UltimoNivAc;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadModalidadeEsportiva(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirModalidadeEsportiva();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirModalidadeEsportiva()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $cadModalidadeEsportiva = new \App\adms\Models\helper\AdmsCreate;
        $cadModalidadeEsportiva->exeCreate("adms_modalidades", $this->Dados);
        if ($cadModalidadeEsportiva->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Modalidade Esportiva cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível cadastrada aModalidade Esportiva!</div>";
            $this->Resultado = false;
        }
    }



}