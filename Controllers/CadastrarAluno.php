<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarAluno
{

    private $Dados;

    public function cadAluno()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadAluno'])) {
            unset($this->Dados['CadAluno']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadAluno = new \App\adms\Models\AdmsCadastrarAluno();
            $cadAluno->cadAluno($this->Dados);
            if ($cadAluno->getResultado()) {
                $UrlDestino = URLADM . 'aluno/listar';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadAlunoViewPriv();
            }
        } else {
            $this->cadAlunoViewPriv();
        }
    }

    private function cadAlunoViewPriv()
    {
        $listarSelect = new \App\adms\Models\AdmsCadastrarAluno();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_aluno' => ['menu_controller' => 'aluno', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        $carregarView = new \Core\ConfigView("adms/Views/aluno/cadAluno", $this->Dados);
        $carregarView->renderizar();
    }

}
