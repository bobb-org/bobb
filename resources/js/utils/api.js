
const axios = require('axios');

const api = axios.create({
    baseURL:'/api/',
    headers: {'X-Requested-With': 'XMLHttpRequest', 'Content-Type':'application/json'},
    withCredentials: true,
})

export default api;
