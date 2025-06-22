const express = require('express');
const router = express.Router();
const adminController = require('../controllers/adminController');

// Admin order management routes
router.get('/orders', adminController.getAllOrders);
router.get('/orders/:id', adminController.getOrderById);
router.put('/orders/:id', adminController.updateOrder);
router.delete('/orders/:id', adminController.deleteOrder);

module.exports = router; 