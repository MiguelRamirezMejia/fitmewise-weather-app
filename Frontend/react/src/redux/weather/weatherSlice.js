import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import axios from 'axios';

const BASE_URL = "http://localhost:8000/api";

// Thunk para obtener el clima
export const fetchWeather = createAsyncThunk(
  'weather/fetchWeather',
  async ({ city, countryCode }, { rejectWithValue }) => {
    try {
      const response = await axios.get(`${BASE_URL}/weather/${countryCode}/${city}`);

      return response.data;
    } catch (error) {
      // Si la solicitud falla, retorna el error
      return rejectWithValue(error.response ? error.response.data : error.message);
    }
  }
);

const weatherSlice = createSlice({
  name: 'weather',
  initialState: {
    current: null,
    status: 'idle',
    error: null,
  },
  reducers: {},
  extraReducers: (builder) => {
    builder
      .addCase(fetchWeather.pending, (state) => {
        state.status = 'loading';
      })
      .addCase(fetchWeather.fulfilled, (state, action) => {
        state.status = 'succeeded';
        state.current = action.payload;
      })
      .addCase(fetchWeather.rejected, (state, action) => {
        state.status = 'failed';
        state.error = action.payload || action.error.message;
      });
  }
});

export default weatherSlice.reducer;
