
import React, { useState } from 'react';
import LocationSelector from './components/LocationSelector';
import WeatherResult from './components/WeatherResult';
import axios from 'axios';

const App = () => {
  const [weatherData, setWeatherData] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const fetchWeatherData = async (countryId, cityId) => {
    setLoading(true);
    setError(null);

    try {
      // Llamada a la API de clima usando los parámetros de país y ciudad
      const response = await axios.get(`http://localhost:8000/api/weather/${countryId}/${cityId}`);
      setWeatherData(response.data);  // Guardar los datos del clima en el estado
    } catch (err) {
      setError('No se pudo obtener el clima.');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100">
      <LocationSelector onSelect={fetchWeatherData} />
      
      {loading && <p>Cargando...</p>}
      {error && <p className="text-red-500">{error}</p>}
      {weatherData && <WeatherResult data={weatherData} />}
    </div>
  );
};

export default App;
