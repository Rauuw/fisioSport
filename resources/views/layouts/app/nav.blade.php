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
                    <a href="#">
                        <i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{ route('listar_pacientes') }}">
                        <i class='bx bx-user icon'></i>
                        <span class="text nav-text">Pacientes</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{ route('listar_ejercicios') }}">
                        <i class='bx bx-dumbbell icon'></i>
                        <span class="text nav-text">Lista Ejercicios</span>
                    </a>
                </li>


                <li class="nav-link">
                    <a href="{{ route('crear_notificacion') }}">
                        <i class='bx bx-message-square-dots icon'></i>
                        <span class="text nav-text">Enviar mensajes</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{ route('ver_notificaciones') }}">
                        <i class='bx bx-message icon'></i>
                        <span class="text nav-text">Ver mensajes</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#" class="toggle-link" data-target="#ejercicios">
                        <i class='bx bx-run icon'></i>
                        <span class="text nav-text">Ejercicios</span>
                    </a>
                    <ul id="ejercicios" class="sub-menu">
                        <li class="nav-link">
                            <a href="{{ route('tracking') }}">
                                <i class='bx bx-right-arrow-alt icon'></i>
                                <span class="text nav-text">Realizar ejercicios</span>
                            </a>
                        </li>
                    </ul>
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
