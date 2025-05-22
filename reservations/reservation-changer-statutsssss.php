<?php
// Inclure la classe Reservation
require_once('../classes/Reservation.php');

// Créer une instance de Reservation
$reservationObj = new Reservation();

// Vérifier si les paramètres nécessaires sont présents
if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['statut']) && !empty($_GET['statut'])) {
    $id = $_GET['id'];
    $statut = $_GET['statut'];
    
    // Vérifier que le statut est valide
    $statuts_valides = ['en attente', 'confirmee', 'annulee', 'terminee'];
    if (!in_array($statut, $statuts_valides)) {
        // Rediriger si le statut n'est pas valide
        header('Location: reservation-details.php?id=' . $id);
        exit;
    }
    
    // Récupérer la réservation pour vérifier qu'elle existe
    $reservation = $reservationObj->getReservationById($id);
    if (!$reservation) {
        // Rediriger si la réservation n'existe pas
        header('Location: ../reservations.php');
        exit;
    }
    
    // Mettre à jour le statut de la réservation
    $data = ['statut' => $statut];
    if ($reservationObj->updateReservation($data, $id)) {
        // Rediriger vers la page de détails avec un message de succès
        header('Location: reservation-details.php?id=' . $id . '&success=1');
        exit;
    } else {
        // Rediriger vers la page de détails avec un message d'erreur
        header('Location: reservation-details.php?id=' . $id . '&error=1');
        exit;
    }
} else {
    // Rediriger si les paramètres nécessaires ne sont pas présents
    header('Location: ../reservations.php');
    exit;
}
?>