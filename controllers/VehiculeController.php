<?php
namespace App\Controllers;

use App\Models\Vehicule;
use App\Models\Categorie;
use App\Providers\View;
use App\Providers\Validator;

class VehiculeController {

    private $vehiculeModel;
    private $categorieModel;

    // -----------Initialise les modèles 
    public function __construct() {
        $this->vehiculeModel = new Vehicule();
        $this->categorieModel = new Categorie();
    }

    // ------------Liste des véhicules 
    public function index() {
        $vehicules = $this->vehiculeModel->getVehiculesWithCategorie();
        return View::render('vehicule/index',[
        'vehicules' => $vehicules,
        'currentPage' => 'vehicules'
        ]) ;
    }

    //------------- Afficher un véhicule
    public function show($data) {
        $vehicule = $this->getVehiculeById($data['id'] ?? null);
        
        if (!$vehicule) {
            return $this->renderError('Véhicule non trouvé!');
        }

        return View::render('vehicule/show', ['vehicule' => $vehicule]);
    }

    // ----------Formulaire de création
    public function create() {
        //Récupère la liste des catégories pour select dans le formulaire.
        $categories = $this->categorieModel->getForSelect();
        
        return View::render('vehicule/create', ['categories' => $categories,]);
    }

    //-----------Enregistrement du véhicule
    public function store($data) {
        $validator = $this->validateVehiculeData($data);

        if($validator->isSuccess()) {
            $data['disponible'] = 1;
            $vehiculeId = $this->vehiculeModel->insert($data);

            return $vehiculeId ? View::redirect('vehicule/show?id=' . $vehiculeId): $this->renderError('Erreur lors de la création du véhicule');
        }

        return $this->renderFormWithErrors('vehicule/create', $validator->getErrors(), $data, 'Nouveau Véhicule');
    }

    // -------------Formulaire de modification
    public function edit($data) {
        $vehicule = $this->getVehiculeByIdForEdit($data['id'] ?? null);
        
        if (!$vehicule) {
            return $this->renderError('Véhicule non trouvé!');
        }

        $categories = $this->categorieModel->getForSelect();
        
        return View::render('vehicule/edit', ['vehicule' => $vehicule, 'categories' => $categories]);
    }

    //------------ Mise à jour 
    public function update($data, $get = null) {
        $get = $get ?? $_GET;
        $id = $get['id'] ?? null;
        
        if (!$id) {
            return $this->renderError('ID véhicule manquant!');
        }

        $validator = $this->validateVehiculeData($data, true);

        if($validator->isSuccess()) {
            $data['disponible'] = isset($data['disponible']) ? 1 : 0;
            $updateSuccess = $this->vehiculeModel->update($data, $id);
            
            return $updateSuccess 
                ? View::redirect('vehicule/show?id=' . $id)
                : $this->renderError('Erreur lors de la mise à jour');
        }

        $vehicule = $this->vehiculeModel->selectId($id);
        return $this->renderFormWithErrors('vehicule/edit', $validator->getErrors(), array_merge($vehicule, $data), 'Modifier Véhicule');
    }

    //--------------- Suppression
    public function delete($data) {
        $id = $data['id'] ?? null;
        
        if (!$id) {
            return $this->renderError('ID véhicule manquant!');
        }

        $deleteSuccess = $this->vehiculeModel->delete($id);
        
        return $deleteSuccess 
            ? View::redirect('vehicules')
            : $this->renderError('Erreur lors de la suppression');
    }

    // Logique de validation
    private function validateVehiculeData($data, $isUpdate = false) {
        $validator = new Validator();
        
        $validator->field('marque', $data['marque'] ?? '')->required()->min(2)->max(50);
        $validator->field('modele', $data['modele'] ?? '')->required()->min(2)->max(50);
        $validator->field('annee', $data['annee'] ?? '')->required()->numeric()->positive();
        $validator->field('immatriculation', $data['immatriculation'] ?? '')->required()->max(20);
        $validator->field('couleur', $data['couleur'] ?? '')->max(30);
        $validator->field('kilometrage', $data['kilometrage'] ?? '')->required()->numeric()->positive();
        $validator->field('categorie_id', $data['categorie_id'] ?? '', 'catégorie')->required()->numeric();

        // Validation personnalisée pour l'année
        if(isset($data['annee'])) {
            $currentYear = date('Y');
            if($data['annee'] < 1900 || $data['annee'] > ($currentYear + 1)) {
                $validator->addError('annee', 'Année invalide');
            }
        }

        return $validator;
    }

    private function getVehiculeById($id) {
        if (!$id) return null;
        return $this->vehiculeModel->getVehiculeWithCategorieById($id);
    }

    private function getVehiculeByIdForEdit($id) {
        if (!$id) return null;
        return $this->vehiculeModel->selectId($id);
    }

    private function renderError($message) {
        return View::render('error', ['message' => $message]);
    }

    private function renderFormWithErrors($view, $errors, $vehicule, $title) {
        $categories = $this->categorieModel->getForSelect();
        
        return View::render($view, [
            'errors' => $errors,
            'vehicule' => $vehicule,
            'categories' => $categories,
        ]);
    }
}