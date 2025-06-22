import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
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
  IconButton,
  Dialog,
  DialogTitle,
  DialogContent,
  DialogActions,
  Box,
  Alert,
  CircularProgress,
  Avatar
} from '@mui/material';
import { 
  Delete as DeleteIcon, 
  Visibility as VisibilityIcon,
  AccountCircle,
  MonetizationOn,
  CalendarToday
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

const DashboardPage = () => {
  const navigate = useNavigate();
  const [orders, setOrders] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [selectedOrder, setSelectedOrder] = useState(null);
  const [deleteDialogOpen, setDeleteDialogOpen] = useState(false);

  useEffect(() => {
    loadOrders();
  }, []);

  const loadOrders = async () => {
    try {
      setLoading(true);
      const { data } = await orderService.getAllOrders();
      setOrders(data);
      setError('');
    } catch (error) {
      setError('Échec du chargement des commandes. Veuillez réessayer.');
      console.error('Erreur lors du chargement:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleViewOrder = (order) => {
    navigate(`/orders/${order._id}`);
  };

  const handleDeleteOrder = (order) => {
    setSelectedOrder(order);
    setDeleteDialogOpen(true);
  };

  const confirmDelete = async () => {
    try {
      await orderService.deleteOrder(selectedOrder._id);
      setOrders(orders.filter(order => order._id !== selectedOrder._id));
      setDeleteDialogOpen(false);
    } catch (error) {
      setError('Échec de la suppression');
      console.error('Erreur lors de la suppression:', error);
    }
  };

  const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('fr-FR', options);
  };

  return (
    <Container maxWidth="xl" sx={{ 
      mt: 4, 
      mb: 6,
      minHeight: '80vh'
    }}>
      {/* En-tête */}
      <Box sx={{ mb: 4 }}>
        <Typography variant="h3" sx={{
          fontWeight: '700',
          color: '#2c3e50',
          background: 'linear-gradient(45deg, #4a9fe0, #6bb9f0)',
          WebkitBackgroundClip: 'text',
          WebkitTextFillColor: 'transparent',
          display: 'inline-block'
        }}>
          Tableau de Bord
        </Typography>
        <Typography variant="subtitle1" color="textSecondary" sx={{ mt: 1 }}>
          Gestion des commandes clients
        </Typography>
      </Box>

      {error && (
        <Alert severity="error" sx={{ mb: 3, borderRadius: '8px' }}>
          {error}
        </Alert>
      )}

      {/* Contenu principal */}
      <GradientPaper>
        <TableContainer>
          <Table>
            <TableHead>
              <TableRow sx={{
                background: 'linear-gradient(90deg, #4a9fe0, #6bb9f0)'
              }}>
                <StyledTableCell sx={{ color: 'white !important' }}>ID Commande</StyledTableCell>
                <StyledTableCell sx={{ color: 'white !important' }}>
                  <Box sx={{ display: 'flex', alignItems: 'center' }}>
                    <CalendarToday sx={{ mr: 1, fontSize: '18px' }} /> Date
                  </Box>
                </StyledTableCell>
                <StyledTableCell sx={{ color: 'white !important' }}>
                  <Box sx={{ display: 'flex', alignItems: 'center' }}>
                    <AccountCircle sx={{ mr: 1, fontSize: '18px' }} /> Client
                  </Box>
                </StyledTableCell>
                <StyledTableCell sx={{ color: 'white !important' }}>
                  <Box sx={{ display: 'flex', alignItems: 'center' }}>
                    <MonetizationOn sx={{ mr: 1, fontSize: '18px' }} /> Montant
                  </Box>
                </StyledTableCell>
                <StyledTableCell sx={{ color: 'white !important' }}>Actions</StyledTableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {loading ? (
                <TableRow>
                  <TableCell colSpan={5} align="center" sx={{ py: 5 }}>
                    <CircularProgress size={60} sx={{ color: '#4a9fe0' }} />
                    <Typography variant="h6" sx={{ mt: 2, color: '#4a9fe0' }}>
                      Chargement des commandes...
                    </Typography>
                  </TableCell>
                </TableRow>
              ) : orders.length === 0 ? (
                <TableRow>
                  <TableCell colSpan={5} align="center" sx={{ py: 5 }}>
                    <img 
                      src="https://cdn.dribbble.com/users/1192256/screenshots/6290585/no-data.png" 
                      alt="Aucune commande" 
                      style={{ height: '150px', marginBottom: '20px', opacity: 0.7 }}
                    />
                    <Typography variant="h6" color="textSecondary">
                      Aucune commande trouvée
                    </Typography>
                  </TableCell>
                </TableRow>
              ) : (
                orders.map((order) => (
                  <StyledTableRow key={order._id} hover>
                    <TableCell>
                      <Typography variant="body2" sx={{ fontWeight: '500' }}>
                        #{order._id.substring(0, 8)}
                      </Typography>
                    </TableCell>
                    <TableCell>
                      <Typography variant="body2">
                        {formatDate(order.createdAt)}
                      </Typography>
                    </TableCell>
                    <TableCell>
                      <Box sx={{ display: 'flex', alignItems: 'center', gap: 1.5 }}>
                        <Avatar sx={{ 
                          bgcolor: '#4a9fe0', 
                          width: 32, 
                          height: 32,
                          fontSize: '0.875rem'
                        }}>
                          {order.userId?.name?.charAt(0) || 'A'}
                        </Avatar>
                        <Box>
                          <Typography variant="subtitle2" sx={{ fontWeight: '600' }}>
                            {order.userId?.name || 'Invité'}
                          </Typography>
                          <Typography variant="caption" color="textSecondary">
                            {order.userId?.email || 'N/A'}
                          </Typography>
                        </Box>
                      </Box>
                    </TableCell>
                    <TableCell sx={{ fontWeight: '600' }}>
                      {order.total.toFixed(2)} DH
                    </TableCell>
                    <TableCell>
                      <Box sx={{ display: 'flex', gap: 1 }}>
                        <IconButton 
                          onClick={() => handleViewOrder(order)}
                          sx={{ 
                            color: '#4a9fe0',
                            '&:hover': { 
                              backgroundColor: 'rgba(74, 159, 224, 0.1)' 
                            }
                          }}
                        >
                          <VisibilityIcon />
                        </IconButton>
                        <IconButton 
                          onClick={() => handleDeleteOrder(order)}
                          sx={{ 
                            color: '#e74c3c',
                            '&:hover': { 
                              backgroundColor: 'rgba(231, 76, 60, 0.1)' 
                            }
                          }}
                        >
                          <DeleteIcon />
                        </IconButton>
                      </Box>
                    </TableCell>
                  </StyledTableRow>
                ))
              )}
            </TableBody>
          </Table>
        </TableContainer>
      </GradientPaper>

      {/* Dialogue de confirmation de suppression */}
      <Dialog 
        open={deleteDialogOpen} 
        onClose={() => setDeleteDialogOpen(false)}
        PaperProps={{
          sx: {
            borderRadius: '12px',
            background: 'linear-gradient(145deg, #e6f3ff, #ffffff)',
            boxShadow: '0 8px 24px rgba(31, 38, 135, 0.15)',
            minWidth: '400px'
          }
        }}
      >
        <DialogTitle sx={{ 
          background: 'linear-gradient(90deg, #4a9fe0, #6bb9f0)',
          color: 'white',
          fontWeight: '600'
        }}>
          Confirmer la suppression
        </DialogTitle>
        <DialogContent sx={{ p: 3 }}>
          <Box sx={{ display: 'flex', alignItems: 'center', mb: 2 }}>
            <Avatar sx={{ 
              bgcolor: '#e74c3c', 
              color: 'white',
              mr: 2
            }}>
              <DeleteIcon />
            </Avatar>
            <Typography variant="h6">
              Supprimer la commande #{selectedOrder?._id.substring(0, 8)}
            </Typography>
          </Box>
          <Typography>
            Voulez-vous vraiment supprimer définitivement cette commande ? Cette action est irréversible.
          </Typography>
          {selectedOrder && (
            <Box sx={{ 
              mt: 2,
              p: 2,
              backgroundColor: 'rgba(231, 76, 60, 0.05)',
              borderRadius: '8px',
              borderLeft: '4px solid #e74c3c'
            }}>
              <Typography variant="subtitle2" sx={{ fontWeight: '600' }}>
                Détails de la commande:
              </Typography>
              <Typography variant="body2">
                Client: {selectedOrder.userId?.name || 'Invité'}
              </Typography>
              <Typography variant="body2">
                Montant: {selectedOrder.total.toFixed(2)} DH
              </Typography>
              <Typography variant="body2">
                Date: {formatDate(selectedOrder.createdAt)}
              </Typography>
            </Box>
          )}
        </DialogContent>
        <DialogActions sx={{ p: 2 }}>
          <Button 
            onClick={() => setDeleteDialogOpen(false)}
            sx={{
              color: '#4a9fe0',
              fontWeight: '600',
              '&:hover': {
                backgroundColor: 'rgba(74, 159, 224, 0.1)'
              }
            }}
          >
            Annuler
          </Button>
          <Button 
            onClick={confirmDelete} 
            sx={{
              background: 'linear-gradient(45deg, #e74c3c 30%, #ff6659 90%)',
              color: 'white',
              fontWeight: '600',
              borderRadius: '8px',
              px: 3,
              '&:hover': {
                background: 'linear-gradient(45deg, #d63c2c 30%, #e65548 90%)',
              }
            }}
          >
            Supprimer
          </Button>
        </DialogActions>
      </Dialog>
    </Container>
  );
};

export default DashboardPage;