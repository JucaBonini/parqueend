<?php


namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class ModalidadeEsportiva
{
    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_modalidadeesportiva' => ['menu_controller' => 'cadastrar-modalidadeesportiva', 'menu_metodo' => 'cad-modalidadeesportiva'],
            'vis_modalidadeesportiva' => ['menu_controller' => 'ver-modalidadeesportiva', 'menu_metodo' => 'ver-modalidadeesportiva'],
            'edit_modalidadeesportiva' => ['menu_controller' => 'editar-modalidadeesportiva', 'menu_metodo' => 'edit-modalidadeesportiva'],
            'del_modalidadeesportiva' => ['menu_controller' => 'apagar-modalidadeesportiva', 'menu_metodo' => 'apagar-amodalidadeesportiva']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarPagina = new \App\adms\Models\AdmsListarModalidade();
        $this->Dados['listModalidadeEsportiva'] = $listarPagina->listarModalidadeEsportiva($this->PageId);
        $this->Dados['paginacao'] = $listarPagina->getResultadoPg();

        $carregarView = new \Core\ConfigView("adms/Views/modalidade/listarModalidade", $this->Dados);
        $carregarView->renderizar();
    }
}