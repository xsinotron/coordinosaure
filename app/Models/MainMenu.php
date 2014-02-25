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
            "text"  => 'Amapiens'
        ),
        array(
            "link"  => '?go=contrats',
            "title" => 'Accédez à la liste des contrats',
            "text"  => 'Contrats'
        ),
        array(
            "link"  => '?go=producteurs',
            "title" => 'Accédez à la liste des producteurs',
            "text"  => 'Producteurs'
        )
    ),
    $actions = array(
        array(
            "class"  => "new",
            "action" => "#",
            "id"     => "add-new-producteur-button",
            "title"  => 'Ajouter un nouvel producteur à l\'amap',
            "text"   => '+ producteur'
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
    function __construct () {
        $this->current = $_SESSION['currentPage'];
        if ($this->current === 'index')       $this->nav[0]['selected'] = 'selected';
        if ($this->current === 'amapiens')    $this->nav[1]['selected'] = 'selected';
        if ($this->current === 'contrats')    $this->nav[2]['selected'] = 'selected';
        if ($this->current === 'producteurs') $this->nav[3]['selected'] = 'selected';
    }
}
?>
