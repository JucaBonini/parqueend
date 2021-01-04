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
                <h2 class="display-4 titulo">Editar dados do aluno</h2>
                <h4 class="display-6">Escola de Futebol - Centro de Formação Parque das bandeiras</h4>
            </div>

            <?php
            if ($this->Dados['botao']['vis_aluno']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-aluno/ver-aluno/' . $valorForm['id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>


                </div>
                <?php
            }
            ?>

        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <input name="id" type="hidden" value="<?php
            if (isset($valorForm['id'])) {
                echo $valorForm['id'];
            }
            ?>">
            <fieldset>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input name="imagem_antiga" type="hidden" value="<?php
                        if (isset($valorForm['imagem_antiga'])) {
                            echo $valorForm['imagem_antiga'];
                        } elseif (isset($valorForm['imagem'])) {
                            echo $valorForm['imagem'];
                        }
                        ?>">

                        <label> Foto </label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group col-md-4">
                        <?php
                        if (isset($valorForm['imagem']) AND ! empty($valorForm['imagem'])) {
                            $imagem_antiga = URLADM . 'assets/imagens/aluno/' . $valorForm['id'] . '/' . $valorForm['imagem'];
                        } elseif (isset($valorForm['imagem_antiga']) AND ! empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'assets/imagens/aluno/' . $valorForm['id'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'assets/imagens/aluno/preview_img.png';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem do Aluno" id="preview-user" class="img-thumbnail" style="width: 150px; height: 150px;">
                    </div>
                    <div class="form-group col-md-2">
                        <label> Situação Cadastral</label>
                        <select name="adms_sits_aluno_id" id="adms_sits_aluno_id" class="form-control">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['sit'] as $sit) {
                                extract($sit);
                                if ($valorForm['adms_sits_aluno_id'] == $id_sit) {
                                    echo "<option value='$id_sit' selected>$nome_sit</option>";
                                } else {
                                    echo "<option value='$id_sit'>$nome_sit</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label> Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Digite o nome completo" value="<?php
                        if (isset($valorForm['nome'])) {
                            echo $valorForm['nome'];
                        }
                        ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label> Nick ou como ele é + conhecido</label>
                        <input name="apelido" type="text" class="form-control" placeholder="Digite como o aluno é conhecido" value="<?php
                        if (isset($valorForm['apelido'])) {
                            echo $valorForm['apelido'];
                        }
                        ?>">
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label> CPF</label>
                        <input name="cpf" type="text" class="form-control" id="cpf" placeholder="Digite Apenas números"  maxlength="11" pattern="[0-9]+$" value="<?php
                        if (isset($valorForm['cpf'])) {
                            echo $valorForm['cpf'];
                        }
                        ?>">
                         <p style="font-size: 12px;">Digite apenas os números</p>
                    </div>
                    <div class="form-group col-md-2">
                        <label> RG</label>
                        <input name="rg" type="text" class="form-control" id="rg"  placeholder="Digite Apenas números" required="" maxlength="10" pattern="[0-9]+$" value="<?php
                        if (isset($valorForm['rg'])) {
                            echo $valorForm['rg'];
                        }
                        ?>">
                        <p style="font-size: 12px;">Digite apenas os números</p>
                    </div>
                    <div class="form-group col-md-2">
                        <label> Data Nasc.</label>
                        <input id="dtnasc" name="data_nasc" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()" value="<?php
                        if (isset($valorForm['data_nasc'])) {
                            echo $valorForm['data_nasc'];
                        }
                        ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label> Sexo</label>
                        <select class="form-control" name="adms_sexo_id" id="adms_sexo_id">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['sex'] as $sex) {
                                extract($sex);
                                if ($valorForm['adms_sexo_id'] == $id_sex) {
                                    echo "<option value='$id_sex' selected>$nome_sex</option>";
                                } else {
                                    echo "<option value='$id_sex'>$nome_sex</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                    <div class="col-md-2 control-label">
                        <h3>Endereço</h3>
                    </div>
                </div>
                <!----Contatos --->
                <div class="form-row">
                    <div class="col-md-2">

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">  CEP</div>
                            </div>
                            <input id="cep" name="cep" placeholder="Apenas números" class="form-control input-md" required="" value="<?php if (isset($valorForm['cep'])) {
                                echo $valorForm['cep'];
                            } ?>" type="search" maxlength="8" pattern="[0-9]+$">
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" onclick="pesquisacep(cep.value)">Pesquisar</button>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> Rua</div>
                            </div>
                            <input id="rua" name="rua" class="form-control" placeholder="" required="" readonly="readonly" type="text" value="<?php if (isset($valorForm['rua'])) {
                                echo $valorForm['rua'];
                            } ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> N°</div>
                            </div>
                            <input id="numero" name="numero" class="form-control" placeholder="" required=""  type="text" value="<?php if (isset($valorForm['numero'])) {
                                echo $valorForm['numero'];
                            } ?>">
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> Bairro</div>
                            </div>
                            <input id="bairro" name="bairro" class="form-control" placeholder="" required="" readonly="readonly" type="text" value="<?php if (isset($valorForm['bairro'])) {
                                echo $valorForm['bairro'];
                            } ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> Cidade</div>
                            </div>
                            <input id="cidade" name="cidade" class="form-control" placeholder="" required=""  readonly="readonly" type="text" value="<?php if (isset($valorForm['cidade'])) {
                                echo $valorForm['cidade'];
                            } ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> Estado</div>
                            </div>
                            <input id="estado" name="estado" class="form-control" placeholder="" required=""  readonly="readonly" type="text" value="<?php if (isset($valorForm['estado'])) {
                                echo $valorForm['estado'];
                            } ?>">
                        </div>
                    </div>
                </div>
                <!----/Contatos --->
                <div class="form-group">
                    <hr>
                    <div class="col-md-3 control-label">
                        <h3>Complementos</h3>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label> Altura</label>
                        <input name="altura" type="text" class="form-control" id="altura"  placeholder="Digite a altura do aluno" value="<?php
                        if (isset($valorForm['altura'])) {
                            echo $valorForm['altura'];
                        }
                        ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label> Peso</label>
                        <input name="peso" type="text" class="form-control" id="peso" placeholder="Digite o peso do aluno" value="<?php
                        if (isset($valorForm['peso'])) {
                            echo $valorForm['peso'];
                        }
                        ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label> Tipo Sanguineo</label>
                        <select class="form-control" name="adms_tp_sanguineo_id" id="adms_tp_sanguineo_id" required>
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['sang'] as $sang) {
                                extract($sang);
                                if ($valorForm['adms_tp_sanguineo_id'] == $id_sang) {
                                    echo "<option value='$id_sang' selected>$nome_sang</option>";
                                } else {
                                    echo "<option value='$id_sang'>$nome_sang</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!--<div class="form-group col-md-4">
                        <label> Atestado Médico</label>
                        <input type="file" class="form-control" name="atestado" id="new_atestado" onchange="previewAtestado();">
                        <p><span class="text-danger">**</span>Inserir o Atestado Médico Legivél</p>
                    </div>-->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label> Posição</label>
                        <select class="form-control" name="adms_posicao_id" id="adms_posicao_id" required>
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['pos'] as $pos) {
                                extract($pos);
                                if ($valorForm['adms_posicao_id'] == $id_pos) {
                                    echo "<option value='$id_pos' selected>$nome_pos</option>";
                                } else {
                                    echo "<option value='$id_pos'>$nome_pos</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label> 2ª Posição</label>
                        <select class="form-control" name="adms_posicao2_id" id="adms_posicao2_id" required>
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['pos'] as $pos) {
                                extract($pos);
                                if ($valorForm['adms_posicao2_id'] == $id_pos) {
                                    echo "<option value='$id_pos' selected>$nome_pos</option>";
                                } else {
                                    echo "<option value='$id_pos'>$nome_pos</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label> Modalidade</label>
                        <select class="form-control" name="adms_modalidade_id" id="adms_modalidade_id" required>
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['mod'] as $mod) {
                                extract($mod);
                                if ($valorForm['adms_modalidade_id'] == $id_mod) {
                                    echo "<option value='$id_mod' selected>$nome_mod</option>";
                                } else {
                                    echo "<option value='$id_mod'>$nome_mod</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <hr>
                    <div class="col-md-2 control-label">
                        <h3>Escolar</h3>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label> Escola</label>
                            <input name="escola" type="text" class="form-control" placeholder="Nome da Escola que estuda" value="<?php
                            if (isset($valorForm['escola'])) {
                                echo $valorForm['escola'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label> Período</label>
                            <select class="form-control" name="adms_turno_id" id="adms_turno_id" >
                                <?php
                                foreach ($this->Dados['select']['tur'] as $tur) {
                                    extract($tur);
                                    if ($valorForm['adms_turno_id'] == $id_tur) {
                                        echo "<option value='$id_tur' selected>$nome_tur</option>";
                                    } else {
                                        echo "<option value='$id_tur'>$nome_tur</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!--<div class="form-group col-md-4">
                            <label> Boletim Escolar</label>
                            <input type="file" class="form-control" name="boletim" id="boletim" onchange="previewAtestado();">
                            <p><span class="text-danger">**</span>Inserir o Boletim Escolar</p>
                        </div>-->
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                    <div class="col-md-2 control-label">
                        <h3>Responsável</h3>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label> Nome do responsável</label>
                            <input name="nome_recado" type="text" class="form-control" ="" placeholder="Digite o nome completo do responsável" value="<?php
                            if (isset($valorForm['nome_recado'])) {
                                echo $valorForm['nome_recado'];
                            }
                            ?>">

                        </div>
                        <div class="form-group col-md-2">
                            <label> Grau de parentesco</label>
                            <select class="form-control" name="adms_parentesco_id" id="adms_parentesco_id" >
                                <option value="">Selecione</option>
                                <?php
                                foreach ($this->Dados['select']['par'] as $par) {
                                    extract($par);
                                    if ($valorForm['adms_parentesco_id'] == $id_par) {
                                        echo "<option value='$id_par' selected>$nome_par</option>";
                                    } else {
                                        echo "<option value='$id_par'>$nome_par</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label> Contato / WhatsApp</label>
                            <input id="prependedtext" name="tel_recado" class="form-control" placeholder="XX XXXXX-XXXX" ="" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                                   OnKeyPress="formatar('## #####-####', this)" value="<?php if (isset($valorForm['tel_recado'])) {
                                echo $valorForm['tel_recado'];
                            } ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label> Recado</label>
                            <input name="nome_recado2" type="text" class="form-control" placeholder="Digite o nome para recado" value="<?php
                            if (isset($valorForm['nome_recado2'])) {
                                echo $valorForm['nome_recado2'];
                            }
                            ?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label> Contato / WhatsApp</label>
                            <input id="prependedtext" name="tel_recado2" class="form-control" placeholder="XX XXXXX-XXXX"  type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                                   OnKeyPress="formatar('## #####-####', this)" value="<?php if (isset($valorForm['tel_recado2'])) {
                                echo $valorForm['tel_recado2'];
                            } ?>">
                        </div>
                    </div>
                </div>

            </fieldset>

            <input name="EditAluno" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
