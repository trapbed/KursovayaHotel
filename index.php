<?php
    include "header.php";
?>
<!-- HEADER -->
    <main id="general">
        <div id="emtyGeneralMain"></div>
        <form id='formGeneralMain' action="catalog.php" method='POST'>
            <div id='inputsDatePeople'>
                <input class='fontArial' type="date" name="" id="" value='2024-04-04'>
                <input class='fontArial' type="date" name="" id="" value=''>
                <div id='forSelect'>
                    <select class='fontArial' name="" id="">
                        <option value=""></option>
                        <option value="">1 гость</option>
                        <option value="">2 гость</option>
                        <option value="">3 гость</option>
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
            <img id='img1' src="\images\servicesIndex\image1.png" alt="">
            <img id='img2' src="\images\servicesIndex\image2.png" alt="">
            <div id="serImgEmty"></div>
            <img id='img3' src="\images\servicesIndex\image3.png" alt="">
            <img id='img4' src="\images\servicesIndex\image4.png" alt="">
        </div>
        <img src="\images\servicesIndex\height.png" alt="">
    </div>
<!-- WHY US -->
    <div id="whyUs">
        <h3>почему мы</h3>
    </div>
</body>
</html>