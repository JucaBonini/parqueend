<?php


namespace App\adms\Models;


class AdmsApagarAluno
{
    private $DadosId;
    private $Resultado;
    private $DadosAluno;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarAluno($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verAluno();
        if ($this->DadosAluno) {
            $apagarAluno = new \App\adms\Models\helper\AdmsDelete();
            $apagarAluno->exeDelete("adms_alunos", "WHERE id =:id", "id={$this->DadosId}");
            if ($apagarAluno->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('assets/imagens/aluno/' . $this->DadosId . '/' . $this->DadosAluno[0]['imagem'], 'assets/imagens/aluno/' . $this->DadosId);
                $_SESSION['msg'] = "<div class='alert alert-success'>Aluno excluido com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Aluno não foi excluido!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível excluir o aluno!</div>";
            $this->Resultado = false;
        }
    }

    public function verAluno()
    {
        $verAluno = new \App\adms\Models\helper\AdmsRead();
        $verAluno->fullRead("SELECT al.imagem FROM adms_alunos al
                WHERE al.id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->DadosAluno = $verAluno->getResultado();
    }

}