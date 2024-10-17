<?php

namespace Source\App\Api;

// Introduzindo token de segurança

use Source\Models\Category;
use Source\Core\TokenJWT;
error_reporting(E_ERROR | E_PARSE);
class Categories extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertCategory(array $data)
    {
        $this->auth();

        if (in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $category = new Category(
            null,
            $data["name"]
        );

        $insertCategory = $category->insert();

        if (!$insertCategory) {
            $this->back([
                "type" => "error",
                "message" => $category->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Categoria cadastrada com sucesso!"
        ]);
    }

    public function listCategory(array $data)
    {
        $category = new Category();
        $listCategories = $category->listCategory($data);
        $this->back($listCategories);
    }

    public function listById(array $data)
    {
        $service = new Category();
        $category = $service->getCategoryById($data["id"]);
        $this->back($category);
    }

    public function updateCategory(array $data): void
    {
        $this->auth();

        $service = new Category(
            $data["id"],
            $data["name"]
        );

        $category = $service->updateCategory();
        if (!$category) {
            $this->back([
                "type" => "error",
                "message" => $service->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Categoria Atualizada com sucesso!"
        ]);
    }

    public function deleteCategory(array $data)
    {
        $this->auth();

        $service = new Category();
        $success = $service->deleteCategory($data["id"]);

        if (!$success) {
            $this->back([
                "type" => "error",
                "message" => $service->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Categoria excluída com sucesso!"
        ]);
    }
}
