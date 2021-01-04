
<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                    <img src="<?php echo URLADM; ?>/assets/images/esqsenha.png" style="background-position: center;  background-size: cover;">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Recuperar a senha</h1>
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
                                <input type="email" name="email" class="form-control form-control-user" placeholder="Digite o e-mail cadastrado no sistema" value="<?php if(isset($valorForm['email'])){echo $valorForm['email'];} ?>">
                            </div>


                            <input name="RecupUserLogin" type="submit" class="btn btn-primary btn-user btn-block" value="Recuperar">

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






