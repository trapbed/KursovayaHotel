
<?php
    include "header.php";
    // print_r($_SESSION);
    $date_arrival = isset($_GET['dateArrival']) ? $_GET['dateArrival'] : false;
    $date_depart  = isset($_GET['dateDeparture']) ? $_GET['dateDeparture'] : false;
    

    $current_date = date('Y-m-d');
    $tommorow = strtotime("$current_date +1 day");
    $tommorow = date("Y-m-d", $tommorow);

    $ten = strtotime("$current_date +30 days");
    $max_date = date('Y-m-d',$ten);

    $min_date = strtotime("$date_arrival+ 1 day");
    $min_date = date('Y-m-d', $min_date);

    $max_date_arrival = strtotime("$current_date +29 days");
    $max_date_arrival = date('Y-m-d',$max_date_arrival);
    


    // $current_date = date('Y-m-d');
    // $tommorow = strtotime("$current_date +1 day");
    // $tommorow = date("Y-m-d", $tommorow);

    // $ten = strtotime("$current_date +10 days");
    // $max_date = date('Y-m-d',$ten);

    // $min_date = strtotime("$date_arrival+ 1 day");
    // $min_date = date('Y-m-d', $min_date);

    // $max_date_arrival = strtotime("$current_date +9 days");
    // $max_date_arrival = date('Y-m-d',$max_date_arrival);
    
    if(isset($_GET['dateDeparture'])){
        $max_date_arrival = $_GET['dateDeparture'];
    }
?> 
<!-- MAIN -->
    <main id="general">
        <div class="emtyGeneralMain"></div>
        <form id='formGeneralMain' action="catalog.php" method='GET'>
            <div id='inputsDatePeople'>
                    <input required class='fontArial' type="date" name="dateArrival" id="indexDateArrival" value='<?= isset($date_arrival) ? $date_arrival : $current_date?>' min='<?=$current_date?>' max='<?=$max_date_arrival?>'>
                    <input required class='fontArial' type="date" name="dateDeparture" id= "indexDateDeparture" value='<?= isset($date_depart) ? $date_depart : $tommorow?>' min='<?=$min_date?>' max='<?=$max_date?>'>
                <div id='forSelect'>
                    <select required class='fontArial' name="numPers" id="">
                        <option value="">Количество гостей</option>
                        <option value="1">1 гость</option>
                        <option value="2">2 гостя</option>
                        <option value="3">3 гостя</option>
                        <option value="4">4 гостя</option>
                    </select>
                </div>
            </div>
            <input class='fontArial' type="submit" value="Искать">
        </form>
    </main>
<!-- SERVICES TEXT -->
    <div id='services'>
        <h3>УСЛУГИ</h3>
        <span>Наш отель предлагает услуги бронирования отелей разных категорий. Также предоставляем допольнительные услуги: подзенмая парковка, заряд электромобилей, посещение спа и бани, услуги няни и прочее. Эти и дргуие услуги вы можете найти в нашем <a href='services.php'>разделе</a>.</span>
    </div>
<!-- SERVICES IMGS -->
    <div id='forServicesImg'>
        <div id='servicesImg'>
            <img id='img1' src="\img\servicesIndex\image1.png" alt="reseption">
            <img id='img2' src="\img\servicesIndex\image2.png" alt="restoraunt">
            <div class="serImgEmty"></div>
            <img id='img3' src="\img\servicesIndex\image3.png" alt="parking">
            <img id='img4' src="\img\servicesIndex\image4.png" alt="cleaning">
        </div>
        <img src="\img\servicesIndex\height.png" alt="bankets">
    </div>
<!-- WHY US -->
    <div id="whyUs">
        <h3>почему мы</h3>
        <div id="fourSecWhyUs">
            <div class="blockWhy">
                <img class="blockWhyImg" src="img/whyUs/why1.png" id="whyHeight1" alt="why us">
                <div class="blockWhyDiv">
                    <h3>Вежливый персонал</h3>
                    <div class="whyEmty"></div>
                    <span>В нашем отеле работает только квалифицированный персонал, прошедший подготовку. В нашем отеле работает только квалифицированный персонал, прошедший подготовку.</span>
                </div>
            </div>
            <div class="blockWhy" id="marginWhy">
                <img class="blockWhyImg" src="img/whyUs/why2.png" id="whyHeight2" alt="why us">
                <div class="blockWhyDiv">
                    <h3>Лучшее обслуживание</h3>
                    <div class="whyEmty"></div>
                    <span>Предлагаем нашим клиентам различные категории услуг и выполняем их на высшем уровне.  Все для Вашего комфортного отдыха. Будем рады выполнить любое Ваше пожелание.</span>
                </div>
            </div>
            <div class="blockWhyEnd">
                <img class="blockWhyImg" src="img/whyUs/why3.png" id="whyHeight3" alt="why us">
                <div class="blockWhyDiv">
                    <h3>Чистота в отеле</h3>
                    <div class="whyEmty"></div>
                    <span>В нашем отеле работает только квалифицированный персонал, прошедший подготовку. В нашем отеле работает только квалифицированный персонал, прошедший подготовку.</span>
                </div>
            </div>
            <div class="blockWhyEnd" id="marginWhy">
                <img class="blockWhyImg" src="img/whyUs/why4.png" id="whyHeight4" alt="why us">
                <div class="blockWhyDiv">
                    <h3>Высокий рейтинг</h3>
                    <div class="whyEmty"></div>
                    <span>Предлагаем нашим клиентам различные категории услуг и выполняем их на высшем уровне.  Все для Вашего комфортного отдыха. Будем рады выполнить любое Ваше пожелание.</span>
                </div>
            </div>
        </div>
    </div>

<!-- ROOMS -->
    <div id="roomsIndex">
        <h3>Номера</h3>
        <div id="sliderRoomsIndex">
            <div id="arrowSliderRoomLeft"></div>
            <div id="roomImg">
                <div id="roomImgDesc">
                    <h3>Стандартный двуместный номер с двуспальной кроватью</h3>
                    <span>Просторная комната с большой двуспальной оборудована кондиционером, холодильником, телефоном, телевизором с плоским экраном. В комнате располагаются кресло/пуф, письменный и журнальный столы.</span>
                </div>
            </div>
            <div id="arrowSliderRoomRight"></div>
        </div>
    </div>

    <div class="emtyBetweenRoomsContacts"></div>

<!-- CONTACTS -->
    <div id="contacts">
        <h3>контакты</h3>
        <div class="contactEmty"></div>
        <div id="contactMap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d904.6995114907479!2d55.98320785755751!3d54.726433415653354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43d93a36aea03e71%3A0x169a8da1bca7c506!2z0YPQuy4g0JrQuNGA0L7QstCwLCAxMDcsINCj0YTQsCwg0KDQtdGB0L8uINCR0LDRiNC60L7RgNGC0L7RgdGC0LDQvSwgNDUwMDc4!5e0!3m2!1sru!2sru!4v1712158963588!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div id="contactContacts">
                <div id="addr" class="infoContact">
                    <span class="goldContact">Адрес : </span>
                    <span class="blackContact">ул.кирова, 107 - 13, уфа, респ. башкортостан, 450061</span>
                </div>
                <div id="phone" class="infoContact">
                    <span class="goldContact">Номер телефона : </span>
                    <span class="blackContact">+7 (952)-812-00-66</span>
                </div>
                <div id="emil" class="infoContact">
                    <span class="goldContact">Адрес Эл. Почты : </span>
                    <span class="blackContact">hotelion@gmail.com</span>
                </div>
            </div>
        </div>
    </div>

<?php 
    include "footer.php";
?>
<script src='../js/ajaxIndex.js'></script>
</body>
</html>