import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8080', // LaravelのAPIサーバーURL
  withCredentials: true, // Laravel Sanctum用のCookieを送信するため
});

api.interceptors.request.use((config) => {
    const token = getCookieValue('XSRF-TOKEN');
    if (token) {
        config.headers['X-XSRF-TOKEN'] = decodeURIComponent(token);
    }
    return config;
});

function getCookieValue(name) {
const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
return match ? match[2] : null;
}

export default api;
