<?php

// print_r($_SERVER);
include "../header.php";
require_once "../database/Admin_info.php";
?>

<div id="containerAdmin">
    <div id="navbarLeftAdmin">

        <a href='../admin/index.php?page_admin=users' class="<?=        (isset($_GET['page_admin']) && $_GET['page_admin']=='users')? 'activeNavbar': 'inactiveNavbar' ?>">Пользователи</a>
        <a href='../admin/index.php?page_admin=rooms' class="<?=        (isset($_GET['page_admin']) && $_GET['page_admin']=='rooms')? 'activeNavbar': 'inactiveNavbar' ?>">Номера</a>
        <a href='../admin/index.php?page_admin=catRooms' class="<?=     (isset($_GET['page_admin']) && $_GET['page_admin']=='catRooms')? 'activeNavbar': 'inactiveNavbar' ?>">Категории номеров</a>
        <a href='../admin/index.php?page_admin=services' class="<?=     (isset($_GET['page_admin']) && $_GET['page_admin']=='services')? 'activeNavbar': 'inactiveNavbar' ?>">Услуги</a>
        <a href='../admin/index.php?page_admin=catServices' class="<?=  (isset($_GET['page_admin']) && $_GET['page_admin']=='catServices')? 'activeNavbar': 'inactiveNavbar' ?>">Категории услуг</a>
        <a href='../admin/index.php?page_admin=bookings' class="<?=     (isset($_GET['page_admin']) && $_GET['page_admin']=='bookings')? 'activeNavbar': 'inactiveNavbar' ?>">Брони</a>
    </div>
    




<div id="containerAdminInfo">
<?php
    if(isset($_GET['page_admin'])  &&  $_GET['page_admin'] != 'users'){
        if($_GET['page_admin'] == 'rooms'){
            echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/add.svg' alt='add'></a>";
            
            echo "<div class='empty14'></div>";

            echo "<table>
                <tr id='tableHeadRooms'>
                    <td class='adminRoomImg'>Изображение</td>
                    <td class='adminRoomSmallName'>Короткое название</td>
                    <td class='adminRoomCat'>Категрия</td>
                    <td class='adminRoomDesc'>Описание</td>
                    <td class='adminRoomLongName'>Длиное название</td>
                    <td class='adminRoomAmount'>Количество<br>(номеров)</td>
                    <td class='adminRoomAction'>Действия</td>
                </tr>
            </table>";
        }
        if($_GET['page_admin'] == 'catRooms'){
            echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/add.svg' alt='add'></a>";
            
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
            echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/add.svg' alt='add'></a>";
            
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
            echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/add.svg' alt='add'></a>";
            
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
            // echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/add.svg' alt='add'></a>";
            
            // echo "<div class='empty14'></div>";

            // echo "<table>
            //     <tr id='tableHeadRooms'>
            //         <td class='adminRoomImg'>Изображение</td>
            //         <td class='adminRoomSmallName'>Короткое название</td>
            //         <td class='adminRoomCat'>Категрия</td>
            //         <td class='adminRoomDesc'>Описание</td>
            //         <td class='adminRoomLongName'>Длиное название</td>
            //         <td class='adminRoomAmount'>Количество<br>(номеров)</td>
            //         <td class='adminRoomAction'>Действия</td>
            //     </tr>
            // </table>";
            $rooms = new Info ();
            $rooms = $rooms->get_info_room();
            foreach($rooms as $room){
                echo "<table>
                <tr id='tableHeadRoomsText'>
                    <td class='adminRoomImg'>".$room[0]."</td>
                    <td class='adminRoomSmallName'>".$room[1]."</td>
                    <td class='adminRoomCat'>".$room[2]."</td>
                    <td class='adminRoomDesc'><a class='linkNoreAdmin' href='' alt=''>Смотреть</a></td>
                    <td class='adminRoomLongName'><a class='linkNoreAdmin' href='' alt=''>Смотреть</a></td>
                    <td class='adminRoomAmount'>".$room[5]."</td>
                    <td class='adminRoomAction'></td>
                </tr>
            </table><hr>";
            }   
        }
        if($_GET['page_admin'] == 'catRooms'){
            // echo "<a class='adminButtonAdd' href=''><img class='adminButtonAdd' src='../images/add.svg' alt='add'></a>";
            
            // echo "<div class='empty14'></div>";

            // echo "<table>
            //     <tr id='tableHeadCatRooms'>
            //         <td class='adminNameCat'>Назвавние категории номера</td>
            //         <td class='adminSquare'>Площадь</td>
            //         <td class='adminNumPers'>Количество гостей</td>
            //         <td class='adminNumRooms'>Количество комнат</td>
            //         <td class='adminPrice'>Цена</td>
            //         <td class='adminAction'>Действия</td>
            //     </tr>
            // </table>";
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
            echo "<table>
            <tr id='tableHeadUsers'>
                <td class='adminUserName'>".$user[0]." ".$user[1]." ".$user[2]."</td>
                <td class='adminUserBday'>".$user[3]."</td>
                <td class='adminUserPhone'>".$user[4]."</td>
                <td class='adminUserEmail'>".$user[5]."</td>
                <td class='adminUserSatus'>".$user[6]."</td>
                <td class='adminUserAction'></td>
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