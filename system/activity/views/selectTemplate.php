<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!defined('ROOTPATH')) {
    require '../root.php';
}
require ROOTPATH . "/ui/modal.php";


require_once ROOTPATH . '/utils/checkUser.php';
checkUser(["professional", "admin"], BASE_URL);

if (!isset($data['groupId'])) {
    $data['groupId'] = '';
}

$filter_value = "";

if (isset($data['query']) && strlen($data['query']) > 0) {
    $filter_value = $data['query'];
}

?>



<script>
    /*
setInterval(function(){ 
    window.dispatchEvent(new Event('resize'));
 }, 1000);
  */
    function mobileAndTabletcheck() {
        var check = false;
        (function(a) {
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
                check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    }

    function askToPerformTour() {
        if (mobileAndTabletcheck()) {
            alert("A criação de atividades deve ser feita utilizando um computador/notebook :)");
            return;
        }

        var steps = [{
            'click #pubMatchingtoSample': "Clique aqui para configurar uma nova atividade de Matching-to-Sample.",
            'nextButton': {
                className: "d-none"
            },
            "skipButton": {
                className: "d-none"
            }
        }];

        var hint = new EnjoyHint();
        hint.set(steps);
        hint.run();
    }
    document.body.onload = function() {
        var tuto_finished = "<?php echo $_SESSION['tuto_finished']; ?>" == "1";
        if (!tuto_finished)
            askToPerformTour();
    };
</script>

<div class="row">
    <div class="col">
        <div class="container mt-3">
            <!-- filtrar -->
            <div class="row mt-4">
                <div class="col">
                    <form autocomplete="off" class="form mt-1" action="index.php?action=selectTemplate&groupId=<?php echo $data['groupId']; ?>" method="post">

                        <div class="form-row">
                            <div class="form-group col-md-11">
                                <input class="form-control mr-sm-2" id="search" name="query" type="query" placeholder="Filtrar" aria-label="Search" value="<?php echo $filter_value; ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <button type="submit" class="btn btn-outline-success form-control">
                                    <i class="fas fa-search"></i>
                                </button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="card-columns">
                <?php
                require_once ROOTPATH . '/utils/DBAccess.php';
                $SQL = "";
                $db = new DBAccess();
                $user_id = $_SESSION['username'];
                $query = $data['query'];

                $SQL = "SELECT COUNT(*) AS total  FROM activity WHERE (owner_id ='$user_id' OR owner_id='pub')AND active=1 AND category LIKE '%template%' AND NOT category like '%reinforcement%'";


                if (isset($data['query'])) {

                    $query = $data['query'];

                    $SQL = $SQL . " AND " .
                        "(name LIKE '%$query%' OR antecedent LIKE '%$query%' OR behavior LIKE '%$query%' OR consequence LIKE '%$query%')";
                }

                $num_res = $db->query($SQL);
                $num_res = mysqli_fetch_assoc($num_res);
                $num_res = $num_res['total'];
                $results_per_page = 12;
                $num_pages = intdiv($num_res, $results_per_page);
                if (($num_pages * $results_per_page) < $num_res)
                    $num_pages = $num_pages + 1;
                //echo "num res: $num_res num pages? $num_pages <br>";

                ///gets results.
                $s_page = $data['page'] - 1;
                if ($s_page < 0) {
                    $s_page = 0;
                }

                $offset = $s_page * $results_per_page;
                $limit  = $results_per_page;

                $SQL = "SELECT * FROM activity WHERE (owner_id ='$user_id' OR owner_id='pub')AND active=1 AND category LIKE '%template%' AND NOT category like '%reinforcement%' LIMIT  $limit OFFSET  $offset";




                if (isset($data['query'])) {

                    $query = $data['query'];
                    $SQL = "SELECT * FROM activity WHERE (owner_id ='$user_id' OR owner_id='pub')AND active=1 AND category LIKE '%template%' AND NOT category like '%reinforcement%'";
                    $SQL = $SQL . " AND " .
                        "(name LIKE '%$query%' OR antecedent LIKE '%$query%' OR behavior LIKE '%$query%' OR consequence LIKE '%$query%') LIMIT  $limit OFFSET  $offset";
                }
                $res = $db->query($SQL);


                ?>

                <?php
                while ($fetch = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="card border-dark">
                        <h4 class="card-header"><?php echo $fetch['name']; ?></h4>
                        <div class="card-body">

                            <p class="card-title"> <?php echo $fetch['antecedent']; ?></p>

                            <a href="" class="card-text"><?php echo $fetch['category']; ?></a> <br>
                            <a id="<?php echo $fetch['id']; ?>" href="index.php?action=newFromTemplate&templateId=<?php echo $fetch['id']; ?>&groupId=<?php echo $data['groupId']; ?>" class="btn btn-dark">Selecionar template</a>
                        </div>

                    </div>
                <?php
                }
                ?>


            </div>

            <div class="row mt-3">
                <div class="col">


                    <!--pagination -->
                    <div class="row mt-3">
                        <div class="col">

                            <ul class="pagination">
                                <!--botton previous -->
                                <?php
                                if ($num_pages <= 1) {
                                ?>
                                    <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                                    <li class="page-item  disabled"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item disabled"><a class="page-link" href="#">Próxima</a></li>
                                    <?php
                                } else {
                                    if (($data['page'] - 1) <= 0) { ?>
                                        <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                                    <?php
                                    } else { ?>
                                        <li class="page-item "><a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($data['page'] - 1); ?>">Anterior</a></li>
                                        <?php
                                    }

                                    /* listing */
                                    $i = 0;

                                    for ($i = (($data['page'] - 5)); $i < (($data['page'] + 5)); $i++) {
                                        if (($data['page'] - 1) == $i) {
                                            //curr page
                                        ?>
                                            <li class="page-item disabled"><a class="page-link" href="#"><?php echo ($i + 1); ?></a></li>
                                            <?php
                                        } else {
                                            if ($i >= 0 && $i <= (($num_pages))) {
                                            ?>
                                                <li class="page-item"><a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($i + 1); ?>"><?php echo ($i + 1); ?></a></li>
                                        <?php

                                            }
                                        }
                                    }

                                    /*botton next*/
                                    if (($data['page']) >= $num_pages) { ?>
                                        <li class="page-item disabled"><a class="page-link" href="#">Próxima</a></li>
                                    <?php
                                    } else { ?>
                                        <li class="page-item "><a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($data['page'] + 1); ?>">Próxima</a></li>
                                <?php

                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>