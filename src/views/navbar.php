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
      <li class="nav-item <?php if ($page === 'install') { print 'active'; } ?>">
        <a class="nav-link" href="/install">Install</a>
      </li>
      <?php if ($loggedin): ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['user']['username'] ?></a>
        <div class="dropdown-menu" aria-labelledby="user-menu">
          <a class="dropdown-item" href="/logout">Logout</a>
        </div>
      </li>
      <?php else: ?>
      <li class="nav-item <?php if ($page === 'login') { print 'active'; } ?>">
        <a class="nav-link" href="/login">Login</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
