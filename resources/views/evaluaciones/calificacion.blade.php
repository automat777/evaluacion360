<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            
            <!-- Card principal -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Encabezado -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-clipboard2-check text-info" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="h3 fw-bold text-dark mb-2">
                            Calificación de Evaluación
                        </h2>
                        <p class="text-muted small mb-0">
                            Registra las calificaciones por competencia del evaluado
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

                        <div class="row g-4 mb-4">
                            <!-- Evaluador -->
                            <div class="col-md-6">
                                <label for="evaluador_id" class="form-label fw-semibold">
                                    <i class="bi bi-person-badge text-info me-1"></i>
                                    Evaluador
                                </label>
                                <select
                                    id="evaluador_id"
                                    name="evaluador_id"
                                    class="form-select form-select-lg"
                                    required
                                >
                                    <option value="">Seleccionar Evaluador</option>
                                    @foreach($empleados as $e)
                                        <option value="{{ $e->id }}" {{ old('evaluador_id') == $e->id ? 'selected' : '' }}>
                                            {{ $e->nombres_apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Por favor seleccione un evaluador.
                                </div>
                            </div>

                            <!-- Evaluado -->
                            <div class="col-md-6">
                                <label for="evaluado_id" class="form-label fw-semibold">
                                    <i class="bi bi-person-check text-info me-1"></i>
                                    Evaluado
                                </label>
                                <select
                                    id="evaluado_id"
                                    name="evaluado_id"
                                    class="form-select form-select-lg"
                                    required
                                >
                                    <option value="">Seleccionar Evaluado</option>
                                    @foreach($empleados as $e)
                                        <option value="{{ $e->id }}" {{ old('evaluado_id') == $e->id ? 'selected' : '' }}>
                                            {{ $e->nombres_apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Por favor seleccione un evaluado.
                                </div>
                            </div>
                        </div>

                        <!-- Área de Competencias -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-star-fill text-info me-2" style="font-size: 1.5rem;"></i>
                                <h4 class="h5 fw-bold text-dark mb-0">Área de Competencias</h4>
                            </div>
                            
                            <div class="card bg-light border-0">
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        @foreach($competencias as $competencia)
                                            <div class="col-12">
                                                <div class="p-3 bg-white rounded shadow-sm border-start border-info border-4">
                                                    <!-- Nombre de la competencia -->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="bi bi-check-circle text-info me-3" style="font-size: 1.2rem;"></i>
                                                        <span class="text-dark fw-medium">{{ $competencia->nombre_area_competencia }}</span>
                                                    </div>
                                                    
                                                    <!-- Opciones de calificación (1-5) -->
                                                    <div class="d-flex justify-content-center gap-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <div class="rating-option">
                                                                <input 
                                                                    type="radio" 
                                                                    class="btn-check" 
                                                                    name="notas[{{ $competencia->id }}]" 
                                                                    id="competencia_{{ $competencia->id }}_nota_{{ $i }}" 
                                                                    value="{{ $i }}"
                                                                    {{ old('notas.'.$competencia->id) == $i ? 'checked' : '' }}
                                                                    required
                                                                >
                                                                <label 
                                                                    class="btn btn-outline-info rating-btn" 
                                                                    for="competencia_{{ $competencia->id }}_nota_{{ $i }}"
                                                                >
                                                                    {{ $i }}
                                                                </label>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    
                                                    <!-- Descripción de la escala -->
                                                    <div class="d-flex justify-content-between mt-2 px-3">
                                                        <small class="text-muted">Bajo</small>
                                                        <small class="text-muted">Alto</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-2 text-muted small">
                                <i class="bi bi-info-circle me-1"></i>
                                Califica cada competencia del 1 al 5, donde 5 es la máxima calificación
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
                                id="btnGuardar"
                                class="btn btn-info btn-lg px-5 text-white"
                                style="background: linear-gradient(135deg, #67b9e8 0%, #4a9fd8 100%); border: none;"
                            >
                                <i class="bi bi-save me-2"></i>
                                Guardar Calificación
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Nota informativa -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Asegúrate de revisar todas las calificaciones antes de guardar
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
    
    /* Estilos para los botones de calificación */
    .rating-option {
        flex: 1;
        max-width: 60px;
    }
    
    .rating-btn {
        width: 100%;
        height: 50px;
        font-size: 1.2rem;
        font-weight: bold;
        border-width: 2px;
        border-color: #67b9e8;
        color: #67b9e8;
        transition: all 0.3s ease;
    }
    
    .rating-btn:hover {
        background-color: #e8f5fc;
        border-color: #4a9fd8;
        color: #4a9fd8;
        transform: scale(1.05);
    }
    
    .btn-check:checked + .rating-btn {
        background: linear-gradient(135deg, #67b9e8 0%, #4a9fd8 100%);
        color: white;
        border-color: #4a9fd8;
        box-shadow: 0 4px 12px rgba(103, 185, 232, 0.4);
        transform: scale(1.1);
    }
    
    /* Animación suave para los items de competencia */
    .col-12 > div {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .col-12 > div:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Responsive: ajustar botones en pantallas pequeñas */
    @media (max-width: 576px) {
        .rating-option {
            max-width: 50px;
        }
        
        .rating-btn {
            height: 45px;
            font-size: 1rem;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // URL del Google Apps Script
    const scriptUrl = 'https://script.google.com/macros/s/AKfycbxcYWn7oeHYQkpapDSAQDFbD2qL8wKB076avDxVNg8dcEhCZJUOV0RmcGJDuSahrkqmhw/exechttps://script.google.com/macros/s/AKfycbyowtQ1d-F-QY_D2QzakXnT8fzXss25cJfhjTcIRA9DxG0cU6Ib6qsGpzG9zbKLX4VD/exec?action=doPost';

    // Función para obtener el texto del select (nombre_apellidos)
    function getSelectedText(selectId) {
        const select = document.getElementById(selectId);
        return select.options[select.selectedIndex]?.text || '';
    }

    // Función para validar el formulario
    function validarFormulario() {
        const evaluadorId = document.getElementById('evaluador_id').value;
        const evaluadoId = document.getElementById('evaluado_id').value;
        
        if (!evaluadorId || !evaluadoId) {
            alert('Por favor selecciona evaluador y evaluado');
            return false;
        }

        // Verificar que todas las competencias tengan nota
        const competenciasInputs = document.querySelectorAll('input[name^="notas["]');
        const competenciasIds = new Set();
        
        competenciasInputs.forEach(input => {
            const match = input.name.match(/notas\[(\d+)\]/);
            if (match) {
                competenciasIds.add(match[1]);
            }
        });

        for (let competenciaId of competenciasIds) {
            const radioSeleccionado = document.querySelector(`input[name="notas[${competenciaId}]"]:checked`);
            if (!radioSeleccionado) {
                alert('Por favor califica todas las competencias');
                return false;
            }
        }

        return true;
    }

    // Función para recopilar los datos del formulario
    function recopilarDatos() {
        const evaluadorNombre = getSelectedText('evaluador_id');
        const evaluadoNombre = getSelectedText('evaluado_id');
        
        const competencias = [];
        const competenciasInputs = document.querySelectorAll('input[name^="notas["]:checked');
        
        competenciasInputs.forEach(input => {
            const match = input.name.match(/notas\[(\d+)\]/);
            if (match) {
                const competenciaId = match[1];
                const nota = input.value;
                
                // Obtener el nombre de la competencia del DOM
                const competenciaElement = input.closest('.col-12').querySelector('.text-dark.fw-medium');
                const competenciaNombre = competenciaElement ? competenciaElement.textContent.trim() : `Competencia ${competenciaId}`;
                
                competencias.push({
                    id: competenciaId,
                    nombre: competenciaNombre,
                    nota: nota
                });
            }
        });

        return {
            evaluador: evaluadorNombre,
            evaluado: evaluadoNombre,
            competencias: competencias,
            fecha: new Date().toLocaleDateString('es-ES', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            }).split('/').reverse().join('-')
        };
    }

    // Función para enviar cada competencia a Google Sheets
    async function enviarCompetenciaAGoogleSheets(evaluador, evaluado, competencia, fecha, index, total) {
        try {
            const datos = new FormData();
            datos.append('evaluador', evaluador);
            datos.append('evaluado', evaluado);
            datos.append('competencia_nombre', competencia.nombre);
            datos.append('nota', competencia.nota);

            await fetch(scriptUrl, {
                method: 'POST',
                body: datos,
                mode: 'no-cors'
            });

            console.log(`Competencia ${index}/${total} enviada: ${competencia.nombre} - Nota: ${competencia.nota}`);
            
        } catch (error) {
            console.error(`Error enviando competencia ${competencia.nombre}:`, error);
            throw error;
        }
    }

    // Función principal para enviar todos los datos
    async function enviarDatosCompletos() {
        // Validar formulario
        if (!validarFormulario()) {
            return;
        }

        // Mostrar loading
        const btnGuardar = document.getElementById('btnGuardar');
        const textoOriginal = btnGuardar.innerHTML;
        btnGuardar.disabled = true;
        btnGuardar.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Enviando...';
        try {
            const datos = recopilarDatos();
            
            console.log('Datos a enviar:', datos);

            // Enviar cada competencia individualmente
            for (let i = 0; i < datos.competencias.length; i++) {
                await enviarCompetenciaAGoogleSheets(
                    datos.evaluador,
                    datos.evaluado,
                    datos.competencias[i],
                    datos.fecha,
                    i + 1,
                    datos.competencias.length
                );
                
                // Pequeña pausa entre envíos para no saturar
                await new Promise(resolve => setTimeout(resolve, 1500));
            }

            // Mostrar mensaje de éxito
            btnGuardar.innerHTML = '<i class="bi bi-check-circle me-2"></i>¡Enviado con éxito!';
            btnGuardar.classList.remove('btn-info');
            btnGuardar.classList.add('btn-success');

            alert(`✅ Calificación guardada con éxito!\n\nEvaluador: ${datos.evaluador}\nEvaluado: ${datos.evaluado}\nCompetencias calificadas: ${datos.competencias.length}`);

            // Opcional: recargar la página después de 2 segundos
            setTimeout(() => {
                window.location.reload();
            }, 2000);

        } catch (error) {
            console.error('Error general:', error);
            alert('❌ Hubo un error al enviar los datos. Por favor, intente nuevamente.');
            
            // Restaurar botón
            btnGuardar.disabled = false;
            btnGuardar.innerHTML = textoOriginal;
        }
    }

    // Asignar evento al botón de guardar cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        const btnGuardar = document.getElementById('btnGuardar');
        if (btnGuardar) {
            btnGuardar.addEventListener('click', enviarDatosCompletos);
        }
    });

    // Validación de Bootstrap
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                event.preventDefault();
                event.stopPropagation();
            }, false);
        });
    })();
</script>