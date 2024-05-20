<?php
include "header.php";
include "C:\OSPanel\domains\coursework\database\Services.php";

$services = new Service;
$services = $services->get_services();
?>

<h1 id='titleServices'>Услуги</h1>
<div id="servicesMain">

<?php
$countCat = 1;
$countServ = 1;
    // CAT OF SERVICES
    $catServ = new Service();
    $servCat = $catServ->get_cat_serv();
    
    foreach($servCat as $cat){
            foreach($services as $serv){
                if($countCat == $cat[0]){
                    echo "<br><div class='nameHrCatServ'><h5 class='nameCatServ'>".$cat[1]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5><div class='hrNameCatServ'></div></div>";
                    echo "<br>";
                    $countCat++;
                    $servicesAll = new Service();
                    $servicesAll = $servicesAll->services_all($cat[0]);

                    $numS = mysqli_num_rows($servicesAll);
                    $servicesAll = mysqli_fetch_all($servicesAll);
                    $justCount = 1;
                    foreach($servicesAll as $serv){
                        if($countServ == 1){
                            echo "<div class='oneRowServ'>";
                        }
                            echo "  <div class='oneService'>
                                        <img src='../images/services/".$serv[4]."' alt='$serv[1]'>
                                        <form>
                                            <input type='hidden'>
                                            <input type='submit' value='' title='Подробнее о $serv[1]'>
                                            
                                        </form><span class='nameService'>$serv[1]</span>
                                    </div>";

                        if($countServ == 4 || $justCount == $numS){
                            echo "</div>";
                            $countServ = 0;
                        }
                        $justCount ++;
                        $countServ++;
                    }
                }
            }

    }
    
include "footer.php";
?>
</div>