import axios from 'axios';

const API_URL = 'http://localhost:5000/api';

const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json'
  }
});

// Order services
export const orderService = {
  getAllOrders: () => api.get('/admin/orders'),
  getOrderById: (orderId) => api.get(`/admin/orders/${orderId}`),
  updateOrderStatus: (orderId, status) => api.put(`/admin/orders/${orderId}`, { status }),
  deleteOrder: (orderId) => api.delete(`/admin/orders/${orderId}`)
};

export default api; 