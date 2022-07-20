<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a href="/" class="navbar-brand">BLOK</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="navbar-item">
                    <a href="/" class="nav-link {{ $title === 'Home' ? 'active' : '' }}">Homo</a>
                </li>
                <li class="navbar-item">
                    <a href="/about" class="nav-link {{ $title === 'About' ? 'active' : '' }}">About</a>
                </li>
                <li class="navbar-item">
                    <a href="/blog" class="nav-link {{ $title === 'Posts' ? 'active' : '' }}">Blog</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
