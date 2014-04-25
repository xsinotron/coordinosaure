<?php
class MainMenu {
    public
    $nav     = array(
        array(
            "link"  => 'index.php',
            "title" => 'Accédez à l\'accueil de coordinosaure',
            "text"  => 'Accueil'
        ),
        array(
            "link"  => '?go=amapiens',
            "title" => 'Accédez à la liste des amapiens',
            "text"  => 'Amapiens',
            "isDropdown" => TRUE,
            "dropdown" => array(
                array(
                    "class"  => "new",
                    "action" => "raptor.php?amapien=new",
                    "modal"  => "#mainModal",
                    "id"     => "add-new-amapien-button",
                    "title"  => 'Créer un nouvel amapien',
                    "text"   => 'Ajouter un amapien'
                )
            )
        ),
        array(
            "link"     => '?go=contrats',
            "title"    => 'Accédez à la liste des contrats',
            "text"     => 'Contrats',
            "isDropdown" => TRUE,
            "dropdown" => array(
                array(
                    "class" => "new",
                    "action" => "raptor.php?contrat_type=new",
                    "modal"  => "#mainModal",
                    "id" => "add-new-contrat-button",
                    "title" => 'Ajouter un nouveau contrat à l\'amap.',
                    "text"  => 'Ajouter un contrat'
                )
            )
        ),
        array(
            "link"  => '?go=producteurs',
            "title" => 'Accédez à la liste des producteurs',
            "text"  => 'Producteurs',
            "isDropdown" => TRUE,
            "dropdown" => array(
                array(
                    "class"  => "new",
                    "action" => "raptor.php?producteur=new",
                    "modal"  => "#mainModal",
                    "id"     => "add-new-producteur-button",
                    "title"  => 'Créer un nouveau producteur',
                    "text"   => 'Ajouter un producteur'
                )
            )
        ),
        array(
            "link"  => '?go=produits',
            "title" => 'Accédez à la liste des produits',
            "text"  => 'Produits',
            "isDropdown" => TRUE,
            "dropdown" => array(
                array(
                    "class"  => "new",
                    "action" => "raptor.php?produit_type=new",
                    "modal"  => "#mainModal",
                    "id"     => "add-new-produit-button",
                    "title"  => 'Créer un nouveau produit',
                    "text"   => 'Ajouter un produit'
                )
            )
        )
    ),
    $actions = array(
        array(
            "class"  => "new",
            "action" => "#",
            "id"     => "add-new-producteur-button",
            "title"  => 'Ajouter un nouvel producteur à l\'amap',
            "text"   => 'Ajouter un producteur'
        ),
        array(
            "class"  => "new",
            "action" => "#",
            "id"     => "add-new-amapien-button",
            "title"  => 'Créer un nouvel amapien',
            "text"   => '+ amapien'
        ),
        array(
            "class" => "new",
            "action" => "#",
            "id" => "add-new-contrat-button",
            "title" => 'Ajouter un nouveau contrat à l\'amap.',
            "text"  => '+ contrat'
        ),
        array(
            "class" => "new",
            "action" => "#",
            "id" => "add-new-produit-button",
            "title" => 'Ajouter un nouveau produit à l\'amap.',
            "text"  => '+ produit'
        ),
        array(
            "class" => "new",
            "action" => "#",
            "id" => "print-contract-button",
            "title" => 'Imprimer un contrat, à position en fonction du contexte',
            "text"  => 'Imprimer un contrat'
        )
    );
    function __construct ($page) {
        $this->current = $page;
        if ($this->current == 'index')       $this->nav[0]['active'] = TRUE;
        if ($this->current == 'amapiens')    $this->nav[1]['active'] = TRUE;
        if ($this->current == 'contrats')    $this->nav[2]['active'] = TRUE;
        if ($this->current == 'producteurs') $this->nav[3]['active'] = TRUE;
        if ($this->current == 'produits')    $this->nav[4]['active'] = TRUE;
    }
}
?>
