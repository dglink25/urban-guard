@foreach($declarations as $declaration)
<div class="declaration-item bg-gray-50 rounded-lg p-4 border-2 border-transparent hover:border-indigo-300 transition-all duration-300 cursor-pointer"
     data-declaration-id="{{ $declaration->id }}"
     onclick="focusOnDeclaration({{ $declaration->id }})">
    
    <div class="flex justify-between items-start mb-3">
        <div class="flex items-center gap-3">
            <span class="text-xl">
                @switch($declaration->infrastructure_type)
                    @case('route') 🛣️ @break
                    @case('pont') 🌉 @break
                    @case('école') 🏫 @break
                    @case('hôpital') 🏥 @break
                    @case('bâtiment') 🏗️ @break
                    @case('travaux') 🚧 @break
                    @case('panne électrique') 💡 @break
                    @default 📍
                @endswitch
            </span>
            <div>
                <div class="text-sm font-bold text-gray-800 capitalize">
                    {{ $declaration->infrastructure_type }}
                </div>
                <div class="text-xs text-gray-500">
                    #{{ str_pad($declaration->id, 6, '0', STR_PAD_LEFT) }}
                </div>
            </div>
        </div>
        <div class="flex flex-col items-end gap-2">
            <span class="text-xs text-gray-500">
                {{ $declaration->created_at->format('d/m/Y') }}
            </span>
            <div class="flex gap-1">
                @if($declaration->urgence)
                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">🔥</span>
                @endif
                <span class="statut-badge statut-{{ $declaration->statut }}">
                    {{ $declaration->statut }}
                </span>
            </div>
        </div>
    </div>

    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
        {{ Str::limit($declaration->description, 100) }}
    </p>

    <div class="flex justify-between items-center text-xs text-gray-500">
        <span>{{ $declaration->user->name ?? 'Anonyme' }}</span>
        <button onclick="event.stopPropagation(); showDeclarationDetails({{ $declaration->id }})"
                class="text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
            Détails →
        </button>
    </div>
</div>
@endforeach