<?php
require_once './app/models/game.model.php';
require_once './app/views/json.view.php';

class GameApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new GameModel();
        $this->view = new JSONView();
    }

    // /api/videojuegos (GetAll)
    public function getAll($req/*, $res*/) {
        /*if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }*/
        
        //Orden por prioridad
        $orderBy = "";
        $order = "asc";

        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        if(isset($req->query->order))
            $order = $req->query->order;

        $game = $this->model->getGames($orderBy, $order);
        
        // mando los juegos a la vista
        return $this->view->response($game, 200);
    }

    // /api/videojuegos/:id
    public function get($req, $res) {
        // obtengo el id de la tarea desde la ruta
        $id = $req->params->id;

        // obtengo la tarea de la DB
        $game = $this->model->getGame($id);

        if(!$game) {
            return $this->view->response("el juego con el id=$id no existe", 404);
        }

        // mando la tarea a la vista
        return $this->view->response($game);
    }
    
    // api/videojuegos/:id (DELETE)
    public function delete($req, $res) {
        $id = $req->params->id;

        $game = $this->model->getGame($id);

        if (!$game) {
            return $this->view->response("El juego con el id=$id no existe", 404);
        }

        $this->model->eraseGame($id);
        $this->view->response("El juego con el id=$id se eliminó con éxito", 200);
    }

    
    
    // api/tareas (POST)
    public function create($req, $res) {
        
        // valido los datos
        if (empty($req->body->titulo) || empty($req->body->genero) || empty($req->body->id_plataforma)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $titulo = $req->body->titulo;       
        $genero = $req->body->genero;       
        $plataforma = $req->body->id_plataforma;

        // inserto los datos
        $id = $this->model->insertGame($titulo, $genero, $plataforma);

        if (!$id) {
            return $this->view->response("Error al insertar juego", 500);
        }

        // buena práctica es devolver el recurso insertado
        $game = $this->model->getGame($id);
        return $this->view->response($game, 201);
    }
    

    public function update($req, $res) {

        $id = $req->params->id;
        $game = $this->model->getGame($id);

        if(!$game)
            return $this->view->response('El juego no existe', 404);


        // valido los datos
        if (empty($req->body->titulo) || empty($req->body->genero) || empty($req->body->id_plataforma)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $titulo = $req->body->titulo;       
        $genero = $req->body->genero;       
        $plataforma = $req->body->id_plataforma;

        // actualizo los datos
        $this->model->updateGame($id, $titulo, $genero, $plataforma);

        // buena práctica es devolver el recurso insertado
        $game = $this->model->getGame($id);
        return $this->view->response($game, 201);
    }
}