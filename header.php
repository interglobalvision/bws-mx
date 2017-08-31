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

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.png">
  <link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.ico">
  <link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-touch.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.png">

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
      <div class="grid-row padding-top-tiny padding-bottom-tiny align-items-end">

        <div class="grid-item item-m-3 item-l-7 item-xl-8 grid-row no-gutter align-items-end">
          <h1 id="header-logo" class="grid-item item-l-4 item-xl-2 font-logo font-size-extra"><a href="<?php echo home_url(); ?>">BWSMX</a></h1>

<?php
  $options = get_site_option('_igv_site_options');

  if (!empty($options['header_strapline'])) {
?>
          <div id="strapline" class="grid-item item-l-8 item-xl-10 font-serif font-italic font-size-mid desktop-only">
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
