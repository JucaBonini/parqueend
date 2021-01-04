<?php


namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerAluno
{
    private $Dados;
    private $DadosId;

    public function verAluno($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $verAluno = new \App\adms\Models\AdmsVerAluno();
            $this->Dados['dados_aluno'] = $verAluno->verAluno($this->DadosId);

            $botao = ['list_aluno' => ['menu_controller' => 'aluno', 'menu_metodo' => 'listar'],
                'edit_aluno' => ['menu_controller' => 'editar-aluno', 'menu_metodo' => 'edit-aluno'],
                'del_aluno' => ['menu_controller' => 'apagar-aluno', 'menu_metodo' => 'apagar-aluno']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adms/Views/aluno/verAluno", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Aluno não encontrado!</div>";
            $UrlDestino = URLADM . 'alunos/listar';
            header("Location: $UrlDestino");
        }
    }

}