import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { orderService } from '../services/api';
import {
  Container,
  Typography,
  Paper,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Button,
  Box,
  Alert,
  CircularProgress,
  Avatar,
  Chip,
  Divider
} from '@mui/material';
import { 
  ArrowBack as ArrowBackIcon,
  LocalShipping,
  Payment,
  Description,
  Person,
  Email,
  CalendarToday,
  MonetizationOn
} from '@mui/icons-material';
import { styled } from '@mui/material/styles';

// Composants stylisés
const GradientPaper = styled(Paper)(({ theme }) => ({
  background: 'linear-gradient(145deg, #e6f3ff, #ffffff)',
  borderRadius: '12px',
  boxShadow: '0 4px 20px rgba(31, 38, 135, 0.1)',
  overflow: 'hidden',
}));

const StyledTableCell = styled(TableCell)(({ theme }) => ({
  fontWeight: '600',
  color: theme.palette.primary.dark,
  borderBottom: '1px solid rgba(0, 0, 0, 0.05)',
}));

const StyledTableRow = styled(TableRow)(({ theme }) => ({
  '&:nth-of-type(even)': {
    backgroundColor: 'rgba(230, 243, 255, 0.3)',
  },
  '&:hover': {
    backgroundColor: 'rgba(173, 216, 230, 0.15)',
  },
}));

const OrderDetailsPage = () => {
  const { orderId } = useParams();
  const navigate = useNavigate();
  const [order, setOrder] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    loadOrder();
  }, [orderId]);

  const loadOrder = async () => {
    try {
      setLoading(true);
      const { data } = await orderService.getOrderById(orderId);
      setOrder(data);
      setError('');
    } catch (error) {
      setError('Échec du chargement des détails de la commande');
      console.error('Erreur lors du chargement:', error);
    } finally {
      setLoading(false);
    }
  };

  const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('fr-FR', options);
  };

  if (loading) {
    return (
      <Container maxWidth="lg" sx={{ mt: 4, mb: 4, display: 'flex', justifyContent: 'center', alignItems: 'center', height: '80vh' }}>
        <CircularProgress size={60} sx={{ color: '#4a9fe0' }} />
      </Container>
    );
  }

  if (!order) {
    return (
      <Container maxWidth="lg" sx={{ mt: 4, mb: 4, textAlign: 'center' }}>
        <img 
          src="https://cdn.dribbble.com/users/1192256/screenshots/6290585/no-data.png" 
          alt="Commande introuvable" 
          style={{ height: '200px', marginBottom: '20px', opacity: 0.7 }}
        />
        <Typography variant="h5" color="textSecondary">
          Commande introuvable
        </Typography>
        <Button
          startIcon={<ArrowBackIcon />}
          onClick={() => navigate('/')}
          sx={{ mt: 3 }}
        >
          Retour aux commandes
        </Button>
      </Container>
    );
  }

  return (
    <Container maxWidth="lg" sx={{ mt: 4, mb: 6 }}>
      <Button
        startIcon={<ArrowBackIcon />}
        onClick={() => navigate('/')}
        sx={{ 
          mb: 3,
          color: '#4a9fe0',
          '&:hover': {
            backgroundColor: 'rgba(74, 159, 224, 0.1)'
          }
        }}
      >
        Retour aux commandes
      </Button>

      <Typography variant="h3" sx={{
        fontWeight: '700',
        color: '#2c3e50',
        background: 'linear-gradient(45deg, #4a9fe0, #6bb9f0)',
        WebkitBackgroundClip: 'text',
        WebkitTextFillColor: 'transparent',
        display: 'inline-block',
        mb: 3
      }}>
        Détails de la commande
      </Typography>

      {error && (
        <Alert severity="error" sx={{ mb: 3, borderRadius: '8px' }}>
          {error}
        </Alert>
      )}

      <GradientPaper sx={{ p: 4, mb: 4 }}>
        <Box sx={{ display: 'flex', justifyContent: 'space-between', flexWrap: 'wrap', gap: 3 }}>
          {/* Informations client */}
          <Box sx={{ flex: 1, minWidth: '300px' }}>
            <Typography variant="h5" sx={{ mb: 2, display: 'flex', alignItems: 'center', color: '#4a9fe0' }}>
              <Person sx={{ mr: 1 }} /> Informations client
            </Typography>
            <Box sx={{ pl: 3 }}>
              <Typography sx={{ mb: 1 }}>
                <strong>Nom:</strong> {order.userId?.name || 'Non spécifié'}
              </Typography>
              <Typography sx={{ mb: 1 }}>
                <strong><Email sx={{ fontSize: '16px', mr: 0.5 }} /> Email:</strong> {order.userId?.email || 'Non spécifié'}
              </Typography>
            </Box>
          </Box>

          {/* Informations commande */}
          <Box sx={{ flex: 1, minWidth: '300px' }}>
            <Typography variant="h5" sx={{ mb: 2, display: 'flex', alignItems: 'center', color: '#4a9fe0' }}>
              <Description sx={{ mr: 1 }} /> Informations commande
            </Typography>
            <Box sx={{ pl: 3 }}>
              <Typography sx={{ mb: 1 }}>
                <strong>N° commande:</strong> #{order._id.substring(0, 8)}
              </Typography>
              <Typography sx={{ mb: 1 }}>
                <strong><CalendarToday sx={{ fontSize: '16px', mr: 0.5 }} /> Date:</strong> {formatDate(order.createdAt)}
              </Typography>
              <Chip 
                label={order.status || 'en traitement'} 
                color="primary"
                size="small"
                sx={{ 
                  fontWeight: '600',
                  textTransform: 'capitalize',
                  mt: 1
                }}
              />
            </Box>
          </Box>

          {/* Informations paiement */}
          <Box sx={{ flex: 1, minWidth: '300px' }}>
            <Typography variant="h5" sx={{ mb: 2, display: 'flex', alignItems: 'center', color: '#4a9fe0' }}>
              <Payment sx={{ mr: 1 }} /> Paiement
            </Typography>
            <Box sx={{ pl: 3 }}>
              <Typography sx={{ mb: 1 }}>
                <strong>Méthode:</strong> {order.paymentMethod || 'Non spécifié'}
              </Typography>
              <Typography sx={{ mb: 1 }}>
                <strong><MonetizationOn sx={{ fontSize: '16px', mr: 0.5 }} /> Total:</strong> {order.total.toFixed(2)} DH
              </Typography>
            </Box>
          </Box>
        </Box>
      </GradientPaper>

      {/* Articles de la commande */}
      <GradientPaper sx={{ p: 3 }}>
        <Typography variant="h5" sx={{ mb: 3, display: 'flex', alignItems: 'center', color: '#4a9fe0' }}>
          <LocalShipping sx={{ mr: 1 }} /> Articles commandés
        </Typography>
        
        <TableContainer>
          <Table>
            <TableHead>
              <TableRow sx={{
                background: 'linear-gradient(90deg, #4a9fe0, #6bb9f0)'
              }}>
                <StyledTableCell sx={{ color: 'white !important' }}>Produit</StyledTableCell>
                <StyledTableCell sx={{ color: 'white !important' }} align="right">Prix unitaire</StyledTableCell>
                <StyledTableCell sx={{ color: 'white !important' }} align="right">Quantité</StyledTableCell>
                <StyledTableCell sx={{ color: 'white !important' }} align="right">Sous-total</StyledTableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {order.items.map((item, index) => (
                <StyledTableRow key={index}>
                  <TableCell>
                    <Box sx={{ display: 'flex', alignItems: 'center', gap: 2 }}>
                      <Avatar 
                        src={item.image} 
                        alt={item.name}
                        sx={{ width: 56, height: 56 }}
                      >
                        {item.name.charAt(0)}
                      </Avatar>
                      <Box>
                        <Typography variant="subtitle1" sx={{ fontWeight: '600' }}>{item.name}</Typography>
                        {item.description && (
                          <Typography variant="body2" color="textSecondary">{item.description}</Typography>
                        )}
                      </Box>
                    </Box>
                  </TableCell>
                  <TableCell align="right">{item.price.toFixed(2)} DH</TableCell>
                  <TableCell align="right">{item.quantity}</TableCell>
                  <TableCell align="right" sx={{ fontWeight: '600' }}>
                    {(item.price * item.quantity).toFixed(2)} DH
                  </TableCell>
                </StyledTableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>

        <Divider sx={{ my: 3 }} />

        <Box sx={{ display: 'flex', justifyContent: 'flex-end' }}>
          <Box sx={{ textAlign: 'right', width: '300px' }}>
            <Typography variant="body1" sx={{ mb: 1 }}>
              <strong>Sous-total:</strong> {(order.total * 0.8).toFixed(2)} DH
            </Typography>
            <Typography variant="body1" sx={{ mb: 1 }}>
              <strong>TVA (20%):</strong> {(order.total * 0.2).toFixed(2)} DH
            </Typography>
            <Typography variant="h5" sx={{ mt: 2, color: '#4a9fe0' }}>
              <strong>Total:</strong> {order.total.toFixed(2)} DH
            </Typography>
          </Box>
        </Box>
      </GradientPaper>
    </Container>
  );
};

export default OrderDetailsPage;