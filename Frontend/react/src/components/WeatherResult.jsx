import React from 'react';

const WeatherResult = ({ data }) => {
  if (!data) return null;

  return (
    <div className="p-6 bg-white rounded-2xl shadow-lg max-w-5xl mx-auto mt-8">
      {/* Título principal */}
      <h2 className="text-2xl font-bold mb-6 text-center text-blue-700">
        Clima actual en {data.ciudad}, {data.pais}
      </h2>

      {/* Clima actual */}
      <div className="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8">
        <img
          src={data.icono_actual}
          alt="icono clima"
          className="w-24 h-24 object-contain"
        />
        <div className="text-lg space-y-2 text-gray-700">
          <p><strong>Temperatura:</strong> {data.temperatura_actual}</p>
          <p><strong>Fahrenheit:</strong> {data.temperatura_actual_fahrenheit}</p>
          <p><strong>Estado:</strong> {data.estado_actual}</p>
          <p className="text-blue-600"><strong>Recomendación:</strong> {data.recomendacion_actual}</p>
        </div>
      </div>

      {/* Pronóstico */}
      <h3 className="text-xl font-semibold mb-4 text-gray-800">Pronóstico de los próximos 5 días:</h3>
      <ul className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {data.pronostico_5_dias.map((dia, index) => (
          <li
            key={index}
            className="bg-blue-50 rounded-xl p-4 shadow hover:shadow-md transition duration-300"
          >
            <p className="text-sm text-gray-500 mb-1">
              <strong>Fecha:</strong> {new Date(dia.fecha).toLocaleDateString()}
            </p>
            <img
              src={dia.icono}
              alt="icono clima"
              className="w-16 h-16 mx-auto my-2"
            />
            <p className="text-center text-gray-700 font-medium">
              {dia.temperatura} / {dia.temperatura_fahrenheit}
            </p>
            <p className="text-center text-gray-600">{dia.estado}</p>
            <p className="mt-2 text-sm text-blue-600 text-center">
              <strong>💡 {dia.recomendacion}</strong>
            </p>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default WeatherResult;
