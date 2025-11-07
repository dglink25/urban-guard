<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 py-8 px-4 sm:px-6 lg:px-8">
    
    {{-- En-tête avec rôle --}}
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12 animate-fadeIn">
            @php
                $roleTitles = [
                    'prefet' => 'Préfet',
                    'maire' => 'Maire',
                    'chef_arrondissement' => 'Chef d\'Arrondissement',
                    'admin' => 'Administrateur'
                ];
                $roleTitle = $roleTitles[Auth::user()->role] ?? 'Utilisateur';
            @endphp
            
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">
                Tableau de Bord {{ $roleTitle }}
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                @switch(Auth::user()->role)
                    @case('prefet')
                        Visualisation des déclarations de votre département
                        @break
                    @case('maire')
                        Visualisation des déclarations de votre commune
                        @break
                    @case('chef_arrondissement')
                        Visualisation des déclarations de votre arrondissement
                        @break
                    @default
                        Visualisation des déclarations proches de votre position
                @endswitch
            </p>
        </div>

        {{-- Statistiques --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 text-center">
                <div class="text-3xl font-bold text-indigo-600 mb-2">{{ $declarations->count() }}</div>
                <div class="text-sm text-gray-600 font-medium">Déclarations Total</div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 text-center">
                <div class="text-3xl font-bold text-red-600 mb-2">
                    {{ $declarations->where('urgence', true)->count() }}
                </div>
                <div class="text-sm text-gray-600 font-medium">Urgences</div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">
                    {{ $followedDeclarations->count() }}
                </div>
                <div class="text-sm text-gray-600 font-medium">Déclarations Suivies</div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 text-center">
                <div class="text-3xl font-bold text-purple-600 mb-2">
                    {{ $declarations->where('has_images', true)->count() }}
                </div>
                <div class="text-sm text-gray-600 font-medium">Avec Photos</div>
            </div>
        </div>

        {{-- Contrôles de filtrage --}}
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200 mb-8">
            <div class="flex flex-wrap gap-4 items-center justify-between">
                <div class="flex flex-wrap gap-2">
                    <button id="filter-all" class="filter-btn active px-6 py-3 bg-indigo-600 text-white rounded-xl font-medium transition-all text-sm">
                        Tout
                    </button>
                    <button id="filter-followed" class="filter-btn px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-medium transition-all text-sm">
                        Déclarations suivies
                    </button>
                    <button id="filter-urgence" class="filter-btn px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-medium transition-all text-sm">
                        Urgences
                    </button>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <select id="statut-filter" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-sm">
                        <option value="all">Tous les statuts</option>
                        <option value="nouveau">Nouveau</option>
                        <option value="en_cours">En cours</option>
                        <option value="résolu">Résolu</option>
                    </select>
                    
                    <button id="locate-me" class="px-6 py-3 bg-green-600 text-white rounded-xl font-medium hover:bg-green-700 transition-all flex items-center gap-2 text-sm">
                        Ma Position
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
            
            {{-- Carte Interactive --}}
            <div class="xl:col-span-3">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Carte Interactive des Déclarations</h2>
                            <p class="text-gray-600 text-sm mt-1">Cliquez sur les marqueurs pour voir les détails</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs">
                            <div class="flex items-center gap-1">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span>Normale</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <span>Urgent</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span>Résolu</span>
                            </div>
                        </div>
                    </div>
                    <div id="map" class="w-full h-96 sm:h-[700px] rounded-b-2xl"></div>
                </div>
            </div>

            {{-- Panneau latéral --}}
            <div class="space-y-6">
                {{-- Légende et informations --}}
                <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">📊 Informations</h2>
                    
                    <div class="space-y-4 text-sm">
                        <div class="p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="font-semibold text-blue-800">Rôle</div>
                            <div class="text-blue-600 capitalize">{{ Auth::user()->role }}</div>
                        </div>
                        
                        <div class="p-3 bg-green-50 rounded-lg border border-green-200">
                            <div class="font-semibold text-green-800">Périmètre</div>
                            <div class="text-green-600">
                                @switch(Auth::user()->role)
                                    @case('prefet')
                                        Département complet
                                        @break
                                    @case('maire')
                                        Commune entière
                                        @break
                                    @case('chef_arrondissement')
                                        Arrondissement
                                        @break
                                    @default
                                        Zone de 50km autour de vous
                                @endswitch
                            </div>
                        </div>

                        <div class="space-y-2 mt-4">
                            <div class="flex items-center justify-between text-xs">
                                <span class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span>Déclaration normale</span>
                                </span>
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $declarations->where('urgence', false)->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                    <span>Urgence</span>
                                </span>
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full">{{ $declarations->where('urgence', true)->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span>Résolu</span>
                                </span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full">{{ $declarations->where('statut', 'résolu')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Liste des Déclarations --}}
                <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Liste des Déclarations</h2>
                    
                    <div id="declarations-list" class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                        @include('dashboard.partials.declarations-list', ['declarations' => $declarations])
                    </div>
                </div>

                {{-- Déclarations Suivies --}}
                @if($followedDeclarations->count() > 0)
                    <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-200">
                        <h2 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                            Mes Déclarations Suivies
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                {{ $followedDeclarations->count() }}
                            </span>
                        </h2>
                        
                        <div class="space-y-3 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($followedDeclarations as $declaration)
                                <div class="declaration-item bg-green-50 rounded-lg p-3 border border-green-200"
                                     data-declaration-id="{{ $declaration->id }}">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">
                                                @switch($declaration->infrastructure_type)
                                                    @case('route') 🛣️ @break
                                                    @case('pont') 🌉 @break
                                                    @case('école') 🏫 @break
                                                    @case('hôpital') 🏥 @break
                                                    @default 📍
                                                @endswitch
                                            </span>
                                            <span class="text-sm font-bold text-gray-800 capitalize">
                                                {{ $declaration->infrastructure_type }}
                                            </span>
                                        </div>
                                        <div class="flex flex-col items-end gap-1">
                                            <span class="text-xs text-gray-500">
                                                {{ $declaration->created_at->format('d/m') }}
                                            </span>
                                            @if($declaration->urgence)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                    🔥
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-gray-600 text-xs mb-2 line-clamp-2">
                                        {{ Str::limit($declaration->description, 60) }}
                                    </p>
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-green-700">{{ $declaration->user->name ?? 'Anonyme' }}</span>
                                        <button onclick="showDeclarationDetails({{ $declaration->id }})"
                                                class="text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                                            Détails →
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal de détails --}}
<div id="declarationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-white rounded-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden">
        {{-- Le contenu sera chargé via JavaScript --}}
    </div>
</div>

{{-- Modal d'image/vidéo --}}
<div id="mediaModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-[60] hidden">
    <div class="relative max-w-7xl max-h-[90vh] w-full h-full flex items-center justify-center p-4">
        <button id="closeMediaModal" class="absolute top-4 right-4 text-white text-3xl z-10 bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center">
            &times;
        </button>
        <button id="prevMedia" class="absolute left-4 text-white text-2xl z-10 bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center">
            ‹
        </button>
        <button id="nextMedia" class="absolute right-4 text-white text-2xl z-10 bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center">
            ›
        </button>
        <div id="mediaContainer" class="w-full h-full flex items-center justify-center">
            {{-- Contenu média --}}
        </div>
    </div>
</div>

{{-- Styles CSS --}}
<style>
    .animate-fadeIn {
        animation: fadeIn 0.8s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .declaration-item.active {
        border-color: #4f46e5;
        background: #f8faff;
        transform: scale(1.02);
    }
    
    .filter-btn.active {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    
    .infrastructure-marker {
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
    }
    
    .infrastructure-marker:hover {
        transform: scale(1.1);
    }
    
    .statut-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .statut-nouveau { background: #fef3c7; color: #92400e; }
    .statut-en_cours { background: #dbeafe; color: #1e40af; }
    .statut-résolu { background: #d1fae5; color: #065f46; }

    /* Responsive */
    @media (max-width: 768px) {
        .xl\:col-span-3 {
            grid-column: span 1;
        }
        
        #map {
            height: 400px !important;
        }
        
        .grid-cols-4 {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

{{-- Scripts JavaScript --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script>
    let map;
    let markers = [];
    let userLocationMarker = null;
    const declarationsData = @json($declarationsMap);
    const beninBounds = @json($beninBounds);
    let currentMediaIndex = 0;
    let currentMediaList = [];

    // Icônes pour les types d'infrastructure
    const infrastructureIcons = {
        route: '🛣️',
        pont: '🌉',
        école: '🏫',
        hôpital: '🏥',
        bâtiment: '🏗️',
        travaux: '🚧',
        'panne electrique': '💡',
        'panne électrique': '💡',
        autre: '📍'
    };

    // Initialisation de la carte
    function initMap() {
        map = L.map('map', {
            minZoom: 7,
            maxBounds: [
                [beninBounds.south, beninBounds.west],
                [beninBounds.north, beninBounds.east]
            ]
        }).setView(beninBounds.center, 8);

        // Restreindre la vue au Bénin
        map.setMaxBounds([
            [beninBounds.south, beninBounds.west],
            [beninBounds.north, beninBounds.east]
        ]);

        // Couche de carte
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Ajouter les marqueurs
        declarationsData.forEach(declaration => {
            if (declaration.latitude && declaration.longitude) {
                addMarkerToMap(declaration);
            }
        });
    }

    // Ajouter un marqueur à la carte
    function addMarkerToMap(declaration) {
        const icon = getMarkerIcon(declaration);
        
        const marker = L.marker([declaration.latitude, declaration.longitude], { icon })
            .addTo(map)
            .bindPopup(createPopupContent(declaration))
            .on('click', function() {
                highlightDeclarationInList(declaration.id);
            });

        markers.push({
            id: declaration.id,
            marker: marker,
            declaration: declaration
        });
    }

    // Obtenir l'icône du marqueur
    function getMarkerIcon(declaration) {
        let color = 'blue';
        if (declaration.urgence) color = 'red';
        if (declaration.statut === 'résolu') color = 'green';

        const iconHtml = `
            <div class="infrastructure-marker" style="
                background-color: ${color};
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
            ">
                ${infrastructureIcons[declaration.infrastructure_type] || '📍'}
            </div>
        `;

        return L.divIcon({
            className: 'custom-marker',
            html: iconHtml,
            iconSize: [32, 32],
            iconAnchor: [16, 16]
        });
    }

    // Créer le contenu du popup
    function createPopupContent(declaration) {
        return `
            <div class="p-3 min-w-[300px]">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                        ${infrastructureIcons[declaration.infrastructure_type] || '📍'}
                        <span class="capitalize">${declaration.infrastructure_type}</span>
                    </h3>
                    <div class="flex gap-1">
                        ${declaration.urgence ? '<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">URGENT</span>' : ''}
                        <span class="statut-badge statut-${declaration.statut}">${declaration.statut}</span>
                    </div>
                </div>
                
                <p class="text-gray-600 text-sm mb-3 leading-relaxed">${declaration.description}</p>
                
                <div class="text-xs text-gray-500 space-y-2">
                    <div class="flex justify-between">
                        <span>Localisation:</span>
                        <span class="font-medium text-gray-700">${declaration.commune || declaration.departement || 'Position GPS'}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Date:</span>
                        <span class="font-medium">${declaration.created_at}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Déclarant:</span>
                        <span class="font-medium">${declaration.user_name}</span>
                    </div>
                </div>
                
                <div class="mt-4 flex gap-2">
                    <button onclick="showDeclarationDetails(${declaration.id})" 
                            class="flex-1 bg-indigo-600 text-white py-2 px-3 rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">
                        Voir détails
                    </button>
                </div>
            </div>
        `;
    }

    // Afficher les détails d'une déclaration
    async function showDeclarationDetails(declarationId) {
        try {
            const response = await fetch(`/declarations/${declarationId}/details`);
            const html = await response.text();
            
            document.getElementById('declarationModal').innerHTML = html;
            document.getElementById('declarationModal').classList.remove('hidden');
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des détails');
        }
    }

    // Fermer la modal
    function closeModal() {
        document.getElementById('declarationModal').classList.add('hidden');
    }

    // Mettre en évidence une déclaration dans la liste
    function highlightDeclarationInList(declarationId) {
        // Retirer la classe active de tous les éléments
        document.querySelectorAll('.declaration-item').forEach(item => {
            item.classList.remove('active');
        });
        
        // Ajouter la classe active à l'élément correspondant
        const declarationItem = document.querySelector(`[data-declaration-id="${declarationId}"]`);
        if (declarationItem) {
            declarationItem.classList.add('active');
            declarationItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Filtrer les déclarations
    async function filterDeclarations(filter, urgence = false) {
        try {
            const response = await fetch(`/api/declarations/filter?filter=${filter}&urgence=${urgence}`);
            const data = await response.json();
            
            if (data.success) {
                // Mettre à jour la liste
                document.getElementById('declarations-list').innerHTML = data.declarations.map(declaration => `
                    <div class="declaration-item bg-gray-50 rounded-lg p-4 border-2 border-transparent hover:border-indigo-300 transition-all duration-300 cursor-pointer"
                         data-declaration-id="${declaration.id}"
                         onclick="focusOnDeclaration(${declaration.id})">
                        
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <span class="text-xl">
                                    ${infrastructureIcons[declaration.infrastructure_type] || '📍'}
                                </span>
                                <div>
                                    <div class="text-sm font-bold text-gray-800 capitalize">
                                        ${declaration.infrastructure_type}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        #${declaration.id.toString().padStart(6, '0')}
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span class="text-xs text-gray-500">
                                    ${new Date(declaration.created_at).toLocaleDateString('fr-FR')}
                                </span>
                                <div class="flex gap-1">
                                    ${declaration.urgence ? '<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">🔥</span>' : ''}
                                    <span class="statut-badge statut-${declaration.statut}">${declaration.statut}</span>
                                </div>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            ${declaration.description}
                        </p>

                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <span>${declaration.user.name}</span>
                            <button onclick="event.stopPropagation(); showDeclarationDetails(${declaration.id})"
                                    class="text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                                Détails →
                            </button>
                        </div>
                    </div>
                `).join('');

                // Mettre à jour la carte
                markers.forEach(marker => map.removeLayer(marker.marker));
                markers = [];
                
                data.declarationsMap.forEach(declaration => {
                    if (declaration.latitude && declaration.longitude) {
                        addMarkerToMap(declaration);
                    }
                });
            }
        } catch (error) {
            console.error('Erreur filtrage:', error);
        }
    }

    // Centrer sur une déclaration
    function focusOnDeclaration(declarationId) {
        const markerData = markers.find(m => m.id === declarationId);
        if (markerData) {
            map.setView([markerData.declaration.latitude, markerData.declaration.longitude], 15);
            markerData.marker.openPopup();
            highlightDeclarationInList(declarationId);
        }
    }

    // Localiser l'utilisateur
    function locateUser() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const { latitude, longitude } = position.coords;
                    
                    if (userLocationMarker) {
                        userLocationMarker.setLatLng([latitude, longitude]);
                    } else {
                        userLocationMarker = L.marker([latitude, longitude], {
                            icon: L.divIcon({
                                className: 'user-location-marker',
                                html: '<div style="background-color: #10b981; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"></div>',
                                iconSize: [20, 20],
                                iconAnchor: [10, 10]
                            })
                        })
                        .addTo(map)
                        .bindPopup('<div class="p-2"><strong>Votre position actuelle</strong></div>')
                        .openPopup();
                    }
                    
                    map.setView([latitude, longitude], 13);
                },
                (error) => {
                    alert('Impossible de vous localiser');
                }
            );
        } else {
            alert('La géolocalisation n\'est pas supportée par votre navigateur.');
        }
    }

    // Afficher un média en plein écran
    function showMedia(mediaUrl, mediaType, mediaList, index) {
        currentMediaList = mediaList;
        currentMediaIndex = index;
        
        const mediaContainer = document.getElementById('mediaContainer');
        mediaContainer.innerHTML = '';
        
        if (mediaType === 'image') {
            const img = document.createElement('img');
            img.src = `/storage/${mediaUrl}`;
            img.className = 'max-w-full max-h-full object-contain';
            img.alt = 'Image déclaration';
            mediaContainer.appendChild(img);
        } else if (mediaType === 'video') {
            const video = document.createElement('video');
            video.src = `/storage/${mediaUrl}`;
            video.controls = true;
            video.className = 'max-w-full max-h-full';
            video.autoplay = true;
            mediaContainer.appendChild(video);
        }
        
        document.getElementById('mediaModal').classList.remove('hidden');
    }

    // Navigation entre les médias
    function navigateMedia(direction) {
        if (currentMediaList.length === 0) return;
        
        currentMediaIndex = (currentMediaIndex + direction + currentMediaList.length) % currentMediaList.length;
        const media = currentMediaList[currentMediaIndex];
        showMedia(media.path, media.type, currentMediaList, currentMediaIndex);
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        
        // Gestion des filtres
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active', 'bg-indigo-600', 'text-white');
                    b.classList.add('bg-gray-200', 'text-gray-700');
                });
                
                this.classList.add('active', 'bg-indigo-600', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-700');
                
                const filter = this.id.replace('filter-', '');
                filterDeclarations(filter);
            });
        });
        
        // Filtre par statut
        document.getElementById('statut-filter').addEventListener('change', function() {
            // Implémenter le filtrage par statut
            console.log('Filtre statut:', this.value);
        });
        
        // Localisation
        document.getElementById('locate-me').addEventListener('click', locateUser);

        // Fermer les modals
        document.getElementById('declarationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.getElementById('mediaModal').addEventListener('click', function(e) {
            if (e.target === this || e.target.id === 'closeMediaModal') {
                this.classList.add('hidden');
            }
        });

        // Navigation médias
        document.getElementById('prevMedia').addEventListener('click', (e) => {
            e.stopPropagation();
            navigateMedia(-1);
        });

        document.getElementById('nextMedia').addEventListener('click', (e) => {
            e.stopPropagation();
            navigateMedia(1);
        });

        // Fermer avec Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                document.getElementById('mediaModal').classList.add('hidden');
            }
        });
    });
</script>
</x-app-layout>