// ADMIN
$(document).on('click', '#submitToBook', function(){
    $.get('http://coursework/book-room.php', function(){
        alert('Подождите немного, собираем информацию о номере!');
    })
})