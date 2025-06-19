<?php
namespace App\Controllers;

use App\Models\Client;
use App\Providers\View;
use App\Providers\Validator;

class ClientController {

    private $clientModel;

    // -----------Initialise les modèles    
    public function __construct() {
        $this->clientModel = new Client();
    }

    // -----------Liste des clients
    public function index() {
        $clients = $this->clientModel->getClients();
        return View::render('client/index', [
        'clients' => $clients,
        'currentPage' => 'clients'
    ]);
    }

    // ----------- Afficher un client  
    public function show($data) {
        $client = $this->getClientById($data['id'] ?? null);
        
        if (!$client) {
            return $this->renderError('Client non trouvé!');
        }

        return View::render('client/show', ['client' => $client]);
    }

    // ----------- Formulaire d’ajout de client 
    public function create() {
        return View::render('client/create');
    }

    // -----------  Enregistrement d’un nouveau client
    public function store($data) {
        $validator = $this->validateClientData($data);

        if($validator->isSuccess()) {
            $data['date_inscription'] = date('Y-m-d');
            $clientId = $this->clientModel->insert($data);

            return $clientId ? View::redirect('client/show?id=' . $clientId) : $this->renderError('Erreur lors de la création du client');
        }

        return $this->renderFormWithErrors('client/create', $validator->getErrors(), $data);
    }

    // -----------  Modifier un client
    public function edit($data) {
        $client = $this->getClientById($data['id'] ?? null);
        
        if (!$client) {
            return $this->renderError('Client non trouvé!');
        }

        return View::render('client/edit', ['client' => $client,]);
    }

    // -----------  Mise à jour des données client
    public function update($data, $get = null) {
        $get = $get ?? $_GET;
        $id = $get['id'] ?? null;
        
        if (!$id) {
            return $this->renderError('ID client manquant!');
        }

        $validator = $this->validateClientData($data, $id);

        if($validator->isSuccess()) {
            $updateSuccess = $this->clientModel->update($data, $id);
            
            return $updateSuccess 
                ? View::redirect('client/show?id=' . $id)
                : $this->renderError('Erreur lors de la mise à jour');
        }

        $client = $this->clientModel->selectId($id);
        return $this->renderFormWithErrors('client/edit', $validator->getErrors(), array_merge($client, $data));

    }

    //------------- Suppression d’un client
    public function delete($data) {
        $id = $data['id'] ?? null;
        
        if (!$id) {
            return $this->renderError('ID client manquant!');
        }

        $deleteSuccess = $this->clientModel->delete($id);
        
        return $deleteSuccess 
            ? View::redirect('clients')
            : $this->renderError('Erreur lors de la suppression');
    }

    //---------------- Validation des données client
    private function validateClientData($data, $id = null) {
        $validator = new Validator();
        
        $validator->field('nom', $data['nom'] ?? '')->required()->min(2)->max(50);
        $validator->field('prenom', $data['prenom'] ?? '')->required()->min(2)->max(50);
        $validator->field('adresse', $data['adresse'] ?? '')->max(255);
        $validator->field('email', $data['email'] ?? '')->required()->max(100);
        $validator->field('telephone', $data['telephone'] ?? '')->required()->max(20);
        $validator->field('permis_conduire', $data['permis_conduire'] ?? '', 'permis de conduire')->required()->max(20);
        return $validator;
    }

    // ------- récupère un client par son ID
    private function getClientById($id) {
        if (!$id) return null;
        return $this->clientModel->selectId($id);
    }

    //--------- affiche une vue d’erreur avec un message
    private function renderError($message) {
        return View::render('error', ['message' => $message]);
    }

    // --- réaffiche un formulaire avec les erreurs
    private function renderFormWithErrors($view, $errors, $client) {
        return View::render($view, [
            'errors' => $errors,
            'client' => $client,
        ]);
    }
}