import React, { useState } from 'react';
import { FaHome, FaUsers, FaBox, FaCalendarAlt, FaBars } from 'react-icons/fa';
import './Sidebar.css';

export default function Sidebar() {
    const [isOpen, setIsOpen] = useState(true);

    return (
        <div className={`sidebar ${isOpen ? 'expanded' : 'collapsed'}`}>
            <div className="toggle" onClick={() => setIsOpen(!isOpen)}>
                <FaBars />
            </div>
            <div className="logo">{isOpen ? '<SNAP/>' : '</>'}</div>
            <nav>
                <a href="#" className="nav-item">
                    <FaHome className="icon" />
                    {isOpen && <span className="text">Dashboard</span>}
                </a>

                <div className="nav-item dropdown">
                    <FaUsers className="icon" />
                    {isOpen && (
                        <>
                            <span className="text">Gestão</span>
                            {/* <div className="submenu">
                                <a href="#">Gestão de Material</a>
                                <a href="#">Gestão de Colaboradores</a>
                            </div> */}
                        </>
                    )}
                </div>

                <a href="#" className="nav-item">
                    <FaBox className="icon" />
                    {isOpen && <span className="text">Eventos</span>}
                </a>

                <a href="#" className="nav-item">
                    <FaCalendarAlt className="icon" />
                    {isOpen && <span className="text">Calendário</span>}
                </a>
            </nav>
        </div>
    );
}
