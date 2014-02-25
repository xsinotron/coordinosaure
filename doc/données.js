var data = {
    recurrence: {
        id: 0,                // ID num auto-increment
        name: 'hebdo'        // Intitulé
        quantite: 52         // namebre par an
    },
    // permet de catégoriser les produits
    contrats: {
        id: 0,                // ID num auto-increment
        name: '',            // intitulé du contrat
    },
    // Définie le producteur d'un contrat
    producteur: {
        id: 0,                // ID num auto-increment
        name: '',
        surname: '',
        address: '',
        email: '',
        phone: '',
        produits: ',,',        // Liste de ses produits
    },
    // élément de base
    produit: {
        id: 0,                // ID num auto-increment
        name: '',            // Initulé du produit
        prix: '',            // Prix du produit
        idContrat: 0,        // ID du contrat auxquel il est lié
        début: 01/01/1900,    // Date de début de contrat
        fin: 01/01/1900,    // Date de fin de contrat
        distribs: 0,        // namebre de distributions dans l'année
        recurrence: 0,        // 0: hebdo, 1: bimensuel, 2: mensuel, 3: bimestriel, 4: trimestriel
        arret: 0            // namebre de semaines d'arret
    },
    amapien: {
        id: 0,                // ID num auto-increment
        name: '',
        surname: '',
        email_1: '',
        email_2: '',
        email_3: '',
        phone: '',
        address: '',
        date_arrived: '',    // Date d'arrivée dans l'AMAP
        a_jour: TRUE        // état de l'amapien
        details: ''            // infos pour le coordinateur.
    }
}
