<?php

class CRUD extends PDO {

    // Constructeur : initialise la connexion à la base de données avec PDO
    public function __construct() {
        parent::__construct('mysql:host=localhost;dbname=location_voiture;port=3306;charset=utf8', 'root', '');
    }

    // Méthode pour sélectionner tous les enregistrements d'une table, triés par un champ donné.
    public function select($table, $field = 'id', $order = 'asc') {
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt = $this->query($sql); 
        return $stmt->fetchAll();
    }

    // Méthode pour sélectionner un enregistrement spécifique selon un champ (par défaut 'id')
    public function selectId($table, $value, $field = 'id') {
        $sql = "SELECT * FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value); // Lie la valeur au paramètre
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    // Méthode pour insérer un nouvel enregistrement dans une table
    public function insert($table, $data) {
        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ":" . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($fieldName) VALUES ($fieldValue)";
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $this->lastInsertId();
    }

    // Méthode pour mettre à jour un enregistrement selon son id
    public function update($table, $data, $id) {
        $fieldDetails = "";
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key = :$key, ";
        }
        $fieldDetails = rtrim($fieldDetails, ", ");
        
        $sql = "UPDATE $table SET $fieldDetails WHERE id = :id";
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":id", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Méthode pour supprimer un enregistrement selon un champ (par défaut 'id')
    public function delete($table, $value, $field = 'id') {
        $sql = "DELETE FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>