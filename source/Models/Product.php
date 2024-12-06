<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;
use Source\Core\Model;
error_reporting(E_ERROR | E_PARSE);
class Product extends Model
{
    private $id;
    private $name;
    private $value;
    private $description;
    private $quantity;
    private $categories_id;
    private $message;

    public function __construct(
        int $id = null,
        string $name = null,
        float $value = null,
        string $description = null,
        int $quantity = null,
        
        int $categories_id = null,

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->description = $description;
        $this->quantity = $quantity;
       
        $this->categories_id = $categories_id;
        $this->entity = "products";
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): void
    {
        $this->value = $value;
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
        return $this->description;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setCategories_id(?int $categories_id): void
    {
        $this->categories_id = $categories_id;
    }
    public function getCategories_id(): ?int
    {
        return $this->categories_id;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getProductById(int $id): array
    {
        $query = "SELECT 
                    products.id, 
                    products.name, 
                    products.description, 
                    products.value, 
                    products.quantity, 
                    categories.name as 'category_name'
                  FROM products
                  INNER JOIN categories 
                  ON products.categories_id = categories.id
                  WHERE products.id = :product_id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":product_id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listProduct()
    {
        $query = "SELECT products.id, products.name, value, description, quantity, categories_id, categories.name AS category_name 
              FROM products 
              INNER JOIN categories ON products.categories_id = categories.id";

        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateProduct(): bool
    {
        $data = file_get_contents('php://input');
        $json_data = json_decode($data, true);

        $this->id = $json_data['id'];
        $this->name = $json_data['name'];
        $this->value = $json_data['value'];
        $this->quantity = $json_data['quantity'];
        $this->description = $json_data['description'];
        $this->categories_id = $json_data['categories_id'];

        $conn = Connect::getInstance();

        $checkQuery = "SELECT name FROM products WHERE name = :name AND id != :id";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bindParam(":name", $this->name);
        $checkStmt->bindParam(":id", $this->id);
        $checkStmt->execute();

        if ($checkStmt->rowCount() > 0) {
            $this->message = "Nome já cadastrado.";
            return false;
        }

        $query = "UPDATE products 
                  SET name = :name, 
                      value = :value, 
                      quantity = :quantity, 
                      description = :description, 
                      categories_id = :categories_id 
                  WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":categories_id", $this->categories_id);

        try {
            $stmt->execute();
            $this->message = "Produto Atualizado com sucesso.";
            return true;
        } catch (PDOException $e) {
            $this->message = "Erro ao Atualizar o produto: " . $e->getMessage();
            return false;
        }
    }




    public function deleteProduct(int $id): bool
    {

        $conn = Connect::getInstance();

        $checkQuery = "SELECT id FROM products WHERE id = :id";

        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bindParam(":id", $id);
        $checkStmt->execute();

        if ($checkStmt->rowCount() === 0) {
            $this->message = "Produto não encontrado.";
            return false;
        }

        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);

        try {
            $stmt->execute();
            $this->message = "Produto Excluido com sucesso ";
            return true;
        } catch (PDOException) {
            $this->message = "Erro ao excluir o produto: ";
            return false;
        }
    }



    public function insert(): ?int
    {

        $conn = Connect::getInstance();


        $query = "SELECT * FROM products WHERE name LIKE :name";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $this->message = "Produto já cadastrado!";
            return false;
        }

        $query = "INSERT INTO `products` (name, value, quantity, description, categories_id) 
                  VALUES (:name, :value, :quantity, :description, :categories_id)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":categories_id", $this->categories_id);

        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException) {
            $this->message = "Por favor, informe todos os campos";
            return false;
        }
    }
}
