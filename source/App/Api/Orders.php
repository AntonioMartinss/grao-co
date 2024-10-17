<?php

namespace Source\App\Api;

// Introduzindo token de segurança

use Source\Models\Order;
use Source\Core\TokenJWT;

error_reporting(E_ERROR | E_PARSE);

class Orders extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertOrder(array $data)
    {
        $this->auth();
        if (in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $order = new Order(
            null,
            $data["total"],
            $data["quantity"],
            $data["description"],
            $data["users_id"]
        );

        $insertOrder = $order->insert();

        if (!$insertOrder) {
            $this->back([
                "type" => "error",
                "message" => $order->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Pedido cadastrado com sucesso!"
        ]);
    }

    public function listOrder(array $data)
    {
        $order = new Order();
        $listOrder = $order->listOrder($data);
        $this->back($listOrder);
    }

    public function listById(array $data)
    {
        $service = new Order();
        $order = $service->getOrderById($data["id"]);
        $this->back($order);
    }

    public function updateOrder(array $data): void
    {
        $this->auth();

        $service = new Order(
            $data["id"],
            $data["total"],
            $data["quantity"],
            $data["description"],
            $data["users_id"]
        );

        $order = $service->updateOrder();
        if (!$order) {
            $this->back([
                "type" => "error",
                "message" => $service->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Pedido Atualizado com sucesso!"
        ]);
    }

    public function deleteOrder(array $data)
    {
        $this->auth();

        $service = new Order();
        $success = $service->deleteOrder($data["id"]);

        if (!$success) {
            $this->back([
                "type" => "error",
                "message" => $service->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Pedido excluído com sucesso!"
        ]);
    }
}
