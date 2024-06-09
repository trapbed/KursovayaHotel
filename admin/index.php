<?php
unset($_SESSION['create_serv']);
unset($_SESSION['create_room']);
include "../header.php";
require_once "../database/Admin_info.php";
if(isset($_GET['page_admin'])){
    $_SESSION['page_admin'] = $_GET['page_admin'];
}
if(isset($_GET['see'])){
    $what = isset($_GET['see']) ? $_GET['see'] : false;
    $id = isset($_GET['id']) ? $_GET['id'] : false ;
    $more_info = new Info();
    $more_info = $more_info->get_more_info($what, $id);

    $page = isset($_GET['page_admin']) ? $_GET['page_admin'] : false;
    
    if($page){
        $title = new Info();
        $title = $title->get_title( $id, $what);
    }

    echo "
    <a id='bgAdminInfo' href='index.php?page_admin=$page'></a>
    <div id='seeMoreAdmin'>
        <a href='index.php?page_admin=$page'><img id='xAdminInfo' src='../img/x.svg' alt='info'></a>
        <span id='moreInfoTitle'>$title</span>
        <span>$more_info[0]</span>
    </div>
    ";
    // echo $more_info[0];
}





if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../index.php");
}


echo "<div id='modalInfoAdmin'></div>";
?>

<div id="containerAdmin">
    
<div id="containerAdminInfo">
<?php
    if(isset($_GET['page_admin'])  &&  $_GET['page_admin'] != 'users'){
        if($_GET['page_admin'] == 'rooms'){
            echo "<a class='adminButtonAdd' href='createRoom.php'><img class='adminButtonAdd' src='../img/admin/add.svg' alt='add'></a>";
            
            echo "<div class='empty14'></div>";

            echo "<table>
                <tr id='tableHeadRooms'>
                    <td class='adminId'>ID</td>
                    <td class='adminRoomImg'>Изображение</td>
                    <td class='adminRoomSmallName'>Короткое название</td>
                    <td class='adminRoomCat'>Категория</td>
                    <td class='adminRoomDesc'>Описание</td>
                    <td class='adminRoomLongName'>Длиное название</td>
                    <td class='adminRoomAmount'>Количество<br>(номеров)</td>
                    <td class='adminRoomAction'>Действия</td>
                </tr>
            </table>";
        }
        // createAdmin.php?act=catRoom&page_admin=catRooms
        if($_GET['page_admin'] == 'catRooms'){
            echo "<a class='adminButtonAdd' href='createCatRoom.php'><img class='adminButtonAdd' src='../img/admin/add.svg' alt='add'></a>";
            
            echo "<div class='empty14'></div>";

            echo "<table>
                <tr id='tableHeadCatRooms'>
                    <td class='adminId'>ID</td>
                    <td class='adminNameCat'>Назвавние категории номера</td>
                    <td class='adminSquare'>Площадь</td>
                    <td class='adminNumPers'>Количество гостей</td>
                    <td class='adminNumRooms'>Количество комнат</td>
                    <td class='adminPrice'>Цена</td>
                    <td class='adminAction'>Действия</td>
                </tr>
            </table>";
        }
        if($_GET['page_admin'] == 'services'){
            echo "<a class='adminButtonAdd' href='createService.php'><img class='adminButtonAdd' src='../img/admin/add.svg' alt='add'></a>";
            
            echo "<div class='empty14'></div>";

            echo "<table>
                <tr id='tableHeadServ'>
                    <td class='adminId'> ID </td>
                    <td class='adminServiceName'> Название </td>
                    <td class='adminServiceDesc'> Описание </td>
                    <td class='adminServiceCat'> Категория </td>
                    <td class='adminServiceImg'> Изображение </td>
                    <td class='adminServicePrice'> Цена </td>
                    <td class='adminServiceAction'> Действия </td>
                </tr>
            </table>";
        }
        if($_GET['page_admin'] == 'catServices'){
            echo "<a class='adminButtonAdd' href='createCatServ.php'><img class='adminButtonAdd' src='../img/admin/add.svg' alt='add'></a>";
            
            echo "<div class='empty14'></div>";

            echo "<table>
                <tr id='tableHeadRoomcatServ'>
                    <td class='adminRoomCatServId'> Идентификатор <br> категории услуги </td>
                    <td class='adminRoomCatServName'> Название категории услуги </td>
                    <td class='adminRoomCatServAction'> Действия </td> 
                </tr>
            </table>";
        }
        if($_GET['page_admin'] == 'bookings'){
            echo "<table>
                <tr id='tableHeadRoomBook'>
                    <td class='adminBooksId'> Номер <br> брони</td>
                    <td class='adminBooksName'> Почта </td>
                    <td class='adminBooksNameRoom'> Название номера</td>
                    <td class='adminBooksDateArrival'> Дата заселения</td>
                    <td class='adminBooksDateDeparture'> Дата выезда</td>
                    <td class='adminBooksSumPrice'> Сумма брони</td>
                    <td class='adminBooksStatus'> Статус</td>
                    <td class='adminBooksChangeStatus'> Действия</td>
                </tr>
            </table>";
        }
        
    }
    else{
        echo "<table>
                <tr id='tableHeadUsers'>
                    <td class='adminId'>ID</td>
                    <td class='adminUserName'>Фамилия Имя</td>
                    <td class='adminUserBday'>Дата рождения</td>
                    <td class='adminUserPhone'>Телефонный номер</td>
                    <td class='adminUserEmail'>Почта</td>
                    <td class='adminUserRole'>Роль</td>
                    <td class='adminUserSatus'>Статус</td>
                    <td class='adminUserAction'>Действия</td>
                </tr>
            </table>";
    }
    ?>
    <div id="scrollContainerAdmin">
    <?php
    if(isset($_GET['page_admin'])  &&  $_GET['page_admin'] != 'users'){
        if($_GET['page_admin'] == 'rooms'){
            $rooms = new Info ();
            $rooms = $rooms->get_info_room();
            foreach($rooms as $room){
                echo "<table>";
                if($room[7] == '0'){
                    echo"<tr class='tableHeadRoomsText'>";
                }
                else{
                    echo"<tr class='tableHeadRoomsTextNoExist'>";
                }
                echo "<td class='adminId'>".$room[6]."</td>
                    <td class='adminRoomImg'><img src='../img/rooms/".$room[0]."' alt='".$room[1]."'></td>
                    <td class='adminRoomSmallName'>".$room[1]."</td>
                    <td class='adminRoomCat'>".$room[2]."</td>
                    <td class='adminRoomDesc'><a class='linkNoreAdmin' href='index.php?see=room_desc&page_admin=rooms&id=$room[6]'>Смотреть</a></td>
                    <td class='adminRoomLongName'><a class='linkNoreAdmin' href='index.php?see=room_long_name&page_admin=rooms&id=$room[6]'>Смотреть</a></td>
                    <td class='adminRoomAmount'>".$room[5]."</td>";
                    if($room[7] == '1'){
                        echo "<td class='adminRoomAction'><a href='actRoom.php?act=delete&id=$room[6]'><img src='../img/admin/bin.svg' alt='delete'></a>  <a href='updateRoom.php?id=$room[6]'><img src='../img/admin/update.svg' alt='update'></a></td>";
                    }
                    else{
                        echo "<td class='adminRoomActionNoExist'><a href='actRoom.php?act=recover&id=$room[6]'><img src='../img/admin/recover.png' alt='delete'></a>  <a href='updateRoom.php?id=$room[6]'><img src='../img/admin/update.svg' alt='update'></a></td>";
                    }
                echo "</tr>
            </table><hr>";
            }   
        }
        if($_GET['page_admin'] == 'catRooms'){
            $categoriesRoom = new Info();
            $categoriesRoom = $categoriesRoom->get_cats_room();

            foreach($categoriesRoom as $cats){
                $price = substr($cats[6],0 ,-3);
                $price = $price."	&#8381;";
                echo "<table>
                <tr id='tableHeadCatRoomsText'>
                    <td class='adminId'>".$cats[0]."</td>
                    <td class='adminNameCat'>".$cats[1]."</td>
                    <td class='adminSquare'>".$cats[5]."</td>
                    <td class='adminNumPers'>".$cats[4]."</td>
                    <td class='adminNumRooms'>".$cats[2]."</td>
                    <td class='adminPrice'>".$price."</td>
                    <td class='adminAction'>";
                    if($cats[7] == '1'){
                        echo "<a href='actStatusCatRoom.php?id=$cats[0]&act=delete'><img src='../img/admin/bin.svg' alt='delete'></a>";
                    }
                    else{
                        echo "<a href='actStatusCatRoom.php?id=$cats[0]&act=recover'><img src='../img/admin/recover.png' alt='recover'></a>";
                    }
                    
                    echo "<a href='updateCatRoom.php?id=$cats[0]'><img src='../img/admin/update.svg' alt='update'></a>
                    </td>
                </tr>
            </table><hr>";
            }
        }
        if($_GET['page_admin'] == 'services'){
            $serv = new Info();
            $serv = $serv->get_info_serv();
            foreach($serv as $s){
                $price = $s[4];
                if($price == '0.00'){
                    $price = "Бесплатно";
                }
                else{
                    $price = substr($price, 0, -3);
                    $price = $price."	&#8381;";
                }
                echo "<table>";
                if($s[6] == '0'){
                    echo "<tr class='tableHeadServNoExist'>";
                }
                else{
                    echo "<tr id='tableHeadServ'>";
                }
                    echo "<td class='adminId'> $s[5] </td>
                    <td class='adminServiceName'> $s[0] </td>
                    <td class='adminServiceDesc'> <a href='index.php?see=serv_desc&page_admin=services&id=$s[5]'>Смотреть </a></td>
                    <td class='adminServiceCat'> $s[2] </td>
                    <td class='adminServiceImg'> <img ";
                    if($s[6] == '0'){
                        echo "class='imgServAdminNoExist'";
                    }
                    else{
                        echo "class='imgServAdmin'";
                    }
                    echo " src='../img/services/$s[3]' alt='$s[0]'> </td>
                    <td class='adminServicePrice'> $price </td>
                    <td class='adminServiceAction'>
                        <a href='change-service.php?id_serv=$s[5]'>Изменить</a>";
                        if($s[6] == '0'){
                            echo "<a class='deleteServ' href='actService.php?id=$s[5]&act=recover'><img src='../img/admin/recover.png' alt='delete'></a>";
                        }
                        else{
                            echo "<a class='deleteServ' href='actService.php?id=$s[5]&act=delete'><img src='../img/admin/bin.svg' alt='delete'></a>";
                        }
                    echo "</td>
                </tr>
            </table><hr>";
            }
        }
        if($_GET['page_admin'] == 'catServices'){
            $cat_serv = new Info();
            $cat_serv = $cat_serv->get_info_cat_serv();
            foreach($cat_serv as $cs){
                echo "<table>";
                if($cs[2] == '1'){
                    echo "<tr id='tableHeadRoomcatServ'>";
                }else{
                    echo "<tr id='tableHeadRoomcatServNoExist'>";
                }
                    echo "<td class='adminRoomCatServId'> $cs[0] </td>
                    <td class='adminRoomCatServName'> $cs[1] </td>
                    <td class='adminRoomCatServAction'>";
                    echo "<a href='updateCatServ.php?id=$cs[0]'><img src='../img/admin/update.svg' alt='update'></a>";

                        if($cs[2] == '0'){
                            echo "<a href='actCatService.php?act=recover&id=$cs[0]'><img src='../img/admin/recover.png' alt='update'></a>";
                        }
                        else{
                            echo "<a href='actCatService.php?act=delete&id=$cs[0]'><img src='../img/admin/bin.svg' alt='delete'></a>";
                        }

                    echo "</td> 
                </tr></table><hr>";
            }

        }
        if($_GET['page_admin'] == 'bookings'){
            $books = new Info();
            $books = $books->get_all_book();
            foreach ($books as $book){
                echo "<table>
                        <tr id='tableHeadRoomBook'>
                            <td class='adminBooksId'>$book[0]</td>
                            <td class='adminBooksName'>$book[1]</td>
                            <td class='adminBooksNameRoom'>$book[2]</td>
                            <td class='adminBooksDateArrival'> $book[3] </td>
                            <td class='adminBooksDateDeparture'> $book[4] </td>
                            <td class='adminBooksSumPrice'>".substr($book[6], 0, -3)."	&#8381;</td>
                            <td class='adminBooksStatus'> $book[5] </td>
                            <td class='adminBooksChangeStatus'>";
                            if($book[5] == 'принят'){
                                echo "
                                <a class='completedBook' href='../admin/action-book.php?act=completed&id=$book[0]'>Выполнить</a>
                                <a class='rejectBook' href='../admin/action-book.php?act=reject&id=$book[0]'>Отклонить</a>";
                            }
                            else{
                                echo "<span class='NoActionBooks'>Нет действий</span>";
                            }
                            echo "</td>
                        </tr>
                    </table><hr>";
            }
           
        } 
    }
    else{
        $allUsers = new Info();
        $allUsers= $allUsers->get_info_user();
        
        foreach($allUsers as $user){
            if($user[3]=='admin'){
                $user[3] = "<span class='adminUserAdmin'>".$user[3]."</span>";
            }
            $nameUser = false;
            $bday = false;
            $phone = false;
            $status = false;
            $action = false;
            $imgStatus = false;
            if($user[3] == 'user'){
                $user1 = new Info();
                $user1 = $user1->get_info_buyer($user[0]);
                if(isset($user1[0]) || isset($user1[1]) || isset($user1[2])){
                    if(isset($user1[0])){
                        $nameUser .= $user1[0]." ";
                    }
                    if(isset($user1[1])){
                        $nameUser .= $user1[1]." ";
                    }
                    if(isset($user1[2])){
                        $nameUser .= $user1[2];
                    }
                }
                $bday = $user1[3];
                $phone = $user1[4];
            }

            if($user[4] == 0){
                $status = 'Действителен';
                $imgStatus = 'block';
            }
            else{
                $status = 'Заблокирован';
                $imgStatus = 'unblock';
            }

            $role = $user[3];
            if($role == 'user'){
                $imgRole = 'user';
                $act = 'toAdmin';
            }
            else{
                $imgRole = 'admin';
                $act = 'toUser';
            }
            //
            echo "<table>
            <tr id='tableHeadUsersInfo'>
                <td class='adminId'>".$user[0]."</td>
                <td class='adminUserName'>".$nameUser."</td>
                <td class='adminUserBday'>".$bday."</td>
                <td class='adminUserPhone'>".$phone."</td>
                <td class='adminUserEmail'>".$user[1]."</td>
                <td class='adminUserRole'>".$role."</td>
                <td class='adminUserSatus'>".$status."</td>
                <td class='adminUserAction'>
                    <a href='changeUser.php?action=".$imgStatus."&id=".$user[0]."'><img class='imgStatusUser' src='../img/admin/".$imgStatus.".svg' alt='".$imgStatus."'></a>
                    <a href='changeUser.php?action=".$act."&id=".$user[0]."'><img class='imgStatusUser' src='../img/admin/".$imgRole.".png' alt='".$act."'></a>
                </td>
            </tr>
        </table><hr>";
        }
    }
    ?>

    </div>
</div>

</div>
<?php
include "../footer.php";
?>

