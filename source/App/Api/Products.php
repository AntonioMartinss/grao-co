<?php

namespace Source\App\Api;

// Introduzindo token de segurança

use Source\Models\Product;
use Source\Core\TokenJWT;
error_reporting(E_ERROR | E_PARSE);
class Products extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertProduct(array $data)
    {
       // $this->auth();

        if (in_array("", $data)) {
            $this->back([
                "type" => "warning",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $product = new Product(
            null,
            $data["name"],
            $data["value"],
            $data["description"],
            $data["quantity"],           
            $data["categories_id"]
        );

        $insertProduct = $product->insert();

        if (!$insertProduct) {
            $this->back([
                "type" => "error",
                "message" => $product->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Produto cadastrado com sucesso!"
        ]);
    }

    public function listProduct()
    {
        $product = new Product();
        $listProducts = $product->listProduct();
        $this->back($listProducts);
    }

    public function listById(array $data)
    {
        $service = new Product();
        $product = $service->getProductById($data["id"]);
        $this->back($product);
    }

    public function updateProduct(array $data) : void
    {
        //$this->auth();

        $service = new Product(
            $data["id"],
            $data["name"],
            $data["value"],
            $data["description"],
            $data["quantity"],
            $data["categories_id"]
        );
        
        $product = $service->updateProduct();
        if (!$product) {
            $this->back([
                "type" => "error",
                "message" => $service->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Produto Atualizado com sucesso!"
        ]);
    }

    public function deleteProduct(array $data)
    {
       // $this->auth();

        $service = new Product();
        $success = $service->deleteProduct($data["id"]);

        if (!$success) {
            $this->back([
                "type" => "error",
                "message" => $service->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Produto excluído com sucesso!"
        ]);
    }
}
