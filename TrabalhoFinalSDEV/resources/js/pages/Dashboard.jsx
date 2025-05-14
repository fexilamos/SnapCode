import React from 'react';
import Layout from '../components/Layout';

export default function Dashboard() {
    return (
        <Layout>

            <h1 style={{ color: 'white', fontFamily: 'Helvetica, Arial, sans-serif' }}>Dashboard</h1>
            <p style={{ color: 'white', fontFamily: 'Helvetica, Arial, sans-serif' }}>Sistema de gestão de fotógrafos.</p>

            <div style={{ display: 'flex', justifyContent: 'space-around', marginTop: '20px' }}>
                <div style={{ backgroundColor: 'white', padding: '20px', borderRadius: '8px', width: '30%' }}>
                    <h2 style={{ color: 'black' }}>Gestão de Material</h2>
                    <p style={{ color: 'black' }}>Gerencie o material fotográfico.</p>
                </div>

                <div style={{ backgroundColor: 'white', padding: '20px', borderRadius: '8px', width: '30%' }}>
                    <h2 style={{ color: 'black' }}>Gestão de Colaboradores</h2>
                    <p style={{ color: 'black' }}>Gerencie os colaboradores.</p>
                </div>

                <div style={{ backgroundColor: 'white', padding: '20px', borderRadius: '8px', width: '30%' }}>
                    <h2 style={{ color: 'black' }}>Eventos</h2>
                    <p style={{ color: 'black' }}>Gerencie os eventos.</p>
                </div>


            </div>
        </Layout>
    );
}
