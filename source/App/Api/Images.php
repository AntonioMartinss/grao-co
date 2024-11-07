<?php

namespace Source\App\Api;

use Source\Core\TokenJWT;
use Source\Models\Image;
use Source\Support\ImageUploader;

class Images extends Api
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function insertPhoto(array $data)
    {

        $imageUploader = new ImageUploader();
        $path = (!empty($_FILES["path"]["name"]) ? $_FILES["path"] : null);
        $this->auth();

        if (!$path) {
            $this->back([
                "type" => "error",
                "message" => "Por favor, envie uma foto do tipo JPG ou JPEG"
            ]);
            return;
        }

        $upload = $imageUploader->upload($path);

        $image = new Image(
            path: $upload,
            products_id: $data["products_id"]
        );

        if (!$image->insert()) {
            $this->back([
                "type" => "error",
                "message" => $image->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => $image->getMessage()
        ]);

    }

    
}