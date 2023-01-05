<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">Social</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo segment(1) != '' ?: 'active'; ?>" href="/">home</a>
          </li>
          <?php if(User::has()): ?>
          <li class="nav-item">
            <a class="nav-link text-danger <?php echo segment(1) != 'profile' ?: 'active'; ?>" href="/profile/info">
              @<?php echo User::user_login(); ?>
            </a>
          </li>
          <?php endif; ?>

         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              digər
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="/mode/<?php echo css_mode()->code; ?>">
                <?php echo css_mode()->css_mode == 'dark' ? 'light' : 'dark'; ?>
              </a>

              <?php if(Setting::about_page_status() == 1): ?>
              <a class="dropdown-item <?php echo segment(2) != 'about' ?: 'active'; ?>" href="/info/about">haqqımızda</a>
              <?php endif; ?>

              <?php if(Setting::rule_page_status() == 1): ?>
              <a class="dropdown-item <?php echo segment(2) != 'rule' ?: 'active'; ?>" href="/info/rule/page/1">qaydalar</a>
              <?php endif; ?>

              <?php if(Setting::faq_page_status() == 1): ?>
              <a class="dropdown-item <?php echo segment(2) != 'faq' ?: 'active'; ?>" href="/info/faq/page/1">Tez-tez verilən suallar</a>
              <?php endif; ?>

              <?php if(Setting::contact_page_status() == 1): ?>
              <a class="dropdown-item <?php echo segment(1) != 'contact' ?: 'active'; ?>" href="/contact">contact</a>
              <?php endif; ?>

            </div>
          </li>
          <?php if(!User::has()): ?>
          <li class="nav-item">
            <a class="nav-link <?php echo segment(1) != 'auth' ?: 'active'; ?>" href="/auth">login</a>
          </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="/signout">çıxış</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>


