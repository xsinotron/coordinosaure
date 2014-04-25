<?php
require 'config.php';
class Core {
    private
    $sqlUser  = 'adminosaure',
    $sqlPass  = 'admin',
    $sqlDir   = 'localhost',
    $database = 'amaposaure',
    $model;
    /**
     * Initialisation de l'objet de connexion à la base de donnée.
     */
    public function init() {
            $this->model = new Modele($this->sqlUser, $this->sqlPass, $this->sqlDir, $this->database);
    }
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
///////////////////// LISTES
///////////
    public function getList($list) {
        $content;
        switch ($list) {
            case 'amapiens':
                $liste = $this->model->getAmapiens();
                $content = $this->model->gen(
                    'app/Views/tables/amapiens.html',
                    new Amapiens($liste)
                );
                break;
            case 'producteurs':
                $liste = $this->model->getProducteurs();
                $content = $this->model->gen(
                    'app/Views/tables/producteurs.html',
                    new Producteurs($liste)
                );
                break;
            case 'produits_type':
            case 'produits':
                $liste = $this->model->getProduitsType();
                print_r($liste);
                $content = $this->model->gen(
                    'app/Views/tables/produits.html',
                    new Produits($liste)
                );
                break;
            case 'contrats':
                $liste = $this->model->getContrats();
                $content = $this->model->gen(
                    'app/Views/tables/contrats.html',
                    new Contrats($liste)
                );
                break;
            default:
                $content = "";
        }
        return $content;
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
            case 'produit_type':
                if ($params['method'] == 'delete') {
                    $data = $this->model->deleteProduitType($params['for']);
                } else if ($params['method'] == 'edit') {
                    $data = $this->model->editProduitType($params['for'], $params['data']);
                } else if ($params['method'] == 'insert') {
                    $data = $this->model->insertProduitType($params['data']);
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
            $types = $req['insert'];
            unset($req["insert"]);
            $req['data'] = $req;
            $infos = $this->getReq(array(
                'method' => 'insert',
                'types'  => $types,
                'data'   => $req['data']
            ));
            echo $infos;
        }
    }
    public function get($what, $who=-1) {
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
     * @return le contenu de la page courante.
     */
    public function page() {
        $curr   = $_SESSION['currentPage'];
        $head   = ($_SESSION['debug'] == TRUE) ?
        array(
            "appTitle"  => "Test",
            "pageTitle" => $curr,
            "debug"     => $_SESSION['debug']
        ) :
        array(
            "appTitle"  => "COORDINOSAURE",
            "pageTitle" => $curr,
            "debug"     => $_SESSION['debug']
        );
        $header = ($_SESSION['debug'] == TRUE) ?
        array(
            "currentPage"    => $curr,
            "appTitle"       => "Test",
            "appVersion"     => "0.2",
            "appDescription" => "Bienvenue sur le site d'administration."
        ) :
        array(
            "currentPage"    => $curr,
            "appTitle"       => "COORDINOSAURE",
            "appVersion"     => "0.2",
            "appDescription" => "Bienvenue sur le site d'administration de l'AMAP Bordeaux Centre."
        );
        $data = array(
            "currentPage"  => $curr,
            "head"         => $this->model->gen('app/Views/head.html', $head),
            "header"       => $this->model->gen('app/Views/header.html', $header),
            "mainMenu"     => $this->mainMenu(),
            "liste"        => $this->getList($curr),
            "amapiensList" => (isset($this->model)) ? json_encode( $this->model->getAmapiens() ) : '"", token=' . json_encode($_SESSION),
            "scripts"      => file_get_contents('app/Views/scripts.html')
        );
        $page = $this->model->gen('app/Views/base.html', $data);
        return $page;
    }
    /**
     * @param {string} $mode : Type de formulaire à ouvrir
     * TODO Ajouter le param edit
     * @return le contenu du formulaire demandé.
     */
    public function popin ($mode, $req) {
        print_r(array($mode, $req));
        $data = array('mode' => $req[$mode]);
        if ($req[$mode] == "edit" || $req[$mode] == "delete") $data['content'] = $this->get($mode, $req['for']);
        switch ($mode) {
            case 'producteur':
                $form = $this->model->gen(
                    'app/Views/forms/producteur.html',
                    new Producteur($data)
                );
                $title = 'Producteur : Nouveau';
                break;
            case 'contrat':
                $form = $this->model->gen(
                'app/Views/forms/contrat.html',
                new Contrat(
                array(
                "mode"     => $req,
                "producteurs" => $this->model->getProducteurs()
                )
                )
                );
                $title = 'Contrat : Nouveau contrat amapien';
                break;
            case 'contrat_type':
                $form = $this->model->gen(
                    'app/Views/forms/contrat_type.html',
                    new ContratType($data)
                );
                $title = 'Contrat : Nouveau type';
                break;
            case 'produit':
                $form = $this->model->gen(
                    'app/Views/forms/produit.html',
                    new Produit(
                        array(
                            "mode"     => $req,
                            "contrats" => $this->model->getContrats()
                        )
                    )
                );
                $title = 'Produit : Nouveau';
                break;
            case 'produit_type':
                $form = $this->model->gen(
                    'app/Views/forms/produit_type.html',
                    new ProduitType(
                        array(
                            "mode"     => $req[$mode],
                            "contrats" => $this->model->getContratsTypes()
                        )
                    )
                );
                $title = 'Produit : Nouveau type';
                break;
            case 'amapien':
            default:
                $form = $this->model->gen(
                    'app/Views/forms/amapien.html',
                    new Amapien($data)
                );
                $title = 'Amapien : Nouveau';
                break;
        }
        return $popin = $this->model->gen(
                'app/Views/popin.html',
                new Popin(array(
                        'title'   => $title,
                        'mode'    => $req[$mode],
                        'content' => $form
                ))
        );
    }
    /**
     * Récupération du menu principal
     */
    public function mainMenu ($page="") {
        if ($page == "") $page = $_SESSION['currentPage'];
        return $this->model->gen("app/Views/mainMenu.html", new MainMenu($page));
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
            if (isset($this->model)) {
                $currentSession = $this->model->getSession();
                if ($_SESSION['token'] != $currentSession) init();
            }
            else {
                $this->init();
            }
        } else {
            $this->init();
        }
    }
}
?>
