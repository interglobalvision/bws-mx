<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
get_template_part('partials/globie');
get_template_part('partials/seo');
?>

  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-16x16.png" sizes="16x16" />
  <meta name="application-name" content="BWSMX"/>
  <meta name="msapplication-TileColor" content="#F8F9FA" />
  <meta name="msapplication-TileImage" content="<?php bloginfo('stylesheet_directory'); ?>/dist/img/mstile-144x144.png" />


<?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php } ?>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<section id="main-container">

  <header id="header">
    <div class="container">
      <div class="grid-row padding-top-tiny padding-bottom-tiny align-items-baseline">

        <div class="grid-item item-m-3 item-l-7 item-xl-8 grid-row no-gutter align-items-baseline">
          <h1 id="header-logo" class="grid-item"><a href="<?php echo home_url(); ?>"><?php echo url_get_contents(get_template_directory_uri() . '/dist/img/bread.svg'); ?></a></h1>

<?php
  $options = get_site_option('_igv_site_options');

  if (!empty($options['header_strapline'])) {
?>
          <div id="strapline" class="grid-item flex-grow font-serif font-italic font-size-mid desktop-only">
            <?php
              echo $options['header_strapline'][array_rand($options['header_strapline'], 1)] . ', ';
              _e('[:en]Mexico City[:es]Ciudad de México[:]');
            ?>
          </div>
<?php
  }
?>

        </div>

        <nav id="main-nav" class="grid-item item-m-7 item-l-4 item-xl-3 flex-grow">
          <ul class="u-inline-list font-bold">
            <li><a href="<?php echo home_url('archive'); ?>"><?php echo __('[:es]Archivo[:en]Archive'); ?></a></li>
            <li><a href="<?php echo home_url('information'); ?>"><?php echo __('[:es]Información[:en]Information'); ?></a></li>
          </ul>
        </nav>

        <div class="grid-item item-m-2 item-l-1 text-align-right">
          <?php echo qtranxf_generateLanguageSelectCode('text'); ?>
        </div>

      </div>
    </div>
  </header>
