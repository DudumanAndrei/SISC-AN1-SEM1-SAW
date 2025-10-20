const destinatiiTuristice = {
    "tipObiect": "DestinatieTuristica",
    "instante": [
        {
            "id": "DT001",
            "nume": "Colosseum",
            "oras": "Roma",
            "tara": "Italia",
            "tipAtractie": "Istoric",
            "costIntrare": 16,
            "timpVizita": "3 ore",
            "rating": 4.8,
            "descriere": "Amfiteatru roman antic, simbol al Romei imperiale",
            "atractiiSpeciale": ["Arena centrală", "Subsoluri", "Muzeu"],
            "program": "9:00-19:00",
            "accesibilitate": "Accesibil cu scaun cu rotile"
        },
        {
            "id": "DT002",
            "nume": "Turnul Eiffel",
            "oras": "Paris",
            "tara": "Franța",
            "tipAtractie": "Arhitectural",
            "costIntrare": 25,
            "timpVizita": "2 ore",
            "rating": 4.9,
            "descriere": "Turn de fier forjat de 324m, simbol al Parisului",
            "atractiiSpeciale": ["Etajul 1 cu podea de sticlă", "Etajul 2 cu restaurant", "Vârful"],
            "program": "9:30-23:45",
            "accesibilitate": "Accesibil parțial"
        },
        {
            "id": "DT003",
            "nume": "Acropola",
            "oras": "Atena",
            "tara": "Grecia",
            "tipAtractie": "Arheologic",
            "costIntrare": 20,
            "timpVizita": "3 ore",
            "rating": 4.7,
            "descriere": "Cetate antică cu temple dedicate zeiței Athena",
            "atractiiSpeciale": ["Parthenon", "Erechtheion", "Propylaea"],
            "program": "8:00-20:00",
            "accesibilitate": "Accesibil cu dificultate"
        },
        {
            "id": "DT004",
            "nume": "Sagrada Familia",
            "oras": "Barcelona",
            "tara": "Spania",
            "tipAtractie": "Religios",
            "costIntrare": 26,
            "timpVizita": "2.5 ore",
            "rating": 4.8,
            "descriere": "Bazilică catolică proiectată de Antoni Gaudí",
            "atractiiSpeciale": ["Fațada Nașterii", "Fațada Patimilor", "Turnuri"],
            "program": "9:00-20:00",
            "accesibilitate": "Accesibil parțial"
        }
    ]
};

const restaurante = {
    "tipObiect": "Restaurant",
    "instante": [
        {
            "id": "R001",
            "nume": "Ristorante Romano",
            "oras": "Roma",
            "tara": "Italia",
            "tipBucatarie": "Italiană",
            "rating": 4.5,
            "costMediu": 35,
            "program": "12:00-23:00",
            "adresa": "Via del Corso 123, Roma",
            "specialitati": ["Pasta Carbonara", "Pizza Romana", "Tiramisu"],
            "meniu": [
                { "felMancare": "Pasta Carbonara", "pret": 15, "categorie": "Principal" },
                { "felMancare": "Pizza Margherita", "pret": 12, "categorie": "Principal" },
                { "felMancare": "Tiramisu", "pret": 8, "categorie": "Desert" },
                { "felMancare": "House Wine", "pret": 12, "categorie": "Băuturi" }
            ],
            "caracteristici": ["Terasă", "WiFi gratuit", "Rezervări online"]
        },
        {
            "id": "R002",
            "nume": "Café de Paris",
            "oras": "Paris",
            "tara": "Franța",
            "tipBucatarie": "Franceză",
            "rating": 4.3,
            "costMediu": 25,
            "program": "7:00-22:00",
            "adresa": "45 Rue Saint-Denis, Paris",
            "specialitati": ["Croissant", "Quiche Lorraine", "Crème Brûlée"],
            "meniu": [
                { "felMancare": "Croissant", "pret": 3, "categorie": "Mic dejun" },
                { "felMancare": "Quiche Lorraine", "pret": 12, "categorie": "Principal" },
                { "felMancare": "Crème Brûlée", "pret": 7, "categorie": "Desert" },
                { "felMancare": "Café au Lait", "pret": 4, "categorie": "Băuturi" }
            ],
            "caracteristici": ["Livrare", "Meniu vegetarian", "Platouri de brunch"]
        },
        {
            "id": "R003",
            "nume": "Taverna Greacă",
            "oras": "Santorini",
            "tara": "Grecia",
            "tipBucatarie": "Greacă",
            "rating": 4.6,
            "costMediu": 30,
            "program": "11:00-24:00",
            "adresa": "Santorini Center, Grecia",
            "specialitati": ["Moussaka", "Greek Salad", "Souvlaki"],
            "meniu": [
                { "felMancare": "Moussaka", "pret": 14, "categorie": "Principal" },
                { "felMancare": "Greek Salad", "pret": 9, "categorie": "Aperitive" },
                { "felMancare": "Souvlaki", "pret": 11, "categorie": "Principal" },
                { "felMancare": "Ouzo", "pret": 6, "categorie": "Băuturi" }
            ],
            "caracteristici": ["Vedere la mare", "Muzică live", "Bucătarie deschisă"]
        },
        {
            "id": "R004",
            "nume": "Tapas Bar Barcelona",
            "oras": "Barcelona",
            "tara": "Spania",
            "tipBucatarie": "Spaniolă",
            "rating": 4.4,
            "costMediu": 28,
            "program": "13:00-01:00",
            "adresa": "Plaza Real 8, Barcelona",
            "specialitati": ["Paella", "Jamon Iberico", "Patatas Bravas"],
            "meniu": [
                { "felMancare": "Paella Valenciana", "pret": 18, "categorie": "Principal" },
                { "felMancare": "Jamon Iberico", "pret": 15, "categorie": "Aperitive" },
                { "felMancare": "Patatas Bravas", "pret": 6, "categorie": "Aperitive" },
                { "felMancare": "Sangria", "pret": 10, "categorie": "Băuturi" }
            ],
            "caracteristici": ["Tapas bar", "Bar de vinuri", "Atmosferă autentică"]
        }
    ]
};

const cazari = {
    "tipObiect": "Cazare",
    "instante": [
        {
            "id": "C001",
            "nume": "Hotel Bella Vista",
            "oras": "Roma",
            "tara": "Italia",
            "tipCazare": "Hotel",
            "stele": 4,
            "costPeNoapte": 120,
            "costTotal": 1200,
            "adresa": "Strada Roma 123, Roma",
            "facilitati": ["Piscină", "Restaurant", "Spa", "WiFi gratuit"],
            "camereDisponibile": 15,
            "rating": 4.2,
            "politici": ["Check-in: 14:00", "Check-out: 12:00", "Animale de companie permise"],
            "contact": { "telefon": "+39 06 1234567", "email": "info@bellavista.com" }
        },
        {
            "id": "C002",
            "nume": "Le Parisien Hotel",
            "oras": "Paris",
            "tara": "Franța",
            "tipCazare": "Hotel de lux",
            "stele": 5,
            "costPeNoapte": 200,
            "costTotal": 1400,
            "adresa": "123 Avenue des Champs-Élysées, Paris",
            "facilitati": ["Room service", "Business center", "Sala de fitness", "Concierge"],
            "camereDisponibile": 8,
            "rating": 4.7,
            "politici": ["Check-in: 15:00", "Check-out: 11:00", "Anulare gratuită"],
            "contact": { "telefon": "+33 1 23456789", "email": "reservations@leparisien.fr" }
        },
        {
            "id": "C003",
            "nume": "Santorini Sunset Resort",
            "oras": "Santorini",
            "tara": "Grecia",
            "tipCazare": "Resort",
            "stele": 4,
            "costPeNoapte": 180,
            "costTotal": 1800,
            "adresa": "Oia, Santorini",
            "facilitati": ["Piscină infinită", "Restaurant cu terasă", "Transfer aeroport", "Tour guide"],
            "camereDisponibile": 12,
            "rating": 4.8,
            "politici": ["Check-in: 14:00", "Check-out: 12:00", "All-inclusive opțional"],
            "contact": { "telefon": "+30 22860 12345", "email": "bookings@santorinisunset.gr" }
        },
        {
            "id": "C004",
            "nume": "Barcelona City Apartments",
            "oras": "Barcelona",
            "tara": "Spania",
            "tipCazare": "Apartament",
            "stele": 3,
            "costPeNoapte": 85,
            "costTotal": 595,
            "adresa": "Carrer de Mallorca 256, Barcelona",
            "facilitati": ["Bucătărie echipată", "WiFi gratuit", "Aer condiționat", "Lift"],
            "camereDisponibile": 6,
            "rating": 4.1,
            "politici": ["Check-in: 16:00", "Check-out: 10:00", "Curățenie zilnică"],
            "contact": { "telefon": "+34 93 1234567", "email": "info@barcelonacityapartments.com" }
        }
    ]
};

function displayDestinations() {
    const container = document.getElementById('contentContainer');
    container.innerHTML = '<h2 style="text-align: center; color: white; margin-bottom: 20px;">🗺️ Destinații Turistice (4 instanțe)</h2>';

    const grid = document.createElement('div');
    grid.className = 'grid-container';

    destinatiiTuristice.instante.forEach(destinatie => {
        const card = createDestinationCard(destinatie);
        grid.appendChild(card);
    });

    container.appendChild(grid);
}

function createDestinationCard(destinatie) {
    const card = document.createElement('div');
    card.className = 'card';

    card.innerHTML = `
        <div class="card-header">
            <h3>${destinatie.nume}</h3>
            <div class="card-subtitle">
                📍 ${destinatie.oras}, ${destinatie.tara} • ⭐ ${destinatie.rating}/5
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">ℹ️ Informații</div>
            <div class="info-item">
                <strong>Tip:</strong> ${destinatie.tipAtractie}<br>
                <strong>Cost intrare:</strong> <span class="cost">${destinatie.costIntrare}€</span><br>
                <strong>Timp vizită:</strong> ${destinatie.timpVizita}<br>
                <strong>Program:</strong> ${destinatie.program}
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">📝 Descriere</div>
            <div class="info-item">${destinatie.descriere}</div>
        </div>
        
        <div class="section">
            <div class="section-title">🎯 Atracții speciale</div>
            ${destinatie.atractiiSpeciale.map(atractie => `
                <div class="destination-item">
                    <div class="item-name">${atractie}</div>
                </div>
            `).join('')}
        </div>
        
        <div class="info-item">
            <strong>Accesibilitate:</strong> ${destinatie.accesibilitate}
        </div>
    `;

    return card;
}

function displayRestaurants() {
    const container = document.getElementById('contentContainer');
    container.innerHTML = '<h2 style="text-align: center; color: white; margin-bottom: 20px;">🍽️ Restaurante (4 instanțe)</h2>';

    const grid = document.createElement('div');
    grid.className = 'grid-container';

    restaurante.instante.forEach(restaurant => {
        const card = createRestaurantCard(restaurant);
        grid.appendChild(card);
    });

    container.appendChild(grid);
}

function createRestaurantCard(restaurant) {
    const card = document.createElement('div');
    card.className = 'card';

    card.innerHTML = `
        <div class="card-header">
            <h3>${restaurant.nume}</h3>
            <div class="card-subtitle">
                📍 ${restaurant.oras}, ${restaurant.tara} • ⭐ ${restaurant.rating}/5
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">🍳 Informații Restaurant</div>
            <div class="info-item">
                <strong>Bucătărie:</strong> ${restaurant.tipBucatarie}<br>
                <strong>Cost mediu:</strong> <span class="cost">${restaurant.costMediu}€/persoană</span><br>
                <strong>Program:</strong> ${restaurant.program}<br>
                <strong>Adresă:</strong> ${restaurant.adresa}
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">🎯 Specialități</div>
            ${restaurant.specialitati.map(specialitate => `
                <div class="destination-item">
                    <div class="item-name">${specialitate}</div>
                </div>
            `).join('')}
        </div>
        
        <div class="section">
            <div class="section-title">📋 Meniu</div>
            <div class="menu-section">
                ${restaurant.meniu.map(item => `
                    <div class="menu-item">
                        <div class="menu-dish">${item.felMancare}</div>
                        <div class="menu-price">${item.pret}€ • ${item.categorie}</div>
                    </div>
                `).join('')}
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">⭐ Caracteristici</div>
            <div class="info-item">
                ${restaurant.caracteristici.join(' • ')}
            </div>
        </div>
    `;

    return card;
}

function displayAccommodations() {
    const container = document.getElementById('contentContainer');
    container.innerHTML = '<h2 style="text-align: center; color: white; margin-bottom: 20px;">🏨 Unități de Cazare (4 instanțe)</h2>';

    const grid = document.createElement('div');
    grid.className = 'grid-container';

    cazari.instante.forEach(cazare => {
        const card = createAccommodationCard(cazare);
        grid.appendChild(card);
    });

    container.appendChild(grid);
}

function createAccommodationCard(cazare) {
    const card = document.createElement('div');
    card.className = 'card';

    card.innerHTML = `
        <div class="card-header">
            <h3>${cazare.nume}</h3>
            <div class="card-subtitle">
                📍 ${cazare.oras}, ${cazare.tara} • ${'⭐'.repeat(cazare.stele)} • Rating: ${cazare.rating}/5
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">💰 Costuri</div>
            <div class="info-item">
                <strong>Cost/noapte:</strong> <span class="cost">${cazare.costPeNoapte}€</span><br>
                <strong>Cost total estimat:</strong> <span class="cost">${cazare.costTotal}€</span><br>
                <strong>Camere disponibile:</strong> ${cazare.camereDisponibile}
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">🏠 Detalii Cazare</div>
            <div class="info-item">
                <strong>Tip:</strong> ${cazare.tipCazare}<br>
                <strong>Adresă:</strong> ${cazare.adresa}
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">🎯 Facilități</div>
            <div class="info-item">
                ${cazare.facilitati.map(facilitate => `
                    <div style="margin: 5px 0;">✓ ${facilitate}</div>
                `).join('')}
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">📋 Politici</div>
            <div class="info-item">
                ${cazare.politici.map(politica => `
                    <div style="margin: 3px 0;">• ${politica}</div>
                `).join('')}
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">📞 Contact</div>
            <div class="info-item">
                <strong>Telefon:</strong> ${cazare.contact.telefon}<br>
                <strong>Email:</strong> ${cazare.contact.email}
            </div>
        </div>
    `;

    return card;
}
function displayStats() {
    const container = document.getElementById('contentContainer');
    container.innerHTML = `
        <div style="text-align: center; color: white; margin-bottom: 30px;">
            <h2>📊 Statistici Generale</h2>
            <p>Prezentarea celor 3 tipuri de obiecte cu câte 4 instanțe fiecare</p>
        </div>
        
        <div class="grid-container">
            <div class="card">
                <div class="card-header">
                    <h3>🗺️ Destinații Turistice</h3>
                </div>
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-value">${destinatiiTuristice.instante.length}</div>
                        <div class="stat-label">Instanțe</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">${calculateAverageCost(destinatiiTuristice.instante, 'costIntrare')}€</div>
                        <div class="stat-label">Cost mediu intrare</div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>🍽️ Restaurante</h3>
                </div>
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-value">${restaurante.instante.length}</div>
                        <div class="stat-label">Instanțe</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">${calculateAverageCost(restaurante.instante, 'costMediu')}€</div>
                        <div class="stat-label">Cost mediu/persoană</div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>🏨 Cazări</h3>
                </div>
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-value">${cazari.instante.length}</div>
                        <div class="stat-label">Instanțe</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">${calculateAverageCost(cazari.instante, 'costPeNoapte')}€</div>
                        <div class="stat-label">Cost mediu/noapte</div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function calculateAverageCost(instances, costField) {
    const total = instances.reduce((sum, instance) => sum + instance[costField], 0);
    return (total / instances.length).toFixed(2);
}


document.getElementById('showAllBtn').addEventListener('click', displayStats);
document.getElementById('showDestinationsBtn').addEventListener('click', displayDestinations);
document.getElementById('showRestaurantsBtn').addEventListener('click', displayRestaurants);
document.getElementById('showAccommodationsBtn').addEventListener('click', displayAccommodations);

displayStats();