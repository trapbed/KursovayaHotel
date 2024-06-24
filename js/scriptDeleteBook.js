let ask = confirm('Вы точно хотите отменить бронь?');
        if(ask){
            
        }
        else{
            alert('Номер еще забронирован на ваше имя!');
            location.href='../account.php?page=history';
        }