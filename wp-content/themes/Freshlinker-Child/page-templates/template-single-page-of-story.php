<?php

/**
 * Template Name: Single Page Story
 *
 * Structure:
 * 1 - [ ] Opening page
 * 2 - [ ] Introduction 宗旨
 * 3 - [ ] About Project LEAD 簡介
 * 4 - [ ] What is Project LEAD and who is it for? 為您打造的Project LEAD
 * 5 - [ ] Features of the Project 特色
 * 6 - [ ] Recollections of Past Participants 過往參加者反饋
 * 7 - [ ] Quick Facts about the Project 數據速覽
 * 7 - [ ] Next Project LEAD
 * 8 - [ ] Register form
 */

?>
 <?php if(have_posts()) :?>
    <div class="post">
        <div class="entry">
          <?php
            $custom_filed_qty = 8;
            for ($i=0; $i<=$custom_filed_qty; $i++) {
              // the_field('custom_title_' . $i);
              // the_field('custom_content_' . $i);
            }
          ?>
        <?php the_field('custom_title_1'); ?>
        <?php the_field('custom_content_1'); ?>

        </div>
    </div>
<?php endif; ?>
