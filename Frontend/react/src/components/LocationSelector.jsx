import React, { useEffect, useState, useMemo } from 'react';
import axios from 'axios';
import Select from 'react-select';

const BASE_URL = "http://localhost:8000/api";

const LocationSelector = ({ onSelect }) => {
  const [countries, setCountries] = useState([]);
  const [cities, setCities] = useState([]);
  const [selectedCountry, setSelectedCountry] = useState(null);
  const [selectedCity, setSelectedCity] = useState(null);

  useEffect(() => {
    axios.get(`${BASE_URL}/countries`)
      .then((res) => setCountries(res.data))
      .catch((err) => console.error('Error cargando países:', err));
  }, []);

  useEffect(() => {
    if (!selectedCountry) {
      setCities([]);
      setSelectedCity(null);
      return;
    }

    setSelectedCity(null);
    axios.get(`${BASE_URL}/cities/${selectedCountry.value}`)
      .then((res) => setCities(res.data || []))
      .catch((err) => {
        console.error('Error cargando ciudades:', err);
        setCities([]);
      });
  }, [selectedCountry]);

  useEffect(() => {
    if (selectedCountry && selectedCity) {
      onSelect(selectedCountry.code, selectedCity.label);
    }
  }, [selectedCity]);

  const countryOptions = useMemo(() =>
    countries.map((c) => ({
      value: c.id,
      label: c.name,
      code: c.code,
    })), [countries]);

  const cityOptions = useMemo(() =>
    cities.map((c) => ({
      value: c.id,
      label: c.name,
    })), [cities]);

  return (
    <div className="p-4 bg-white rounded shadow-md w-full max-w-md mx-auto">
      <label className="block mb-2 font-bold">País</label>
      <Select
        options={countryOptions}
        value={selectedCountry}
        onChange={setSelectedCountry}
        placeholder="Selecciona un país"
        className="mb-4"
        isSearchable
      />

      <label className="block mb-2 font-bold">Ciudad</label>
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
      />
    </div>
  );
};

export default React.memo(LocationSelector);
