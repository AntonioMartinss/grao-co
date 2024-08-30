
# API - Web Services

## Rotas e Requisições

Atualmente, a plataforma disponibiliza 10 rotas no total para manipulação de produtos e categorias.

### Produtos

- **Listar todos os produtos inseridos no banco:**
  ```http
  GET /list
  ```
  - Controlador: `Products:listProduct`

- **Listar um produto por ID:**
  ```http
  GET /list/{id}
  ```
  - Controlador: `Products:listById`

- **Inserir um produto no banco:**
  ```http
  POST /insert-product
  ```
  - Controlador: `Products:insertProduct`

- **Atualizar um produto no banco:**
  ```http
  POST /update-product/{id}
  ```
  - Controlador: `Products:updateProduct`
  - **Nota:** Em breve será adicionada a funcionalidade com o método `PUT`.

- **Deletar um produto do banco:**
  ```http
  DELETE /delete-product/{id}
  ```
  - Controlador: `Products:deleteProduct`

### Categorias

- **Listar todas as categorias inseridas no banco:**
  ```http
  GET /list
  ```
  - Controlador: `Categories:listCategory`

- **Listar uma categoria por ID:**
  ```http
  GET /list/{id}
  ```
  - Controlador: `Categories:listById`

- **Inserir uma categoria no banco:**
  ```http
  POST /insert-category
  ```
  - Controlador: `Categories:insertCategory`

- **Atualizar uma categoria no banco:**
  ```http
  POST /update-category/{id}
  ```
  - Controlador: `Categories:updateCategory`
  - **Nota:** Em breve será adicionada a funcionalidade com o método `PUT`.

- **Deletar uma categoria do banco:**
  ```http
  DELETE /delete-category/{id}
  ```
  - Controlador: `Categories:deleteCategory`

## Exemplos de Retorno das Requisições

Aqui está um exemplo de como a aplicação lida com a exclusão de uma categoria:

```php
try {
    $stmt->execute();
    $this->message = "Categoria excluída com sucesso";
    return true;
} catch (PDOException $e) {
    $this->message = "Erro ao excluir a categoria: " . $e->getMessage();
    return false;
}
```

## Autenticação com Token JWT

A maioria das rotas está protegida por token JWT. Após o login, um token é gerado e deve ser utilizado para acessar essas funcionalidades.

- **Códigos de Status:**
  - Sucesso ao processar a requisição: **200**
  - Acesso não autorizado: **401**
  - Erro ao processar a requisição: **404**
