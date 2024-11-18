<?php

class PlatformModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=web2tpe;charset=utf8', 'root', '');
    }

    public function getPlatforms($orderBy = "", $order = "asc") {
        $sql = 'SELECT * FROM plataformas ';

        switch($orderBy) {
            case 'nombrePlataforma':
                $sql .= " ORDER BY nombrePlataforma $order";
                break;
            case 'fabricante':
                $sql .= " ORDER BY fabricante $order";
                break;
            case 'tipo':
                $sql .= " ORDER BY tipo $order";
                break;
            case 'id_plataforma':
                $sql .= " ORDER BY id_plataforma $order";
                break;
            default:
                break;
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $platform = $query->fetchAll(PDO::FETCH_OBJ); 
        return $platform;
    }
 
    public function getPlatform($id) {    
        $query = $this->db->prepare('SELECT * FROM plataformas WHERE id_plataforma = ?'); 
        $query->execute([$id]);   
        $platform = $query->fetch(PDO::FETCH_OBJ);
        return $platform;
    }

    //metedo DELETE
    public function erasePlatform($id) {
        $query = $this->db->prepare('DELETE FROM plataformas WHERE id_plataforma = ?');
        $query->execute([$id]);
    }

    //metodo POST
    public function insertPlatform($nombrePlataforma, $farbicante,$tipo) {
        $query = $this->db->prepare('INSERT INTO plataformas(nombrePlataforma, fabricante, tipo) VALUES (?, ?, ?)');
        $query->execute([$nombrePlataforma, $farbicante,$tipo]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    //metodo PUT
    public function updatePlatform($id_platform, $nombrePlataforma, $fabricante, $tipo) {
        $query = $this->db->prepare('UPDATE plataformas SET nombrePlataforma = ?, fabricante = ?, tipo = ? WHERE id_plataforma = ?');
        $query->execute([$nombrePlataforma, $fabricante, $tipo, $id_plataform]);   
    }





}