import { useState } from 'react';

const WeatherForm = ({ onSearch }) => {
  const [city, setCity] = useState('');
  const [country, setCountry] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!city || !country) return;
    onSearch(city, country);
  };

  return (
    <form onSubmit={handleSubmit} className="flex flex-col gap-4 p-4">
      <input
        type="text"
        placeholder="Ciudad"
        value={city}
        onChange={(e) => setCity(e.target.value)}
        className="border p-2 rounded"
      />
      <input
        type="text"
        placeholder="Código del país (ej. CO, US)"
        value={country}
        onChange={(e) => setCountry(e.target.value)}
        className="border p-2 rounded"
      />
      <button type="submit" className="bg-blue-600 text-white p-2 rounded">
        Consultar Clima
      </button>
    </form>
  );
};

export default WeatherForm;
