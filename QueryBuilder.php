<?php

class QueryBuilder {

    protected $pdo;

    public function __construct($configDB) {
        var_dump(gettype($configDB));
        die();
        $this->pdo = new PDO('mysql:host=' . $configDB['host'] . ';dbname=' . $configDB['database'], $configDB['username'], $configDB['password']);
    }
    /**
    Parameters:
    $table - string

    Description: Получить все записи из таблицы БД

    Return value: array
     **/
    public function getAll($table) {
        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    Parameters:
    $table - string
    $id - integer

    Description: Получить одну запись из таблицы БД

    Return value: array
     **/
    public function getOne($table, $id) {
        $sql = "SELECT * FROM {$table} WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        //$statement->bindValue(':id', $id);
        //$statement->bindParam(':id', $id);
        $statement->execute([
            'id' => $id
        ]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
    }

    /**
    Parameters:
    $table - string
    $data - array

    Description: Создать новую запись в БД

    Return value: null
     **/
    public function create($table, $data) {
        $keys = implode(',', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$tags})";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    /**
    Parameters:
    $table - string
    $data - array
    $id - integer

    Description: Изменить запись в таблице БД

    Return value: null
     **/
    public function update($table, $data, $id) {

        $keys = array_keys($data);

        $string = '';

        foreach($keys as $key) {
            $string .= $key . '=:' . $key . ',';
        }
        $keys = rtrim($string, ',');

        $data['id'] = $id;

        $sql = "UPDATE {$table} SET {$keys} WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    /**
    Parameters:
    $table - string
    $id - integer

    Description: Удалить запись из таблицы БД

    Return value: null
     **/
    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
    }

}