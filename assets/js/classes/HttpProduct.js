import HttpClientBase from './HttpClientBase.js';

export class HttpProduct extends HttpClientBase {
    constructor() {
        super(`http://localhost/grao-co/api/products`);
    }

    async listById(id) {
        return this.get('/list/:id', { id: id });
    }
    async listProduct() {
        return this.get('/list');
    }
    async insert(data) {
        return this.post('/insert', data);
    }
    async updateProduct(productId ,data) {
        return this.put(`/update-product/${productId}`, data);
    }
    async deleteProduct(productId){
        return this.delete(`/delete-product/:id`, {id: productId});
    }

}