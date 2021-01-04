<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image">
                            <img src="<?php echo URLADM; ?>/assets/imagens/logologin2.png"
                                 style="background-position: center;  background-size: cover;">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h2 class="h4 text-gray-900 mb-4">SISTEMA DE CADASTRO</h2>
                                    <h6>ÁREA EXCLUSIVA PARA OS RESPONSÁVEIS PELOS ATLETAS</h6>
                                </div>
                                <?php
                                //var_dump($this->Dados['form']);
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                                if (isset($this->Dados['form'])) {
                                    $valorForm = $this->Dados['form'];
                                }
                                ?>
                                <form class="user" method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" name="usuario" class="form-control form-control-user"
                                               placeholder="Digite seu Usuário"
                                               value="<?php if (isset($valorForm['usuario'])) {
                                                   echo $valorForm['usuario'];
                                               } ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="senha" class="form-control form-control-user"
                                               placeholder="Digita sua senha">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <!--<label class="custom-control-label" for="customCheck">Remember Me</label>-->
                                        </div>
                                    </div>

                                    <input name="SendLogin" type="submit" class="btn btn-primary btn-user btn-block"
                                           value="Acessar">

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="btn btn-success btn-user btn-block"
                                       href="<?php echo URLADM . 'novo-usuario/novoUsuario' ?>">Crie a sua conta
                                        aqui!</a>
                                </div>
                                <br><br>
                                <div class="text-center">
                                    <a class="btn btn-warning btn-sm"
                                       href="<?php echo URLADM . 'esqueceu-senha/esqueceu-senha' ?>">Esqueceu a
                                        senha?</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>






