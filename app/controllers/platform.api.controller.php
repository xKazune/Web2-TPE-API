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

    // /api/plataformas
    public function getAll($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }


        // BUSCAR IDEA DE COMO APLICAR EL FILTRO A LAS PLATAFORMAS
        $filtrarFinalizadas = null;
        // obtengo los las plataformas de la DB
        //Filtrado
        if(isset($req->query->finalizadas)) {
            $filtrarFinalizadas = $req->query->finalizadas;
        }
        
        //Orden por prioridad
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $platform = $this->model->getPlatforms($filtrarFinalizadas, $orderBy);
        
        // mando los juegos a la vista
        return $this->view->response($platform);
    }

    // /api/plataformas/:id (GET)
    public function get($req, $res) {
        // obtengo el id de la tarea desde la ruta
        $id = $req->params->id;

        // obtengo la tarea de la DB
        $platform = $this->model->getPlatform($id);

        if(!$platform) {
            return $this->view->response("La plataforma con el id=$id no existe", 404);
        }

        // mando la tarea a la vista
        return $this->view->response($platform);
    }
    
    // api/plataformas/:id (DELETE)
    public function delete($req, $res) {
        $id = $req->params->id;

        $platform = $this->model->getPlatform($id);

        if (!$platform) {
            return $this->view->response("La plataforma con el id=$id no existe", 404);
        }

        $this->model->erasePlatform($id);
        $this->view->response("La plataforma con el id=$id se eliminó con éxito");
    }

    // api/plataforma (POST)
    public function create($req, $res) {

        // valido los datos
        if (empty($req->body->nombrePlataforma) || empty($req->body->tipo)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $nombrePlataforma = $req->body->titulo;       
        $fabricante = $req->body->descripcion;       
        $tipo = $req->body->prioridad;       

        // inserto los datos
        $id = $this->model->insertPlatform($nombrePlataforma, $fabricante, $tipo);

        if (!$id) {
            return $this->view->response("Error al insertar plataforma", 500);
        }

        // buena práctica es devolver el recurso insertado
        $platform = $this->model->getPlatform($id);
        return $this->view->response($platform, 201);
    }







}