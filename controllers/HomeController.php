<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Reservation;

/**
 * Gère la page d'accueil et les statistiques générales
*/
class HomeController {

    public function index() {
    
        // Création des instances des modèles nécessaires
        $clientModel = new Client();
        $vehiculeModel = new Vehicule();
        $reservationModel = new Reservation();
        
        // Récupération des statistiques pour le tableau de bord
        $stats = [
            'total_clients' => count($clientModel->select()),
            'total_vehicules' => count($vehiculeModel->select()),
            'vehicules_disponibles' => count($vehiculeModel->getVehiculesDisponibles()),
            'total_reservations' => count($reservationModel->select()),
        ];

        // Préparation des données à envoyer à la vue
        $data = [
            'stats' => $stats,
        ];
        
        return View::render('home/index', $data);
    }
}