<?php
require_once('CRUD.php');

class Vehicule {
    private $crud;

    // Constructeur: initialise la connexion à la base de données
    public function __construct() {
        $this->crud = new CRUD();

    }

    // Récupérer tous les véhicules avec les noms de catégories
    public function getAllVehicules() {
        $sql = "SELECT v.*, c.nom AS nom_categorie 
                FROM vehicules v 
                LEFT JOIN categories c ON v.categorie_id = c.id 
                ORDER BY v.marque, v.modele";
        $stmt = $this->crud->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupérer un véhicule par son ID
    public function getVehiculeById($id) {
        $sql = "SELECT v.*, c.nom AS nom_categorie, c.tarif_journalier 
                FROM vehicules v 
                LEFT JOIN categories c ON v.categorie_id = c.id 
                WHERE v.id = :id";
        $stmt = $this->crud->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    // Ajouter un nouveau véhicule
    public function addVehicule($data) {
        return $this->crud->insert('vehicules', $data);
    }

    // Mettre à jour un véhicule
    public function updateVehicule($id, $data) {
        return $this->crud->update('vehicules', $data, $id);
    }

    // Supprimer un véhicule
    public function deleteVehicule($id) {
        return $this->crud->delete('vehicules', $id);
    }

    // Récupérer toutes les catégories (pour les formulaires)
    public function getAllCategories() {
        return $this->crud->select('categories', 'nom', 'asc');
    }

    // // Changer le statut de disponibilité d'un véhicule
    // public function changeDisponibilite($id, $disponible) {
    //     $data = ['disponible' => $disponible];
    //     return $this->crud->update('vehicules', $data, $id);
    // }

    // Vérifier si un véhicule est réservé (pour éviter la suppression)
    public function isVehiculeReserve($id) {
        $sql = "SELECT COUNT(*) FROM reservations WHERE vehicule_id = :id AND statut IN ('en attente', 'confirmée')";
        $stmt = $this->crud->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }

    //Le nombre total des véhicules disponibles
       public function getNombreVehiculesDisponibles() {
        $sql = "SELECT COUNT(*) AS total FROM vehicules WHERE disponible = TRUE";
        $stmt = $this->crud->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
}
?>