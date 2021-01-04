<?php


namespace App\adms\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsRgUnico
{
    private $Rg;
    private $Resultado;
    private $EditarUnico;
    private $DadoId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function valRgUnico($Rg, $EditarUnico = null, $DadoId = null)
    {
        $this->Rg = (string) $Rg;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valRgUnico = new \App\adms\Models\helper\AdmsRead();
        if(!empty($this->EditarUnico) AND ($this->EditarUnico == true)){
            $valRgUnico->fullRead("SELECT id FROM adms_alunos WHERE rg =:rg AND id <>:id LIMIT :limit", "rg={$this->Rg}&limit=1&id={$this->DadoId}");
        }else{
            $valRgUnico->fullRead("SELECT id FROM adms_alunos WHERE rg =:rg LIMIT :limit", "rg={$this->Rg}&limit=1");
        }
        $this->Resultado = $valRgUnico->getResultado();
        if (!empty($this->Resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este RG já está cadastrado!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}