Lien vers le site en ligne : https://ent.iarovaia.butmmi.o2switch.site/
Lien vers le site en local, après installation : http://localhost/ENT/login.php 
ATTENTION selon le nom du fichier dans lequel vous stockez le site, il vous faudra modifier l'URL. Ici, le site web est dans un dossier appelé "ENT".


Pour installer ce site sur votre machine, il vous faudra :

1\. Télécharger tous les dossiers sur votre ordinateur.

Vous devrez placer ces fichiers (dossier img et son contenu, dossier document et son contenu, dossier fact_access et son contenu, ainsi que tous les fichiers php, sql et html) dans un dossier que vous nommerez à votre aise. Pour que le site fonctionne, vous devrez l'installer sur un serveur local.
Si vous installez wamp, placez le dossier du site dans wamp64/www. Si vous désirez l'installer sur xampp, il faudra suivre le chemin xampp/htdocs. sur mamp, pour mac, suivez le chemin MAMP/htdocs.

2\. Installer la base de données sur votre ordinateur.

Pour se faire, vous devrez trouver le fichier "bdd_ent.sql". Vous irez ensuite dans votre base de données local : lancez votre serveur, affichez les icones cachées, repérez votre application serveur, cliquez dessus et sélectionnez "phpMyAdmin". Une page s'ouvre sur votre navigateur par défaut, et vous demande de vous identifier. Si vous êtes sur wamp, ou xamp, l'identifiant par défaut est "root", et il n'y a aucun mot de passe. Si vous utilisez Mamp, l'identifiant est "root" et le mot de passe est "root". Ouvrez votre base de données. En haut à droite, appuyez sur "Importer", et sélectionnez le fichier "bdd_ent.sql" cité plus tôt. La base de données est automtiquement
crée.

3\. Modifier les informations de connexion.

Ouvrez le fichier "connexion.php" dans un éditeur de code (visual studio code par exemple) ou un éditeur de texte (l'application bloc note par exemple), et modifiez les informations décrites dans le fichier.
