<form action="{{ route('ejercicio.update', $ejercicio->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Campos del formulario para editar los detalles del ejercicio -->
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="{{ $ejercicio->nombre }}">
    <!-- Otros campos del formulario (duracion, descripcion, etc.) -->

    <!-- Botón de enviar el formulario -->
    <button type="submit">Guardar cambios</button>
</form>
