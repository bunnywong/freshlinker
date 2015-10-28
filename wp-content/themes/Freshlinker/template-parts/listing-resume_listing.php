<?php
/**
* Display all resume listing
*
* @package WordPress
* @subpackage Job_Board
* @since Job Board 1.3
*
*/
?>



<div id="jobs-listing" class="related-job-listing featured-job">
  <div class="container">

    <div class="jobs-listing-title">
      <h3 class="uppercase">
        <i class="fa fa-user"></i>
        <?php the_title(); ?>
      </h3>
    </div>


    <div id="all_resumes">

      <?php


      $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

      $resume_args = array();

      $resume_args['post_type'] = 'resume';
      $resume_args['posts_per_page'] = 7;
      $resume_args['paged'] = $paged;


      /** Refine query by keyword search **/

      if( isset($_GET['resume_search_keyword']) && $_GET['resume_search_keyword'] != '' ) :
        $resume_args['s'] = $_GET['resume_search_keyword'];
      endif;


      /* Refine query by resume category and career level */


      // Resume Category
      if( isset($_GET['resume_category']) && $_GET['resume_category'] != '' ) :

        $resume_category = $_GET['resume_category'];
        $resume_category_array = array(
          'taxonomy'	=> 'resume_category',
          'field'		  => 'slug',
          'terms'	  	=> array($resume_category),
        );
        $resume_args['tax_query']	= array(
          $resume_category_array
        );

      endif;

      // Career Level
      if( isset($_GET['career_level']) && $_GET['career_level'] != '' ) :

        $career_level = $_GET['career_level'];
        $career_level_array = array(
          'taxonomy'	=> 'career_level',
          'field'		=> 'slug',
          'terms'		=> array($career_level),
        );
        $resume_args['tax_query']	= array(
          $career_level_array
        );

      endif;


      // Resume Category & Career Level
      if( ( isset($_GET['resume_category']) && $_GET['resume_category'] != '' ) && ( isset($_GET['career_level']) && $_GET['career_level'] != '' ) ) :

        $resume_args['tax_query']	= array(
          'relation' => 'AND', // relation
          $resume_category_array, // Resume category
          $career_level_array // Career level
        );

      endif;



      /** Meta query **/


      /** Salary range **/

      $resume_search_salary = null;
      if( isset($_GET['resume_search_expected_salary_to']) && !empty($_GET['resume_search_expected_salary_to']) ){

        /*
        $resume_args['meta_query'] = array(

          array(
            'key' => '_resume_monthly_salary',
            'value' => array($_GET['resume_search_expected_salary_from'], $_GET['resume_search_expected_salary_to']),
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
          ),

        );
        */


        $resume_search_salary = array(
          'key' => '_resume_monthly_salary',
          'value' => array($_GET['resume_search_expected_salary_from'], $_GET['resume_search_expected_salary_to']),
          'compare' => 'BETWEEN',
          'type' => 'NUMERIC'
        );


      }

      /** Salary range ends **/

      /** Experience year **/

      $resume_search_experience = null;
      if( isset($_GET['resume_search_experience']) && $_GET['resume_search_experience'] != '' ) {

        /*
        $resume_args['meta_query'] = array(

          array(
            'key' => '_resume_experience',
            'value' => $_GET['resume_search_experience'],
            'compare' => 'IN'
          ),

        );
        */

        $resume_search_experience = array(
          'key' => '_resume_experience',
          'value' => $_GET['resume_search_experience'],
          'compare' => 'IN'
        );

      }

      /** Experience year ends **/

      /** Location **/
      $resume_search_location = null;
      if( isset($_GET['resume_search_location']) && $_GET['resume_search_location'] != '' ) {


        /*
        $resume_args['meta_query'] = array(

          array(
            'key' => '_resume_location',
            'value' => $_GET['resume_search_location'],
            'compare' => 'LIKE'
          ),

        );
        */

        $resume_search_location = array(
          'key' => '_resume_location',
          'value' => $_GET['resume_search_location'],
          'compare' => 'LIKE'
        );

      }
      /** Location ends **/


      /** Enable multiple meta query **/
      $resume_args['meta_query'] = array(
        $resume_search_salary,
        $resume_search_experience,
        $resume_search_location
      );

      $resumes = new WP_Query($resume_args);

      if( $resumes->have_posts() ) {

        echo '<div class="table-responsive"><table class="item-listing-table">';

      while( $resumes->have_posts() ) {
        $resumes->the_post();


        $resume_data = array(

          'title' => get_the_title(),
          'professional_title' => vp_metabox('jobboard_resume_mb.resume_professional_title', null, get_the_id()),
          'experience_year' => vp_metabox('jobboard_resume_mb.year_experience'),
          'location' => vp_metabox('jobboard_resume_mb.resume_location'),
          'sallary' => vp_metabox('jobboard_resume_mb.proposed_monthly_sallary') . __('/month', 'jobboard')

        );

        /** Resume meta data **/

        $resume_metadata = get_post_meta(get_the_ID(), 'jobboard_resume_mb', true);

        ?>


              <!-- item row starts -->
              <tr class="an-item-listing-row">
                <td class="padding-left-right-20">
                  <div class="an-item-col first-item-col">
                    <?php
                    $resume_thumbnail = get_the_post_thumbnail( get_the_id(), 'jobboard-resume-listing-img' );
                    echo $resume_thumbnail;
                    ?>
                  </div><!-- /.job-company-logo -->
                </td>
                <td class="has-left-border padding-left-right-20">
                  <div class="an-item-col resume-listing-name">
                    <h4><?php echo $resume_data['title']; ?></h4>
                    <p class="person-job-occupation"><?php echo $resume_data['professional_title']; ?></p>
                  </div><!-- /.an-item-col -->
                </td>
                <td class="has-left-border padding-left-right-20">
                  <div class="an-item-col resume-experience">
                    <i class="fa fa-fw fa-certificate fa-orange"></i>
                    <?php
                    $year = __(' years', 'jobboard');
                    if ($resume_data['experience_year'] == '1') {
                      $year = __(' year', 'jobboard');
                    }
                    echo $resume_data['experience_year'] . $year;
                    ?>
                  </div><!-- /.an-item-col -->
                </td>
                <td class="has-left-border padding-left-right-20">
                  <div class="an-item-col resume-listing-region">
                    <i class="fa fa-fw fa-map-marker"></i>
                    <?php echo $resume_data['location']; ?>
                  </div><!-- /.job-listing-region -->
                </td>
                <td class="has-left-border padding-left-right-20">
                  <div class="an-item-col resume-rate">
                    <i class="fa fa-fw fa-dollar fa-green"></i>
                    <?php echo $resume_data['sallary']; ?>
                  </div><!-- /.an-item-col -->
                </td>
                <td class="has-left-border padding-left-25">
                  <div class="an-item-col job-listing-view">
                    <a class="btn btn-blue rounded-5 view-resume-btn" href="<?php echo esc_url( get_permalink(get_the_id()) ); ?>" class="btn btn-view-job"><?php _e( 'View Resume', 'jobboard' ) ?></a>
                  </div><!-- /.job-listing-view -->
                </td>
              </tr>
              <tr class="tr-space has-border-bottom"></tr>
              <tr class="tr-space"></tr>
              <!-- item row ends -->


      <?php

      } // endwhile


      echo '</table></div>';


      $big = 999999999; // need an unlikely integer

      echo '<div class="dashboard-pagination">';

      echo paginate_links( array(
        'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'	=> '?paged=%#%',
        'current'	=> max( 1, get_query_var('paged') ),
        'total'		=> $resumes->max_num_pages,
        'prev_text'	=> __( 'Previous', 'jobboard' ),
        'next_text' => __( 'Next', 'jobboard' ),
        ) );

        echo '</div><!-- /.dashboard-pagination -->';

        wp_reset_postdata();


      } // endif

      else {


        echo __('<h4>No resume found</h4>', 'jobboard');

      }

      ?>


    </div><!-- /#all_resumes -->



  </div><!-- /.container -->
</div><!-- /#jobs-listing -->
