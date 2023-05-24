<?php

class User extends Conn2
{
    public object $conn;
    public array $formData;

    public function list(): array
    {
        $this->conn = $this->connectDb();
        $query_users = "SELECT id, sku, name, price, dimension1, dimension2, dimension3, weight, size  FROM users3 ORDER BY id ASC LIMIT 40";
        $result_users = $this->conn->prepare($query_users);
        $result_users->execute();
        $retorno = $result_users->fetchAll();
        // var_dump($retorno);
        return $retorno;
    }

    public function delete($id): bool
    {
        $this->conn = $this->connectDb();
        $query_delete_user = "DELETE FROM users3 WHERE id = :id";
        $delete_user = $this->conn->prepare($query_delete_user);
        $delete_user->bindParam(':id', $id);
        $delete_user->execute();
    
        if ($delete_user->rowCount()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function index(): bool
    {
        var_dump($this->formData);
        $this->conn = $this->connectDb();
        $query_user = "INSERT INTO users3 (sku, name, price, dimension1, dimension2, dimension3, weight, size) VALUES (:sku, :name, :price, :dimension1, :dimension2, :dimension3, :weight, :size)";
        $add_user = $this->conn->prepare($query_user);
        $add_user->bindParam(':sku', $this->formData['sku']);
        $add_user->bindParam(':name', $this->formData['name']);
        $add_user->bindParam(':price', $this->formData['price']);
        $add_user->bindParam(':dimension1', $this->formData['dimension1']);
        $add_user->bindParam(':dimension2', $this->formData['dimension2']);
        $add_user->bindParam(':dimension3', $this->formData['dimension3']);
        $add_user->bindParam(':weight', $this->formData['weight']);
        $add_user->bindParam(':size', $this->formData['size']);



        $add_user->execute();

        if ($add_user->rowCount()) {
            return true;
        } else {
            return false;
        }
    }
}
