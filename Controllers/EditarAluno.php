<?php


namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarAluno
{
    private $Dados;
    private $DadosId;

    public function editAluno($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editAlunoPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Aluno não encontrado!</div>";
            $UrlDestino = URLADM . 'alunos/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editAlunoPriv()
    {
        if (!empty($this->Dados['EditAluno'])) {
            unset($this->Dados['EditAluno']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarAluno = new \App\adms\Models\AdmsEditarAluno();
            $editarAluno->altAluno($this->Dados);
            if ($editarAluno->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>As alterações foi aceita com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-aluno/ver-aluno/' . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editAlunoViewPriv();
            }
        } else {
            $verAluno = new \App\adms\Models\AdmsEditarAluno();
            $this->Dados['form'] = $verAluno->verAluno($this->DadosId);
            $this->editAlunoViewPriv();
        }
    }

    private function editAlunoViewPriv()
    {
        if ($this->Dados['form']) {
            $listarSelect = new \App\adms\Models\AdmsEditarAluno();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $botao = ['vis_aluno' => ['menu_controller' => 'ver-aluno', 'menu_metodo' => 'ver-aluno']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            $carregarView = new \Core\ConfigView("adms/Views/aluno/editarAluno", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O aluno não foi encontrado em nosso banco de dados!</div>";
            $UrlDestino = URLADM . 'alunos/listar';
            header("Location: $UrlDestino");
        }
    }

}