<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            
            <!-- Card principal -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Encabezado -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-clipboard-check text-info" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-2">
                            Nueva Relación de Evaluación
                        </h2>
                        <p class="text-muted small mb-0">
                            Asigna tus evaluadores. Un máximo de 5, incluyéndote (autoevaluación).
                        </p>
                    </div>

                    <hr class="my-4">

                    <!-- Mensaje de éxito -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Mensajes de error -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6 class="alert-heading fw-bold mb-2">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Se encontraron errores:
                            </h6>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Formulario -->
                    <form action="" method="" class="needs-validation" novalidate>
                        @csrf

                        <!-- Periodo -->
                        <div class="mb-4">
                            <label for="periodo_id" class="form-label fw-semibold">
                                <i class="bi bi-calendar-range text-info me-1"></i>
                                Periodo de evaluación
                            </label>
                            <select
                                id="periodo_id"
                                name="periodo_id"
                                class="form-select form-select-lg"
                                required
                            >
                                <option value="">Seleccione un período</option>
                                @foreach($periodos as $p)
                                    <option value="{{ $p->id }}" {{ old('periodo_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nombre_periodo }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un período.
                            </div>
                        </div>

                        <!-- Evaluador -->
                        <div class="mb-4">
                            <label for="evaluador_id" class="form-label fw-semibold">
                                <i class="bi bi-person-badge text-info me-1"></i>
                                Quien te evaluará 
                            </label>
                            <select
                                name="evaluador_id"
                                id="evaluador_id"
                                class="form-select form-select-lg"
                                required
                            >
                                <option value="">Seleccione evaluador</option>
                                @foreach($empleados as $e)
                                    <option value="{{ $e->nombres_apellidos }}" {{ old('evaluador_id') == $e->id ? 'selected' : '' }}>
                                        {{ $e->nombres_apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un evaluador.
                            </div>
                        </div>

                        <!-- Tipo de relación -->
                        <div class="mb-4">
                            <label for="tipo_id" class="form-label fw-semibold">
                                <i class="bi bi-diagram-3 text-info me-1"></i>
                                La persona seleccionada es: 
                            </label>
                            <select
                                name="tipo_id"
                                id="tipo_id"
                                class="form-select form-select-lg"
                                required
                            >
                                <option value="">Seleccione tipo de relación</option>
                                @foreach($tipos as $t)
                                    <option value="{{ $t->nombre_tipo }}" {{ old('tipo_id') == $t->id ? 'selected' : '' }}>
                                        {{ $t->nombre_tipo }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un tipo de relación.
                            </div>
                        </div>

                        <!-- Evaluado -->
                        <div class="mb-4">
                            <label for="evaluado_id" class="form-label fw-semibold">
                                <i class="bi bi-person-check text-info me-1"></i>
                                Buscate y selecciona a ti mismo como evaluado
                            </label>
                            <select
                                name="evaluado_id"
                                id="evaluado_id"
                                class="form-select form-select-lg"
                                required
                            >
                                <option value="">Seleccione evaluado</option>
                                @foreach($empleados as $e)
                                    <option value="{{ $e->nombres_apellidos }}" {{ old('evaluado_id') == $e->id ? 'selected' : '' }}>
                                        {{ $e->nombres_apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un evaluado.
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4 pt-3 border-top">
                            <button
                                type="button"
                                class="btn btn-outline-secondary me-md-2"
                                onclick="window.history.back()"
                            >
                                <i class="bi bi-arrow-left me-1"></i>
                                Cancelar
                            </button>
                            <button
                                type="button"
                                onclick="submitForm()"
                                class="btn btn-info btn-lg px-5 text-white"
                                style="background: linear-gradient(135deg, #67b9e8 0%, #4a9fd8 100%); border: none;"
                            >
                                <i class="bi bi-save me-2"></i>
                                Registrar relación
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Nota informativa -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Recuerda verificar la información antes de registrar
                </small>
            </div>

        </div>
    </div>
</div>

<style>
    .form-select:focus,
    .form-control:focus {
        border-color: #67b9e8;
        box-shadow: 0 0 0 0.25rem rgba(103, 185, 232, 0.25);
    }
    
    .btn-info:hover {
        background: linear-gradient(135deg, #4a9fd8 0%, #3a8fc8 100%) !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(103, 185, 232, 0.4);
        transition: all 0.3s ease;
    }
    
    .card {
        border-radius: 1rem;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

     $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            theme: 'classic',
            placeholder: "Seleccione una opción",
            allowClear: true
        });
        
        // Mejorar el estilo de los dropdowns de Select2
        $('.select2-container').addClass('rounded-xl');
    });

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