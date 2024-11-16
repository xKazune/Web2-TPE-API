<?php

class PlatformModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=web2tpe;charset=utf8', 'root', '');
    }

    public function getPlatforms($filtrarFinalizadas = null, $orderBy = false) {
        $sql = 'SELECT * FROM plataformas ';

        //Filtrado
        if($filtrarFinalizadas != null) {
            if($filtrarFinalizadas == 'true')
                $sql .= ' WHERE finalizada = 1';
            else
                $sql .= ' WHERE finalizada = 0';
        }

        //Ordern por prioridad
        if($orderBy) {
            switch($orderBy) {
                case 'titulo':
                    $sql .= ' ORDER BY titulo';
                    break;
                case 'prioridad':
                    $sql .= ' ORDER BY prioridad';
                    break;
            }
        }

        // 2. Ejecuto la consulta
        $query = $this->db->prepare($sql);
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $platform = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $platform;
    }
 
    public function getPlatform($id) {    
        $query = $this->db->prepare('SELECT * FROM plataformas WHERE id = ?'); 
        $query->execute([$id]);   
    
        $platform = $query->fetch(PDO::FETCH_OBJ);
    
        return $platform;
    }

    //metedo DELETE
    public function erasePlatform($id) {
        $query = $this->db->prepare('DELETE FROM plataformas WHERE id = ?');
        $query->execute([$id]);
    }

    //metodo POST
    public function insertPlatform($nombrePlataforma, $farbicante,$tipo, $finished = false) { //AVERIGUAR SI HAY Q MODIFICAR LA BASE DE DATOS PARA EL "FINALIZADA"
        $query = $this->db->prepare('INSERT INTO plataformas(nombrePlataforma, fabricante, tipo,finished) VALUES (?, ?, ?, ?)');
        $query->execute([$nombrePlataforma, $farbicante,$tipo , $finished]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }







}