<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="./"><i class="fa-solid fa-film"></i> Archiv für Filmfreunde</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      {*
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./"><i class="fa-solid fa-home"></i> Home</a>
        </li>
      </ul>
      *}
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex">
        {if $isLoggedIn}
        <li class="nav-item navbar-text">
          <i class="fa-solid fa-user"></i> {$currentUser}
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./?controller=security&action=logout"><i class="fa-solid fa-sign-out"></i> Logout</a>
        </li>
        {else}
        <li class="nav-item">
          <a class="nav-link" href="./?controller=security&action=login"><i class="fa-solid fa-sign-in"></i> Login</a>
        </li>
        {/if}
      </ul>
    </div>
  </div>
</nav>
