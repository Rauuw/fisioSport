
              <!--   <ul id="rutinas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                    style="">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('martillo') }}">Ejercicio 1</a></li>
                </ul>
                <ul id="rutinas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                    style="">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('entrelazada') }}">Ejercicio 2</a></li>
                </ul>
                <ul id="rutinas" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                    style="">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('lateral') }}">Ejercicio 3</a></li>
                </ul>
            </li>


            <li class="sidebar-item">
                <a data-bs-target="#notifications" data-bs-toggle="collapse" class="sidebar-link collapsed"
                    aria-expanded="false">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="align-middle">Notificaciones</span>
                </a>
                <ul id="notifications" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                    style="">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('crear_notificacion_paciente') }}">Crear
                            notificación</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('ver_notificaciones') }}">Ver
                            notificaciones</a></li>
                </ul>
            </li>

 -->

<nav class="sidebar">
        <header>
            <div class="image-text">
                <div class="text logo-text">
                    <span class="name">FisioSport</span>
                </div>
            </div>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    Opciones
                </li>

                <ul class="menu-links">
                    
                   <li class="nav-link">
                        <a href="">
                            <i class='bx bx-dumbbell icon'></i>
                            <span class="text nav-text">Mis Rutinas</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                    <!-- Añadir contenido adicional aquí si es necesario -->
            </div>
        </div>
    </nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var toggleLinks = document.querySelectorAll('.toggle-link');
    toggleLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var target = document.querySelector(this.getAttribute('data-target'));
            this.parentElement.classList.toggle('active');
        });
    });
});

</script>