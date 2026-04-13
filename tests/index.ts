import { ApiService } from "../src/frontend/ApiService";

export const test = async () => {
    const api = new ApiService('http://localhost:3000');
    api.request('/hello').then(data => {
        console.log('API Response:', data);
    })
    .catch(err => {
        console.error('API Error:', err);
    });
}