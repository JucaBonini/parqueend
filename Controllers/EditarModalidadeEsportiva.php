<?php


namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarModalidadeEsportiva
{
    private $Dados;
    private $DadosId;

    public function editModalidadeEsportiva($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editModalidadeEsportivaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Modalidade Esportiva não encontrado!</div>";
            $UrlDestino = URLADM . 'modalidade-esportiva/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editModalidadeEsportivaPriv()
    {
        if (!empty($this->Dados['EditModalidadeEsportiva'])) {
            unset($this->Dados['EditModalidadeEsportiva']);
            $editarModalidadeEsportiva = new \App\adms\Models\AdmsEditarModalidadeEsportiva();
            $editarModalidadeEsportiva->altModalidadeEsportiva($this->Dados);
            if ($editarModalidadeEsportiva->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Modalidade Esportiva editada com sucesso!</div>";
                $UrlDestino = URLADM . 'modalidade-esportiva/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editModalidadeEsportivaViewPriv();
            }
        } else {
            $verModalidadeEsportiva = new \App\adms\Models\AdmsEditarModalidadeEsportiva();
            $this->Dados['form'] = $verModalidadeEsportiva->verModalidadeEsportiva($this->DadosId);
            $this->editModalidadeEsportivaViewPriv();
        }
    }

    private function editModalidadeEsportivaViewPriv()
    {
        if ($this->Dados['form']) {
            $botao = ['vis_modalidadeesportiva' => ['menu_controller' => 'modalidadeesportiva', 'menu_metodo' => 'modalidadeesportiva']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            $carregarView = new \Core\ConfigView("adms/Views/modalidade/editarModalidadeEsportiva", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Modalidade Esportiva não encontrada!</div>";
            $UrlDestino = URLADM . 'modalidade-esportiva/listar';
            header("Location: $UrlDestino");
        }
    }
}