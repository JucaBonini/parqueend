<?php


namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarAluno
{
    private $DadosId;

    public function apagarAluno($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $apagarAluno = new \App\adms\Models\AdmsApagarAluno();
            $apagarAluno->apagarAluno($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um Aluno!</div>";
        }
        $UrlDestino = URLADM . 'aluno/listar';
        header("Location: $UrlDestino");
    }

}