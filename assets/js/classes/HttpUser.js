import HttpClientBase from './HttpClientBase.js';

export class HttpUser extends HttpClientBase {
    constructor() {
        super(`http://localhost/grao-co/api/users`);
    }

    async createUser(userData) {
        return this.post('/', userData);
    }
    async loginUser(data) {
        return this.post('/login', data);
    }
    async loginAdmin(data) {
        return this.post('/admin', data);
    }
    async list(data) {
        return this.get('/list', data);
    }
    async me(data) {
        return this.get('/me', data);
    } 
    async update(userId,data) {
        return this.put(`/update/${userId}`, data);
    }



}