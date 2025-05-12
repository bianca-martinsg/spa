import axios from 'axios';

const API_URL = '/api/products';

export default {
    async fetchAll() {
        const response = await axios.get(API_URL);
        return response.data;
    },

    async save(productData) {
        const response = await axios.post(API_URL, productData);
        return response.data;
    }
};
