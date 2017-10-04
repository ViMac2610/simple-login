<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="/">Simple Login</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if ($page === 'home') { print 'active'; } ?>">
        <a class="nav-link" href="/">Home</a>
      </li>
      <?php if (!$loggedin): ?>
      <li class="nav-item <?php if ($page === 'login') { print 'active'; } ?>">
        <a class="nav-link" href="/login">Login</a>
      </li>
      <?php endif; ?>
      <?php if ($loggedin): ?>
      <li class="nav-item <?php if ($page === 'logout') { print 'active'; } ?>">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
