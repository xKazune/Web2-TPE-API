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
        /*ESTO CREO QUE NO VA ACA PORQUE ESTO ES PARA OBTENER TODOS Y ACA NO IMPORTA. VA EN EL EDITAR O AGREGAR
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }*/

        $orderBy = "";
        $order = "asc";

        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        if(isset($req->query->order))
            $order = $req->query->order;

        $game = $this->model->getGames($orderBy, $order);
        return $this->view->response($game, 200);
    }

    // /api/videojuegos/:id
    public function get($req/*, $res*/) {
        // obtengo el id del juego desde la ruta
        $id = $req->params->id;

        // obtengo el juego de la DB
        $game = $this->model->getGame($id);

        if(!$game) {
            return $this->view->response("el juego con el id=$id no existe", 404);
        }

        // mando el juego a la vista
        return $this->view->response($game);
    }
    
    // api/videojuegos/:id (DELETE) REVISAR
    public function delete($req, $res) {
        $id = $req->params->id;

        $game = $this->model->getGame($id);

        if (!$game) {
            return $this->view->response("El juego con el id=$id no existe", 404);
        }

        $this->model->eraseGame($id);
        $this->view->response("El juego con el id=$id se eliminó con éxito", 200);
    }

    
    
    // api/tareas (POST) REVISAR LO DEL RES
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

        $game = $this->model->getGame($id);
        return $this->view->response($game, 201);
    }
    
    //REVISAR EL RES
    public function update($req, $res) {

        $id = $req->params->id;
        $game = $this->model->getGame($id);

        if(!$game){
            return $this->view->response('El juego no existe', 404);
        }

        if (empty($req->body->titulo) || empty($req->body->genero) || empty($req->body->id_plataforma)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $titulo = $req->body->titulo;       
        $genero = $req->body->genero;       
        $plataforma = $req->body->id_plataforma;

        $this->model->updateGame($id, $titulo, $genero, $plataforma);
        $game = $this->model->getGame($id);
        return $this->view->response($game, 201);
    }
}