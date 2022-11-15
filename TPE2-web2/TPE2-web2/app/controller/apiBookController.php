<?php
require_once './app/models/book.model.php';
require_once './app/views/apiView.php';


class ApiBookController
{
    private $model;
    private $view;
    private $data;

    function __construct()
    {
        $this->model = new BookModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }

    public function getAll($params = null){
        // Ordenamiento asc y desc
        $sortWL = ['id', 'title', 'genre', 'name'];
        $orderByWL = ['asc', 'desc'];
        if (isset($_GET['sort']) || isset($_GET['orderBy'])) {
            if (isset($_GET['sort']) && in_array($_GET['sort'], $sortWL) && isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderByWL)){            
                $sort = $_GET['sort'];
                $orderBy = $_GET['orderBy'];
                $books = $this->model->order($sort, $orderBy);
                $this->view->response($books, 200);
            } 
            else if (!isset($_GET['orderBy']) && isset($_GET['sort']) && in_array($_GET['sort'], $sortWL)) {
            $sort = $_GET['sort'];
            $orderBy = "ASC";
            $books = $this->model->order($sort, $orderBy);
            $this->view->response($books, 200);
            } 
        }
        //Paginacion
        if (isset($_GET['limit']) && isset($_GET['start'])
        ) {
            if (is_numeric($_GET['limit'])) {
                if ($_GET['limit']) {
                    $limit = $_GET['limit'];
                } else {
                    $limit = 4;
                }
                if (isset($_GET['start'])) {
                    if (is_numeric($_GET['start'])) {
                        $start = $_GET['start'];
                    } else {
                        $start = 0;
                    }
                    $from = ((int)$start - 1) * (int)$limit;
                    $books = $this->model->getAllPages($from, $limit);
                    $this->view->response($books, 200);
                }
            }
        } else if (!isset($_GET['limit']) && isset($_GET['start'])) {
            if (is_numeric($_GET['start'])) {
                $start = $_GET['start'];
            } else {
                $start = 0;
            }
            $limit = 4;
            $from = ((int)$start - 1) * (int)$limit;
            $books = $this->model->getAllPages($from, $limit);
            $this->view->response($books, 200);
        } else {
            $books = $this->model->getAllBooks();
            $this->view->response($books, 200);
        }

        //filtro por genero
        if (isset($_GET['genre']) && count($_GET) ==2){ //count controla que reciba solo dos parametros
            $genre = $_GET ['$genre'];
            $books = $this->model->getBooksByGenre($genre);
            if (count($books) > 0) {
                $this->view->response($books, 200);
            }
        } 
    }
    

    public function getBook($params = null)
    {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $book = $this->model->getBook($id);

        if ($book) {
            $this->view->response($book);
        } else {
            $this->view->response("Book id=$id not found", 404);
        }
    }

    public function insertBook($params = null)
    {
        $book = $this->getData();

        if (empty($book->title) || empty($book->genre)) {
            $this->view->response("Complete los datos solicitados", 400);
        } else {
            $id = $this->model->insert($book->title, $book->genre, $book->id_author);
            $book = $this->model->getBook($id);
            $this->view->response($book, 201);
        }
    }

    public function updateBook($params = null)
    {
        $id = $params[':ID'];
        $data = $this->getData();
        $book = $this->model->getBook($id);
        if ($book) {
            $this->model->updateBook($id, $data->title, $data->genre, $data->id_author);
            $book = $this->model->getBook($id);
            $this->view->response($book, 200);
        } else {
            return $this->view->response("El libro id=$id no existe.", 404);
        }
    }

    public function removeBook($params = null)
    {
        $id = $params[':ID'];

        $book = $this->model->getBook($id);
        if ($book) {
            $this->model->deleteBookById($id);
            $this->view->response("El libro fue eliminado correctamente", 200);
        } else {
            $this->view->response("El libro con el id=$id no existe", 404);
        }
    }
}