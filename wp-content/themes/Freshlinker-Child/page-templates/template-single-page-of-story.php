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
  <link rel="stylesheet" href="<?= get_site_url(); ?>/wp-content/themes/Freshlinker-Child/inc/css/single-page-story.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
  <link rel="icon" href="favicon.ico" sizes="16x16 32x32 48x48 64x64">
  <link rel="icon" href="favicon.png" sizes="192x192">
</head>
<body>
    <?php
      // while( have_posts() ){
      //   // the_post();
      //   // the_content();
      // }//endwhile;

      /* Ref
        https://daneden.github.io/animate.css/
        http://mynameismatthieu.com/WOW/docs.html
      */
    ?>
<div id="js-main" class="main">
<!-- <a href="http://f.freshlinker.com/" class="header-logo" title="Freshlinker">
            <img src="http://f.freshlinker.com/wp-content/uploads/2015/07/FreshLinker_logo-42.png" alt="Freshlinker"></a> -->
  <div class="flexbox-fix-for-ie">
    <header class="section-intro vertical-center">
      <div class="container">
        <h1 class="headline animated slideInDown wow">
          <!-- <strong><?php wp_title( '-', true, 'right' ); ?></strong> -->
          <strong>Freshlinker<br><span>Project LEAD. 5-day HIGH DENSITY CAREER TRAINING CAMP</span></strong>
        </h1>
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
          if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 1 ); }
        ?>
      </div>
  </section>
</div>

  <script>
    var currentLang = '<? echo ICL_LANGUAGE_CODE; ?>';
  </script>
  <script src="<?= get_site_url(); ?>/wp-content/themes/Freshlinker-Child/inc/js/single-page-story.js" async></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
  <script>
    new WOW().init();
  </script>

</body>
</html>

