<?php


namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmsCadastrarAluno
{

    private $Resultado;
    private $Dados;
    private $Foto;

    function getResultado()
    {
        return $this->Resultado;
    }

    private function verAluno()
    {
        $verAluno = new \App\adms\Models\helper\AdmsRead();
        $verAluno->fullRead("SELECT ordem FROM adms_alunos ORDER BY ordem DESC LIMIT :limit", "limit=1");
        $this->UltimoAluno = $verAluno->getResultado();
    }

    public function cadAluno(array $Dados)
    {
        $this->Dados = $Dados;

        $this->Foto = $this->Dados['imagem_nova'];
        unset( $this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirAluno();
        } else {
            $this->Resultado = false;
        }
    }

    private function valCampos()
    {

        $valRgUnico = new \App\adms\Models\helper\AdmsRgUnico();
        $valRgUnico->valRgUnico($this->Dados['rg']);

        if ( $valRgUnico->getResultado()) {
            $this->inserirAluno();
        } else {
            $this->Resultado = false;
        }
    }

    private function valFoto()
    {
        $uploadImg = new \App\adms\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImagem($this->Foto, 'assets/imagens/aluno/' . $this->Dados['id'] . '/', $this->Dados['imagem'], 120, 165);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Aluno cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O aluno não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }



    private function inserirAluno()
    {
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['imagem'] = $slugImg->nomeSlug($this->Foto['name']);

        $cadalunos = new \App\adms\Models\helper\AdmsCreate;
        $cadalunos->exeCreate("adms_alunos", $this->Dados);
        if ($cadalunos->getResultado()) {
            if (empty($this->Foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Aluno cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['id'] = $cadalunos->getResultado();
                $this->valFoto();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O aluno não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }


    public function listarCadastrar()
    {
        $listar = new \App\adms\Models\helper\AdmsRead();

        $listar->fullRead("SELECT id id_sit, nome nome_sit FROM adms_sits_usuarios ORDER BY nome ASC");
        $registro['sit'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_sex, nome nome_sex FROM adms_sexos ORDER BY nome ASC");
        $registro['sex'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_sang, nome nome_sang FROM adms_tp_sanguineos ORDER BY nome ASC");
        $registro['sang'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_mod, nome nome_mod FROM adms_modalidades ORDER BY nome ASC");
        $registro['mod'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_tur, nome nome_tur FROM adms_turnos ORDER BY nome ASC");
        $registro['tur'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_par, nome nome_par FROM adms_parentescos ORDER BY nome ASC");
        $registro['par'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_pos, nome nome_pos FROM adms_posicaos ORDER BY nome ASC");
        $registro['pos'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_pos2, nome nome_pos2 FROM adms_posicaos ORDER BY nome ASC");
        $registro['pos2'] = $listar->getResultado();

        $this->Resultado = ['sit' => $registro['sit'], 'sex' => $registro['sex'], 'sang' => $registro['sang'],
            'mod' => $registro['mod'], 'tur' => $registro['tur'], 'par' => $registro['par'], 'pos' => $registro['pos'], 'pos2' => $registro['pos2']];

        return $this->Resultado;
    }

}