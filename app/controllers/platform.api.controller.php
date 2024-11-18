<?php
require_once './app/models/platform.model.php';
require_once './app/views/json.view.php';

class PlatformApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PlatformModel();
        $this->view = new JSONView();
    }

    // /api/plataformas (GetAll)
    public function getAll($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $orderBy = "";
        $order = "asc";

        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
        }

        if(isset($req->query->order)){
            $order = $req->query->order;
        }

        $platform = $this->model->getPlatforms($orderBy, $order);
        return $this->view->response($platform, 200);
    }

    // /api/plataformas/:id (GET)
    public function get($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $platform = $this->model->getPlatform($id);
        if(!$platform) {
            return $this->view->response("La plataforma con el id=$id no existe", 404);
        }
        return $this->view->response($platform, 200);
    }
    
    // api/plataformas/:id (DELETE)
    public function delete($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $platform = $this->model->getPlatform($id);

        if (!$platform) {
            return $this->view->response("La plataforma con el id=$id no existe", 404);
        }

        $this->model->erasePlatform($id);
        $this->view->response("La plataforma con el id=$id se eliminó con éxito", 200);
    }

    // api/plataforma (POST)
    public function create($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        if (empty($req->body->nombrePlataforma) || empty($req->body->fabricante) || empty($req->body->tipo)) {
            return $this->view->response('Faltan completar datos', 400);
        }
        $nombrePlataforma = $req->body->nombrePlataforma;       
        $fabricante = $req->body->fabricante;       
        $tipo = $req->body->tipo;       

        $id = $this->model->insertPlatform($nombrePlataforma, $fabricante, $tipo);

        if (!$id) {
            return $this->view->response("Error al insertar plataforma", 500);
        }

        $platform = $this->model->getPlatform($id);
        return $this->view->response($platform, 201);
    }

    // api/plataforma/:id (PUT)
    public function update($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $game = $this->model->getPlatform($id);

        if (!$platform) {
            return $this->view->response("La plataforma con el id=$id no existe", 404);
        }

        if (empty($req->body->nombrePlataforma) || empty($req->body->fabricante) || empty($req->body->tipo)) {
            return $this->view->response('Faltan completar datos', 400);
        }
        $nombrePlataforma = $req->body->nombrePlataforma;       
        $fabricante = $req->body->fabricante;       
        $tipo = $req->body->tipo;  

        $this->model->updatePlatform($id, $nombrePlataforma, $fabricante, $tipo);
        $platform = $this->model->getPlatform($id);
        return $this->view->response($platform, 201);
    }





}