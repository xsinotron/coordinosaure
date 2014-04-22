<?php
/**
 * constructeur de classe PRODUIT
 */
class Produit {
    public
    $action       = "",
    $legend       = "Informations générales",
    $labelProduit = "Nom du produit",
    $labelContrat = "Contrat",
    $labelPrix    = "Prix unitaire",
    $valuePrix    = "00.00€",
    $prix_unitaire,

    $id,
    $name,
    $contrat_id,
    $submit      = "Il est vraiment bien ce produit!";
    
    public function __construct($data){
      //print_r($data);
        if (isset($data['mode'])) {
            if ($data['mode'] == 'new') {
                $this->action = "raptor.php?insert=produit";
            } else if ($data['mode'] == 'edit'){
                $this->action = "raptor.php?edit=produit";
                $this->submit = "un beau contrat tout neuf";
            } else if ($data['mode'] == 'delete') {
                $this->action = "raptor.php?delete=produit";
                $this->submit = "va-t-en!";
            } else {
                // Par défaut
            }
        }
        if(isset($data['contrats'])) {
            $this->contrats = $data['contrats'];
        }
        for ($i = 1; $i < 13; $i++) $this->nbProd[] = ($i < 10) ? "0".$i : $i;
        
    }
}
?>
