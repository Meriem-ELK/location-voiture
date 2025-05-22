<?php
require_once 'CRUD.php';

// Classe Client
class Client {
    private $crud; 
    private $table = "clients";
    
    // Propriétés
    public $id;
    public $nom;
    public $prenom;
    public $adresse;
    public $email;
    public $telephone;
    public $permis_conduire;
    public $date_inscription;
    
    // Constructeur : instancie un objet CRUD à l'initialisation de la classe
    public function __construct() {
        $this->crud = new CRUD();
        
    }
    
    // Méthode pour récupérer tous les clients, triés par nom
    public function getAllClients() {
        return $this->crud->select($this->table, "nom");
    }
    
    // Méthode pour récupérer un client par son ID
    public function getClientById($id) {
        return $this->crud->selectId($this->table, $id);
    }
    
    // Méthode pour ajouter un nouveau client
    public function addClient($data) {
        return $this->crud->insert($this->table, $data);
    }
    
    // Méthode pour mettre à jour un client
    public function updateClient($data, $id) {
        return $this->crud->update($this->table, $data, $id);   
    }
    
    // Vérifier si un client a des réservations associées
    public function hasReservations($clientId) {
        $sql = "SELECT COUNT(*) FROM reservations WHERE client_id = :client_id";
        $stmt = $this->crud->prepare($sql);
        $stmt->bindValue(":client_id", $clientId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
    
    // Méthode pour supprimer un client
    public function deleteClient($id) {
        // Vérifier d'abord si le client a des réservations
        if ($this->hasReservations($id)) {
            return "reservation_exists";
        }
        
        return $this->crud->delete($this->table, $id);
    }
}
?>