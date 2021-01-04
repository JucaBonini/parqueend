<?php


namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsListarModalidade
{
    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5;
    private $ResultadoPg;

    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }


    public function listarModalidadeEsportiva($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\adms\Models\helper\AdmsPaginacao(URLADM . 'modalidade/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id) AS num_result 
                FROM adms_modalidades");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarModalidadeEsportiva = new \App\adms\Models\helper\AdmsRead();
        $listarModalidadeEsportiva->fullRead("SELECT * FROM adms_modalidades
                ORDER BY id DESC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarModalidadeEsportiva->getResultado();
        return $this->Resultado;
    }
}