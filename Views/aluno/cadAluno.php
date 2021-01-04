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
                <h2 class="display-4 titulo">Ficha de Inscrição</h2>
                <h4 class="display-6">Escola de Futebol - Centro de Formação Parque das bandeiras</h4>

            </div>
            <div class="p-2">

                        <span class="d-none d-md-block">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-hand-point-right"></i> Leia Autorização / Termos
                            </button>
                        </span>
            </div>
        </div>

        <hr>
        <!---Formulario-->
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <fieldset>
                <div class="form-row">
                    <div class="form-group col-md-4">

                        <label><span class="text-danger">*</span> Foto </label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group col-md-2">
                        <?php
                        $imagem_nova = URLADM . 'assets/imagens/aluno/preview_img.png';
                        ?>
                        <img src="<?php echo $imagem_nova; ?>" alt="Imagem do Aluno" id="preview-user" class="img-thumbnail" style="width: 150px; height: 150px;">
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
                    <label><span class="text-danger">*</span> Nome</label>
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
                    <label><span class="text-danger">*</span> RG</label>
                    <input name="rg" type="text" class="form-control" id="rg"  placeholder="Digite Apenas números" required="" maxlength="10" pattern="[0-9]+$" value="<?php
                    if (isset($valorForm['rg'])) {
                        echo $valorForm['rg'];
                    }
                    ?>">
                    <p style="font-size: 12px;">Digite apenas os números</p>
                </div>
                <div class="form-group col-md-2">
                    <label><span class="text-danger">*</span> Data Nasc.</label>
                    <input id="dtnasc" name="data_nasc" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()" value="<?php
                    if (isset($valorForm['data_nasc'])) {
                        echo $valorForm['data_nasc'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-2">
                    <label><span class="text-danger">*</span> Sexo</label>
                    <select class="form-control" name="adms_sexo_id" id="adms_sexo_id" required>
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
                                    <div class="input-group-text"><span class="text-danger">*</span>  CEP</div>
                                </div>
                                <input id="cep" name="cep" placeholder="Apenas números" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$">
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
                                <input id="rua" name="rua" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="text-danger">*</span> N°</div>
                                </div>
                                <input id="numero" name="numero" class="form-control" placeholder="" required=""  type="text">
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="text-danger">*</span> Bairro</div>
                                </div>
                                <input id="bairro" name="bairro" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="text-danger">*</span> Cidade</div>
                                </div>
                                <input id="cidade" name="cidade" class="form-control" placeholder="" required=""  readonly="readonly" type="text">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="text-danger">*</span> Estado</div>
                                </div>
                                <input id="estado" name="estado" class="form-control" placeholder="" required=""  readonly="readonly" type="text">
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
                        <label><span class="text-danger">*</span> Altura</label>
                        <input name="altura" type="text" class="form-control" id="altura"  required="" placeholder="Digite a altura do aluno" value="<?php
                        if (isset($valorForm['altura'])) {
                            echo $valorForm['altura'];
                        }
                        ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label><span class="text-danger">*</span> Peso</label>
                        <input name="peso" type="text" class="form-control" id="peso"  required="" placeholder="Digite o peso do aluno" value="<?php
                        if (isset($valorForm['peso'])) {
                            echo $valorForm['peso'];
                        }
                        ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label><span class="text-danger">*</span> Tipo Sanguineo</label>
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
                        <label><span class="text-danger">*</span> Posição</label>
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
                        <label><span class="text-danger">*</span> 2ª Posição</label>
                        <select class="form-control" name="adms_posicao2_id" id="adms_posicao2_id" required>
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['pos2'] as $pos2) {
                                extract($pos2);
                                if ($valorForm['adms_posicao2_id'] == $id_pos2) {
                                    echo "<option value='$id_pos2' selected>$nome_pos2</option>";
                                } else {
                                    echo "<option value='$id_pos2'>$nome_pos2</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label><span class="text-danger">*</span> Modalidade</label>
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
                            <label><span class="text-danger">*</span> Escola</label>
                            <input name="escola" type="text" class="form-control" placeholder="Nome da Escola que estuda" value="<?php
                            if (isset($valorForm['escola'])) {
                                echo $valorForm['escola'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label><span class="text-danger">*</span> Período</label>
                            <select class="form-control" name="adms_turno_id" id="adms_turno_id" required>
                                <option value="">Selecione</option>
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
                            <label><span class="text-danger">*</span> Nome do responsável</label>
                            <input name="nome_recado" type="text" class="form-control" required="" placeholder="Digite o nome completo do responsável" value="<?php
                            if (isset($valorForm['nome_recado'])) {
                                echo $valorForm['nome_recado'];
                            }
                            ?>">

                        </div>
                        <div class="form-group col-md-2">
                            <label><span class="text-danger">*</span> Grau de parentesco</label>
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
                            <label><span class="text-danger">*</span> Contato / WhatsApp</label>
                            <input id="prependedtext" name="tel_recado" class="form-control" placeholder="XX XXXXX-XXXX" required="" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
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

            <!--<p class="font-italic text-danger"><em>*Campos Obrigtórios</em></p>-->
            <p class="font-italic text-danger"><em>**Ao clicar no botão inscrever atleta, você automaticamente concordará com nossos termos. Leia atentamente!</em></p>
            <input name="CadAluno" type="submit" value="Inscrever Atleta" class="btn btn-success btn-lg btn-block">
            <!--<button type="submit" class="btn btn-success btn-lg btn-block">Inscrever Atleta</button>-->

        </form>
        <br>

        <!--/Formulario-->
    </div>
</div>
</div>

<div class="modal fade" id="apagarRegistro" tabindex="-1" role="dialog" aria-labelledby="apagarRegistroLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">EXCLUIR ITEM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir o item selecionado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Apagar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Termos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Eu responsável pelo atleta (menor) acima citado, venho solicitar a sua inscrição na Escola C.F.P.B Centro de
                    Formação Parque das Bandeiras, assumindo nesta oportunidade:<br><br>
                    1º) Eximir o CFPB de eventuais acidentes - tais como; Lesões, Fraturas, Ferimentos, Torções e etc, decorrente da prática esportiva. Se ocorre é dever do CFPB prestar os primeiros socorros e comunicar o fato
                    ao responsável imediatamente, que deverá se dirigir ao local indicado afim de que seja dada a continuidade ao atendimento.<br><br>
                    2º) Apresentar ATESTADO MÉDICO comunicando que o aluno inscrito está apto ao esporte (prática de futebol);<br><br>
                    3º) É indispensável que o atleta (aluno) esteja estudando. DE MATRÍCULA ESCOLAR:
                    Deverá ser apresentada DECLARAÇÃO,<br><br>
                    4º) Informar a direção do CFPB sobre eventuais PROBLEMAS DE SAÚDE que o atleta venha a sofrer;<br><br>
                    5º) A freqüência do aluno (atleta) nos treinos será controlada pelo CFPB. É cargo do responsável pelo aluno zelar pela freqüência do atleta nos treinamentos;<br><br>
                    6º) Os dias e horários dos treinamentos (turmas) serão divulgados previamente pelo CFPB;<br><br>
                    7º) O aluno (atleta) deverá comparecer com o material de treinamento conforme designado pela direção do CFPB (chuteira, tênis e uniforme);<br><br>
                    8º) Os problemas de ordem disciplinar serão resolvidos pela direção do CFPB e posteriormente comunicados aos responsáveis pelo aluno (atleta);<br><br>
                    9º) Em caso de chuva 30 minutos antes do início do treino, fica acertado que o mesmo estará cancelado;<br><br>
                    10º) Os materiais, bem como uniformes para jogos, coletes, bolas, cones, etc — são de uso exclusivo do CFPB e serão disponibilizados aos alunos inscritos;<br><br>
                    11º) Os alunos estão sujeitos a não serem selecionados para competições, cabendo ao CFPB como caráter recreativo;<br><br>
                    12º) Ao assinar esse termo , declaro-me ciente e autorizo, gratuitamente o CFPB e bem como seus parceiros apoiadores do Projeto CFPB, a reproduzir a imagem do atleta (aluno),
                    através de fotografias e filmes, para fins de divulgação do projeto e das atividades do CFPB por todas as formas de comunicação existentes e sem necessidade de nova autorização.<br><br>
                    13º) Os casos omissos serão resolvidos pela direção do CFPB, tendo conhecimento aos responsáveis pelos alunos (atletas).<br><br>
                    14º) As atividades deverão ser desenvolvidas duas vezes por semana (quarta e sexta-feira), conforme quadro abaixo.<br><br>
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                    <tr>
                        <th scope="col">DIAS</th>
                        <th scope="col">HORÁRIOS</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center;">
                    <tr>
                        <th scope="row">Quarta-Feira</th>
                        <td>09:00 as 11:00 e 14:00as 16:00hs</td>
                    </tr>
                    <tr>
                        <th scope="row">Sexta-Feira</th>
                        <td>09:00 as 11:00 e 14:00as 16:00hs</td>
                    </tr>
                    </tbody>
                </table><br>
                <p>
                    Nestes termos assino a presente INSCRIÇÃO e AUTORIZO o menor citado,
                    à freqüentar a Escola de Futebol, informando ainda que o mesmo encontra-se matriculado em escola de ensino regular,
                    em plenas condições de saúde para prática de esporte, me responsabilizando por todo e qualquer acidente que o menor
                    venha a sofrer praticando esporte nos locais de treino do CFPB.
                </p>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImagem(){
        var imagem = document.querySelector('input[name=imagem').files[0];
        var preview = document.querySelector('#preview-user');

        var reader = new FileReader();

        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(imagem){
            reader.readAsDataURL(imagem);
        }else{
            preview.src = "";
        }
    }
</script>
<script>
    function previewAtestado(){
        var atestado = document.querySelector('input[name=atestado').files[0];
        var preview = document.querySelector('#preview-user01');

        var reader = new FileReader();

        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(atestado){
            reader.readAsDataURL(atestado);
        }else{
            preview.src = "";
        }
    }
</script>
<script>
    function previewBoletim(){
        var boletim = document.querySelector('input[name=boletim').files[0];
        var preview = document.querySelector('#preview-user02');

        var reader = new FileReader();

        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(boletim){
            reader.readAsDataURL(boletim);
        }else{
            preview.src = "";
        }
    }
</script>

