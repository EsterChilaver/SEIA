function validate(){
    console.log("validade...");
    var format = /[áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var username = document.getElementById('signup_username');
   
   console.log("user name> " + username.value);
   console.log("user name test: " + format.test(username.value));
   if(format.test(username.value)){
       alert("O nome de usuário só pode conter letras e números (sem acentuação)");
        return false;
   }
    
   return true;
    
}