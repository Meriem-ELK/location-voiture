<?php
namespace App\Controllers;

use App\Models\Reservation;
use App\Models\Client;
use App\Models\Vehicule;
use App\Providers\View;

class ReservationController {

    private $reservationModel;
    private $clientModel;
    private $vehiculeModel;

    // -----------Initialise les modèles 
    public function __construct() {
        $this->reservationModel = new Reservation();
        $this->clientModel = new Client();
        $this->vehiculeModel = new Vehicule();
    }

    // ------------Liste des réservations 
    public function index() {
        $reservations = $this->reservationModel->getReservationsComplete();
        return View::render('reservations/index', [
            'reservations' => $reservations,
            'currentPage' => 'reservations'
        ]);
    }


// ----------Formulaire de création
    public function create() {
        return View::render('reservations/create');
}


//------------- Afficher une réservation
    public function show($data) {
     return View::render('reservations/show');
    }

    
    // // -------------Formulaire de modification
    public function edit($data) {
      return View::render('reservations/edit');
    }


    //--------------- Suppression
    public function delete($data) {
        $id = $data['id'] ?? null;
        
        if (!$id) {
            return $this->renderError('ID réservation manquant!');
        }

        $deleteSuccess = $this->reservationModel->delete($id);
        
        return $deleteSuccess 
            ? View::redirect('reservations')
            : $this->renderError('Erreur lors de la suppression');
    }

    private function renderError($message) {
         return View::render('error', ['message' => $message]);
    }

}