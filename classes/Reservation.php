<?php
require_once 'CRUD.php';

class Reservation {
    private $crud; 
    private $table = "reservations";
    
    // Propriétés
    public $id;
    public $client_id;
    public $vehicule_id;
    public $date_debut;
    public $date_fin;
    public $prix_total;
    public $statut;
    
    // Constructeur : instancie un objet CRUD à l'initialisation de la classe
    public function __construct() {
        $this->crud = new CRUD();
    }
    
    // Méthode pour récupérer toutes les réservations
    public function getAllReservations() {
        return $this->crud->select($this->table, "date_debut", "desc");
    }
    
    // Méthode pour récupérer une réservation par son ID
    public function getReservationById($id) {
        return $this->crud->selectId($this->table, $id);
    }
    
    // Méthode pour ajouter une nouvelle réservation
    public function addReservation($data) {
        return $this->crud->insert($this->table, $data);
    }
    
    // Méthode pour mettre à jour une réservation
    public function updateReservation($data, $id) {
        return $this->crud->update($this->table, $data, $id);
    }
    
    // Méthode pour supprimer une réservation
    public function deleteReservation($id) {
        return $this->crud->delete($this->table, $id);
    }
    
    // Méthode pour récupérer les détails complets d'une réservation (avec infos client et véhicule)
    public function getReservationDetails($id) {
        $sql = "SELECT r.*, c.nom as client_nom, c.prenom as client_prenom, 
                v.marque, v.modele, v.immatriculation, cat.nom as categorie, cat.tarif_journalier
                FROM reservations r
                JOIN clients c ON r.client_id = c.id
                JOIN vehicules v ON r.vehicule_id = v.id
                JOIN categories cat ON v.categorie_id = cat.id
                WHERE r.id = :id";
        
        $stmt = $this->crud->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    // Méthode pour récupérer toutes les réservations avec détails
    public function getAllReservationsWithDetails() {
        $sql = "SELECT r.*, c.nom as client_nom, c.prenom as client_prenom, 
                v.marque, v.modele, v.immatriculation
                FROM reservations r
                JOIN clients c ON r.client_id = c.id
                JOIN vehicules v ON r.vehicule_id = v.id
                ORDER BY r.date_debut DESC";
        
        $stmt = $this->crud->query($sql);
        return $stmt->fetchAll();
    }
    
    // Méthode pour calculer le prix total d'une réservation
    public function calculerPrixTotal($vehicule_id, $date_debut, $date_fin) {
        // Récupérer le tarif journalier du véhicule
        $sql = "SELECT cat.tarif_journalier 
                FROM vehicules v
                JOIN categories cat ON v.categorie_id = cat.id
                WHERE v.id = :vehicule_id";
        
        $stmt = $this->crud->prepare($sql);
        $stmt->bindValue(":vehicule_id", $vehicule_id);
        $stmt->execute();
        $result = $stmt->fetch();
        
        if (!$result) {
            return false;
        }
        
        $tarif_journalier = $result['tarif_journalier'];
        
        // Calculer le nombre de jours
        $debut = new DateTime($date_debut);
        $fin = new DateTime($date_fin);
        $interval = $debut->diff($fin);
        $nb_jours = $interval->days + 1; // +1 car on compte aussi le jour de début
        
        // Calculer le prix total
        return $tarif_journalier * $nb_jours;
    }
    
    // Méthode pour vérifier si un véhicule est disponible pour une période donnée
    public function isVehiculeDisponible($vehicule_id, $date_debut, $date_fin, $reservation_id = null) {
        $sql = "SELECT COUNT(*) as count FROM reservations 
                WHERE vehicule_id = :vehicule_id 
                AND statut != 'annulée' 
                AND ((date_debut BETWEEN :date_debut AND :date_fin) 
                OR (date_fin BETWEEN :date_debut AND :date_fin)
                OR (:date_debut BETWEEN date_debut AND date_fin))";
        
        // Si on modifie une réservation existante, exclure cette réservation de la vérification
        if ($reservation_id) {
            $sql .= " AND id != :reservation_id";
        }
        
        $stmt = $this->crud->prepare($sql);
        $stmt->bindValue(":vehicule_id", $vehicule_id);
        $stmt->bindValue(":date_debut", $date_debut);
        $stmt->bindValue(":date_fin", $date_fin);
        
        if ($reservation_id) {
            $stmt->bindValue(":reservation_id", $reservation_id);
        }
        
        $stmt->execute();
        $result = $stmt->fetch();
        
        return $result['count'] == 0;
    }
    
    // Méthode pour récupérer tous les clients (pour le formulaire)
    public function getAllClients() {
        return $this->crud->select("clients", "nom");
    }
    
    // Méthode pour récupérer tous les véhicules disponibles (pour le formulaire)
    public function getAllVehicules() {
        $sql = "SELECT v.*, c.nom as categorie, c.tarif_journalier 
                FROM vehicules v
                JOIN categories c ON v.categorie_id = c.id
                WHERE v.disponible = TRUE
                ORDER BY v.marque, v.modele";
        
        $stmt = $this->crud->query($sql);
        return $stmt->fetchAll();
    }
}
?>