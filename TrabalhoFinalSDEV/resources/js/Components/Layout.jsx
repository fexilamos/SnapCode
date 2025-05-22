// resources/js/components/Layout.jsx
import React from 'react';
import Sidebar from './Sidebar';

export default function Layout({ children }) {
    return (
        <div style={{ display: 'flex' }}>
            <Sidebar />
            <main style={{ flexGrow: 1, padding: '20px' }}>
                {children}
            </main>
        </div>
    );
}
