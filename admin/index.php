<?php
include "../header.php";
require_once "../database/Admin_info.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../index.php");
}
?>

<div id="containerAdmin">
    
<div id="containerAdminInfo">
<?php
    if(isset($_GET['page_admin'])  &&  $_GET['page_admin'] != 'users'){
        if($_GET['page_admin'] == 'rooms'){
            echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/admin/add.svg' alt='add'></a>";
            
            echo "<div class='empty14'></div>";

            echo "<table>
                <tr id='tableHeadRooms'>
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
        if($_GET['page_admin'] == 'catRooms'){
            echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/admin/add.svg' alt='add'></a>";
            
            echo "<div class='empty14'></div>";

            echo "<table>
                <tr id='tableHeadCatRooms'>
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
            echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/admin/add.svg' alt='add'></a>";
            
            echo "<div class='empty14'></div>";

            echo "<table>
                <tr id='tableHeadServ'>
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
            echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/admin/add.svg' alt='add'></a>";
            
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
                    <td class='adminBooksName'> Фамилия Имя покупателя</td>
                    <td class='adminBooksNameRoom'> Название номера</td>
                    <td class='adminBooksDateArrival'> Дата заселения</td>
                    <td class='adminBooksDateDeparture'> Дата выезда</td>
                    <td class='adminBooksSumPrice'> Сумма брони</td>
                    <td class='adminBooksStatus'> Статус</td>
                </tr>
            </table>";
        }
        
    }
    else{
        echo "<table>
                <tr id='tableHeadUsers'>
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
                echo "<table>
                <tr id='tableHeadRoomsText'>
                    <td class='adminRoomImg'><img src='../images/rooms/".$room[0]."' alt='".$room[1]."'></td>
                    <td class='adminRoomSmallName'>".$room[1]."</td>
                    <td class='adminRoomCat'>".$room[2]."</td>
                    <td class='adminRoomDesc'><a class='linkNoreAdmin' href='' alt=''>Смотреть</a></td>
                    <td class='adminRoomLongName'><a class='linkNoreAdmin' href='' alt=''>Смотреть</a></td>
                    <td class='adminRoomAmount'>".$room[5]."</td>
                    <td class='adminRoomAction'><a href='deleteRoom.php'><img src='../images/admin/bin.svg' alt='delete'></a><a href='updateRoom.php'><img src='../images/admin/update.svg' alt='update'></a></td>
                </tr>
            </table><hr>";
            }   
        }
        if($_GET['page_admin'] == 'catRooms'){
            $categoriesRoom = new Info();
            $categoriesRoom = $categoriesRoom->get_cats_room();

            foreach($categoriesRoom as $cats){
                $price = substr($cats[6],0 ,-3);
                echo "<table>
                <tr id='tableHeadCatRoomsText'>
                    <td class='adminNameCat'>".$cats[1]."</td>
                    <td class='adminSquare'>".$cats[5]."</td>
                    <td class='adminNumPers'>".$cats[4]."</td>
                    <td class='adminNumRooms'>".$cats[2]."</td>
                    <td class='adminPrice'>".$price."</td>
                    <td class='adminAction'><a href='deleteCatRoom.php'><img src='../images/admin/bin.svg' alt='delete'></a><a href='updateCatRoom.php'><img src='../images/admin/update.svg' alt='update'></a></td>
                </tr>
            </table><hr>";
            }
        }
        if($_GET['page_admin'] == 'services'){
            // echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/add.svg' alt='add'></a>";
            
            // echo "<div class='empty14'></div>";

            // echo "<table>
            //     <tr id='tableHeadServ'>
            //         <td class='adminServiceName'> Название </td>
            //         <td class='adminServiceDesc'> Описание </td>
            //         <td class='adminServiceCat'> Категория </td>
            //         <td class='adminServiceImg'> Изображение </td>
            //         <td class='adminServicePrice'> Цена </td>
            //         <td class='adminServiceAction'> Действия </td>
            //     </tr>
            // </table>";
        }
        if($_GET['page_admin'] == 'catServices'){
            // echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/add.svg' alt='add'></a>";
            
            // echo "<div class='empty14'></div>";

            // echo "<table>
            //     <tr id='tableHeadRoomcatServ'>
            //         <td class='adminRoomCatServId'> Идентификатор <br> категории услуги </td>
            //         <td class='adminRoomCatServName'> Название категории услуги </td>
            //         <td class='adminRoomCatServAction'> Действия </td> 
            //     </tr>
            // </table>";
        }
        if($_GET['page_admin'] == 'bookings'){
            // echo "<table>
            //     <tr id='tableHeadRoomBook'>
            //         <td class='adminBooksId'> Номер <br> брони</td>
            //         <td class='adminBooksName'> Фамилия Имя покупателя</td>
            //         <td class='adminBooksNameRoom'> Название номера</td>
            //         <td class='adminBooksDateArrival'> Дата заселения</td>
            //         <td class='adminBooksDateDeparture'> Дата выезда</td>
            //         <td class='adminBooksSumPrice'> Сумма брони</td>
            //         <td class='adminBooksStatus'> Статус</td>
            //     </tr>
            // </table>";
        }
        
        
        
        
        
    }
    else{
        // echo "<table>
        //         <tr id='tableHeadUsers'>
        //             <td class='adminUserName'>Фамилия Имя</td>
        //             <td class='adminUserBday'>Дата рождения</td>
        //             <td class='adminUserPhone'>Телефонный номер</td>
        //             <td class='adminUserEmail'>Почта</td>
        //             <td class='adminUserSatus'>Статус</td>
        //             <td class='adminUserAction'>Действия</td>
        //         </tr>
        //     </table>";

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
            //
            echo "<table>
            <tr id='tableHeadUsersInfo'>
                <td class='adminUserName'>".$nameUser."</td>
                <td class='adminUserBday'>".$bday."</td>
                <td class='adminUserPhone'>".$phone."</td>
                <td class='adminUserEmail'>".$user[1]."</td>
                <td class='adminUserRole'>".$user[3]."</td>
                <td class='adminUserSatus'>".$status."</td>
                <td class='adminUserAction'><a href='changeUser.php?action=".$imgStatus."&&id=".$user[0]."'><img class='imgStatusUser' src='../images/admin/".$imgStatus.".svg' alt='".$imgStatus."'></a></td>
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
<script>
        $("#roomSelect").change(function() {
            $("#roomAdminForm").submit();
        });
        $("#servSelect").change(function() {
            $("#servAdminForm").submit();
        });
  </script>