<?php


namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarModalidadeEsportiva
{
    private $Dados;

    public function cadModalidadeEsportiva()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadModalidadeEsportiva'])) {
            unset($this->Dados['CadModalidadeEsportiva']);
            $cadModalidadeEsportiva = new \App\adms\Models\AdmsCadastrarModalidadeEsportiva();
            $cadModalidadeEsportiva->cadModalidadeEsportiva($this->Dados);
            if ($cadModalidadeEsportiva->getResultado()) {
                $UrlDestino = URLADM . 'modalidade-esportiva/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadModalidadeEsportivaViewPriv();
            }
        } else {
            $this->cadModalidadeEsportivaViewPriv();
        }
    }

    private function cadModalidadeEsportivaViewPriv()
    {
        $botao = ['list_ModalidadeEsportiva' => ['menu_controller' => 'modalidade-esportiva', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        $carregarView = new \Core\ConfigView("adms/Views/modalidade/cadModalidadeEsportiva", $this->Dados);
        $carregarView->renderizar();
    }

}