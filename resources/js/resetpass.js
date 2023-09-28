const pwShow = document.querySelector(".show"),
   createPw = document.querySelector("#createPw"),
   confirmPw = document.querySelector("#confirmPw");

pwShow.addEventListener("click", ()=>{
   if((createPw.type === "password") && (confirmPw.type === "password")){
      createPw.type = "text";
      confirmPw.type = "text";
      pwShow.classList.replace("fa-eye-slash", "fa-eye");
   }else {
      createPw.type = "password";
      confirmPw.type = "password";
      pwShow.classList.replace("fa-eye", "fa-eye-slash");
   }
});

