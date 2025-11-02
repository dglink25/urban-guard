<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8 max-w-2xl mx-auto">
        
        <!-- EN-TÊTE : Titre et Retour -->
        <div class="flex items-center space-x-4 mb-6">
            <a href="{{ route('departements.index') }}" class="text-gray-500 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-extrabold text-gray-800">
                Ajouter un Département
            </h1>
        </div>
        
        <!-- FORMULAIRE : Carte Élevée et Bordure Accent -->
        <form method="POST" action="{{ route('departements.store') }}" 
              class="bg-white shadow-2xl rounded-xl p-8 space-y-6 border-l-4 border-indigo-500 transition duration-300 hover:shadow-indigo-100/50">
            @csrf
            
            <!-- Champ du nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom du Département <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 p-3"
                    placeholder="Ex: Alibori"
                >
                @error('name') 
                    <p class="text-red-600 text-sm mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>

            <!-- Bouton d'action -->
            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50"
                >
                    <i class="fas fa-save mr-2"></i> Enregistrer le Département
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
