<?php


namespace App\adms\Models;


if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsEditarAluno
{
    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;
    private $ImgAntiga;


    function getResultado()
    {
        return $this->Resultado;
    }


    public function verAluno($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verAluno = new \App\adms\Models\helper\AdmsRead();
        $verAluno->fullRead("SELECT * FROM adms_alunos
                WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verAluno->getResultado();
        return $this->Resultado;
    }


    public function altAluno(array $Dados)
    {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $this->Foto = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->valCampos();
        } else {
            $this->Resultado = false;
        }
    }

    private function valCampos()
    {

        $valRgUnico = new \App\adms\Models\helper\AdmsRgUnico();
        $EditarUnico = true;
        $valRgUnico->valRgUnico($this->Dados['rg'], $EditarUnico, $this->Dados['id']);

        $valAluno = new \App\adms\Models\helper\AdmsValAluno();
        $valAluno->valAluno($this->Dados['rg'], $EditarUnico, $this->Dados['id']);

        if (( $valAluno->getResultado()) AND ( $valRgUnico->getResultado())) {
            $this->valFoto();
        } else {
            $this->Resultado = false;
        }
    }

    private function valFoto()
{
    if (empty($this->Foto['name'])) {
        $this->updateEditAluno();
    } else {
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['imagem'] = $slugImg->nomeSlug($this->Foto['name']);

        $uploadImg = new \App\adms\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImagem($this->Foto, 'assets/imagens/aluno/' . $this->Dados['id'] . '/', $this->Dados['imagem'], 120, 165);
        if ($uploadImg->getResultado()) {
            $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
            $apagarImg->apagarImg('assets/imagens/aluno/' . $this->Dados['id'] . '/' . $this->ImgAntiga);
            $this->updateEditAluno();
        } else {
            $this->Resultado = false;
        }
    }
}

    private function updateEditAluno()
    {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAltAluno = new \App\adms\Models\helper\AdmsUpdate();
        $upAltAluno->exeUpdate("adms_alunos", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltAluno->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Aluno atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi possível atualizar os dados do aluno!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id id_sit, nome nome_sit FROM adms_sits_alunos ORDER BY nome ASC");
        $registro['sit'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_sex, nome nome_sex FROM adms_sexos ORDER BY nome ASC");
        $registro['sex'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_sang, nome nome_sang FROM adms_tp_sanguineos ORDER BY nome ASC");
        $registro['sang'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_mod, nome nome_mod FROM adms_modalidades ORDER BY nome ASC");
        $registro['mod'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_pos, nome nome_pos FROM adms_posicaos ORDER BY nome ASC");
        $registro['pos'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_tur, nome nome_tur FROM adms_turnos ORDER BY nome ASC");
        $registro['tur'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_par, nome nome_par FROM adms_parentescos ORDER BY nome ASC");
        $registro['par'] = $listar->getResultado();

        $this->Resultado = ['sit' =>  $registro['sit'], 'sex' => $registro['sex'], 'sang' => $registro['sang'], 'mod' => $registro['mod'], 'pos' => $registro['pos'], 'tur' => $registro['tur'], 'par' => $registro['par']];

        return $this->Resultado;
    }

}