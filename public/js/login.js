const registerBtn= document.getElementById('register');
const container = document.getElementById('contailer');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () =>{
    container.classList.add("active");
});
loginBtn.addEventListener('click', () =>{
    container.classList.remove("active");
});