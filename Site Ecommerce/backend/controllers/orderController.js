const Order = require('../models/Order');
const Cart = require('../models/Cart');
const mongoose = require('mongoose');

// Get user's orders
exports.getOrders = async (req, res) => {
  try {
    const orders = await Order.find({ userId: req.user._id })
      .sort({ createdAt: -1 });
    res.json(orders);
  } catch (error) {
    console.error('Error fetching orders:', error);
    res.status(500).json({ message: 'Error fetching orders', error: error.message });
  }
};

// Create new order
exports.createOrder = async (req, res) => {
  try {
    console.log('Received order request:', req.body);
    const { items, total } = req.body;
    
    if (!items || items.length === 0) {
      return res.status(400).json({ message: 'No items provided for order' });
    }

    if (!total || total <= 0) {
      return res.status(400).json({ message: 'Invalid total amount' });
    }

    // Validate each item
    for (const item of items) {
      if (!item.productId || !item.name || !item.price || !item.quantity || !item.image) {
        return res.status(400).json({ 
          message: 'Invalid item data', 
          item: item 
        });
      }
    }

    // Validate and transform items
    const orderItems = items.map(item => {
      try {
        // Generate a new ObjectId for the product
        const productId = new mongoose.Types.ObjectId();

        return {
          productId,
          name: item.name,
          price: Number(item.price),
          quantity: Number(item.quantity),
          image: item.image
        };
      } catch (error) {
        console.error('Error processing item:', item, error);
        throw new Error(`Invalid item data: ${error.message}`);
      }
    });

    console.log('Processed order items:', orderItems);

    const order = new Order({
      userId: req.user._id,
      items: orderItems,
      total: Number(total),
      status: 'pending'
    });

    // Validate the order before saving
    const validationError = order.validateSync();
    if (validationError) {
      console.error('Order validation error:', validationError);
      return res.status(400).json({ 
        message: 'Invalid order data', 
        error: validationError.message 
      });
    }

    await order.save();
    console.log('Order saved successfully:', order);
    res.status(201).json(order);
  } catch (error) {
    console.error('Error creating order:', error);
    res.status(500).json({ 
      message: 'Error creating order', 
      error: error.message,
      details: error.stack
    });
  }
};

// Get order by ID
exports.getOrderById = async (req, res) => {
  try {
    const order = await Order.findOne({
      _id: req.params.id,
      userId: req.user._id
    });

    if (!order) {
      return res.status(404).json({ message: 'Order not found' });
    }

    res.json(order);
  } catch (error) {
    console.error('Error fetching order:', error);
    res.status(500).json({ message: 'Error fetching order', error: error.message });
  }
}; 