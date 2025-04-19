import React, { useEffect, useState } from 'react';
import axios from 'axios';

const LocationSelector = ({ onSelect }) => {
  const [countries, setCountries] = useState([]);
  const [cities, setCities] = useState([]);
  const [selectedCountry, setSelectedCountry] = useState('');
  const [selectedCity, setSelectedCity] = useState('');

  useEffect(() => {
    axios.get('http://localhost:8000/api/countries')
      .then(response => setCountries(response.data))
      .catch(error => console.error('Error cargando países:', error));
  }, []);

  useEffect(() => {
    if (selectedCountry) {
      axios.get(`http://localhost:8000/api/cities/${selectedCountry}`)
        .then(response => setCities(response.data))
        .catch(error => console.error('Error cargando ciudades:', error));
    } else {
      setCities([]);
    }
  }, [selectedCountry]);

  useEffect(() => {
    if (selectedCity && selectedCountry) {
      onSelect(selectedCountry, selectedCity);
    }
    // No incluyas onSelect si no es una función que cambia cada vez
  }, [selectedCity, selectedCountry]);
  

  return (
    <div className="p-4">
      <label className="block mb-2 font-bold">País</label>
      <select
        className="border p-2 w-full mb-4"
        value={selectedCountry}
        onChange={(e) => {
          setSelectedCountry(e.target.value);
          setSelectedCity(''); // resetear ciudad
        }}
      >
        <option value="">-- Selecciona un país --</option>
        {countries.map((country) => (
          <option key={country.id} value={country.id}>
            {country.name}
          </option>
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
          <option key={city.id} value={city.id}>
            {city.name}
          </option>
        ))}
      </select>
    </div>
  );
};

export default LocationSelector;
