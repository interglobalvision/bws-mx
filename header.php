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

  <header id="header" class="container">
    <div class="grid-row padding-top-tiny padding-bottom-tiny">
      <div class="grid-item item-m-2">
        <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
      </div>
      <div class="grid-item item-m-6 font-serif">
        <?php
          $options = get_site_option('_igv_site_options');

          if (!empty($options['header_strapline'])) {
            echo $options['header_strapline'];
          }
        ?>
      </div>
      <div class="grid-item item-m-3">
        <ul class="u-inline-list">
          <li><a href="<?php echo home_url('archive'); ?>"><?php echo __('[:es]Archivo[:en]Archive'); ?></a></li>
          <li><a href="<?php echo home_url('information'); ?>"><?php echo __('[:es]Información[:en]Information'); ?></a></li>
        </ul>
      </div>
      <div class="grid-item item-m-1 text-align-right">
        <?php echo qtranxf_generateLanguageSelectCode('text'); ?>
      </div>
  </header>
