<?php
namespace App\Models;
use App\Models\CRUD;

/**
 * Modèle Vehicule
 * Gère toutes les opérations liées à la table 'vehicules'
 */
class Vehicule extends CRUD {
    
    protected $table = "vehicules";
    protected $primaryKey = "id";
    protected $fillable = [
        'marque', 
        'modele', 
        'annee', 
        'immatriculation', 
        'couleur', 
        'kilometrage', 
        'disponible', 
        'categorie_id'
    ];

    /**
     * Obtient tous les véhicules avec leur catégorie
     */
    public function getVehiculesWithCategorie() {
        $sql = "SELECT v.*, c.nom as categorie_nom, c.tarif_journalier 
                FROM $this->table v 
                LEFT JOIN categories c ON v.categorie_id = c.id 
                ORDER BY v.marque ASC";
        
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }


    /**
     * Obtient un véhicule spécifique avec sa catégorie
    */
    public function getVehiculeWithCategorieById($id) {
        $sql = "SELECT v.*, c.nom as categorie_nom, c.tarif_journalier, c.description as categorie_description
                FROM $this->table v 
                LEFT JOIN categories c ON v.categorie_id = c.id 
                WHERE v.id = :id";
        
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    /**
     * Obtient les véhicules disponibles
    */
    public function getVehiculesDisponibles() {
        $sql = "SELECT v.*, c.nom as categorie_nom, c.tarif_journalier 
                FROM $this->table v 
                LEFT JOIN categories c ON v.categorie_id = c.id 
                WHERE v.disponible = 1 
                ORDER BY v.marque ASC";
        
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

}