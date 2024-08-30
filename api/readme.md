# API - Web Services

## Rotas e suas requisições

- #### Atualmente na plataforma estão disponíveis para produtos e categorias, 10 rotas no total

## Produtos

#### Listar todos os produtos inseridos no banco.
> $route->get("/list","Products:listProduct");
<br>
#### Listar por ID os produtos inseridos no banco.
> $route->get("/list/{id}","Products:listById");
<br>
#### Inserir produtos no banco.
> $route->post("/insert-product","Products:insertProduct");
<br>
#### Atualizar produtos no banco.
> $route->post("/update-product/{id}","Products:updateProduct");
obs: Em breve será adicionado a funcionalidade com PUT.
<br>
#### Deletar produto no banco.
> $route->delete("/delete-product/{id}","Products:deleteProduct");
<br>

## Categorias

#### Listar todas as categorias inseridas no banco.
> $route->get("/list","Categories:listCategory");;
<br>
#### Listar por ID as categorias inseridas no banco.
> $route->get("/list/{id}","Categories:listById");
<br>
#### Inserir categorias no banco.
> $route->post("/insert-category","Categories:insertCategory");
<br>
#### Atualizar categorias no banco.
> $route->post("/update-category/{id}","Categories:updateCategory");
obs: Em breve será adicionado a funcionalidade com PUT.
<br>
#### Deletar categoria no banco.
> $route->delete("/delete-category/{id}","Categories:deleteCategory");
<br>

## Exemplos de retornos após a requisição

- ####   try {
        $stmt->execute();
        $this->message = "Categoria Excluida com sucesso ";
        return true;
   #### } catch (PDOException) {
        $this->message = "Erro ao excluir a categoria: ";
        return false;
    }

## Retornos e Validação com Token JWT

- #### Atualmente, a maioria das rotas estão sendo protegidas por token, após o login é gerado um token que permite ser utilizado estas funcionalidades.

- #### Sucesso ao processar a requisição -> 200
- #### Acesso não autorizado -> 401
- #### Erro ao processar a requisição -> 404


