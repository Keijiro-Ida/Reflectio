import logo from './logo.svg';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import './App.css';
import Login from './pages/Login';
import Reflections from './pages/Reflections';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/reflections" element={<Reflections />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
