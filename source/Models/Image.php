<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;
use Source\Core\Model;


class Image extends Model
{
    private $id;
    private $path;
    private $products_id;
    private $message;

    public function __construct(
        int $id = null,
        string $path = null,
        int $products_id = null

    ) {
        $this->id = $id;
        $this->path = $path;
        $this->products_id = $products_id;
        $this->entity = "images";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): void
    {
        $this->path = $path;
    }
    public function getProductsId(): ?int
    {
        return $this->products_id;
    }

    public function setProductsId(?int $products_id): void
    {
        $this->products_id = $products_id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function insert (): bool
    {
       
        $query = "INSERT INTO images (path, products_id) 
                  VALUES (:path, :products_id)";

        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":path", $this->path);
        $stmt->bindParam(":products_id", $this->products_id);

        try {
            $stmt->execute();
            $this->message = "Foto inserida com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar: {$exception->getMessage()}";
            return false;
        }

    }
}
