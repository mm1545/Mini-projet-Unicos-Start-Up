const eye = document.querySelectorAll(".feather-eye");
const eyeoff = document.querySelectorAll(".feather-eye-off");
const passwordField = document.querySelectorAll("input[type=password]");
passwordField.forEach((passwordField, i) => {
eye[i].addEventListener("click",function(e) {
  eye[i].style.display = "none";
  eyeoff[i].style.display = "block";
  passwordField.type = "text";
  e.preventDefault();
});

eyeoff[i].addEventListener("click", function(e) {
  eyeoff[i].style.display = "none";
  eye[i].style.display = "block";
  passwordField.type = "password";
  e.preventDefault();
});
});

let formulaire = document.getElementById('form1');
formulaire.addEventListener('submit',function(e){
  
    let Lname=document.getElementById("Lname");
    let mail = document.getElementById("email");
    let cin = document.getElementById("cin");
    let numreg=document.getElementById("numreg");
    let mdp=document.getElementById("pass");
    let name=document.getElementById("name");
    let confmdp=document.getElementById("confirmpass");
    let imgS = document.getElementById("imgS");
    let regExnumreg=/^[A-Z]\d{10}$/;
    let regExmdp=/^[A-Za-z0-9]{8,}[$#]$/;
    let regExNom=/^[a-zA-Z\s]{1,20}$/;
    let regExEmail= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
    let regExCin=/[0-9]{8}/;
    let myError=document.getElementById('erreur');
    myError.style.color='red';
 


 //controle image
 let file = imgS.files[0];
 let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

 if (imgS.files.length === 0) {
  myError.innerHTML = "Veuillez sélectionner une image";
  imgS.classList.add('is-invalid');
  e.preventDefault(); 
} else if (!allowedExtensions.exec(file.name)) {
      myError.innerHTML = "Les extensions autorisées sont .jpg, .jpeg, .png, .gif";

      imgS.classList.add('is-invalid');

      e.preventDefault(); 
  }else{
    imgS.classList.remove('is-invalid');  

  } 
   //controle confirm pass
 if (confmdp.value.trim()=='')
 {	
 myError.innerHTML='Confirmez votre mot de passe';
 myError.style.color='red';
 confmdp.classList.add('is-invalid');
 e.preventDefault();
 }
 else if(confmdp.value!==mdp.value){

 myError.innerHTML="Le mot de passe est incorrect";
 confmdp.classList.add('is-invalid');
 e.preventDefault();
 }
 else{
  confmdp.classList.remove('is-invalid');

 }
    //controle mot de passe
    if (mdp.value.trim()=='')
    {	
    myError.innerHTML='Le champ mot de passe est requis';
    mdp.classList.add('is-invalid');
 
    e.preventDefault();
    }
    else if(regExmdp.test(mdp.value)==false){
 
    myError.innerHTML="Le champ mot de passe doit être composé d'au mois 8 chiffres ou lettres et finissant par $ ou #";
    mdp.classList.add('is-invalid');
 
    e.preventDefault();
    }
    else{
      mdp.classList.remove('is-invalid');

    }
    //controle num registre
    if (numreg.value.trim()=='')
    {	
		myError.innerHTML='Le champ numéro de registre est requis';
    numreg.classList.add('is-invalid');
		e.preventDefault();
    }
    else if(regExnumreg.test(numreg.value)==false){

		myError.innerHTML="Le champ numéro de registre doit être composé d'une lettre MAJUSCULE et 10 chiffres exactement";
    numreg.classList.add('is-invalid');
		e.preventDefault();
    }else{
      numreg.classList.remove('is-invalid');

    }
   //controle de l'email
   if (mail.value.trim()=='')
   {	
   myError.innerHTML='Le champ Email est requis';
   mail.classList.add('is-invalid');
   e.preventDefault();
   }
   else 
     if(regExEmail.test(mail.value)==false){
   myError.innerHTML="L'adresse email n'est pas valide";
   mail.classList.add('is-invalid');
   e.preventDefault();
     }else{
      mail.classList.remove('is-invalid');

     }
       
     // controle cin
     if (cin.value.trim()=='')
     {	
     myError.innerHTML='Le champ cin est requis';
     cin.classList.add('is-invalid');
     e.preventDefault();
     }
     else if(regExCin.test(cin.value)==false){
 
     myError.innerHTML="Le champ cin doit être composé de 8 chiffres";
     cin.classList.add('is-invalid');
     e.preventDefault();
     }else{
      cin.classList.remove('is-invalid');

     }
  //controle prénom
 if (name.value.trim()=='')
 {	
 myError.innerHTML='Le champ prénom est requis';
 name.classList.add('is-invalid');

 e.preventDefault();
 }
 else if(regExNom.test(name.value)==false){

 myError.innerHTML="Le champ prénom doit être composé de lettres ou d'espaces et moins et ne dépasse pas 20 caractéres";
 name.classList.add('is-invalid');

 e.preventDefault();
 }
 else{
  name.classList.remove('is-invalid');
 }
      // controle du nom
      if (Lname.value.trim()=='')
      {	
      myError.innerHTML='Le champ nom est requis';
      Lname.classList.add('is-invalid');
      e.preventDefault();
      }
      else if(regExNom.test(Lname.value)==false){
  
      myError.innerHTML="Le champ nom doit être composé de lettres ou d'espaces et moins et ne dépasse pas 20 caractéres";
      Lname.classList.add('is-invalid');
      e.preventDefault();
      }
      else{
        Lname.classList.remove('is-invalid');

      }
});


