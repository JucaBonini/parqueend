<?php


namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarModalidadeEsportiva
{
    private $DadosId;

    public function apagarModalidadeEsportiva($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $apagarModalidadeEsportiva = new \App\adms\Models\AdmsApagarModalidadeEsportiva();
            $apagarModalidadeEsportiva->apagarModalidadeEsportiva($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma Modalidade Esportiva!</div>";
        }
        $UrlDestino = URLADM . 'modalidade-esportiva/listar';
        header("Location: $UrlDestino");
    }


}