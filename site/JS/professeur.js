function setPresence(cours, eleve, e) {
    $.post("function/professeurAPI.php?action=setPresent",
        {
            cours:cours,
            eleve:eleve,
            present:e.checked
        },
        (result,status)=>{            
            console.log(result);
            const resultat = JSON.parse(result);
            $("#presence_"+resultat.eleve).text(resultat.present == "true" ? "1" : "0");
        }
    );
    
}