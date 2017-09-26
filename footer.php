  <footer id="footer" class="padding-top-basic padding-bottom-small border-top-white">
    <div class="container">
      <div class="grid-row justify-between">

        <div class="grid-item item-s-12 item-m-auto item-l-4 grid-row no-gutter margin-bottom-small">
          <div class="grid-item item-s-6 item-m-auto"><a href="<?php echo home_url(); ?>"><?php echo url_get_contents(get_template_directory_uri() . '/dist/img/bread.svg'); ?></a></div>

          <div class="grid-item flex-grow font-size-tiny">
          <?php
            $options = get_site_option('_igv_site_options');

            if (!empty($options['contact_tel'])) {
          ?>
            <div class="margin-bottom-tiny">
              <a class="link-underline" href="tel:<?php echo $options['contact_tel']; ?>"><?php echo $options['contact_tel']; ?></a>
            </div>
          <?php
            }

            if (!empty($options['contact_email'])) {
          ?>
            <div>
              <a class="link-underline" href="mailto:<?php echo $options['contact_email']; ?>"><?php echo $options['contact_email']; ?></a>
            </div>
          <?php
            }
          ?>
          </div>
        </div>

        <div class="grid-item item-s-12 item-m-auto item-l-6 margin-bottom-small no-gutter">
<?php
            if (!empty($options['contact_mailchimp_action'])) {
?>
          <form action="<?php echo $options['contact_mailchimp_action']; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" class="font-sans grid-row">
            <input placeholder="Email" type="email" name="EMAIL" id="mce-EMAIL" class="font-size-tiny grid-item item-s-5 item-m-7 item-l-4">
<?php
              if (!empty($options['contact_mailchimp_validation'])) {
?>
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="<?php echo $options['contact_mailchimp_validation']; ?>" tabindex="-1" value=""></div>
<?php
              }
?>
            <input type="submit" class="font-size-tiny font-bold grid-item item-s-6 offset-s-1 item-m-auto text-align-left" value="<?php _e('[:en]Subscribe[:es]Suscribirse[:]'); ?>">
          </form>
<?php
            }
?>
        </div>

        <div id="social-icons" class="grid-item item-s-12 item-m-auto item-l-2 margin-bottom-small">
          <ul class="u-inline-list">
          <?php
            if (!empty($options['socialmedia_instagram'])) {
          ?>
            <li><a href="https://instagram.com/<?php echo $options['socialmedia_instagram']; ?>"><?php echo url_get_contents(get_template_directory_uri() . '/dist/img/icon_ig.svg'); ?></a></li>
          <?php
            }

            if (!empty($options['socialmedia_facebook_url'])) {
          ?>
            <li><a href="<?php echo $options['socialmedia_facebook_url']; ?>"><?php echo url_get_contents(get_template_directory_uri() . '/dist/img/icon_fb.svg'); ?></a></li>
          <?php
            }

            if (!empty($options['socialmedia_twitter'])) {
          ?>
            <li><a href="https://twitter.com/<?php echo $options['socialmedia_twitter']; ?>"><?php echo url_get_contents(get_template_directory_uri() . '/dist/img/icon_tw.svg'); ?></a></li>
          <?php
            }
          ?>
          </ul>
        </div>

      </div>
    </div>
  </footer>

</section>

<?php
get_template_part('partials/scripts');
get_template_part('partials/schema-org');
?>

</body>
</html>
