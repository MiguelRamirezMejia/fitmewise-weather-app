import React, { useEffect, useState } from 'react';
import axios from 'axios';
import Select from 'react-select';

const BASE_URL = "http://localhost:8000/api";

const LocationSelector = ({ onSelect }) => {
  const [countries, setCountries] = useState([]);
  const [cities, setCities] = useState([]);
  const [selectedCountry, setSelectedCountry] = useState(null);
  const [selectedCity, setSelectedCity] = useState(null);

  // Obtener países
  useEffect(() => {
    axios.get(`${BASE_URL}/countries`)
      .then((response) => {
        setCountries(response.data);
      })
      .catch((error) => {
        console.error('Error cargando países:', error);
      });
  }, []);

  // Cuando se cambia de país, limpiar ciudad y cargar nuevas ciudades
  useEffect(() => {
    if (!selectedCountry) {
      setCities([]);
      setSelectedCity(null);
      return;
    }

    setSelectedCity(null); // Limpiar ciudad anterior

    axios.get(`${BASE_URL}/cities/${selectedCountry.value}`)
      .then((response) => {
        setCities(response.data || []);
      })
      .catch((error) => {
        console.error('Error cargando ciudades:', error);
        setCities([]);
      });
  }, [selectedCountry]);

  // Enviar datos seleccionados al componente padre
  useEffect(() => {
    if (selectedCountry && selectedCity) {
      onSelect(selectedCountry.code, selectedCity.label);
    }
  }, [selectedCity]); // 🔥 Solo cuando cambia la ciudad (ya se eligió país antes)

  const countryOptions = countries.map((country) => ({
    value: country.id,
    label: country.name,
    code: country.code,
  }));

  const cityOptions = cities.map((city) => ({
    value: city.id,
    label: city.name,
  }));

  return (
    <div className="p-6 bg-white rounded-lg shadow-xl max-w-lg mx-auto space-y-6">
      <h2 className="text-2xl font-semibold text-center">Selecciona tu ubicación</h2>
      
      <div className="space-y-4">
        {/* Selección de país */}
        <div className="flex flex-col">
          <label className="text-lg font-medium mb-2">País</label>
          <Select
            options={countryOptions}
            value={selectedCountry}
            onChange={setSelectedCountry}
            placeholder="Selecciona un país"
            className="mb-4"
            isSearchable
            isClearable
            styles={{
              control: (base) => ({
                ...base,
                borderColor: '#e2e8f0',
                borderRadius: '0.375rem',
                boxShadow: 'none',
                '&:hover': {
                  borderColor: '#a0aec0',
                },
              }),
            }}
          />
        </div>

        {/* Selección de ciudad */}
        <div className="flex flex-col">
          <label className="text-lg font-medium mb-2">Ciudad</label>
          <Select
            options={cityOptions}
            value={selectedCity}
            onChange={setSelectedCity}
            placeholder="Selecciona una ciudad"
            isDisabled={!selectedCountry}
            noOptionsMessage={() =>
              !selectedCountry
                ? 'Selecciona un país primero'
                : 'No hay ciudades disponibles'
            }
            isSearchable
            isClearable
            styles={{
              control: (base) => ({
                ...base,
                borderColor: '#e2e8f0',
                borderRadius: '0.375rem',
                boxShadow: 'none',
                '&:hover': {
                  borderColor: '#a0aec0',
                },
              }),
            }}
          />
        </div>
      </div>
    </div>
  );
};

export default LocationSelector;
