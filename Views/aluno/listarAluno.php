<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
//var_dump($this->Dados);
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Listar Aluno/Atleta</h2>
            </div>
            <?php
            if ($this->Dados['botao']['cad_aluno']) {
                ?>
                <a href="<?php echo URLADM . 'cadastrar-aluno/cad-aluno'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-success btn-sm">
                            Cadastrar Aluno/Atleta
                        </button>
                    </div>
                </a>
                <?php
            }
            ?>

        </div>
        <?php
        if (empty($this->Dados['listAluno'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum aluno/atleta encontrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th class="d-none d-sm-table-cell">Nick</th>
                    <th class="d-none d-sm-table-cell">data_nasc</th>
                    <th class="d-none d-sm-table-cell">Responsável</th>
                    <th class="d-none d-lg-table-cell">Situação</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->Dados['listAluno'] as $aluno) {
                    extract($aluno);
                    ?>
                    <tr>

                        <th><?php echo $id; ?></th>
                        <th>
                            <?php
                            if (!empty($imagem)) {
                                echo "<img class='border-1 rounded' src='" . URLADM . "assets/imagens/aluno/" . $id . "/" . $imagem . "'  witdh='50' height='75'>";
                            } else {
                                echo "<img src='" . URLADM . "assets/imagens/aluno/icone_aluno.png' witdh='35' height='55'>";
                            }
                            ?>
                        </th>
                        <td><?php echo $nome; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $apelido; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $data_nasc; ?></td>
                        <td class="d-none d-sm-table-cell"><?php echo $nome_recado; ?></td>
                        <td class="d-none d-lg-table-cell">
                            <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_sit; ?></span>
                        </td>
                        <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_aluno']) {
                                        echo "<a href='". URLADM . "ver-aluno/ver-aluno/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_aluno']) {
                                        echo "<a href='". URLADM . "editar-aluno/edit-aluno/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_aluno']) {
                                        echo "<a href='". URLADM . "apagar-aluno/apagar-aluno/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                            <div class="dropdown d-block d-md-none">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                    <?php
                                    if ($this->Dados['botao']['vis_aluno']) {
                                        echo "<a class='dropdown-item' href='". URLADM . "ver-aluno/ver-aluno/$id'>Visualizar</a>";
                                    }
                                    if ($this->Dados['botao']['edit_aluno']) {
                                        echo "<a class='dropdown-item' href='". URLADM . "editar-aluno/edit-aluno/$id'>Editar</a>";
                                    }
                                    if ($this->Dados['botao']['del_aluno']) {
                                        echo "<a class='dropdown-item' href='". URLADM . "apagar-aluno/apagar-aluno/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                                    }
                                    ?>


                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>

            <?php
            echo $this->Dados['paginacao'];
            ?>
        </div>

    </div>
    <p style="font-size: 14px; color: red;">* Se você verificou alguns dados incorretos e quer corrigir, por favor envia um WhatsApp para o (13) 97409-3997, nos informe o id e nome do aluno.</p>
</div>

