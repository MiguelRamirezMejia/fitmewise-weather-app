import React, { useEffect, useState } from 'react';
import axios from 'axios';

const BASE_URL = "http://localhost:8000/api";

const LocationSelector = ({ onSelect }) => {
  const [countries, setCountries] = useState([]);
  const [cities, setCities] = useState([]);
  const [selectedCountry, setSelectedCountry] = useState('');
  const [selectedCity, setSelectedCity] = useState('');

  // Cargar países al montar
  useEffect(() => {
    axios.get(`${BASE_URL}/countries`)
      .then(response => setCountries(response.data))
      .catch(error => console.error('Error cargando países:', error));
  }, []);

  // Cargar ciudades al cambiar país
  useEffect(() => {
    if (selectedCountry) {
      axios.get(`${BASE_URL}/cities/${selectedCountry}`)
        .then(response => setCities(response.data))
        .catch(error => console.error('Error cargando ciudades:', error));
    } else {
      setCities([]);
    }
  }, [selectedCountry]);

  // Llamar a onSelect solo cuando se tiene una ciudad y país válidos
  useEffect(() => {
    // Evitar ejecutar si aún no se han cargado los datos necesarios
    if (!selectedCountry || !selectedCity || countries.length === 0 || cities.length === 0) return;

    const country = countries.find(c => c.id === Number(selectedCountry));
    const city = cities.find(c => c.id === Number(selectedCity));

    if (country && city) {
      onSelect(country.code, city.name);
    }
  }, [selectedCountry, selectedCity]); // 🔥 Solo dependencias necesarias

  return (
    <div className="p-4 bg-white rounded shadow-md w-full max-w-md">
      <label className="block mb-2 font-bold">País</label>
      <select
        className="border p-2 w-full mb-4"
        value={selectedCountry}
        onChange={(e) => {
          setSelectedCountry(e.target.value);
          setSelectedCity('');
        }}
      >
        <option value="">-- Selecciona un país --</option>
        {countries.map((country) => (
          <option key={country.id} value={country.id}>{country.name}</option>
        ))}
      </select>

      <label className="block mb-2 font-bold">Ciudad</label>
      <select
        className="border p-2 w-full"
        value={selectedCity}
        onChange={(e) => setSelectedCity(e.target.value)}
        disabled={!selectedCountry}
      >
        <option value="">-- Selecciona una ciudad --</option>
        {cities.map((city) => (
          <option key={city.id} value={city.id}>{city.name}</option>
        ))}
      </select>
    </div>
  );
};

export default LocationSelector;
