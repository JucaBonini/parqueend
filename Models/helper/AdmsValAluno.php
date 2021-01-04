<?php


namespace App\adms\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsValAluno
{
    private $Aluno;
    private $Resultado;
    private $EditarUnico;
    private $DadoId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function valAluno($Aluno, $EditarUnico = null, $DadoId = null)
    {
        $this->Aluno = (string) $Aluno;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valAluno = new \App\adms\Models\helper\AdmsRead();
        if(!empty($this->EditarUnico) AND ($this->EditarUnico == true)){
            $valAluno->fullRead("SELECT id FROM adms_alunos WHERE rg =:rg AND id <>:id LIMIT :limit", "rg={$this->Aluno}&limit=1&id={$this->DadoId}");
        }else{
            $valAluno->fullRead("SELECT id FROM adms_alunos WHERE rg =:rg LIMIT :limit", "rg={$this->Aluno}&limit=1");
        }
        $this->Resultado = $valAluno->getResultado();
        if (!empty($this->Resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este aluno já está cadastrado!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }



}