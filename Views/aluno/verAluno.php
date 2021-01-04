<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['dados_aluno'][0])) {
    extract($this->Dados['dados_aluno'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Detalhes do Aluno</h2>
                </div>
                <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->Dados['botao']['list_aluno']) {
                        echo "<a href='" . URLADM . "aluno/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                    }
                    if ($this->Dados['botao']['edit_aluno']) {
                        echo "<a href='" . URLADM . "editar-aluno/edit-aluno/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                    }
                    if ($this->Dados['botao']['del_aluno']) {
                        echo "<a href='" . URLADM . "apagar-aluno/apagar-aluno/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                    }
                    ?>
                </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <?php
                            if ($this->Dados['botao']['list_aluno']) {
                                echo "<a href='" . URLADM . "alunos/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                            }
                            if ($this->Dados['botao']['edit_aluno']) {
                                echo "<a href='" . URLADM . "editar-aluno/edit-aluno/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                            }
                            if ($this->Dados['botao']['del_aluno']) {
                                echo "<a href='" . URLADM . "apagar-aluno/apagar-aluno/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }

            ?>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $id; ?> - <?php echo $nome; ?> -  <?php echo $apelido; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center">
                                <?php
                                if (!empty($imagem)) {
                                    echo "<img class='border-1 rounded' src='" . URLADM . "assets/imagens/aluno/" . $id . "/" . $imagem . "'  witdh='100' height='135'>";
                                } else {
                                    echo "<img src='" . URLADM . "assets/imagens/aluno/icone_aluno.png' witdh='100' height='135'>";
                                }
                                ?>

                            </div>

                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>

                                    <tr>
                                        <td>Contato/Recado:</td>
                                        <td><a href="https://api.whatsapp.com/send?phone=55<?php echo $tel_recado; ?>"
                                               target="_blank"><?php echo $tel_recado; ?> </a></td>
                                    </tr>
                                    <tr>
                                        <td>Responsável p/Aluno:</td>
                                        <td><?php echo $nome_recado; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Data Nasc:</td>
                                        <td><?php echo $data_nasc; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Rg:</td>
                                        <td><?php echo $rg; ?></td>
                                    </tr>
                                    <tr>
                                        <td>CPF:</td>
                                        <td><?php echo $cpf; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Sexo:</td>
                                        <td><?php echo $nome_sex; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tp Sanguineo:</td>
                                        <td><?php echo $nome_san; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Peso:</td>
                                        <td><?php echo $peso; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Altura:</td>
                                        <td><?php echo $altura; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Posição:</td>
                                        <td><?php echo $nome_pos; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Posição2:</td>
                                        <td><?php echo $nome_pos2; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Escola:</td>
                                        <td><?php echo $escola; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Período escolar:</td>
                                        <td><?php echo $nome_tur; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Situação</td>
                                        <td>
                                            <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_sit; ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Data Cadastro:</td>
                                        <td><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alteração Cadastro:</td>
                                        <td><?php
                                            if (!empty($modified)) {
                                                echo date('d/m/Y H:i:s', strtotime($modified));
                                            }
                                            ?></td>
                                    </tr>

                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Aluno não encontrado!</div>";
    $UrlDestino = URLADM . 'aluno/listar';
    header("Location: $UrlDestino");
}
?>



