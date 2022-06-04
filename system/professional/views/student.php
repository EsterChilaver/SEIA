<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }
    require ROOTPATH . "/ui/modal.php";

    $filter_value = "";

    if (isset($data['query']) && strlen($data['query']) > 0) {
        $filter_value = $data['query'];
    }


    require_once ROOTPATH . '/utils/checkUser.php';

    checkUser(["professional", "admin"], BASE_URL);

    $user_id = $_SESSION['username'];
?>

<div class="container">

    <div class="header-titulo" id="students">

        <div class="desenho-e-texto">

            <div class="texto">

                <h1>Estudantes</h1>

                <div class="barra-horizontal"></div>

                <p class="texto-conteudo">Visualize ou cadastre novos estudantes.</p>

            </div>

            <div class="desenho"><img src="/SEIA/media/vetores/estudantes.svg"></img></div>

        </div>

    </div>

</div><!--container-->

<div class="corpo">

    <div class="barra-pesquisa">    

        <a id="tutoNovaAtividade"class="btn btn-warning btn-lg btn-block border-dark text-white" href="index.php?action=new"><p><img src="/SEIA/media/barra_pesquisa/adicionar_branco.svg">Nova atividade</p></a>
                        
        <a class="btn hide-btn" href="index.php?action=repository"><p>Buscar no repositório</p></a>

        <!-- filtrar -->    
                            
        <form autocomplete="off" class="form mt-1" action="index.php?action=student" method="post">
            <input hidden id="rep" name="rep" type="rep"  value="<?php echo $repository?>">

            <div class="form-group" id="pesquisar">
                <button type="submit" class="btn btn-outline-success form-control">
                    <img src="/SEIA/media/barra_pesquisa/pesquisa.svg"></img>
                </button> 

                <input class="form-control mr-sm-2" id="search" name="query" type="query" placeholder="PESQUISE POR ATIVIDADES" aria-label="Search" value="">
            </div>
                                        
        </form>
                        
    </div><!--barra-pesquisa--> 

    <!-- resultados -->
    <div class="card-columns" id="cards-estudantes">

        <?php
            require_once ROOTPATH . '/utils/DBAccess.php';
            $SQL = "";
            $db = new DBAccess();
            $user_id = $user_id;
            $query = "";

            $SQL = "SELECT COUNT(*) AS total  FROM student LEFT JOIN student_tutorship  ON student.id=student_tutorship.student_id WHERE student_tutorship.professional_id ='$user_id' ";

            if (isset($data['query'])) {

                $query = $data['query'];

                $SQL = $SQL . " AND " .
                "name LIKE '%$query%'";
            }

            $num_res = $db->query($SQL);
            $num_res = mysqli_fetch_assoc($num_res);
            $num_res = $num_res['total'];
            $results_per_page = 12;
            $num_pages = intdiv($num_res, $results_per_page);

            if (($num_pages * $results_per_page) < $num_res)
            $num_pages = $num_pages + 1;

            ///gets results.

            $s_page = $data['page'] - 1;
                
                if ($s_page < 0) {
                    $s_page = 0;
                }

            $offset = $s_page * $results_per_page;
            $limit  = $results_per_page;

            $SQL = "SELECT *  FROM student LEFT JOIN student_tutorship  ON student.id=student_tutorship.student_id WHERE student_tutorship.professional_id ='$user_id' LIMIT $limit OFFSET  $offset";

            //echo $SQL;

            if (isset($data['query'])) {
                $query = $data['query'];
                $SQL = "SELECT *  FROM student LEFT JOIN student_tutorship  ON student.id=student_tutorship.student_id WHERE student_tutorship.professional_id ='$user_id' ";

                $SQL = $SQL . " AND " .
                    "name LIKE '%$query%'  LIMIT  $limit OFFSET  $offset";
            }
                                    
            $res = $db->query($SQL);

        ?>

        <?php while ($fetch = mysqli_fetch_assoc($res)) { ?>

        <div class="card text-white bg-danger border-dark" id="<?php echo $fetch['id']; ?>">

            <div class="card-img-top rounded img-thumbnail">
                <img class="img-fluid rounded img-thumbnail" width="100%" height="auto" src="<?php echo BASE_URL; ?>/data/student/<?php echo $fetch['student_id']; ?>/<?php echo $fetch['avatar']; ?>">
            </div><!--card-img-top-->

            <h4 class="card-header border-dark">
                <p><?php echo $fetch['name']; ?></p>

                <div class="ver-mais">
                    <div class="bolinha"></div>
                    <div class="bolinha"></div>
                    <div class="bolinha"></div>
                </div>
            </h4>

            <div class="card-body">

                <div class="categorias-estimulo">
                    <p class="card-text">Nascimento:</p>
                    <p><input class="form-control" type="date" disabled value="<?php echo $fetch['birthday']; ?>"></p>
                </div>

                <div class="categorias-estimulo">
                    <p class="card-text">Endereço:</p>
                    <p><?php echo $fetch['city']; echo " - " . $fetch['state']; ?></p>
                </div>  

                <div class="categorias-estimulo">
                    <p class="card-text">Medicação:</p>
                    <p><?php echo $fetch['medication']; ?></p>
                </div>

                <div class="dropdown container-fluid">
                    <button class="btn btn-secondary dropdown-toggle btn-lg btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opções</button>

                    <div class="dropdown-menu container-fluid" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="index.php?action=editStudent&studentId=<?php echo $fetch['student_id']; ?>">Perfil</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>/sessionProgram/index.php?action=index&studentId=<?php echo $fetch['student_id']; ?>">Programações de Ensino</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>/sessionProgram/index.php?action=editFullSession&id=<?php echo $fetch['curriculum_id']; ?>" &studentId=<?php echo $fetch['student_id']; ?>">Configurar/Aplicar Currículo</a>
                        <a class="dropdown-item" href="index.php?action=editStudentData&studentId=<?php echo $fetch['student_id']; ?>">Editar dados</a>
                        <a class="dropdown-item" href="index.php?action=studentReport&studentId=<?php echo $fetch['student_id']; ?>">Relatórios</a>
                        <a class="dropdown-item" href="javascript:askToRemoveStudent('<?php echo $fetch['student_id']; ?>')">Remover estudante</a>
                    </div><!--dropdown-menu-->

                </div><!--dropdown-->

            </div><!--card-body-->
        </div><!--card-->

        <?php } ?>

    </div><!--card-colums-->

    <!--pagination -->
    <div class="conteiner-pagination">                        
            
            <ul class="pagination">
                <!--botton previous -->
                
                <?php
                    if ($num_pages <= 1) {
                ?>

                <a class="page-link" href="#">
                    <li class="voltar-avancar">                
                        <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                    </li>
                </a>
                
                <a class="page-link" href="#"><li class="page-item disabled">1</li></a>
                
                <a class="page-link" href="#">
                    <li class="voltar-avancar">                
                        <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>                
                    </li>
                </a>

                <?php
                    } else {
                        if (($data['page'] - 1) <= 0) { ?>
                            
                            <a class="page-link" href="#">
                                <li class="voltar-avancar">                            
                                    <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                                </li>
                            </a>
                            
                        <?php } else { ?>

                            <a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($data['page'] - 1); ?>">
                                <li class="voltar-avancar">                            
                                    <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                                </li>
                            </a>

                        <?php }

                        /* listing */
                        
                            $i = 0;

                            for ($i = (($data['page'] - 5)); $i < (($data['page'] + 5)); $i++) {
                                if (($data['page'] - 1) == $i) {
                                //curr page
                        
                        ?>

                            <a class="page-link" href="#">
                                <li class="page-item disabled"><?php echo ($i + 1); ?></li>
                            </a>

                            <?php
                        
                                } else {

                                    if ($i >= 0 && $i <= (($num_pages))) {
                            
                            ?>

                            
                            <a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($i + 1); ?>">
                                <li class="page-item"><?php echo ($i + 1); ?></li>
                            </a>
                            
                            <?php }}}

                /*botton next*/

                    if (($data['page']) >= $num_pages) { ?>
                    
                        <a class="page-link" href="#">
                            <li class="voltar-avancar">
                                <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>                        
                            </li>
                        </a>
                        
                    <?php } else { ?>
                        
                        
                        <a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($data['page'] + 1); ?>">
                            <li class="voltar-avancar">
                                <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>                        
                            </li>
                        </a>
                        
                    <?php }}?>
                                        
            </ul>
            
    </div><!--conteiner pagination-->

</div><!--corpo-->
        
        <!--botão de ajuda-->                                    
        <!--div id='help' style="position: absolute; top:5px; right: 30px;" >
            <button class='btn btn-block btn-lg btn-warning' onclick="showHelp()">
                <i class="fas fa-question"></i>
            </button>
        </div-->

<script>
    function askToRemoveStudent(id) {
        showModal("Remover?", "Remover o estudante? Isto não pode ser desfeito!", function() {
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (this.readyState != 4) return;

                if (this.status == 200) {
                    console.log(this.responseText);
                    window.location.reload();

                }


            };

            xhr.open("POST", '<?php echo BASE_URL; ?>/professional/index.php?action=removeStudent', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");

            xhr.send('student_id=' + id);
        });
    }

    function removeActivity(id) {

        showModal("Remover Atividade?", "Isso não poderá ser desfeito. A atividade continuará a existir em programas de ensino existentes, mas não aparecerá mais neste lista.", function() {

            console.log("send http");
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (this.readyState != 4) return;

                if (this.status == 200) {
                    var data = this.responseText; // JSON.parse(this.responseText);
                    var el = document.getElementById(data);
                    el.parentNode.removeChild(el);
                    closeModal();
                }


            };

            xhr.open("POST", '<?php echo BASE_URL; ?>/activity/index.php?action=removeActivity', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
            var url = 'activityId=' + id + "&page=" + <?php echo $data['page']; ?>;

            var query = "<?php echo $query; ?>";

            url = url + "&query=" + query;
            xhr.send(url);
        }, true);
    }
</script>