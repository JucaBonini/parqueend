<?php


namespace App\adms\Models;


class AdmsEditarModalidadeEsportiva
{
    private $Resultado;
    private $Dados;
    private $DadosId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verModalidadeEsportiva($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verModalidadeEsportiva = new \App\adms\Models\helper\AdmsRead();
        $verModalidadeEsportiva->fullRead("SELECT * FROM adms_modalidades
                WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verModalidadeEsportiva->getResultado();
        return $this->Resultado;
    }

    public function altModalidadeEsportiva(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditModalidadeEsportiva();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditModalidadeEsportiva()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltModalidadeEsportiva = new \App\adms\Models\helper\AdmsUpdate();
        $upAltModalidadeEsportiva->exeUpdate("adms_modalidades", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltModalidadeEsportiva->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Modalidade Esportiva atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível atualizada a Modalidade Esportiva!</div>";
            $this->Resultado = false;
        }
    }

    /**
     * <b>Listar registros para chave estrangeira:</b> Buscar informações na tabela "adms_cors" para utilizar como chave estrangeira
     */

}