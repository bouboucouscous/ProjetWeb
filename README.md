# ProjetWeb
Sujet du projet :  
Gestion de l'appel  
## Récupérer le projet
git clone https://github.com/bouboucouscous/ProjetWeb.git  
git fetch
git config --global user.name "Your Name"  
  
## Fonctionnement pour ajouter des modifications :  
git checkout -b nomdeTaBranche  
git add .  
git commit -m "ce que tu as ajouté"  
git push --set-upstream origin nomdeTaBranche  

### si branche existante
git add .  
git commit -m "ce que tu as ajouté"  
git push  

### recuper les modifications sur la branche main
git checkout main  
git pull  

### recupérer les dernières modifcations sur ca branche de travail
#### faire la tache précédente
git checkout nomdeTaBranche  
git rebase main  
#### lors du git push faire
push --force  
