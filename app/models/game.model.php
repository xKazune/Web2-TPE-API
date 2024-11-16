<?php

class GameModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=web2tpe;charset=utf8', 'root', '');
    }
                            //Creo que no iria
                            //$filtrarFinalizadas = null
    public function getGames($orderBy = "", $order = "asc") {
        $sql = 'SELECT * FROM videojuegos';

        //Ordern por columna
        //Podemos acomodarlo a lo que queramos ordenar. por plataformas o por genero.
        
        switch($orderBy) {
            case 'titulo':
                $sql .= " ORDER BY titulo $order";
                break;
            case 'genero':
                $sql .= " ORDER BY genero $order";
                break;
            default:
                break;
        }

        // 2. Ejecuto la consulta
        $query = $this->db->prepare($sql);
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $games = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $games;
    }
 
    public function getGame($id) {    
        $query = $this->db->prepare('SELECT * FROM videojuegos WHERE id_videojuego = ?'); 
        $query->execute([$id]);   
    
        $game = $query->fetch(PDO::FETCH_OBJ);
    
        return $game;
    }

    //metedo DELETE
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