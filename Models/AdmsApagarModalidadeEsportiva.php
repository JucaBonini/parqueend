<?php


namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsApagarModalidadeEsportiva
{
    private $DadosId;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function apagarModalidadeEsportiva($DadosId = null) {
        $this->DadosId = (int) $DadosId;
        $apagarModalidadeEsportiva = new \App\adms\Models\helper\AdmsDelete();
        $apagarModalidadeEsportiva->exeDelete("adms_modalidades", "WHERE id =:id", "id={$this->DadosId}");
        if ($apagarModalidadeEsportiva->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>A Modalidade Esportiva foi excluida com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível excluir a Modalidade Esportiva!</div>";
            $this->Resultado = false;
        }
    }

}