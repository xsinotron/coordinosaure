# -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
# Description des contenus de COORDINOZAURE
# -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-

A FAIRE :
finir la mise en place des formulaires de creation :
    Finir l'ajout des paramètres en JS à envoyer dans les requetes à la BDD.
créer les listes producteurs, contrats, produits 
Ajouter la méthode édition 
Ajouter la méthode dupliquer
Ajouter la méthode supprimer

# Version courante :
Contenus des pages :
Amapiens:
liste des amapiens,
-> listes des contrats pris -> listes des produits pris
-> listes des paiements
Producteurs: liste des producteurs

Contrats: liste des contrats possibles

Produits: liste des produits possibles












# AMAPIEN:
INSERT INTO `amaposaure`.`amapiens` (`id`, `name`, `surname`, `address`, `zipcode`, `city`, `email1`, `email2`, `email3`, `phone`, `arrived`, `updated`, `active`, `infos`) VALUES (NULL, 'Alexis', 'Collin', '11, avenue Lucien Lerousseau', '33130', 'Bègles', 'alecollin@gmail.com', 'fanny.crapart@gmail.com', NULL, '0650340917', '2013-05-01', '1', '1', 'N''a pas reçu son contrat légumes');
PRODUCTEUR:
INSERT INTO `amaposaure`.`producteurs` (`id`, `name`, `surname`, `email`, `address`, `zipcode`, `city`, `phone`, `infos`) VALUES (NULL, 'Laville', 'Philippe', 'philouch@coquin.org', 'rue du champs', '33456', 'Eyzine', '0123456789', NULL);
CONTRATS_TYPE:
INSERT INTO `amaposaure`.`contrats_type` (`id`, `name`, `producteur_id`, `debut`, `fin`) VALUES (NULL, 'Légumes', '1', '2013-05-23', '2014-05-01');
API Google des jours fériés :
https://developers.google.com/gdata/docs/json?hl=fr
http://www.google.com/calendar/feeds/fr.french%23holiday@group.v.calendar.google.com/public/full?alt=json

ACCUEIL
    Tableau rÉcapitulatif des amapiens (faire un tableau triable)
        name,
        PrÉname,
        Contrats (LOPVF),
        updated,
        DÉtails,
        Modifier (ACTION).http://cinemur.fr/film/you-re-next-227035
    Tableau des contrats en cours (trier par type de contrat) :
        Type de produit,
        Date de dÉbut,
        Date de fin,
        namebre de distributions,
        Distributions restantes,
        Modifier (ACTION).
        
NAVIGATION
    Accueil
    Ajouter un amapien
    CrÉer un nouveau contrat
    TÉlÉcharger un contrat (TODO Édition des contrats)

DONNÉES
    CONTRATTYPE
        Id,
        name
        PRODUCTEURS
        Id,
        Id Contrat,
        name,
        address,
        phone,
        Fax,
        Mobile,
        email.
    RÉFÉRENTS
        Id,
        Id contrat,
        Id Amapien.
    PRODUIT
        Id,
        Id Contrat,
        name,
        Prix unitaire,
        namebre de distributions,
        Date de dÉbut,
        Date de fin.
    AMAPIEN
        Id,
        name,
        PrÉname,
        address,
        phone,
        Date d'arrivÉe,
        email_1,
        email_2,
        email_3.
    CONTRATSIGNE
        Id,
        Id Amapien,
        Id produit,
        Mode de paiement,
        namebre de paiements,
        Date dÉbut,
        Date de fin.
    PAIEMENTS
        Id,
        Id ContratSignÉ,
        paiement_1, ..., paiement_24

CONTENUS
Formulaires :
Ajouter Amapien :
    CoordonnÉes : name, prÉname, email(3 max), address, phone, date d'arrivÉe.
    + Contrat : Type, produit, namebre de paiements + dÉtails des paiements, updated, infos, signÉ.
Ajouter Contrat :
    name.
    + Produit : name, Prix unitaire, namebre de distributions, Date de dÉbut, date de fin.
Modifier un amapien :
    name, prÉname, email(3 max), address, phone, date d'arrivÉe.
    Supprimer l'amapien.
Modifier un contrat : 
    name.
    + Produit : name, Prix unitaire, namebre de distributions, Date de dÉbut, date de fin.
    Ajouter un produit
    Supprimer un produit
    Supprimer le contrat.
    
Mise en place d'un backup
"mysql" PossibilitÉ de faire une sauvegarde fichier dans un dossier rÉguliÉrement :
http://atranchant.developpez.com/mysql/evenement/#L240
mysql>DELIMITER |
CREATE EVENT EXEMPLE_RESTORE
    ON SCHEDULE AT CURRENT_DATE + INTERVAL 1 DAY + INTERVAL 5 HOUR
    DO BEGIN
        DROP TABLE ARTICLE.DECLENCHEUR;
        RESTORE TABLE ARTICLE.DECLENCHEUR FROM 'sauvegarde/';
    END |
Query OK, 1 row affected, 1 warning (0.00 sec)
DELIMITER ;

"crontab" permet de lancer un script shell É la rÉcurrence choisit.
http://www.siteduzero.com/tutoriel-3-156090-la-sauvegarde-sous-gnu-linux.html#ss_part_3
