var lastRow = null;

function UpdateUser(e, id) {
  if (id == "nouveau") {
    document.forms[0].elements[0].value = "";
    document.forms[0].elements[1].value = "";
    document.forms[0].elements[2].value = "";
    document.forms[0].elements[4].required = true;
    document.forms[0].elements[5].value = "Créer";
    document.forms[0].action = "creerouupdate.php?cree=true";
    document.forms[1].elements[0].disabled = true;
    lastRow.style.background = "rgb(255, 255, 255)"
    lastRow = null;
  }
  else {
    console.log()
    document.forms[1].action = document.forms[1].action+id;
    $.get("getUser.php?id="+id,traiterReponseDemande);
  }
  if (lastRow != null) {
    lastRow.style.background = "rgb(255, 255, 255)"
  }
  e.style.background = "rgb(69, 123, 230)";
  lastRow = e;
}

function traiterReponseDemande(donnees) {
  data = JSON.parse(donnees);
  data.forEach(element => {
    document.forms[0].elements[0].value = element.nom;
    document.forms[0].elements[1].value = element.prenom;
    document.forms[0].elements[2].value = element.email;
    document.forms[0].elements[3].value = element.role;
  });
  
  document.forms[0].elements[4].required = false;
  document.forms[0].elements[5].value = "Mettre à jour";
  document.forms[0].action = "creerouupdate.php?cree=false";
  document.forms[1].elements[0].disabled = false;
}