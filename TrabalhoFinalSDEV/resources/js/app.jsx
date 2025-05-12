import './bootstrap';

import Alpine from 'alpinejs';
import React from 'react';
import ReactDOM from 'react-dom/client';
import Sidebar from './components/Sidebar';

window.Alpine = Alpine;

Alpine.start();

ReactDOM.createRoot(document.getElementById('app')).render(
    <React.StrictMode>
        <Sidebar />
    </React.StrictMode>
);
