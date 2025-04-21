import React from "react";

const Sidebar = ({ isOpen, setIsOpen }) => {
  return (
    <div
      className={`fixed top-0 left-0 h-full transition-transform duration-300 transform z-50 ${
        isOpen ? "translate-x-0" : "-translate-x-full"
      } bg-gray-800 text-white w-64 shadow-lg`}
    >
      <div className="p-4 flex justify-between items-center border-b border-gray-700">
        <h2 className="text-xl font-bold">Clima App</h2>
        {/* Botón de cerrar visible SIEMPRE */}
        <button
          onClick={() => setIsOpen(false)}
          className="text-white text-2xl hover:text-gray-400"
        >
          &times; {/* X de cerrar */}
        </button>
      </div>

      <nav className="mt-6">
        <ul>
          <li>
            <a href="/" className="block p-4 hover:bg-gray-700">
              Inicio
            </a>
          </li>
          <li>
            <a href="/otra-pagina" className="block p-4 hover:bg-gray-700">
              Otra Página
            </a>
          </li>
        </ul>
      </nav>
    </div>
  );
};

export default Sidebar;
