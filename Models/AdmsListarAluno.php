<?php


namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsListarAluno
{
    private $Resultado;
    private $PageId;
    private $LimiteResultado = 20;
    private $ResultadoPg;
    private $ContarAluno;

    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }


    public function listarAluno($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\adms\Models\helper\AdmsPaginacao(URLADM . 'aluno/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id) AS num_result 
                FROM adms_alunos");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarAluno = new \App\adms\Models\helper\AdmsRead();
        $listarAluno->fullRead("SELECT al.id, al.nome, al.apelido, al.imagem, al.adms_sexo_id, al.data_nasc, al.nome_recado, al.adms_sits_aluno_id,
                sit.nome nome_sit,
                cr.cor cor_cr,
                sex.nome nome_sex
                FROM adms_alunos al 
                INNER JOIN adms_sits_alunos sit ON sit.id=al.adms_sits_aluno_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                INNER JOIN adms_sexos sex ON sex.id=al.adms_sexo_id
                ORDER BY id DESC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarAluno->getResultado();
        return $this->Resultado;
    }


}
