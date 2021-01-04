
<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                    <img src="<?php echo URLADM; ?>/assets/images/atualizasenha.png" style="background-position: center;  background-size: cover;">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Atualize sua Senha</h1>
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
                        <form class="user" name="formuser" method="POST" action="">


                            <div class="form-group">

                                    <input type="password" name="senha" class="form-control form-control-user"  placeholder="Digite uma senha ">


                            </div>

                            <input name="AtualSenha" type="submit" class="btn btn-warning btn-user btn-block" value="Atualizar">

                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?php echo URLADM . 'login/acesso' ?>">Lembrou da senha? Conecte-se!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>






