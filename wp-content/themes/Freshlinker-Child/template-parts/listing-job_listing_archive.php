<?php
/**
 * Template Part Name : Archive Job Listing
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */
?>
<div id="jobs-listing" class="related-job-listing featured-job">
  <div class="container">
    <div class="jobs-listing-title">
      <h3>
        <i class="fa fa-briefcase"></i>
        <?php

        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        echo $term->name;

        $job_category_slug = $term->slug;

        ?>
      </h3>
    </div>
    <div class="jobs-listing-wrapper">
      <div id="job-listing-tabs">
        <ul>
        <?php
          echo '<li><a href="#all_jobs">'.__( 'All', 'jobboard' ).'</a></li>';
          $job_types = get_terms('job_type');
          foreach( $job_types as $job_type ){
            echo '<li><a href="#'.$job_type->slug.'-'.$job_type->term_id.'">'.esc_attr( $job_type->name ).'</a></li>';
          }
        ?>
        </ul>
        <div id="all_jobs">
        <?php

          $job_args = array(
            'post_type' => 'job',
            'job_category' => $job_category_slug
          );

          $jobs = new WP_Query($job_args);
          while( $jobs-> have_posts() ){
            $jobs->the_post();
          ?>
          <div class="job-listing-row clearfix">
            <div class="job-company-logo">
            <?php
              $comp_id = get_post_meta( get_the_id(), '_jboard_job_company', true );
              echo get_the_post_thumbnail( $comp_id , 'jobboard-related-company-logo-thumbnail' );
            ?>
            </div><!-- /.job-company-logo -->
            <div class="job-listing-name">
              <h4><?php echo esc_attr( get_the_title() ); ?></h4>
              <p class="job-listing-summary"><?php echo get_post_meta( get_the_id(), '_jboard_job_summary', true ); ?></p>
            </div><!-- /.job-listing-name -->
            <div class="job-listing-region">
              <?php
                $job_taxs = get_the_terms( get_the_id(), 'job_nature' );
                if($job_taxs){
                  foreach( $job_taxs as $job_tax ){
                    echo '<span>' . esc_attr( $job_tax->name ) . '</span>';
                  }
                }
              ?>
            </div><!-- /.job-listing-region -->
            <div class="job-listing-type">
              <i class="fa fa-fw fa-user"></i>
              <?php
                $job_taxs = get_the_terms( get_the_id(), 'job_type' );
                if($job_taxs){
                  foreach( $job_taxs as $job_tax ){
                    echo esc_attr( $job_tax->name );
                  }
                }
              ?>
            </div><!-- /.job-listing-type -->
            <div class="job-listing-view">
              <a href="<?php echo esc_url( get_permalink(get_the_id()) ); ?>" class="btn btn-view-job"><?php _e( 'View Job', 'jobboard' ) ?></a>
            </div><!-- /.job-listing-view -->
          </div><!-- /#job-listing-<?php echo esc_attr( get_the_id() ); ?> -->
        <?php
          } //endwhile;
          wp_reset_postdata();
        ?>
        </div><!-- /#all_jobs -->
        <?php
          foreach( $job_types as $job_type ){
        ?>
        <div id="<?php echo $job_type->slug.'-'.$job_type->term_id; ?>">
        <?php
          $job_args['tax_query'] = array(
            array(
              'taxonomy' => 'job_type',
              'terms' => $job_type->term_id,
            ),
          );
          $jobs = new WP_Query($job_args);
          while( $jobs-> have_posts() ){
            $jobs->the_post();
        ?>
          <div class="job-listing-row clearfix">
            <div class="job-company-logo">
            <?php
              $comp_id = get_post_meta( get_the_id(), '_jboard_job_company', true );
              echo get_the_post_thumbnail( $comp_id , 'jobboard-related-company-logo-thumbnail' );
            ?>
            </div><!-- /.job-company-logo -->
            <div class="job-listing-name">
              <h4><?php echo esc_attr( get_the_title() ); ?></h4>
              <p class="job-listing-summary"><?php echo get_post_meta( get_the_id(), '_jboard_job_summary', true ); ?></p>
            </div><!-- /.job-listing-name -->
            <div class="job-listing-region">
              <i class="fa fa-fw fa-map-marker"></i>
              <?php
                $job_taxs = get_the_terms( get_the_id(), 'job_region' );
                if($job_taxs){
                  foreach( $job_taxs as $job_tax ){
                    echo esc_attr( $job_tax->name );
                  }
                }
              ?>
            </div><!-- /.job-listing-region -->
            <div class="job-listing-type">
              <i class="fa fa-fw fa-user"></i>
              <?php
                $job_taxs = get_the_terms( get_the_id(), 'job_type' );
                if($job_taxs){
                  foreach( $job_taxs as $job_tax ){
                    echo esc_attr( $job_tax->name );
                  }
                }
              ?>
            </div><!-- /.job-listing-type -->
            <div class="job-listing-view">
              <a href="<?php echo esc_url( get_permalink(get_the_id()) ); ?>" class="btn btn-view-job"><?php _e( 'View Job', 'jobboard' ) ?></a>
            </div><!-- /.job-listing-view -->
          </div><!-- /#job-listing-<?php echo esc_attr( get_the_id() ); ?> -->
        <?php
          } //endwhile;
          wp_reset_postdata()
        ?>
        </div><!-- /#<?php echo esc_attr( $job_type->slug ).'-'.esc_attr( $job_type->term_id ); ?> -->
        <?php
          } //endforeach;
        ?>
      </div><!-- /#job-listing-tabs -->
    </div><!-- /.jobs-listing-wrapper -->
  </div><!-- /.container -->
</div><!-- /#jobs-listings -->
