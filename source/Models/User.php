<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;
use Source\Core\Model;

class User extends Model
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $url;
    private $plans_id;
    private $usersCategories_id;
    private $message;

    public function __construct(
        int $id = null,
        string $name = null,
        string $email = null,
        string $password = null,
        string $url = null,
        int $plans_id = null,
        int $usersCategories_id = null

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->url = $url;
        $this->plans_id = $plans_id;
        $this->usersCategories_id = $usersCategories_id;
        $this->entity = "users";
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
    public function getPlans(): ?int
    {
        return $this->plans_id;
    }
    public function setPlans(?int $plans_id): void
    {
        $this->plans_id = $plans_id;
    }

    public function getCategoriesId(): ?int
    {
        return $this->plans_id;
    }
    public function setCategoriesId(?int $usersCategories_id): void
    {
        $this->usersCategories_id = $usersCategories_id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function listUsers()
    {
        $query = "SELECT 
                    users.id, 
                    users.name, 
                    users.email, 
                    users.password, 
                    users.url, 
                    users.usersCategories_id
                  FROM users";
                  
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    

    public function getUserById(int $id): array
    {
        $query = "SELECT 
                    users.id, 
                    users.name, 
                    users.email, 
                    users.password, 
                    users.url, 
                    userscategories.type as 'category_type'
                  FROM users
                  INNER JOIN userscategories 
                  ON users.usersCategories_id = userscategories.id
                  WHERE users.id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function insert(): ?int
    {

        $conn = Connect::getInstance();

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->message = "E-mail Inválido!";
            return false;
        }

        $query = "SELECT * FROM users WHERE email LIKE :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $this->message = "E-mail já cadastrado!";
            return false;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password, usersCategories_id) 
                  VALUES (:name, :email, :password, 1)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException) {
            $this->message = "Por favor, informe todos os campos!";
            return false;
        }
    }

    public function login(string $email, string $password): bool
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();

        if (!$result) {
            $this->message = "E-mail não cadastrado!";
            return false;
        }

        if (!password_verify($password, $result->password)) {
            $this->message = "Senha incorreta!";
            return false;
        }

        $this->setId($result->id);
        $this->setName($result->name);
        $this->setEmail($result->email);

        $this->message = "Usuário logado com sucesso!";

        session_start();

        $_SESSION['id'] = $result->id;
        $_SESSION['name'] = $result->name;
        $_SESSION['email'] = $result->email;

        return true;
    }
    public function loginAdmin(string $email, string $password): bool
    {
        $userCategory = 2;

        $query = "SELECT * FROM users WHERE email = :email AND usersCategories_id = :userCategory";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":userCategory", $userCategory);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();

        if (!$result) {
            $this->message = "Usuário não é um administrador!";
            return false;
        }

        if (!password_verify($password, $result->password)) {
            $this->message = "Senha incorreta!";
            return false;
        }

        $this->setId($result->id);
        $this->setName($result->name);
        $this->setEmail($result->email);

        $this->message = "Administrador logado!";

        return true;
    }


    public function update(): bool
    {
        $conn = Connect::getInstance();

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->message = "E-mail inválido!";
            return false;
        }

        $query = "SELECT * FROM users WHERE email LIKE :email AND id != :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $this->message = "E-mail já cadastrado!";
            return false;
        }

        $query = "UPDATE users 
                  SET name = :name, email = :email 
                  WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            $this->message = "Usuário atualizado com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar: {$exception->getMessage()}";
            return false;
        }
    }

    public function updatePassword(string $password, string $newPassword, string $confirmNewPassword): bool
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $result = $stmt->fetch();

        if (!password_verify($password, $result->password)) {
            $this->message = "Senha incorreta!";
            return false;
        }

        if ($newPassword != $confirmNewPassword) {
            $this->message = "As senhas não conferem!";
            return false;
        }

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE users 
                  SET password = :password 
                  WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":password", $newPassword);
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            $this->message = "Senha atualizada com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar: {$exception->getMessage()}";
            return false;
        }
    }
}
