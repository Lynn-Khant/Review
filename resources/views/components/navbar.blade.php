<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a
            class="navbar-brand"
            href="/"
        >R3VIEW</a>
        <div class="d-flex">
            <a
                href="#home"
                class="nav-link"
            >Home</a>
            <a
                href="#blogs"
                class="nav-link"
            >Blogs</a>
            @if(!auth()->check())
            <a 
                href="/register"
                class="nav-link">
            Register</a>
            <a 
                href="/login"
                class="nav-link">
            Login</a>
            @else
            <a
                href="#"
                class="nav-link">
            {{auth()->user()->name}}</a>
            <form
                action="/logout"
                method="POST">
                @csrf
                <button type="submit" class="nav-link btn btn-link">Logout</button>
            </form>
            @endif
        </div>
    </div>
</nav>