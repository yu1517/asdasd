<?php
class BookModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_tpe;charset=utf8', 'root', '');
    }

    //Devuelve la lista de tareas completa
    function getAllBooks(){
        //1. Abro la conexion
        //2.Enviar la consulta(2 sub pasos: prepare y execte)
        $query = $this->db->prepare("SELECT books.id, books.id_author, books.title, books.genre, books.imagen, authors.name FROM books INNER JOIN authors ON books.id_author = authors.id_author");
        $query->execute();
        //3. Obtengo la respuesta con un fetchAll(porque)
        $books = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $books;
    }

    public function getAllPages($from, $limit){
        $query = $this->db->prepare("SELECT books.id, books.id_author, books.title, books.genre, books.imagen, authors.name FROM books INNER JOIN authors ON books.id_author = authors.id_author LIMIT $from,$limit");
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_OBJ);
        return $books;
    }

    //Obtiene una tarea determinada por su id
    function getBook($id){
        $query = $this->db->prepare('SELECT * FROM books WHERE id = ?');
        $query->execute([$id]);
        $books = $query->fetch(PDO::FETCH_OBJ);
        return $books;
    }

    function order($sort, $orderBy){
        $query = $this->db->prepare("SELECT books.id, books.id_author, books.title, books.genre, books.imagen, authors.name FROM books INNER JOIN authors ON books.id_author = authors.id_author ORDER BY $sort $orderBy");
        $query->execute();
        //3. Obtengo la respuesta con un fetchAll(porque)
        $orderedBooks = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $orderedBooks;
    }
    
    function getBooksByGenre($genre){
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query = $this->db->prepare("SELECT * FROM books  WHERE genre IN ? ");
        $query->execute(["%$genre%"]);
        return $query->fetchAll(PDO::FETCH_OBJ); 
    }

    //Inserta una tarea en la base de datos.

    public function insert($title, $genre, $id_author){

        $query = $this->db->prepare("INSERT INTO books (title, genre, id_author) VALUES (?, ?, ?)");
        $query->execute([$title, $genre, $id_author]);
        return $this->db->lastInsertId();
    }

    public function updateBook($id, $title, $genre, $id_author){
        $query = $this->db->prepare("UPDATE `books` SET title=?, genre=?, id_author=? WHERE id=?");
        $query->execute([$title, $genre, $id_author, $id]);
    }

    //Elimina una tarea dado su id
    function deleteBookById($id){
        $query = $this->db->prepare('DELETE FROM books WHERE id = ?');
        $query->execute([$id]);
    }
}