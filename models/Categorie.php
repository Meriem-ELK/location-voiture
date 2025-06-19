<?php
namespace App\Models;
use App\Models\CRUD;

/**
 * Modèle Categorie
 * Gère toutes les opérations liées à la table 'categories'
 */
class Categorie extends CRUD {
    
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $fillable = [
        'nom', 
        'description', 
        'tarif_journalier'
    ];

    // /**
    //  * Obtient les catégories avec le nombre de véhicules
    //  * @return array - Catégories avec statistiques
    //  */
    // public function getCategoriesWithCount() {
    //     $sql = "SELECT c.*, COUNT(v.id) as nombre_vehicules 
    //             FROM $this->table c 
    //             LEFT JOIN vehicules v ON c.id = v.categorie_id 
    //             GROUP BY c.id 
    //             ORDER BY c.nom ASC";
        
    //     $stmt = $this->query($sql);
    //     return $stmt->fetchAll();
    // }

    /**
     * Obtient les catégories pour un select
     * @return array - Liste simple des catégories
     */
    public function getForSelect() {
        $sql = "SELECT id, nom, tarif_journalier FROM $this->table ORDER BY nom ASC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
}