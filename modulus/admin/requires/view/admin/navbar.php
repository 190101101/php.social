<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">Panel</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo segment(1) != '' ?: 'active'; ?>" href="/">home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo segment(1) != '' ?: 'active'; ?>" href="/panel/admin">panel</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              other
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <?php if(User::has()): ?>
              <a class="dropdown-item" 
              href="/mode/<?php echo css_mode()->code; ?>">
                <?php echo css_mode()->css_mode == 'dark' ? 'light' : 'dark'; ?>
              </a>
              <?php endif; ?>
              <a class="dropdown-item <?php echo segment(2) != 'setting' ?: 'active'; ?>" href="/panel/setting/page/1">setting</a>
              <a class="dropdown-item <?php echo segment(2) != 'rule' ?: 'active'; ?>" href="/panel/rule/page/1">Rule</a>
              <a class="dropdown-item <?php echo segment(2) != 'faq' ?: 'active'; ?>" href="/panel/faq/page/1">FAQ</a>
              <a class="dropdown-item <?php echo segment(1) != 'contact' ?: 'active'; ?>" href="/panel/contact/page/1">contact</a>
              <a class="dropdown-item <?php echo segment(1) != 'guest' ?: 'active'; ?>" href="/panel/guest/page/1">guest</a>
              <?php if(segment(2) != 'admin' && segment(2) != 'contact' && segment(2) != 'setting'):?>
               <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo segment(1); ?>/<?php echo segment(2); ?>/create">create</a>
              <?php endif; ?>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>


