<nav
    class="navbar navbar-expand-md m-1 rounded rounded-5 navbar-dark fixed-top"
    style="background: <?= $bg_color ?? "rgba(179, 173, 173, 0.27)" ?>;">
    <div class="container-fluid">
        <a class="navbar-brand" style="padding-left: 10px;" href="/">Save Your Cite</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="citation/create.php">Create</a>
                </li>
            </ul>
            <form action="/" method="GET" class="d-flex">
                <input name="search" style="background: none;" class="form-control me-2 rounded rounded-4" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-none text-white rounded rounded-4 border border-white" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>