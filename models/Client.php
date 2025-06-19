<?php
namespace App\Models;
use App\Models\CRUD;

class Client extends CRUD {

    protected $table = "clients";
    protected $primaryKey = "id";
    protected $fillable = [
        'nom', 
        'prenom', 
        'adresse', 
        'email', 
        'telephone', 
        'permis_conduire', 
        'date_inscription'
    ];

    /**
     * Obtient la liste des clients
     */
    public function getClients() {
        $sql = "SELECT c.*
                FROM $this->table c
                GROUP BY c.id 
                ORDER BY c.nom ASC";
        
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

       /**
     * Obtient liste des clients pour un select
     */
    public function getForSelect() {
        $sql = "SELECT id, nom FROM $this->table ORDER BY nom ASC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
}