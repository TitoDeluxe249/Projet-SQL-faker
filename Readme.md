*****************************************Projet SQL : base de données Ecommerce - AMBA TERENCE B2***************************************

Ce script PHP génère des données (factices) pour remplir une base de données Ecommerce. 
Il utilise la bibliothèque Faker pour créer des enregistrements de test pour les tables de la base de données. 


*********Configuration :*********

Avant d'exécuter le script, assurez-vous d'avoir la bibliothèque Faker installée et configurée pour exécuter ce script.
Assurez-vous également d'avoir les extensions requises pour pouvoir lire les fichiers (ex: SQLite et SQLite Viewer)
Vous pouvez modifier les informations de connexion en modifiant les variables suivantes :

$host : L'hôte de la base de données.
$dbname : Le nom de la base de données.
$username : Le nom d'utilisateur de la base de données.
$password : Le mot de passe de la base de données.


*********Utilisation :*********

Créez une base de données vide avec la structure de tables correspondante. Vous pouvez utiliser des outils tels que phpMyAdmin ou un script SQL pour cela. 

Exécutez le script en effectuent la commande : php faker.php

Ou une autre façon d'excuter le programme :

Exécutez le script en accédant avec votre navigateur Web au lien suivant : http://localhost/xampp/Projet-SQL-AMBA-TERENCE-B2-INFO-faker_tito/faker.php (mais que je ne vous conseille pas) et en visitant la page qui contient le formulaire "Générer des données". Vous devrez peut-être ajuster le chemin du fichier d'action du formulaire (action="faker.php") pour correspondre à l'emplacement de votre script.
Cliquez sur le bouton "Générer des données" pour remplir la base de données avec des enregistrements factices.


Une fois le processus terminé, le script affichera le message "Data inserted successfully!" et les données seront alors afficher dans le fichier tables.db du répertoire. 
! Attention : Assurez-vous d'avoir installer les extensions requises pour pour lire le fichier!


*********Personnalisation :*********

Le script est conçu pour générer 100 enregistrements factices pour chaque table de la base de données. Vous pouvez ajuster le nombre d'enregistrements en modifiant la valeur de la variable $numberOfRecords.

Vous pouvez également personnaliser la structure des données factices pour chaque table en modifiant les requêtes SQL correspondantes. Par exemple, vous pouvez ajouter ou supprimer des champs ou modifier les valeurs générées par Faker selon vos besoins.

Assurez-vous que la structure des tables de votre base de données correspond à celle définie dans les requêtes SQL du script.


*********Auteur :*********

AMBA TERENCE B2 INFORMATIQUE