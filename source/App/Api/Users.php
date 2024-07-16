<?php

namespace Source\App\Api;

use Source\Models\User;


class Users extends Api
{
    public function listUsers ()
    {
        $users = new User();
        $this->back($users->selectAll());
    }

    public function createUser (array $data)
    {
        if(in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $user = new User(
            null,
            $data["name"],
            $data["email"],
            $data["password"]
        
        );

        $insertUser = $user->insert();

        if(!$insertUser){
            $this->back([
                "type" => "error",
                "message" => $user->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Usuário cadastrodo com sucesso!"
        ]);

    }
    public function loginUser (array $data)
    {
        if(in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        
        $user = new User();

        if(!$user->login(
            $data["email"],
            $data["password"]))
            {
                $this->back([
                    "type" => "error",
                    "message" => "Email ou senha inválidos"
                ]);
                return;
            }

            $this->back([
                "type" => "success",
                "message" => "Usuário logado!",
                "user" => [
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail()     
                                   
                ]
            ]);
        

    }
    public function loginAdmin (array $data)
    {
        if(in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        
        $user = new User();

        if(!$user->loginAdmin(
            $data["email"],
            $data["password"]))
            {
                $this->back([
                    "type" => "error",
                    "message" => "Email ou senha inválidos"
                ]);
                return;
            }

            $this->back([
                "type" => "success",
                "message" => "Administrador logado!",
                "user" => [
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail()
                                   
                ]
            ]);
        

    }
    
}