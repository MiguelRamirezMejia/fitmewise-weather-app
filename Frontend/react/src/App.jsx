// src/App.jsx

import React, { useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import LocationSelector from "./components/LocationSelector";
import WeatherResult from "./components/WeatherResult";
import Sidebar from "./components/sidebar";
import { fetchWeather } from "./redux/weather/weatherSlice";

const App = () => {
  const [isOpen, setIsOpen] = useState(true); // Control del sidebar
  const dispatch = useDispatch();
  const weather = useSelector((state) => state.weather);

  const handleSelect = (city, countryCode) => {
    dispatch(fetchWeather({ city, countryCode }));
  };

  return (
    <div className="flex min-h-screen bg-gray-100">
      {/* Botón flotante para abrir el Sidebar si está cerrado */}
      {!isOpen && (
        <button
          onClick={() => setIsOpen(true)}
          className="fixed top-4 left-4 z-40 bg-blue-600 text-black px-3 py-2 rounded shadow"
        >
          ☰
        </button>
      )}

      {/* Sidebar */}
      <Sidebar isOpen={isOpen} setIsOpen={setIsOpen} />

      {/* Contenido principal */}
      <div
        className={`flex-1 transition-all duration-300 ${
          isOpen ? "ml-64" : "ml-0 pl-20"
        } p-6`}
      >
        <h1 className="text-2xl font-bold mb-4 text-center">Consulta el clima</h1>
        <LocationSelector onSelect={handleSelect} />

        {/* Contenedor con ancho fijo */}
        <div className="max-w-5xl w-full mx-auto mt-6">
          {/* Mantener espacio para resultados */}
          <div className="flex flex-col items-center space-y-4">
            {weather.status === "loading" && (
              <div className="w-full p-6 bg-white rounded-2xl shadow-lg animate-pulse">
                <h2 className="text-2xl font-bold text-center text-gray-300">
                  Cargando clima...
                </h2>
              </div>
            )}

            {weather.status === "failed" && (
              <div className="w-full p-6 bg-white rounded-2xl shadow-lg">
                <p className="text-center text-red-500">Error: {weather.error}</p>
              </div>
            )}

            {weather.status === "succeeded" && (
              <WeatherResult data={weather.current} />
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export default App;
