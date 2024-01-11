Lien vers le site en ligne : https://dariaiarovaia.great-site.net/ENT/login.php

Lien vers le site en local, après installation : http://localhost/ENT/login.php


ATTENTION selon le nom du fichier dans lequel vous stockez le site, il vous faudra modifier l'URL. Ici, le site web est dans un dossier appelé "ENT".


Pour installer ce site sur votre machine en local, il vous faudra :

1\. Télécharger tous les dossiers sur votre ordinateur.

Vous devrez placer ces fichiers (dossier img et son contenu, dossier document et son contenu, dossier fact_access et son contenu, ainsi que tous les fichiers php, sql et html) dans un dossier que vous nommerez à votre aise. Pour que le site fonctionne, vous devrez l'installer sur un serveur local.
Si vous installez wamp, placez le dossier du site dans wamp64/www. Si vous désirez l'installer sur xampp, il faudra suivre le chemin xampp/htdocs. sur mamp, pour mac, suivez le chemin MAMP/htdocs.

2\. Installer la base de données sur votre ordinateur.

Pour se faire, vous devrez trouver le fichier "bdd_ent.sql". Vous irez ensuite dans votre base de données local : lancez votre serveur, affichez les icones cachées, repérez votre application serveur, cliquez dessus et sélectionnez "phpMyAdmin". Une page s'ouvre sur votre navigateur par défaut, et vous demande de vous identifier. Si vous êtes sur wamp, ou xamp, l'identifiant par défaut est "root", et il n'y a aucun mot de passe. Si vous utilisez Wamp, l'identifiant est "root" et le mot de passe est "root" ('' pour Windows). Ouvrez votre base de données. En haut à droite, appuyez sur "Importer", et sélectionnez le fichier "bdd_ent.sql" cité plus tôt. La base de données est automtiquement
crée.

3\. Modifier les informations de connexion.

Ouvrez le fichier "connexion.php" dans un éditeur de code (visual studio code par exemple) ou un éditeur de texte (l'application bloc note par exemple), et modifiez les informations décrites dans le fichier.
 
$db = new PDO('mysql:host=localhost;dbname= NOM DE VOTRE BASE DE DONNÉES;port= PORT(PEUT ÊTRE TROUVÉ DANS LA BASE DE DONNÉES EN HAUT, GÉNÉRALEMENT 3306);charset=utf8', 'LOGIN UTILISATEUR BASE DE DONNÉES', 'MOT DE PASSE UTILISATEUR BASE DE DONNÉES');


Pour installer ce site sur un serveur, vous aurez besoin de :

1\. Créer un domaine ou un sous-domaine pour votre site.

2\. Sauvegarde des fichiers :

Copiez tous les fichiers du site vers le nouvel emplacement sur le serveur de destination (selon le serveur, vous pouvez choisir le chemin du dossier ou ce dossier sera attribué automatiquement).
Utilisez des outils comme FTP pour assurer une copie complète et rapide. Le serveur qui prend en charge FTP fournira les données de connexion, que vous pouvez trouver dans la section FTP ou dans l'aide.

3\. Base de données :

Créez une base de données.
Créez un utilisateur de base de données qui se connectera aux données, ou utilisez le login et le mot de passe fournis par le serveur.
Importez la base de données à partir des fichiers (ent.sql) dans la base de données créée.

4\. Éditez le fichier connexion.php :

 
$db = new PDO('mysql:host= VOTRE HÔTE (les données peuvent être trouvées sur le site de votre hébergeur) ;dbname= NOM DE VOTRE BASE DE DONNÉES;port= PORT(PEUT ÊTRE TROUVÉ DANS LA BASE DE DONNÉES EN HAUT, GÉNÉRALEMENT 3306);charset=utf8', 'LOGIN UTILISATEUR BASE DE DONNÉES', 'MOT DE PASSE UTILISATEUR BASE DE DONNÉES');


5\.Sécurité (facultatif) :

Obtenez un certificat SSL. Selon l'hébergeur, vous pouvez le faire gratuitement dans votre tableau de bord ou moyennant des frais.

