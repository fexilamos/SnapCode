import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

import Dashboard from './pages/Dashboard';
import Gestao from './pages/Gestao';
import Eventos from './pages/Eventos';
import Calendario from './pages/Calendario';

import './components/Sidebar.css';

const root = createRoot(document.getElementById('app'));

root.render(
    <BrowserRouter>
        <Routes>
            <Route path="/" element={<Dashboard />} />
            <Route path="/gestao" element={<Gestao />} />
            <Route path="/eventos" element={<Eventos />} />
            <Route path="/calendario" element={<Calendario />} />
        </Routes>
    </BrowserRouter>
);
