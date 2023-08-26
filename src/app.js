//--Desperrois Lucas---//

//-------app.js-----//

//document javascript qui gère les cliques sur les imputs pour qu'elles deviennent rouge



//DOMContentLoaded permet de s'assurer que tous les élements html sont générés par le php avant de commencer l'execution de ce code javascript


document.addEventListener('DOMContentLoaded', function () {
    const inputWrapper = document.querySelectorAll(".inputformulaire");
    
    
    //on selectionne chaque inputWrapper donc chaque div avec la classe inputformulaire
    //puis on parcout à l'intérieur les input, la barre qui souligne l'input(le div surligne) et le label au dessus de l'input avec la classe placeholdezr
    inputWrapper.forEach(wrapper => {
    //selection des balises dans la div inputformulaire qui est selectionne
    const input = wrapper.querySelector('.moninput');
    const div = wrapper.querySelector('.surligne');
    const label = wrapper.querySelector('.placeholder');

    //si clique on ajoute le rouge sur le label et la div
    input.addEventListener('focus',() => {
        div.classList.add('rouge');    //On ajoute  le rouge à la div et au label
        label.classList.add('bouge');
    });
    //dès que le clique s'effectue autre par on retire le rouge du div et du label
    input.addEventListener('blur',() => {
        div.classList.remove('rouge');
        label.classList.remove('bouge');
    })

    
    

    })
    const mdp = document.querySelector('.motdepasse');
    
    const inputmdp = document.getElementById('mdp');
   
    inputmdp.addEventListener('focus',() =>{
        mdp.classList.add('apparait')
     })
    inputmdp.addEventListener('blur',() => {
        mdp.classList.remove('apparait');
    })

    
    
    
    

    
})

//------------------------------------------------------------------//


changement = true;
//fonction changer de type void qui sert à modifier la visibilité de l'input de mot de passe
//aucun paramètres
//elle est utiliser sur l'attribut onclick de l'icone(balise image) visible/pas visible




function changer(){

  
    
    const inscription = document.getElementById("formsend");
    const visible = document.querySelector('.visible');
    const inputmdp2 = document.getElementById('mdp');
    if(changement==true){
            
            visible.src='src/image/icons8-invisible-30.png'
            inputmdp2.setAttribute("type","text")
            changement=false; 
            
        }
        else if(changement==false){
            visible.src='src/image/icons8-visible-30.png'
            inputmdp2.setAttribute("type","password");
            changement=true;

        }
    
}





//Fonction regex qui permet de valider une expression régulière pour un mot de passe
//fonction validateMDP(mdp) , mdp : string
//résultat de la fonction : true si la chaine est valide false sinon

function validateMDP(mdp){
    var Reg = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/);
    return Reg.test(mdp);
}
//--------------------------------------------------------------------//
//Deuxième fonction regex qui permet de valider l'expressino d'un email
//fonction checkEmail(email) , paramètre email : string
//résultat de la fonction : true si l'email est valide false sinon

function checkEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

//---------------------------------------------------------------------//


//fonction de type void qui permet d'afficher des messages à l'utilisateur sur des 
//inputs qui ont été remplis d'une mauvaise façon (mot de passe incorrecte,champ vide , email pas valide ou déjà inscrit) etc...)
function validerFormulaire(){
        var test = false;
        document.getElementById('myform').addEventListener("submit",function(event){
            var inputvaluenom = document.getElementById("nom").value;
            var inputvalueprenom = document.getElementById("prenom").value;
            var inputvaluemdp = document.getElementById("mdp").value;
            var inputvalueemail = document.getElementById("email").value;
            var inputvalueconfirmation = document.getElementById("confirmation").value;
            //vérifcation d'un email pas vide avec ce que doit contenir un email
            //le choix de ne pas mettre de else if permet d'afficher tous les erreurs d'inputs en même temps
            //c'est un choix discutable
            if(!checkEmail(inputvalueemail)){
                const enleve = document.getElementById('email');
                const email = document.querySelector('.emailvide')
                email.classList.add('apparait');
                enleve.addEventListener('focus',()=>{
                    email.classList.remove('apparait');
                })
                event.preventDefault();
            }
            
            //vérif mot de passe
            if(!validateMDP(inputvaluemdp)){
                const debug = document.getElementById('mdp');
                const apparaitpas = document.querySelector('.motdepasse');
                const mdp = document.querySelector('.mdpincorrecte');
                mdp.classList.add('apparait');
                debug.addEventListener('focus',()=>{
                    mdp.classList.remove('apparait');
                })
                
                
                
                event.preventDefault();
            }
            //vérif confirmation égal au mot de passe rentré
            
            
            //vérificatino d'un nom pas vide
            if(inputvaluenom.trim()===""){
                const nom = document.querySelector('.nom');
                const enleve2 = document.getElementById('nom');

                nom.classList.add('apparait');
                enleve2.addEventListener('focus',()=>{
                    nom.classList.remove('apparait');
                })
                
               
                event.preventDefault();
                
                
            }
            //vérification d'un prénom pas vide
            if(inputvalueprenom.trim()===""){
                const prenom = document.querySelector('.prenom');
                const eneleve1 = document.getElementById('prenom');
                prenom.classList.add('apparait');
                eneleve1.addEventListener('focus',() =>{
                    prenom.classList.remove('apparait')
                })
                
                
                event.preventDefault();
                
                
                
            }
            console.log(inputvaluemdp);
            if(inputvalueconfirmation.trim()=="" || inputvaluemdp!==inputvalueconfirmation){
                const confirmation = document.querySelector('.confirmation');
                const enleve3 = document.getElementById('confirmation');
                confirmation.classList.add('apparait');
                enleve3.addEventListener('focus',()=>{
                    confirmation.classList.remove('apparait');
                })
                event.preventDefault();
                
                
            }
            else{
                test=true;
            }
            
            if(test===true){


                document.getElementById('myform').submit();
            }
        })
        
        
}

//--------------------------fin du programme --------------------------//

