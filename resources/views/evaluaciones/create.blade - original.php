<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                    <li>{{ $error }}</li>                @endforeach
            </ul>
        </div>
    @endif

    <form action="" method="" class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Periodo de Evaluación</label>
                <div class="relative">
                    <select id="periodo_id" name="periodo_id" class="appearance-none w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-3 transition-all outline-none">
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
                        <option value="{{ $e->nombres_apellidos }}" {{ old('evaluador_id') == $e->id ? 'selected' : '' }}>
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
                        <option value="{{ $t->nombre_tipo }}" {{ old('tipo_id') == $t->id ? 'selected' : '' }}>
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
                        <option value="{{ $e->nombres_apellidos }}" {{ old('evaluado_id') == $e->id ? 'selected' : '' }}>
                            {{ $e->nombres_apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-10 flex justify-center">
            <button type="button" onclick="submitForm()" class="w-full md:w-auto px-10 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-indigo-200 transform hover:-translate-y-0.5 transition-all duration-200">
                Registrar Relación
            </button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

    function submitForm() {
        const formData = {
            evaluado: document.getElementById('evaluado_id').value,
            evaluador: document.getElementById('evaluador_id').value,
            relacion: document.getElementById('tipo_id').value,
            fecha: new Date().toLocaleDateString('es-ES', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            }).split('/').reverse().join('-'),
            periodo: document.getElementById('periodo_id').value
        };
        enviarDatosAGoogleSheets(formData);
    }

    // URL del Google Apps Script que consulta Neon
    const scriptUrl = 'https://script.google.com/macros/s/AKfycbyowtQ1d-F-QY_D2QzakXnT8fzXss25cJfhjTcIRA9DxG0cU6Ib6qsGpzG9zbKLX4VD/exec?action=getEvaluados';
                
    // Función async para manejar la petición fetch
    async function enviarDatosAGoogleSheets(xdatos) {
        try {
            // Crear FormData con los datos
            const datos = new FormData();
            datos.append('evaluado', xdatos.evaluado);
            datos.append('evaluador', xdatos.evaluador);
            datos.append('relacion', xdatos.relacion);
            datos.append('fecha', xdatos.fecha);
            datos.append('periodo', xdatos.periodo);

            // Hacer la petición fetch con await (dentro de función async)
            await fetch(scriptUrl, {
                method: 'POST',
                body: datos,
                mode: 'no-cors' // Importante para evitar bloqueos de CORS con Google
            });
            
            // Aquí puedes agregar lógica para mostrar un mensaje de éxito
            alert('¡Datos enviados correctamente a Google Sheets!');
            
            // También puedes enviar el formulario normal a Laravel
            //document.querySelector('form').submit();
            
        } catch (error) {
            console.error('Error enviando a Google Sheets:', error);
            alert('Hubo un error al enviar los datos. Por favor, intente nuevamente.');
            
            // Aún así enviar el formulario a Laravel si falla Google Sheets
            //document.querySelector('form').submit();
        }
    }
</script>