<?php

namespace Source\App\Api;

// Introduzindo token de segurança

use Source\Models\Category;
use Source\Core\TokenJWT;

class Categories extends Api
{
   
    public function insertCategory (array $data)
    {
        if(in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $category = new Category(
            null,
            $data["name"],
        );

        $insertcategory = $category->insert();

        if(!$insertcategory){
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
        // quando a rota não necessita de autenticação, não evoca o método $this->auth()
        $category = new Category();
        $listcategories = $category->listCategory($data["id"]);
        $this->back($listcategories);
    }
    
    public function listById(array $data)
{
    $service = new Category();
    $category = $service->getCategoryById($data["id"]);
    $this->back($category);
}
public function updateCategory(array $data)
{
    $service = new Category(
        $data["id"],
            $data["name"]
    );
    $category = $service->updateCategory();
    //$this->back($product);
    var_dump($category);
}

public function deleteCategory(array $data)
{
    $service = new Category();
    $success = $service->deleteCategory($data["id"]);
    
    if(!$success){
        $this->back([
            "type" => "error",
            "message" => $service->getMessage()
        ]);
        return;
    }

    $this->back([
        "type" => "success",
        "message" => "Categoria Excluida com sucesso!"
    ]);
}
    
}