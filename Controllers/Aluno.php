<?php


namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Aluno
{
    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_aluno' => ['menu_controller' => 'cadastrar-aluno', 'menu_metodo' => 'cad-aluno'],
            'vis_aluno' => ['menu_controller' => 'ver-aluno', 'menu_metodo' => 'ver-aluno'],
            'edit_aluno' => ['menu_controller' => 'editar-aluno', 'menu_metodo' => 'edit-aluno'],
            'del_aluno' => ['menu_controller' => 'apagar-aluno', 'menu_metodo' => 'apagar-aluno']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarPagina = new \App\adms\Models\AdmsListarAluno();
        $this->Dados['listAluno'] = $listarPagina->listarAluno($this->PageId);
        $this->Dados['paginacao'] = $listarPagina->getResultadoPg();

        $carregarView = new \Core\ConfigView("adms/Views/aluno/listarAluno", $this->Dados);
        $carregarView->renderizar();
    }
}