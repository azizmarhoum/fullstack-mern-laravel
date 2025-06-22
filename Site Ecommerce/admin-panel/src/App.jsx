import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { ThemeProvider, createTheme } from '@mui/material';
import CssBaseline from '@mui/material/CssBaseline';
import DashboardPage from './pages/DashboardPage';
import OrderDetailsPage from './pages/OrderDetailsPage';

const theme = createTheme({
  palette: {
    mode: 'light',
    primary: {
      main: '#1976d2',
    },
    secondary: {
      main: '#dc004e',
    },
  },
});

function App() {
  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <Router>
        <Routes>
          <Route path="/" element={<DashboardPage />} />
          <Route path="/orders/:orderId" element={<OrderDetailsPage />} />
        </Routes>
      </Router>
    </ThemeProvider>
  );
}

export default App;
