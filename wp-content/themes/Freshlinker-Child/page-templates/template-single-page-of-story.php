<?php

/**
 * Template Name: Single Page Story
 *
 */
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <script>document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/,"") + " js";</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="<?= get_site_url(); ?>/wp-content/themes/Freshlinker-Child/inc/css/single-page-story.css?<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
  <link rel="icon" href="favicon.ico" sizes="16x16 32x32 48x48 64x64">
  <link rel="icon" href="favicon.png" sizes="192x192">
</head>

<body>
<div id="js-main" class="main">
  <div class="my-logo-wrapper">
    <a href="http://<?php echo get_option('home'); ?>" class="header-logo" title="Freshlinker">
      <img src="/wp-content/uploads/2015/12/fresh-logo.png"></a>
    </a>
  </div>
  <div class="lang-wrapper">
    <span><a href="/lead" class="js-lang">正體中文</a></span>
  </div>
  <div class="flexbox-fix-for-ie">
    <header class="section-intro vertical-center">
      <div class="container">
        <h1 class="headline animated slideInDown wow">
          <strong>FreshLinker<br><span>Project LEAD. 5-day HIGH DENSITY CAREER TRAINING CAMP</span></strong>
        </h1>
        <h2 class="main-sub-title">Register Now !</h2>
        <nav id="js-nav" class="mainnav animated slideInUp">
          <ul>
            <?php
              $custom_filed_qty = 7;
              for ($i=1; $i<=$custom_filed_qty; $i++) {
                echo '<li><a href="#' . sanitize_title(get_field('custom_title_' . $i)). '">';
                the_field('custom_title_' . $i);
                echo '</a></li>';
              }
            ?>
          </ul>
        </nav>
      </div>
    </header>
  </div>

  <?php for($i=1; $i<=$custom_filed_qty; $i++): ?>
    <?php
      if ($i%2==0) {
        $style = 'bglight';
        $direction = 'slideInLeft';
      }
      else {
        $style = 'bgdark';
        $direction = 'slideInRight';
      }
    ?>
    <section id="<?= sanitize_title(get_field('custom_title_' . $i)); ?>" class="section-about <?= $style ?> data-wow-duration=\"2s\" data-wow-delay=\"5s\"">
      <div class="container">
        <h1 class="headline animated slideInDown wow">
          <?php echo the_field('custom_title_' . $i); ?>
        </h1>
        <div id="basic-waypoint-<?= $i; ?>" class="text animated slideInUp wow" data-wow-duration=\"1s\" data-wow-delay=\"20s\">
          <?php echo the_field('custom_content_' . $i); ?>
        </div>
      </div>
    </section>
  <?php endfor; ?>

  <section id="connect" class="section-connect wow bounceInUp center animated js-connect">
    <div class="container">
      <h1 class="headline">Register form</h1>
      <?php
          if( function_exists( 'ninja_forms_display_form' ) ){
            // Contact form for Development / Production
            $_SERVER["HTTP_HOST"] === 'f.freshlinker.com' ? $from_id = 1 : $from_id = 5;
            ninja_forms_display_form($from_id);
          }
        ?>
      </div>
  </section>
</div>

  <script src="<?= get_site_url(); ?>/wp-content/themes/Freshlinker-Child/inc/js/single-page-story.js?<?php echo time(); ?>" async></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
  <script>
    new WOW().init();
  </script>

</body>
</html>

