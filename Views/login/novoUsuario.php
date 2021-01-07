<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                    <img src="<?php echo URLADM; ?>/assets/imagens/caduser.png"
                         style="background-position: center;  background-size: cover;">

                </div>

                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-hand-point-right"></i> Por favor, leia nosso Termo de Compromisso <i class="fas fa-hand-pointer"></i>
                            </button><br>
                            <h1 class="h4 text-gray-900 mb-4">Você é novo por aqui?? Cadastre-se!</h1>


                        </div>
                        <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        if (isset($this->Dados['form'])) {
                            $valorForm = $this->Dados['form'];
                        }
                        ?>
                        <form class="user" name="formuser" method="POST" action="" >

                            <div class="form-group">
                                <input type="text" name="nome" class="form-control form-control-user"
                                       placeholder="Digite seu nome completo"
                                       value="<?php if (isset($valorForm['nome'])) {
                                           echo $valorForm['nome'];
                                       } ?>">
                            </div>

                            <div class="form-group">
                                <input type="tel" name="contato" id="contato" OnKeyPress="formatar('## #####-####', this)" class="form-control form-control-user"
                                       placeholder="Digite seu CELULAR com DDD"
                                       value="<?php if (isset($valorForm['contato'])) {
                                           echo $valorForm['contato'];
                                       } ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="datanasc" OnKeyPress="formatar('##/##/####', this)"  class="form-control form-control-user"
                                       placeholder="Digite sua data de nascimento"
                                       value="<?php if (isset($valorForm['datanasc'])) {
                                           echo $valorForm['datanasc'];
                                       } ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user"
                                       placeholder="Digite seu melhor E-mail"
                                       value="<?php if (isset($valorForm['email'])) {
                                           echo $valorForm['email'];
                                       } ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="usuario" class="form-control form-control-user"
                                       placeholder="Digite um usuário" value="<?php if (isset($valorForm['usuario'])) {
                                    echo $valorForm['usuario'];
                                } ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" name="senha" class="form-control form-control-user"
                                       placeholder="Digite uma senha ">
                            </div>

                            <input name="CadUserLogin" id="CadUserLogin" type="submit" class="btn btn-success btn-user btn-block"
                                   value="Cadastrar">

                        </form>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <a class="btn btn-warning btn-user btn-block" href="<?php echo URLADM . '/esqueceu-senha/esqueceu-senha' ?>">Esqueceu a
                                        senha?</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center">
                                    <a class="btn btn-info btn-user btn-block" href="<?php echo URLADM . 'login/acesso' ?>">já tem uma conta?
                                        Conecte-se!</a>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TERMO DE COMPROMISSO E RESPONSÁBILIDADE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Olá! Responsável pelos nossos atletas, estamos com essa nova ferramenta para inscrição e acompanhamento de seus filhos,
                lembrando que esse ambiente e monitorado por nosso suporte de TI, e quaisquer quebra de conduta dos nossos termo e estatuto
                estaremos enviando um comunicado alertando do ato e com isso tomaremos medidas cabíveis dentro da Lei.
                Ao se cadastrar em nosso sistema, você estará automaticamente aceitando os nossos termos.

            </div>
            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>
<script>
    function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i)

        if (texto.substring(0, 1) != saida) {
            documento.value += texto.substring(0, 1);
        }

    }
</script>









