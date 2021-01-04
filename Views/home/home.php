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
                <h2 class="display-4 titulo">Dashboard</h2>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-success text-white">

                    <a href="<?php echo URLADM . 'cadastrar-aluno/cad-aluno'; ?>" style="color: #ffffff !important; text-decoration: none;">
                        <div class="card-body">
                            <i class="fas fa-child fa-3x"></i>
                            <h6 class="card-title">Formulário de Inscrição</h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-info text-white">
                    <a href="<?php echo URLADM . 'aluno/listar'; ?>" style="color: #ffffff !important; text-decoration: none;">
                        <div class="card-body">
                            <i class="fas fa-eye fa-3x"></i>
                            <h6 class="card-title">Ver Alunos</h6>

                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-danger text-white">
                    <a href="<?php echo URLADM . 'usuarios/listar'; ?>" style="color: #ffffff !important; text-decoration: none;">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x"></i>
                        <h6 class="card-title">Usuários do Sistema</h6>
                    </div>
                    </a>
                </div>

            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card bg-warning text-white">
                    <a href="<?php echo URLADM . '#'; ?>" style="color: #ffffff !important; text-decoration: none;">
                    <div class="card-body">
                        <i class="fas fa-money-bill-alt fa-3x"></i>
                        <h6 class="card-title">Financeiro/Prestação</h6>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>