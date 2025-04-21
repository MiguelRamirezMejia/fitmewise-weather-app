const WeatherResult = ({ data }) => {
  if (!data) return null;

  console.log("teste");  // Verifica que los datos lleguen correctamente

  return (
    <div className="p-4">
      <h2 className="text-xl font-bold mb-2">
        Clima en {data.ciudad}, {data.pais}
      </h2>
      <div className="flex items-center gap-4 mb-4">
        <img src={data.icono_actual} alt="icono clima" />
        <div>
          <p>Temperatura: {data.temperatura_actual}</p>
          <p>Fahrenheit: {data.temperatura_actual_fahrenheit}</p>
          <p>Estado: {data.estado_actual}</p>
          <p><strong>Recomendación:</strong> {data.recomendacion_actual}</p>
        </div>
      </div>

      <h3 className="text-lg font-semibold mb-2">Pronóstico 5 días:</h3>
      <ul className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {data.pronostico_5_dias.map((dia, index) => (
          <li key={index} className="border p-3 rounded shadow">
            <p><strong>Fecha:</strong> {new Date(dia.fecha).toLocaleDateString()}</p> {/* Convertir fecha a formato legible */}
            <img src={dia.icono} alt="icono clima" />
            <p>{dia.temperatura} / {dia.temperatura_fahrenheit}</p>
            <p>Estado: {dia.estado}</p>
            <p><strong>Recomendación:</strong> {dia.recomendacion}</p>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default WeatherResult;
