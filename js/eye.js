let input = document.getElementById('inputPass');
let eyeOpen = document.getElementById('eyeOpen');
let eyeClose = document.getElementById('eyeClose');

eyeClose.addEventListener('click',function(){
    eyeClose.style.display = "none";
    eyeOpen.style.display = "block";
    input.type = "text";
})
eyeOpen.addEventListener('click', function(){
    eyeClose.style.display = "block";
    eyeOpen.style.display = "none";
    input.type = "password";
})
