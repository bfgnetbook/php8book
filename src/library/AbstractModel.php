<?php

namespace App\Library;

use App\Library\Container;
use App\Library\Database;
use PDO;

abstract class AbstractModel
{
    protected $db;
    protected $table; // Nombre de la tabla en la base de datos

    public function __construct(Container $container, $table)
    {
        $this->db = $container->make(Database::class);
        $this->table = $table;
    }

    public function executeQuery($sql, array $params = [], $all = true)
    {
        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Error al ejecutar la consulta: " . $stmt->errorInfo()[2]);
        }

        if (strpos(strtoupper($sql), 'SELECT') === 0) {
            if ($all) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        return $stmt->rowCount();
    }

    public function findAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($fields) VALUES ($placeholders)");
        return $stmt->execute($data);
    }

    public function update($id, array $data)
    {
        $setPart = implode(', ', array_map(function ($field) {
            return "{$field} = :{$field}";
        }, array_keys($data)));

        $stmt = $this->db->prepare("UPDATE {$this->table} SET $setPart WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
