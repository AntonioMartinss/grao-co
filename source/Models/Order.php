<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;
use Source\Core\Model;
error_reporting(E_ERROR | E_PARSE);
class Order extends Model
{
    private $id;
    private $total;
    private $quantity;
    private $description;
    private $users_id;
    private $message;

    public function __construct(
        int $id = null,
        float $total = null,
        int $quantity = null,
        string $description = null,
        int $users_id = null

    ) {
        $this->id = $id;
        $this->total = $total;
        $this->quantity = $quantity;
        $this->description = $description;
        $this->users_id = $users_id;
        $this->entity = "order";
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): void
    {
        $this->total = $total;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }
    public function getDescription(): ?string
    {
        return $this->quantity;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    
    public function getUsersId(): ?int
    {
        return $this->users_id;
    }

    public function setUsersId(?int $users_id): void
    {
        $this->users_id = $users_id;
    }



    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getOrderById(int $id): array
    {
        $query = "SELECT 
                    order.id, 
                    order.total,
                    order.quantity,
                    order.description
                  FROM `order`
                  WHERE order.id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listOrder()
    {

        $query = "SELECT * FROM `order`";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function updateOrder(): bool
{
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);

    $this->id = $json_data['id'];
    $this->total = $json_data['total'];
    $this->quantity = $json_data['quantity'];
    $this->description = $json_data['description'];
    $this->users_id = $json_data['users_id'];

    $conn = Connect::getInstance();

    $checkQuery = "SELECT id FROM `order` WHERE id = :id";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":id", $this->id);
    $checkStmt->execute();

    if ($checkStmt->rowCount() === 0) {
        $this->message = "Pedido não encontrado.";
        return false;
    }

    $query = "UPDATE `order` 
              SET total = :total, 
                  quantity = :quantity, 
                  description = :description,
                  users_id = :users_id
              WHERE id = :id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":total", $this->total);
    $stmt->bindParam(":quantity", $this->quantity);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":users_id", $this->users_id);

    try {
        $stmt->execute();
        $this->message = "Pedido Atualizado com sucesso.";
        return true;
    } catch (PDOException $e) {
        $this->message = "Erro ao Atualizar o Pedido: " . $e->getMessage();
        return false;
    }
}
    
   
    public function deleteOrder(int $id): bool
{

    $conn = Connect::getInstance();

    $checkQuery = "SELECT id FROM `order` WHERE id = :id";
    
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":id", $id);
    $checkStmt->execute();

    if ($checkStmt->rowCount() === 0) {
        $this->message = "Pedido não encontrado.";
        return false;
    }

    $query = "DELETE FROM `order` WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);

    try {
        $stmt->execute();
        $this->message = "Pedido Excluido com sucesso ";
        return true;
    } catch (PDOException) {
        $this->message = "Erro ao excluir o pedido: ";
        return false;
    }
}

public function insert(): ?int
{

    $conn = Connect::getInstance();


    $query = "INSERT INTO `order` (total,quantity,description,users_id) 
              VALUES (:total,:quantity,:description,:users_id)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":total", $this->total);
    $stmt->bindParam(":quantity", $this->quantity);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":users_id", $this->users_id);
    

    try {
        $stmt->execute();
        return $conn->lastInsertId();
    } catch (PDOException) {
        $this->message = "Por favor, informe todos os campos";
        return false;
    }
}
}
