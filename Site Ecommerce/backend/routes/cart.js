const express = require('express');
const router = express.Router();
const cartController = require('../controllers/cartController');
const auth = require('../middleware/auth');

// All cart routes require authentication
router.use(auth);

// Get user's cart
router.get('/', cartController.getCart);

// Add item to cart
router.post('/items', cartController.addToCart);

// Update cart item quantity
router.put('/items/:productId', cartController.updateCartItem);

// Remove item from cart
router.delete('/items/:productId', cartController.removeFromCart);

// Clear cart
router.delete('/', cartController.clearCart);

module.exports = router; 