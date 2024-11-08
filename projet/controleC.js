let formulaire2 = document.getElementById('form2');
formulaire2.addEventListener('submit',function(e){
    let Lname=document.getElementById("CapLname");
    let mail = document.getElementById("Capemail");
    let cin = document.getElementById("Capcin");
    let mdp=document.getElementById("Cappass");
    let name=document.getElementById("Capname");
    let confmdp=document.getElementById("Capconfirmpass");
    let regExmdp=/^[A-Za-z0-9]{8,}[$#]$/;
    let regExNom=/^[a-zA-Z\s]{1,20}$/;
    let regExEmail= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
    let regExCin=/[0-9]{8}/;
    let myError=document.getElementById('erreur2');
    myError.style.color='red';
    
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