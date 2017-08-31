  <footer id="footer" class="padding-top-basic padding-bottom-small border-top-white">
    <div class="container">
      <div class="grid-row justify-between">

        <div class="grid-item item-s-12 item-m-auto item-l-4 grid-row no-gutter margin-bottom-small">
          <h2 id="footer-logo" class="grid-item item-s-6 item-m-auto font-logo"><a href="<?php echo home_url(); ?>">BWSMX</a></h2>

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

        <div class="grid-item item-s-6 item-m-auto item-l-6 margin-bottom-small">
        <?php
          if (!empty($options['contact_mailchimp'])) {
            echo $options['contact_mailchimp'];
          } else {
            echo 'maiaiilllchiiiimppppp';
          }
        ?>
        </div>

        <div id="social-icons" class="grid-item item-s-6 item-m-auto item-l-2 margin-bottom-small">
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
