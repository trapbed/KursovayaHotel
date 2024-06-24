<?php
include "header.php";
include "C:\OSPanel\domains\coursework\database\Services.php";

$services = new Service();
$services = $services->get_services();
if(isset($_GET['see'])){
    $what = isset($_GET['see']) ? $_GET['see'] : false;
    $id = isset($_GET['id']) ? $_GET['id'] : false ;
    $more_info = new Service();
    $more_info = $more_info->get_more_info($what, $id);

    $page = isset($_GET['page_admin']) ? $_GET['page_admin'] : false;
    $item = isset($_GET['item']) ? $_GET['item'] : false;
    
    if($page){
        $title = new Service();
        $title = $title->get_title( $id, $what);
    }

    echo "
    <a id='bgAdminInfo' href='services.php#$item'></a>
    <div id='seeMoreAdmin'>
        <a href='services.php#$item'><img id='xAdminInfo' src='../img/x.svg' alt='info'></a>
        <span id='moreInfoTitle'>$title</span>
        <span>$more_info[0]</span>
        <span>Цена: $more_info[1]</span>
    </div>
    ";
    // echo $more_info[0];
}

?>

<h1 id='titleServices'>Услуги</h1>
<div id="servicesMain">

<?php
$countCat = 1;
$countServ = 1;
$justCount = 1;


$id_cat_service = new Service();
$id_cat_service = $id_cat_service->get_array_from_id_cat_service();
    // CAT OF SERVICES
    $catServ = new Service();
    $servCat = $catServ->get_cat_serv();


    foreach($id_cat_service as $cat_serv){
        foreach($id_cat_service as $cat){
            if($cat_serv[0] == $cat[0]){
                
                echo "<br><div class='nameHrCatServ'><h5 class='nameCatServ'>".$cat_serv[1]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5><div class='hrNameCatServ'></div></div>";
                echo "<br>";
                $serv_by_cat = new Service();
                $serv_by_cat = $serv_by_cat->get_services_by_cat($cat_serv[0]);
                $array_serv = $serv_by_cat['array'];
                if($serv_by_cat['num_row'] == 0){
                    echo "<span class='undefinedService'>Нет услуг по категории!</span>";
                }
                else{
                    foreach($array_serv as $serv){
                        if($countServ == 1){
                            echo "<div class='oneRowServ'>";
                        }
                        echo "  <div class='oneService' id='serv_id$serv[0]_cat$cat_serv[0]'>
                            <img src='../img/services/".$serv[4]."' alt='$serv[1]'>
                            <form method='GET' action='services.php'>
                                <input type='hidden' name='see' value='serv_desc'>
                                <input type='hidden' name='page_admin' value='services'>
                                <input type='hidden' name='item' value='serv_id$serv[0]_cat$cat_serv[0]'>
                                <input type='hidden' name='id' value='$serv[1]'>
                                <input type='submit' value='' title='Подробнее о $serv[1]'>
                                
                            </form><span class='nameService'>$serv[1]</span>
                        </div>";
                        // echo $serv_by_cat['num_row'];
                        // echo $justCount;
                        // echo $countServ;
                        if($countServ == 4 || $justCount == $serv_by_cat['num_row']){
                            echo "</div>";
                            $countServ = 0;
                        }
                        if($justCount == $serv_by_cat['num_row']){
                            $justCount = 0;
                        }
                        $justCount ++;
                        $countServ++;
                    }
                    
                }
                
        }
    }
}
    
include "footer.php";
?>
</div>