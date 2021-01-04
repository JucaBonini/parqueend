<?php


namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsVerAluno
{
    private $Resultado;
    private $DadosId;

    public function verAluno($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verAluno = new \App\adms\Models\helper\AdmsRead();
        $verAluno->fullRead("SELECT al.*,                
                sit.nome nome_sit,
                sex.nome nome_sex,
                san.nome nome_san,                
                cr.cor cor_cr,
                pos.nome nome_pos,
                pos2.nome nome_pos2,
                tur.nome nome_tur
                FROM adms_alunos al
                INNER JOIN adms_tp_sanguineos san On san.id=al.adms_tp_sanguineo_id
                INNER JOIN adms_sexos sex ON sex.id=al.adms_sexo_id
                INNER JOIN adms_sits_alunos sit ON sit.id=al.adms_sits_aluno_id
                INNER JOIN adms_cors cr ON cr.id=sit.adms_cor_id
                INNER JOIN adms_posicaos pos ON pos.id=al.adms_posicao_id 
                INNER JOIN adms_posicaos pos2 ON pos2.id=al.adms_posicao2_id
                INNER JOIN adms_turnos tur ON tur.id=al.adms_turno_id
                WHERE al.id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado= $verAluno->getResultado();
        return $this->Resultado;
    }
}