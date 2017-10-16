<?php
/**
 * @Project: slim_project.
 * @Author: Gerley Adriano Miranda Cruz
 * @Created: 28/01/2017
 */
namespace controllers;

class Pessoa {

    private $databaseConnection;

    public function __construct() {
        $this->databaseConnection = new \PDO('mysql:host=localhost;dbname=api', 'root', 'sefaz123');
        $this->databaseConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function lista() {
        global $app;
        $query = $this->databaseConnection->prepare("SELECT * FROM pessoa");
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $app->render('default.php', array('data' => $result), 200);
    }

    public function get($id) {
        global $app;
        $query = $this->databaseConnection->prepare("SELECT * FROM pessoa WHERE pessoa_id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        $app->render('default.php', array('data' => $result), 200);
    }

    public function adicionar() {
        global $app;
        $dados = json_decode($app->request->getBody(), true);
        $dados = (sizeof($dados)==0) ? $_POST : $dados;
        $keys = array_keys($dados);
        $query = $this->databaseConnection->prepare("INSERT INTO pessoa (".implode(',', $keys).") VALUES (:".implode(",:",$keys).")");
        foreach ($dados as $key=> $value) {
            $query->bindValue(':'. $key, $value);
        }
        $query->execute();
        $app->render('default.php', array('data' => array('id' => $this->databaseConnection->lastInsertId())), 200);
    }

    public function editar($id) {
        global $app;
        $dados = json_encode($app->request->getBody(), true);
        $dados = (sizeof($dados)==0) ? $_POST : $dados;
        $sets = array();
        foreach ($dados as $key => $value) {
            $sets[] = $key . " = :" . $key;
        }
        $query = $this->databaseConnection->prepare("UPDATE pessoa SET ".implode(',', $sets)." WHERE pessoa_id = :id ");
        $query->bindValue(':id', $id);
        foreach ($dados as $key => $value) {
            $query->bindValue(':'.$key, $value);
        }
        $app->render('default.php', array('data' => array('status' => $query->execute()==1)), 200);
    }

    public function excluir($id) {
        global $app;
        $query = $this->databaseConnection->prepare("DELETE FROM pessoa WHERE pessoa_id = :id");
        $query->bindValue(':id', $id);
        $app->render('default.php', array('data' => array('status' => $query->execute() == 1)), 200);
    }
}
