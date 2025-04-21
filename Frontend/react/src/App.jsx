
// import React, { useState } from 'react';
// import LocationSelector from './components/LocationSelector';
// import WeatherResult from './components/WeatherResult';
// import axios from 'axios';

// const App = () => {
//   const [weatherData, setWeatherData] = useState(null);
//   const [loading, setLoading] = useState(false);
//   const [error, setError] = useState(null);

//   const fetchWeatherData = async (countryId, cityId) => {
//     setLoading(true);
//     setError(null);
  
//     try {
//       const response = await axios.get(`http://localhost:8000/api/weather/${cityId}/${countryId}`);
//       console.log("Datos obtenidos de la API:", response.data);  // Verifica los datos que devuelve la API
//       setWeatherData(response.data);  // Guardar los datos del clima en el estado
//     } catch (err) {
//       setError('No se pudo obtener el clima.');
//       console.error(err);
//     } finally {
//       setLoading(false);
//     }
//   };
  

//   return (
//     <div className="min-h-screen flex items-center justify-center bg-gray-100">
//       <LocationSelector onSelect={fetchWeatherData} />
      
//       {loading && <p>Cargando...</p>}
//       {error && <p className="text-red-500">{error}</p>}
//       {weatherData && <WeatherResult data={weatherData} />}
//     </div>
//   );
// };

// export default App;

// src/App.jsx

import React, { useEffect } from 'react';
import LocationSelector from './components/LocationSelector';
import WeatherResult from './components/WeatherResult';
import { useDispatch, useSelector } from 'react-redux';
import { fetchWeather } from './redux/weather/weatherSlice'; // Importar el thunk de Redux

const App = () => {
  const dispatch = useDispatch();
  const weather = useSelector((state) => state.weather);

  const handleSelect = (city, countryCode) => {
    dispatch(fetchWeather({ city, countryCode }));  // Llamar al thunk
  };

  return (
    <div className="App">
      <h1 className="text-center text-2xl">Consulta el clima</h1>
      <LocationSelector onSelect={handleSelect} />

      {/* Mostrar el estado de carga */}
      {weather.status === 'loading' && <p>Cargando clima...</p>}

      {/* Mostrar error si existe */}
      {weather.status === 'failed' && <p>Error: {weather.error}</p>}

      {/* Mostrar los resultados si están disponibles */}
      {weather.status === 'succeeded' && <WeatherResult data={weather.current} />}
    </div>
  );
};

export default App;
