  </main>

  <footer class="bottom pt-sm pb-4">
    <div class="container">
      <div class="row is-style-wide-gutters">
        <div class="col-lg-3 pb-6">
          <?php dynamic_sidebar('footer-1'); ?>
        </div>
        <div class="col-lg-5 pb-6">
          <?php dynamic_sidebar('footer-2'); ?>
        </div>
        <div class="col-lg-4 pb-6">
          <?php dynamic_sidebar('footer-3'); ?>
        </div>
      </div>

      <div class="row is-style-wide-gutters">
        <div class="col-12">
          <?php if (!is_user_logged_in()): ?>
            <div class="footer-sign-in d-flex align-items-center mt-4">
              <div><?= inline_svg('images/icon-user.svg') ?></div>
              <div><a href="/my-account">Create an account or sign in</a></div>
            </div>
          <?php else: ?>
            <div class="footer-sign-in d-flex align-items-center mt-4">
              <div><?= inline_svg('images/icon-user.svg') ?></div>
              <div><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </footer>

  <?php wp_footer() ?>

</body>
</html>
