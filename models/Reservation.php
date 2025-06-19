<?php
namespace App\Models;
use App\Models\CRUD;

/**
 * Modèle Reservation
 */
class Reservation extends CRUD {
    
    protected $table = "reservations";
    protected $primaryKey = "id";
    protected $fillable = [
        'client_id', 
        'vehicule_id', 
        'date_debut', 
        'date_fin', 
        'prix_total', 
        'statut'
    ];

/**
    * Obtient toutes les réservations avec les détails client et véhicule
*/
    public function getReservationsComplete() {
        $sql = "SELECT r.*, 
                       CONCAT(c.nom, ' ', c.prenom) as client_nom,
                       c.email as client_email,
                       CONCAT(v.marque, ' ', v.modele) as vehicule_nom,
                       v.immatriculation,
                       cat.nom as categorie_nom
                FROM $this->table r
                JOIN clients c ON r.client_id = c.id
                JOIN vehicules v ON r.vehicule_id = v.id
                LEFT JOIN categories cat ON v.categorie_id = cat.id
                ORDER BY r.date_debut DESC";
        
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
}