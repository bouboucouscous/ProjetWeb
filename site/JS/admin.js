function createUser(){
    document.getElementById("accesPageByMenu").src = "createUser.php";
}
function createCours(){
    document.getElementById("accesPageByMenu").src = "createCours.php";
}
function createTeam(){
    document.getElementById("accesPageByMenu").src = "createTeam.php";
}

function openNav() {
    document.getElementById("MENU").style.width = "120px";    
    document.getElementById("btnNav").innerHTML = "";
  }
  
  function closeNav() {
    document.getElementById("MENU").style.width = "0";
    document.getElementById("btnNav").innerHTML = "&#9658;";
  }