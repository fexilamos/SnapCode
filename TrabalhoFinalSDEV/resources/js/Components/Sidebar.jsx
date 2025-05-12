import React, { useState } from 'react';
import './Sidebar.css'; // Cria um ficheiro CSS para os estilos

export default function Sidebar() {
    const [isOpen, setIsOpen] = useState(true);

    return (
        <div className={`sidebar ${isOpen ? 'expanded' : 'collapsed'}`}>
            <div className="toggle" onClick={() => setIsOpen(!isOpen)}>
                ☰
            </div>
            <div className="logo">&lt;SNAP/&gt;</div>
            <nav>
                <a href="#">Dashboard</a>
                <div className="dropdown">
                    <span>Gestão</span>
                    {isOpen && (
                        <div className="submenu">
                            <a href="#">Gestão de Material</a>
                            <a href="#">Gestão de colaboradores</a>
                        </div>
                    )}
                </div>
                <a href="#">Eventos</a>
                <a href="#">Calendário</a>
            </nav>
        </div>
    );
}
