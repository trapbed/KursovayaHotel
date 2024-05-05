let bgModal = document.getElementById('backgroundModal');
// signup
let signupBtn = document.getElementById('signup');
let closeSignup = document.getElementById('closeSignup');
// signupModal
let signupModal = document.getElementById('signUpDiv');

signupBtn.addEventListener('click', function(){
    signupModal.style.top = "23.5vmax";
    bgModal.style.top = "24vmax";
})
closeSignup.addEventListener('click', function(){
    signupModal.style.top = "-50vmax";
    bgModal.style.top = "-50vmax";
})



// signin
let signinBtn = document.getElementById('signin');
let closeSignin = document.getElementById('closeSignin');
// signinModal
let signinModal = document.getElementById('signinDiv');

signinBtn.addEventListener('click', function(){
    signinModal.style.top = "20vmax";
    bgModal.style.top = "24vmax";
})
closeSignin.addEventListener('click', function(){
    signinModal.style.top = "-50vmax";
    bgModal.style.top = "-50vmax";
})


// bgModal
bgModal.addEventListener('click', function(){
    signinModal.style.top = "-50vmax";
    signupModal.style.top = "-50vmax";
    bgModal.style.top = "-50vmax";
})


// to change modal
// on signup
let toSigninbtn = document.getElementById('toSigninbtn');
// on signup
let toSignupBtn = document.getElementById('toSignupBtn');

toSigninbtn.addEventListener('click', function(){
    signinModal.style.top = "20vmax";
    signupModal.style.top = "-50vmax";
})
toSignupBtn.addEventListener('click', function(){
    signinModal.style.top = "-50vmax";
    signupModal.style.top = "23.5vmax";
})
