<?php

class GameModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=web2tpe;charset=utf8', 'root', '');
    }

    public function getGames($orderBy = "", $order = "asc") {
        $sql = 'SELECT * FROM videojuegos';

        //Verificar los ultimos 2 casos.
        switch($orderBy) {
            case 'titulo':
                $sql .= " ORDER BY titulo $order";
                break;
            case 'genero':
                $sql .= " ORDER BY genero $order";
                break;
            case 'plataforma':
                $sql .= " ORDER BY id_plataforma $order";
                break;
            case 'id':
                $sql .= " ORDER BY id_videojuego $order";
                break;
            default:
                break;
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $games = $query->fetchAll(PDO::FETCH_OBJ); 
        return $games;
    }
 
    public function getGame($id) {    
        $query = $this->db->prepare('SELECT * FROM videojuegos WHERE id_videojuego = ?'); 
        $query->execute([$id]);   
    
        $game = $query->fetch(PDO::FETCH_OBJ);
    
        return $game;
    }

    //metedo DELETE REVISAR
    public function eraseGame($id) {
        $query = $this->db->prepare('DELETE FROM videojuegos WHERE id = ?');
        $query->execute([$id]);
    }

    //metodo POST              
    public function insertGame($titulo, $genero, $plataforma) {
        $query = $this->db->prepare('INSERT INTO videojuegos(titulo, genero, id_plataforma) VALUES (?, ?, ?)');
        $query->execute([$titulo, $genero, $plataforma]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function updateGame($id, $titulo, $genero, $plataforma) {
        $query = $this->db->prepare('UPDATE videojuegos SET titulo = ?, genero = ?, id_plataforma = ? WHERE id_videojuego = ?');
        $query->execute([$titulo, $genero, $plataforma, $id]);   
    }
}