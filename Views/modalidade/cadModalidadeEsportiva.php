<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Cadastre uma Modalidade Esportiva</h2>
            </div>
            <div class="p-2">
            <a class="btn btn-primary" href="<?php echo URLADM . 'modalidade-esportiva/listar'; ?>"> Listar</a>


            </div>

        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome</label>
                    <input name="nome" type="text" class="form-control" placeholder="Nome da Modalidade Esportiva" value="<?php
                    if (isset($valorForm['nome'])) {
                        echo $valorForm['nome'];
                    }
                    ?>">
                </div>

            </div>

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadModalidadeEsportiva" type="submit" class="btn btn-warning" value="Cadastrar">
        </form>
    </div>
</div>
