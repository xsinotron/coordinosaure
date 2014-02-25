<?php
class Main {
    private
    $sqlUser  = 'adminosaure',
    $sqlPass  = 'admin',
    $sqlDir   = 'localhost',
    $database = 'amaposaure',
    $model;
    public function init() {
            $this->model = new Modele($this->sqlUser, $this->sqlPass, $this->sqlDir, $this->database);
            $_SESSION['debug'] = TRUE;
    }
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
///////////////////// LISTES
///////////
    public function getList($list) {
        switch ($list) {
            case 'amapiens':
                $liste = $this->model->getAmapiens();
                echo $this->model->gen(
                    'app/Views/tables/amapiens.tpl',
                    new Amapiens($liste)
                );
                break;
            case 'producteurs':
                $liste = $this->model->getProducteurs();
                echo $this->model->gen(
                    'app/Views/tables/producteurs.tpl',
                    new Producteurs($liste)
                );
                break;
            case 'produits':
                
                break;
            case 'contrats':
                $liste = $this->model->getContrats();
                echo $this->model->gen(
                    'app/Views/tables/contrats.tpl',
                    new Contrats($liste)
                );
                break;
                
        }
    }
    /**
     * @param {array} $params : array(types, method, for, data)
     * types : la table à mettre à jour.
     * method : l'action : delete, edit, insert.
     * for : liste des champs à éditer
     * data : données correspondantes
     * @return Données de la requête.
     */
    private
    function getReq ($params) {
        //print_r($params);
        switch ($params['types']) {
            case 'contrat':
                if ($params['method'] == 'delete') {
                    $data = $this->model->deleteContrat($params['for']);
                } else if ($params['method'] == 'edit') {
                    $data = $this->model->editContrat($params['for'], $params['data']);
                } else if ($params['method'] == 'insert') {
                    $data = $this->model->insertContrat($params['data']);
                }
                break;
            case 'contrat_type':
                if ($params['method'] == 'delete') {
                    $data = $this->model->deleteContratType($params['for']);
                } else if ($params['method'] == 'edit') {
                    $data = $this->model->editContratType($params['for'], $params['data']);
                } else if ($params['method'] == 'insert') {
                    $data = $this->model->insertContratType($params['data']);
                }
                break;
            case 'produit':
                if ($params['method'] == 'delete') {
                    $data = $this->model->deleteProduit($params['for']);
                } else if ($params['method'] == 'edit') {
                    $data = $this->model->editProduit($params['for'], $params['data']);
                } else if ($params['method'] == 'insert') {
                    $data = $this->model->insertProduit($params['data']);
                }
                break;
            case 'amapien':
                if ($params['method'] == 'delete') {
                    $data = $this->model->deleteAmapien($params['for']);
                } else if ($params['method'] == 'edit') {
                    $data = $this->model->editAmapien($params['for'], $params['data']);
                } else if ($params['method'] == 'insert') {
                    $data = $this->model->insertAmapien($params['data']);
                }
                break;
            case 'producteur':
                if ($params['method'] == 'delete') {
                    $data = $this->model->deleteProducteur($params['for']);
                } else if ($params['method'] == 'edit') {
                    $data = $this->model->editProducteur($params['for'], $params['data']);
                } else if ($params['method'] == 'insert') {
                    $data = $this->model->insertProducteur($params['data']);
                }
                break;
            
            default:
                $data = "pas de types";
                break;
        }
        if (gettype($data) == 'boolean' && $data == TRUE) echo 'TRUE';
        if (gettype($data) == 'boolean' && $data == FALSE) echo 'FALSE';
        return $data;
    }
    public
    function install () {
        $this->model->install();
    }
    public
    function destroy () {
        $this->model->delete();
    }
    public
    function action($req) {
        // PAS DE PARAMS
        if (!isset($req['data']) && (isset($req['edit']) || isset($req['insert']))) {
            echo json_encode(array(
                'success' => false,
                'message' => 'Pas de paramètre.'
            ));
        }
        // PAS D'ID
        if (!isset($req['for']) && (isset($req['edit']) || isset($req['delete']))) {
            echo json_encode(array(
                'success' => false,
                'message' => "Pas d'identifiant."
            ));
        }
        // EDIT
        if (isset($req['edit'])) {
            
            $infos = $this->getReq(array(
                'method' => 'edit',
                'types'  => $req['edit'],
                'for'    => $req['for'],
                'data'   => $req['data']
            ));
        // DELETE
        } else if (isset($req['delete'])) {
            $infos = $this->getReq(array(
                'method' => 'delete',
                'types'  => $req['delete'],
                'for'    => $req['for']
            ));
        // INSERT
        } else if (isset($req['insert'])) {
            $infos = $this->getReq(array(
                'method' => 'insert',
                'types'  => $req['insert'],
                'data'   => $req['data']
            ));
            echo $infos;
        }
    }
    public
    function get($what, $who=-1) {
        if        ($what == 'contrats') {
            $infos = $this->model->getContrats();
        } else if ($what == 'contrat') {
            $infos = $this->model->getContrat($who);
        } else if ($what == 'contrats_type') {
            $infos = $this->model->getContratsType();
        } else if ($what == 'contrat_type') {
            $infos = $this->model->getContratType($who);
        } else if ($what == 'amapiens') {
            $infos = $this->model->getAmapiens();
        } else if ($what == 'amapien') {
            $infos = $this->model->getAmapien($who);
        } else if ($what == 'produits') {
            $infos = $this->model->getProduits();
        } else if ($what == 'produit') {
            $infos = $this->model->getProduit($who);
        } else if ($what == 'producteurs') {
            $infos = $this->model->getProducteurs();
        } else if ($what == 'producteur') {
            $infos = $this->model->getProducteur($who);
        }
        return $infos;
    }
    /**
     * @param {string} $mode : Type de formulaire à ouvrir
     * TODO Ajouter le param edit
     * @return le contenu du formulaire demandé.
     */
    public
    function popin ($mode, $req) {
        $data = array('mode' => $req[$mode]);
        if ($req[$mode] == "edit" || $req[$mode] == "delete") $data['content'] = $this->get($mode, $req['for']);
        switch ($mode) {
            case 'producteur':
                $form = $this->model->gen(
                'app/Views/forms/producteur.tpl',
                new Producteur(
                array("mode" => $req)
                )
                );
                $title = 'Nouveau producteur';
                break;
            case 'contrat':
                $form = $this->model->gen(
                'app/Views/forms/contrat.tpl',
                new Contrat(
                array(
                "mode"     => $req,
                "producteurs" => $this->model->getProducteurs()
                )
                )
                );
                $title = 'Nouveau contrat';
                break;
            case 'contrat_type':
                $form = $this->model->gen(
                'app/Views/forms/contrat_type.tpl',
                new ContratType(
                array(
                "mode"     => $req,
                "producteurs" => $this->model->getProducteurs()
                )
                )
                );
                $title = 'Nouveau contrat';
                break;
            case 'produit':
                $form = $this->model->gen(
                'app/Views/forms/produit.tpl',
                new Produit(
                array(
                "mode"     => $req,
                "contrats" => $this->model->getContrats()
                )
                )
                );
                $title = 'Nouveau produit';
                break;
            case 'amapien':
            default:
                $form = $this->model->gen(
                'app/Views/forms/amapien.tpl',
                new Amapien($data)
                );
                $title = 'Nouvel Amapien';
                break;
        }
        return $popin = $this->model->gen(
                'app/Views/popin.tpl',
                new Popin(array(
                        'title'   => $title,
                        'content' => $form
                ))
        );
    }
    public function mainMenu ($page) {
        return $this->model->gen("app/Views/mainMenu.tpl", new MainMenu($page));
    }
    function __construct () {
        if (
            isset($_SESSION)
            && (
            isset($_SESSION['token']) &&
            isset($this->model)
            ) || (
            isset($_SESSION['debug']) &&
            $_SESSION['debug'] == FALSE
            )
            ) {
          //print_r($_SESSION['modele']);
            $currentSession = $this->model->getSession();
            if ($_SESSION['token'] != $currentSession) init();
        } else {
            $this->init();
        }
    }
}
?>
