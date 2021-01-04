<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Listar Modalidade Esportiva</h2>
            </div>
            <div class="p-2">

                <?php
                if ($this->Dados['botao']['cad_modalidadeesportiva']) {
                    echo "<a href='" . URLADM . "cadastrar-modalidadeesportiva/cad-modalidadeesportiva' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>

        </div>
        <?php
        if (empty($this->Dados['listModalidadeEsportiva'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma cor encontrada!
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
                    <th>Modalidade Esportiva</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->Dados['listModalidadeEsportiva'] as $mod) {
                    extract($mod);
                    ?>
                    <tr>
                        <th><?php echo $id; ?></th>
                        <td> <?php echo $nome; ?></td>

                        <td class="text-center">
                                <span class="d-none d-md-block">
                                    <a class="btn btn-outline-warning btn-sm" href="<?php echo URLADM . 'editar-modalidadeesportiva/edit-modalidadeesportiva/'.$id; ?>"> Editar</a>
                                    <a class="btn btn-outline-danger btn-sm" href="<?php echo URLADM . 'apagar-modalidade-esportiva/apagar-modalidade-esportiva/'.$id; ?>" data-confirm="Tem certeza de que deseja excluir o item selecionado?"> Excluir</a>

                                </span>
                            <div class="dropdown d-block d-md-none">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                    <a class="btn btn-outline-warning btn-sm" href="<?php echo URLADM . 'editar-modalidadeesportiva/edit-modalidadeesportiva/'.$id; ?>"> Editar</a>
                                    <a class="btn btn-outline-danger btn-sm" href="<?php echo URLADM . 'apagar-modalidade-esportiva/apagar-modalidade-esportiva/'.$id; ?>" data-confirm="Tem certeza de que deseja excluir o item selecionado?"> Excluir</a>
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
</div>
