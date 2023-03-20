function createUser(){
    document.getElementById("accesPageByMenu").src = "createUser.php";
}
function createCours(){
    document.getElementById("accesPageByMenu").src = "createCours.php";
}
function createTeam(){
    document.getElementById("accesPageByMenu").src = "createClasse.php";
}

function openNav() {
    document.getElementById("MENU").style.width = "120px";    
    document.getElementById("btnNav").innerHTML = "";
  }
  
function closeNav() {
  document.getElementById("MENU").style.width = "0";
  document.getElementById("btnNav").innerHTML = "&#9658;";
}

var lastRow = null;
var lastRow2 = null;
var lastRow3 = null;
var idClasse = null;

function UpdateUser(e, id) {
  if (id == "nouveau") {
    document.forms[0].elements[0].value = "";
    document.forms[0].elements[1].value = "";
    document.forms[0].elements[2].value = "";
    document.forms[0].elements[4].required = true;
    document.forms[0].elements[6].value = "Créer";
    document.forms[0].action = "function/creerOuUpdate.php?cree=1";
    document.forms[1].elements[1].disabled = true;
    lastRow.style.background = "rgb(255, 255, 255)"
    lastRow = null;
  }
  else {
    document.forms[1].elements[0].value = id;
    document.forms[0].elements[5].value = id;
    $.get("function/getUser.php?id="+id,traiterReponseDemande);
  }
  if (lastRow != null) {
    lastRow.style.background = "rgb(255, 255, 255)"
  }
  e.style.background = "rgb(69, 123, 230)";
  lastRow = e;
}

function traiterReponseDemande(donnees) {
  var data = JSON.parse(donnees);
  data.forEach(element => {
    document.forms[0].elements[0].value = element.nom;
    document.forms[0].elements[1].value = element.prenom;
    document.forms[0].elements[2].value = element.email;
    document.forms[0].elements[3].value = element.role;
  });
  document.forms[0].elements[4].required = false;
  document.forms[0].elements[6].value = "Mettre à jour";
  document.forms[0].action = "function/creerOuUpdate.php?cree=0";
  document.forms[1].elements[1].disabled = false;

}

function UpdateClasse(e, id) {
  cleanTab();
  if (id == "nouveau") {
    document.forms[0].elements[0].value = "";
    document.forms[0].elements[1].value = "Créer";
    document.forms[0].action = "function/manageClasse.php?cree=1";
    document.forms[1].elements[1].disabled = true;
    lastRow.style.background = "rgb(255, 255, 255)";
    lastRow = null;
    idClasse = null;
  }
  else {
    document.forms[0].elements[0].value = id;
    document.forms[1].elements[0].value = id;
    document.forms[0].elements[1].value = "Mettre à jour";
    document.forms[0].action = "function/manageClasse.php?cree=0";
    document.forms[1].elements[1].disabled = false;
    $.get("function/getEleveByClasse.php?id="+id,traiterReponseDemande2);
    idClasse = id;
  }
  if (lastRow != null) {
    lastRow.style.background = "rgb(255, 255, 255)"
  }
  e.style.background = "rgb(69, 123, 230)";
  lastRow = e;
}

function traiterReponseDemande2(donnees) {
  if (donnees == "Identifiant invalide") {
    alert(donnees);
  }
  else if (donnees == "Déjà dans une classe!!!") {
    alert(donnees);
  }
  else {
    var refTable = document.getElementById("tableauEleveParClasse");
    var data = JSON.parse(donnees);
    var i = 2;
    data.forEach(element => {
      var nouvelleLigne = refTable.insertRow(i);
      nouvelleLigne.setAttribute('onclick','DeleteUserToClasse(this,"'+element.identifiantLogin+'")');
      var nouvelleCellule1 = nouvelleLigne.insertCell(0);
      var nouvelleCellule2 = nouvelleLigne.insertCell(1);
      var nouvelleCellule3 = nouvelleLigne.insertCell(2);
      var nouveauTexte = document.createTextNode(element.identifiantLogin);
      nouvelleCellule1.appendChild(nouveauTexte);
      nouveauTexte = document.createTextNode(element.nom);
      nouvelleCellule2.appendChild(nouveauTexte);
      nouveauTexte = document.createTextNode(element.prenom);
      nouvelleCellule3.appendChild(nouveauTexte);
      i++;
    });
  }
}

function cleanTab() {
  var refTable = document.getElementById("tableauEleveParClasse");
  taille = refTable.rows.length;
  for (let index = 2; index <= taille; index++) {
    try {
      refTable.deleteRow(2);
    } catch (error) {}
  }
}

function AddUserToClasse(){
  cleanTab();
  try {
    DeleteUserToClasse(null, "nouveau")
  } catch (error) {}
  if (idClasse != null) 
  {
    reponse = prompt("Ajouter identifiant de l'élève", "identifiantEleve");
    $.get("function/addEleveToClasse.php?idClasse="+idClasse+"&idEleve="+reponse,traiterReponseDemande2);
  } 
  else 
  {
    alert("Pas possible pas de classe selectionner.");
  }
}

function DeleteUserToClasse(e, id)
{
  if (id == "nouveau") {
    document.forms[2].elements[2].disabled = true;
    lastRow3.style.background = "rgb(255, 255, 255)";
    lastRow3 = null;
  }
  else {
    document.forms[2].elements[2].disabled = false;
    document.forms[2].elements[0].value = idClasse;
    document.forms[2].elements[1].value = id;
    if (lastRow3 != null) {
      lastRow3.style.background = "rgb(255, 255, 255)"
    }
    e.style.background = "rgb(69, 123, 230)";
    lastRow3 = e;
  }
}


function deleteCours(e,id)
{
  document.forms[1].elements[0].value = id;
  document.forms[1].elements[1].disabled = false;
  if (lastRow != null) {
    lastRow.style.background = "rgb(255, 255, 255)"
  }
  e.style.background = "rgb(69, 123, 230)";
  lastRow = e;
}