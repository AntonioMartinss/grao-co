import HttpClientBase from './HttpClientBase.js';

export class HttpService extends HttpClientBase {
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
    async updateProduct(id) {
        return this.put('/update-product/:id', { id: id });
    }
    async deleteProduct(id) {
        return this.put('/delete-product/:id', { id: id });
    }


// async getServicesByName(serviceName) {
    //     //console.log()
    //     return this.get(`/list-by-name/name/:name`,serviceName);
    // }

    // async getServicesByCategory(category_id) {
    //     return this.get('/list-by-category/category/:id', {id: category_id});
    // }
    /*

    async deleteService(serviceId) {
        return this.delete(`/services/${serviceId}`);
    }

    // Exemplo com FormData
    async uploadServiceImage(serviceId, imageFile) {
        const formData = new FormData();
        formData.append('image', imageFile);
        return this.post(`/services/${serviceId}/image`, formData);
    }*/
}