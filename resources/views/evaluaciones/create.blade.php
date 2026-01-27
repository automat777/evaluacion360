<div class="max-w-4xl mx-auto p-8">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Nueva Relación de Evaluación</h2>
        <p class="text-gray-600">Complete los datos para asignar evaluadores y evaluados.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-center p-4 bg-green-50 border-l-4 border-green-500 text-green-800 rounded-r-lg shadow-sm">
            <h2> Relacion Creada</h2>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span class="font-bold">Se encontraron errores:</span>
            </div>
            <ul class="list-disc ml-8 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evaluaciones.store') }}" method="POST" class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Periodo de Evaluación</label>
                <div class="relative">
                    <select name="periodo_id" class="appearance-none w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-3 transition-all outline-none">
                        <option value="">Seleccione Periodo</option>
                        @foreach($periodos as $p)
                            <option value="{{ $p->id }}" {{ old('periodo_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nombre_periodo }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex flex-col">
                <label class="block text-sm font-semibold text-gray-700 mb-2 italic">1. Evaluador</label>
                <select name="evaluador_id" id="evaluador_id" class="w-full bg-blue-50 border border-blue-200 text-blue-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-400 p-3 outline-none font-medium">
                    <option value="">Seleccione...</option>
                    @foreach($empleados as $e)
                        <option value="{{ $e->id }}" {{ old('evaluador_id') == $e->id ? 'selected' : '' }}>
                            {{ $e->nombres_apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col">
                <label class="block text-sm font-semibold text-gray-700 mb-2 italic">2. Tipo de Relación</label>
                <select name="tipo_id" id="tipo_id" class="w-full bg-amber-50 border border-amber-200 text-amber-900 text-sm rounded-lg focus:ring-2 focus:ring-amber-400 p-3 outline-none font-medium">
                    <option value="">Seleccione...</option>
                    @foreach($tipos as $t)
                        <option value="{{ $t->id }}" {{ old('tipo_id') == $t->id ? 'selected' : '' }}>
                            {{ $t->nombre_tipo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2 flex flex-col pt-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2 italic text-center">3. Evaluado Final</label>
                <select name="evaluado_id" id="evaluado_id" class="w-full md:w-2/3 mx-auto bg-green-50 border border-green-200 text-green-900 text-sm rounded-lg focus:ring-2 focus:ring-green-400 p-3 outline-none font-bold">
                    <option value="">Seleccione...</option>
                    @foreach($empleados as $e)
                        <option value="{{ $e->id }}" {{ old('evaluado_id') == $e->id ? 'selected' : '' }}>
                            {{ $e->nombres_apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-10 flex justify-center">
            <button type="submit" class="w-full md:w-auto px-10 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-indigo-200 transform hover:-translate-y-0.5 transition-all duration-200">
                Registrar Relación
            </button>
        </div>
    </form>
</div>

<script>
    const tipoSelect = document.getElementById('tipo_id');
    const evaluadorSelect = document.getElementById('evaluador_id');
    const evaluadoSelect = document.getElementById('evaluado_id');

    function syncAuto() {
        let tipoTexto = tipoSelect.options[tipoSelect.selectedIndex].text.toLowerCase();
        if (tipoTexto.includes('auto')) {
            evaluadoSelect.value = evaluadorSelect.value;
            // Efecto visual de deshabilitado suave
            evaluadoSelect.classList.add('opacity-70', 'cursor-not-allowed');
        } else {
            evaluadoSelect.classList.remove('opacity-70', 'cursor-not-allowed');
        }
    }

    tipoSelect.addEventListener('change', syncAuto);
    evaluadorSelect.addEventListener('change', syncAuto);
</script>