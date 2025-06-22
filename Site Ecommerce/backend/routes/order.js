const express = require('express');
const router = express.Router();
const orderController = require('../controllers/orderController');
const auth = require('../middleware/auth');

// All order routes require authentication
router.use(auth);

// Get user's orders
router.get('/', orderController.getOrders);

// Create new order
router.post('/', orderController.createOrder);

// Get order by ID
router.get('/:id', orderController.getOrderById);

module.exports = router; 