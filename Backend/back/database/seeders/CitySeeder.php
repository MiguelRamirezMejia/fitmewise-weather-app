<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Country;

class CitySeeder extends Seeder
{
    public function run()
    {
        $countries = Country::all();

        // Añadir ciudades por país
        foreach ($countries as $country) {
            $cities = [
                'ES' => ['Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza', 'Málaga', 'Murcia', 'Palma', 'Las Palmas de Gran Canaria', 'Bilbao'],
                'CU' => ['Havana', 'Varadero', 'Santiago de Cuba', 'Camagüey', 'Holguín', 'Cienfuegos', 'Pinar del Río', 'Santa Clara', 'Guantánamo', 'Matanzas'],
                'AR' => ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata', 'San Miguel de Tucumán', 'Salta', 'Santa Fe', 'Mar del Plata', 'San Juan'],
                'MX' => ['Mexico City', 'Guadalajara', 'Monterrey', 'Puebla', 'Cancún', 'Mérida', 'Tijuana', 'León', 'Chihuahua', 'Toluca'],
                'BR' => ['São Paulo', 'Rio de Janeiro', 'Salvador', 'Brasília', 'Fortaleza', 'Belo Horizonte', 'Manaus', 'Curitiba', 'Recife', 'Porto Alegre'],
                'GB' => ['London', 'Manchester', 'Birmingham', 'Leeds', 'Glasgow', 'Liverpool', 'Edinburgh', 'Bristol', 'Sheffield', 'Leicester'],
                'IT' => ['Rome', 'Milan', 'Naples', 'Turin', 'Palermo', 'Genoa', 'Bologna', 'Florence', 'Venice', 'Verona'],
                'DE' => ['Berlin', 'Hamburg', 'Munich', 'Cologne', 'Frankfurt', 'Stuttgart', 'Düsseldorf', 'Dortmund', 'Essen', 'Leipzig'],
                'CA' => ['Toronto', 'Vancouver', 'Montreal', 'Calgary', 'Ottawa', 'Edmonton', 'Winnipeg', 'Quebec City', 'Hamilton', 'Kitchener'],
                'FR' => ['Paris', 'Marseille', 'Lyon', 'Toulouse', 'Nice', 'Nantes', 'Montpellier', 'Strasbourg', 'Bordeaux', 'Lille'],
                'AU' => ['Sydney', 'Melbourne', 'Brisbane', 'Perth', 'Adelaide', 'Gold Coast', 'Canberra', 'Hobart', 'Newcastle', 'Wollongong'],
                'IN' => ['New Delhi', 'Mumbai', 'Bengaluru', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad', 'Jaipur', 'Lucknow'],
                'CN' => ['Beijing', 'Shanghai', 'Guangzhou', 'Shenzhen', 'Chengdu', 'Hangzhou', 'Wuhan', 'Xi\'an', 'Tianjin', 'Chongqing'],
                'JP' => ['Tokyo', 'Osaka', 'Yokohama', 'Nagoya', 'Sapporo', 'Kobe', 'Fukuoka', 'Kawasaki', 'Saitama', 'Hiroshima'],
                'ZA' => ['Johannesburg', 'Cape Town', 'Durban', 'Pretoria', 'Port Elizabeth', 'Bloemfontein', 'East London', 'Polokwane', 'Nelspruit', 'Kimberley'],
                'NG' => ['Lagos', 'Abuja', 'Kano', 'Ibadan', 'Benin City', 'Maiduguri', 'Port Harcourt', 'Zaria', 'Aba', 'Kaduna'],
                'KR' => ['Seoul', 'Busan', 'Incheon', 'Daegu', 'Daejeon', 'Gwangju', 'Ulsan', 'Suwon', 'Changwon', 'Jeonju'],
                'RU' => ['Moscow', 'Saint Petersburg', 'Novosibirsk', 'Yekaterinburg', 'Nizhny Novgorod', 'Samara', 'Omsk', 'Kazan', 'Chelyabinsk', 'Rostov-on-Don'],
                'EG' => ['Cairo', 'Alexandria', 'Giza', 'Shubra El-Kheima', 'Port Said', 'Suez', 'Mansoura', 'Tanta', 'Aswan', 'Ismailia'],
                'KE' => ['Nairobi', 'Mombasa', 'Kisumu', 'Nakuru', 'Eldoret', 'Thika', 'Malindi', 'Meru', 'Nyeri', 'Kisii'],
                'PH' => ['Manila', 'Quezon City', 'Cebu City', 'Davao City', 'Taguig', 'Zamboanga City', 'Antipolo', 'Pasig', 'Cagayan de Oro', 'Iloilo City'],
                'ID' => ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Bekasi', 'Makassar', 'Tangerang', 'Depok', 'Palembang', 'Semarang'],
                'NG' => ['Lagos', 'Abuja', 'Kano', 'Ibadan', 'Benin City', 'Maiduguri', 'Port Harcourt', 'Zaria', 'Aba', 'Kaduna'],
                'US' => ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'San Jose'],
                'CL' => ['Santiago', 'Valparaíso', 'Concepción', 'La Serena', 'Antofagasta', 'Temuco', 'Rancagua', 'Talca', 'Iquique', 'Puerto Montt'],
                'PE' => ['Lima', 'Arequipa', 'Trujillo', 'Chiclayo', 'Piura', 'Cusco', 'Iquitos', 'Huancayo', 'Tacna', 'Pucallpa'],
                'VE' => ['Caracas', 'Maracaibo', 'Valencia', 'Barquisimeto', 'Maracay', 'Ciudad Guayana', 'Barcelona', 'Maturín', 'San Cristóbal', 'Cumaná'],
                'UY' => ['Montevideo', 'Salto', 'Paysandú', 'Las Piedras', 'Rivera', 'Maldonado', 'Tacuarembó', 'Melo', 'Mercedes', 'Artigas'],
                'EC' => ['Quito', 'Guayaquil', 'Cuenca', 'Santo Domingo', 'Machala', 'Durán', 'Portoviejo', 'Ambato', 'Manta', 'Loja'],
                'BO' => ['Santa Cruz de la Sierra', 'La Paz', 'El Alto', 'Cochabamba', 'Oruro', 'Sucre', 'Tarija', 'Potosí', 'Sacaba', 'Montero'],
                'PY' => ['Asunción', 'Ciudad del Este', 'San Lorenzo', 'Luque', 'Capiatá', 'Lambaré', 'Fernando de la Mora', 'Limpio', 'Ñemby', 'Encarnación'],
                'CR' => ['San José', 'Limón', 'Alajuela', 'Heredia', 'Puntarenas', 'Cartago', 'Liberia', 'San Carlos', 'Desamparados', 'Nicoya'],
                'GT' => ['Ciudad de Guatemala', 'Mixco', 'Villa Nueva', 'Quetzaltenango', 'Escuintla', 'Villa Canales', 'Petapa', 'San Juan Sacatepéquez', 'Chinautla', 'Chimaltenango'],
                'HN' => ['Tegucigalpa', 'San Pedro Sula', 'Choloma', 'La Ceiba', 'El Progreso', 'Choluteca', 'Comayagua', 'Puerto Cortés', 'La Lima', 'Danlí'],
                'NI' => ['Managua', 'León', 'Masaya', 'Chinandega', 'Matagalpa', 'Estelí', 'Granada', 'Jinotega', 'Bluefields', 'Ciudad Sandino'],
                'PA' => ['Ciudad de Panamá', 'San Miguelito', 'Colón', 'David', 'La Chorrera', 'Santiago de Veraguas', 'Chitré', 'Penonomé', 'Aguadulce', 'Arraiján'],
                'SV' => ['San Salvador', 'Santa Ana', 'San Miguel', 'Soyapango', 'Mejicanos', 'Santa Tecla', 'Apopa', 'Delgado', 'Ilopango', 'Ahuachapán'],
                'DO' => ['Santo Domingo', 'Santiago de los Caballeros', 'La Romana', 'San Pedro de Macorís', 'San Francisco de Macorís', 'Higüey', 'Puerto Plata', 'Moca', 'Bonao', 'La Vega'],
                'HT' => ['Puerto Príncipe', 'Cap-Haïtien', 'Les Cayes', 'Gonaïves', 'Petion-Ville', 'Jacmel', 'Saint-Marc', 'Port-de-Paix', 'Jeremie', 'Hinche'],
                'IE' => ['Dublín', 'Cork', 'Limerick', 'Galway', 'Waterford', 'Drogheda', 'Dundalk', 'Bray', 'Swords', 'Navan'],
                'NL' => ['Ámsterdam', 'Róterdam', 'La Haya', 'Utrecht', 'Eindhoven', 'Tilburg', 'Groninga', 'Almere', 'Breda', 'Nimega'],
                'SE' => ['Estocolmo', 'Gotemburgo', 'Malmö', 'Uppsala', 'Västerås', 'Örebro', 'Linköping', 'Helsingborg', 'Jönköping', 'Norrköping'],
                'NO' => ['Oslo', 'Bergen', 'Trondheim', 'Stavanger', 'Drammen', 'Fredrikstad', 'Kristiansand', 'Sandnes', 'Tromsø', 'Sarpsborg'],
                'FI' => ['Helsinki', 'Espoo', 'Tampere', 'Vantaa', 'Oulu', 'Turku', 'Jyväskylä', 'Lahti', 'Kuopio', 'Pori'],
                'DK' => ['Copenhague', 'Aarhus', 'Odense', 'Aalborg', 'Esbjerg', 'Randers', 'Kolding', 'Horsens', 'Vejle', 'Roskilde'],
                'BE' => ['Bruselas', 'Amberes', 'Gante', 'Charleroi', 'Lieja', 'Brujas', 'Namur', 'Lovaina', 'Mons', 'Aalst'],
                'CH' => ['Zúrich', 'Ginebra', 'Basilea', 'Berna', 'Lausana', 'Winterthur', 'Lucerna', 'San Galo', 'Lugano', 'Biel/Bienne'],
                'AT' => ['Viena', 'Graz', 'Linz', 'Salzburgo', 'Innsbruck', 'Klagenfurt', 'Villach', 'Wels', 'Sankt Pölten', 'Dornbirn'],
                'NZ' => ['Auckland', 'Wellington', 'Christchurch', 'Hamilton', 'Tauranga', 'Napier-Hastings', 'Dunedin', 'Palmerston North', 'Nelson', 'Rotorua'],
                'SG' => ['Singapur'],
                'MY' => ['Kuala Lumpur', 'George Town', 'Ipoh', 'Shah Alam', 'Petaling Jaya', 'Johor Bahru', 'Malaca', 'Kota Kinabalu', 'Kuching', 'Seremban'],
                'TH' => ['Bangkok', 'Nonthaburi', 'Nakhon Ratchasima', 'Chiang Mai', 'Hat Yai', 'Udon Thani', 'Pak Kret', 'Khon Kaen', 'Nakhon Si Thammarat', 'Ubon Ratchathani'],
                'CO' => ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena', 'Cúcuta', 'Bucaramanga', 'Pereira', 'Santa Marta', 'Ibagué'],

            ];

            $countries = Country::all();

            foreach ($countries as $country) {
                // Verificar si el país tiene ciudades definidas en el arreglo
                if (isset($cities[$country->code])) {
                    foreach ($cities[$country->code] as $cityName) {
                        City::create([
                            'name' => $cityName,
                            'country_id' => $country->id
                        ]);
                    }
                }
            }
        }
    }
}