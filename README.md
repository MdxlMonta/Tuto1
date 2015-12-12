Ce Bundle correspond au Cours 1 sur www.mdxl.xyz/cours/ :   
Symfony 2.7  
### Services et Upload de Fichier    
            

                      
Exemple: Gestion d'utilisateurs possédant un Avatar.   
Mot clefs: Services, EntityListener, Injection de dépendance, Upload, Extension Twig, CRUD
I - Création du Bundle: UserBundle.  

1. Création du Bundle.   
2. Création de l'Entity User.   
3. On rajoute la validation.   
4. Génération du CRUD.   
5. Génération en BD.   

II – Création du Bundle : AvatarUserBundle   

1. Création du  Bundle
2. Création de l'entity AvatarUser.   
3. On clean le bundle.   
4. Modification de l'entity AvatarUser.   
5. Modification de l'entity UserBundle.   
6. Modification de la BD.   

III – Création du service Upload.   


1. Création de l'interface UploadInterface.   
2. Création de la class Upload.   
3. Création du service Upload.   
Paramètre:    
\- Le chemin du dossier des images dans /web.   

IV – Création de l'Entitylistener sur Doctrine : AvatarUserListener.   


1. Création de la class AvatarUserListener.   
2. Création du service AvatarUserListener.   
Paramètres:   
\- Service Upload (qui implémente UploadInterface).      

V - Modification du Controller et des Views.   


1. Modification des Views du UserBundle.   
2. Création de la class pour l'extension Twig.   
3. Création de l'extension Twig (Paramètre : Une image).   
4. Adaptation des Views à l'extension Twig.   
5. Modification de UserType.   
				
VI – Modification de l'emplacement des paramètres nécessaires.   


1. On déplace les paramètres.   
2. Modification de DepencyInjection/Configuration.php.   
3. Modification de DepencyInjection/TutoAvatarUserExtension.php   


