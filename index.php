<?php 
/*
 Plugin Name: Charity Fundraiser Pro Posttype
 Plugin URI: http://www.themesglance.com/
 Description: Creating new post type for Charity Fundraiser Pro Theme.
 Author: Themes Glance
 Version: 1.0
 Author URI: http://www.themesglance.com/
*/

define( 'CHARITY_FUNDRAISER_PRO_POSTTYPE_VERSION', '1.0' );

add_action( 'init', 'charity_fundraiser_pro_posttype_create_post_type' );

function charity_fundraiser_pro_posttype_create_post_type() {
  register_post_type( 'causes',
    array(
      'labels' => array(
        'name' => __( 'Causes','charity-fundraiser-pro-posttype' ),
        'singular_name' => __( 'Causes','charity-fundraiser-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-portfolio',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
  register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Events','charity-fundraiser-pro-posttype' ),
        'singular_name' => __( 'Events','charity-fundraiser-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-tag',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
  register_post_type( 'testimonials',
    array(
  		'labels' => array(
  			'name' => __( 'Testimonials','charity-fundraiser-pro-posttype' ),
  			'singular_name' => __( 'Testimonials','charity-fundraiser-pro-posttype' )
  		),
  		'capability_type' => 'post',
  		'menu_icon'  => 'dashicons-businessman',
  		'public' => true,
  		'supports' => array(
  			'title',
  			'editor',
  			'thumbnail'
  		)
		)
	);
  register_post_type( 'donator',
    array(
      'labels' => array(
        'name' => __( 'Donator','charity-fundraiser-pro-posttype' ),
        'singular_name' => __( 'Donator','charity-fundraiser-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-businessman',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
  register_post_type( 'team',
    array(
      'labels' => array(
        'name' => __( 'Our Team','charity-fundraiser-pro-posttype' ),
        'singular_name' => __( 'Our Team','charity-fundraiser-pro-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array( 
          'title',
          'editor',
          'thumbnail'
      )
    )
  );
}

/*--------------- causes section ----------------*/

function charity_fundraiser_pro_posttype_bn_designation_meta() {
    add_meta_box( 'charity_fundraiser_pro_posttype_bn_meta', __( 'Enter Meta Setting','charity-fundraiser-pro-posttype' ), 'charity_fundraiser_pro_posttype_bn_meta_callback', 'causes', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'charity_fundraiser_pro_posttype_bn_designation_meta');
}
/* Adds a meta box for custom post */
function charity_fundraiser_pro_posttype_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'charity_fundraiser_pro_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    ?>
    <div id="causes_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                    <td class="left">
                        <?php esc_html_e( 'Goal', 'charity-fundraiser-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-goal" id="meta-goal" value="<?php echo esc_html($bn_stored_meta['meta-goal'][0]); ?>" />
                    </td>
                </tr>
                <tr id="meta-2">
                    <td class="left">
                        <?php esc_html_e( 'Raised', 'charity-fundraiser-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-raised" id="meta-raised" value="<?php echo esc_html($bn_stored_meta['meta-raised'][0]); ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom fields meta input */
function charity_fundraiser_pro_posttype_bn_metadesig_causes_save( $post_id ) {
    if( isset( $_POST[ 'meta-goal' ] ) ) {
        update_post_meta( $post_id, 'meta-goal', sanitize_text_field($_POST[ 'meta-goal' ]) );
    }
    if( isset( $_POST[ 'meta-raised' ] ) ) {
        update_post_meta( $post_id, 'meta-raised', sanitize_text_field($_POST[ 'meta-raised' ]) );
    } 
    
}
add_action( 'save_post', 'charity_fundraiser_pro_posttype_bn_metadesig_causes_save' );

/* -------------------------------Events------------------------------ */
function charity_fundraiser_pro_posttype_bn_custom_meta_event() {

    add_meta_box( 'bn_meta', __( 'Events Meta', 'ts-charity-pro-posttype' ), 'charity_fundraiser_pro_posttype_bn_meta_callback_event', 'events', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'charity_fundraiser_pro_posttype_bn_custom_meta_event');
}

function charity_fundraiser_pro_posttype_bn_meta_callback_event( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    ?>
  <div id="property_stuff">
    <table id="list-table">     
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <p>
            <label for="meta-location"><?php echo esc_html('Location'); ?></label><br>
            <input type="text" name="meta-location" id="meta-location" class="meta-location regular-text" value="<?php echo  $bn_stored_meta['meta-location'][0]; ?>">
          </p>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}
function charity_fundraiser_pro_posttype_bn_meta_save_event( $post_id ) {

  if (!isset($_POST['bn_nonce']) || !wp_verify_nonce($_POST['bn_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  // Save Image
  
  if( isset( $_POST[ 'meta-location' ] ) ) {
      update_post_meta( $post_id, 'meta-location', esc_html($_POST[ 'meta-location' ]) );
  }
}
add_action( 'save_post', 'charity_fundraiser_pro_posttype_bn_meta_save_event' );

/*----------------------Testimonial section ----------------------*/
/* Adds a meta box to the Testimonial editing screen */
function charity_fundraiser_pro_posttype_bn_testimonial_meta_box() {
	add_meta_box( 'charity-fundraiser-pro-posttype-testimonial-meta', __( 'Enter Details', 'charity-fundraiser-pro-posttype' ), 'charity_fundraiser_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'charity_fundraiser_pro_posttype_bn_testimonial_meta_box');
}
/* Adds a meta box for custom post */
function charity_fundraiser_pro_posttype_bn_testimonial_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'charity_fundraiser_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
	$desigstory = get_post_meta( $post->ID, 'charity_fundraiser_pro_posttype_testimonial_desigstory', true );
	?>
	<div id="testimonials_custom_stuff">
		<table id="list">
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left">
						<?php _e( 'Designation', 'charity-fundraiser-pro-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="charity_fundraiser_pro_posttype_testimonial_desigstory" id="charity_fundraiser_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/* Saves the custom meta input */
function charity_fundraiser_pro_posttype_bn_metadesig_save( $post_id ) {
	if (!isset($_POST['charity_fundraiser_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['charity_fundraiser_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save desig.
	if( isset( $_POST[ 'charity_fundraiser_pro_posttype_testimonial_desigstory' ] ) ) {
		update_post_meta( $post_id, 'charity_fundraiser_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'charity_fundraiser_pro_posttype_testimonial_desigstory']) );
	}
}

add_action( 'save_post', 'charity_fundraiser_pro_posttype_bn_metadesig_save' );

/*------------------------- Team Section-----------------------------*/
/* Adds a meta box for Designation */
function charity_fundraiser_pro_posttype_bn_team_meta() {
    add_meta_box( 'charity_fundraiser_pro_posttype_bn_meta', __( 'Enter Details','charity-fundraiser-pro-posttype' ), 'charity_fundraiser_pro_posttype_ex_bn_meta_callback', 'team', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'charity_fundraiser_pro_posttype_bn_team_meta');
}
/* Adds a meta box for custom post */
function charity_fundraiser_pro_posttype_ex_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'charity_fundraiser_pro_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );

    //Email details
    if(!empty($bn_stored_meta['meta-desig'][0]))
      $bn_meta_desig = $bn_stored_meta['meta-desig'][0];
    else
      $bn_meta_desig = '';

    //Phone details
    if(!empty($bn_stored_meta['meta-call'][0]))
      $bn_meta_call = $bn_stored_meta['meta-call'][0];
    else
      $bn_meta_call = '';

    //facebook details
    if(!empty($bn_stored_meta['meta-facebookurl'][0]))
      $bn_meta_facebookurl = $bn_stored_meta['meta-facebookurl'][0];
    else
      $bn_meta_facebookurl = '';

    //linkdenurl details
    if(!empty($bn_stored_meta['meta-linkdenurl'][0]))
      $bn_meta_linkdenurl = $bn_stored_meta['meta-linkdenurl'][0];
    else
      $bn_meta_linkdenurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-twitterurl'][0]))
      $bn_meta_twitterurl = $bn_stored_meta['meta-twitterurl'][0];
    else
      $bn_meta_twitterurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-googleplusurl'][0]))
      $bn_meta_googleplusurl = $bn_stored_meta['meta-googleplusurl'][0];
    else
      $bn_meta_googleplusurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-designation'][0]))
      $bn_meta_designation = $bn_stored_meta['meta-designation'][0];
    else
      $bn_meta_designation = '';

    ?>
    <div id="agent_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                    <td class="left">
                        <?php _e( 'Email', 'charity-fundraiser-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-desig" id="meta-desig" value="<?php echo esc_attr($bn_meta_desig); ?>" />
                    </td>
                </tr>
                <tr id="meta-2">
                    <td class="left">
                        <?php _e( 'Phone Number', 'charity-fundraiser-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-call" id="meta-call" value="<?php echo esc_attr($bn_meta_call); ?>" />
                    </td>
                </tr>
                <tr id="meta-3">
                  <td class="left">
                    <?php _e( 'Facebook Url', 'charity-fundraiser-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-facebookurl" id="meta-facebookurl" value="<?php echo esc_url($bn_meta_facebookurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-4">
                  <td class="left">
                    <?php _e( 'Linkedin URL', 'charity-fundraiser-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-linkdenurl" id="meta-linkdenurl" value="<?php echo esc_url($bn_meta_linkdenurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-5">
                  <td class="left">
                    <?php _e( 'Twitter Url', 'charity-fundraiser-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-twitterurl" id="meta-twitterurl" value="<?php echo esc_url( $bn_meta_twitterurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-6">
                  <td class="left">
                    <?php _e( 'GooglePlus URL', 'charity-fundraiser-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-googleplusurl" id="meta-googleplusurl" value="<?php echo esc_url($bn_meta_googleplusurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-7">
                  <td class="left">
                    <?php _e( 'Designation', 'charity-fundraiser-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-designation" id="meta-designation" value="<?php echo esc_attr($bn_meta_designation); ?>" />
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom Designation meta input */
function charity_fundraiser_pro_posttype_ex_bn_metadesig_save( $post_id ) {
    if( isset( $_POST[ 'meta-desig' ] ) ) {
        update_post_meta( $post_id, 'meta-desig', esc_html($_POST[ 'meta-desig' ]) );
    }
    if( isset( $_POST[ 'meta-call' ] ) ) {
        update_post_meta( $post_id, 'meta-call', esc_html($_POST[ 'meta-call' ]) );
    }
    // Save facebookurl
    if( isset( $_POST[ 'meta-facebookurl' ] ) ) {
        update_post_meta( $post_id, 'meta-facebookurl', esc_url($_POST[ 'meta-facebookurl' ]) );
    }
    // Save linkdenurl
    if( isset( $_POST[ 'meta-linkdenurl' ] ) ) {
        update_post_meta( $post_id, 'meta-linkdenurl', esc_url($_POST[ 'meta-linkdenurl' ]) );
    }
    if( isset( $_POST[ 'meta-twitterurl' ] ) ) {
        update_post_meta( $post_id, 'meta-twitterurl', esc_url($_POST[ 'meta-twitterurl' ]) );
    }
    // Save googleplusurl
    if( isset( $_POST[ 'meta-googleplusurl' ] ) ) {
        update_post_meta( $post_id, 'meta-googleplusurl', esc_url($_POST[ 'meta-googleplusurl' ]) );
    }
    // Save designation
    if( isset( $_POST[ 'meta-designation' ] ) ) {
        update_post_meta( $post_id, 'meta-designation', esc_html($_POST[ 'meta-designation' ]) );
    }
}
add_action( 'save_post', 'charity_fundraiser_pro_posttype_ex_bn_metadesig_save' );

add_action( 'save_post', 'bn_meta_save' );
/* Saves the custom meta input */
function bn_meta_save( $post_id ) {
  if( isset( $_POST[ 'charity_fundraiser_pro_posttype_team_featured' ] )) {
      update_post_meta( $post_id, 'charity_fundraiser_pro_posttype_team_featured', esc_attr(1));
  }else{
    update_post_meta( $post_id, 'charity_fundraiser_pro_posttype_team_featured', esc_attr(0));
  }
}
/*------------------------ Top Donator --------------------------*/
function charity_fundraiser_pro_posttype_bn_donator_meta_box() {
  add_meta_box( 'charity-fundraiser-pro-posttype-donator-meta', __( 'Enter Details', 'charity-fundraiser-pro-posttype' ), 'charity_fundraiser_pro_posttype_bn_donator_meta_callback', 'donator', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'charity_fundraiser_pro_posttype_bn_donator_meta_box');
}
/* Adds a meta box for custom post */
function charity_fundraiser_pro_posttype_bn_donator_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'charity_fundraiser_pro_posttype_posttype_donator_meta_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
  $desigstory = get_post_meta( $post->ID, 'charity_fundraiser_pro_posttype_donator_desigstory', true );
  $donated = get_post_meta( $post->ID, 'charity_fundraiser_pro_posttype_donator_donated', true );
  ?>
  <div id="donators_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Designation', 'charity-fundraiser-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="charity_fundraiser_pro_posttype_donator_desigstory" id="charity_fundraiser_pro_posttype_donator_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
            <?php _e( 'Donated', 'charity-fundraiser-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="charity_fundraiser_pro_posttype_donator_donated" id="charity_fundraiser_pro_posttype_donator_donated" value="<?php echo esc_attr( $donated ); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

/* Saves the custom meta input */
function charity_fundraiser_pro_posttype_bn_metadonate_save( $post_id ) {
  if (!isset($_POST['charity_fundraiser_pro_posttype_posttype_donator_meta_nonce']) || !wp_verify_nonce($_POST['charity_fundraiser_pro_posttype_posttype_donator_meta_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Save desig.
  if( isset( $_POST[ 'charity_fundraiser_pro_posttype_donator_desigstory' ] ) ) {
    update_post_meta( $post_id, 'charity_fundraiser_pro_posttype_donator_desigstory', sanitize_text_field($_POST[ 'charity_fundraiser_pro_posttype_donator_desigstory']) );
  }
  if( isset( $_POST[ 'charity_fundraiser_pro_posttype_donator_donated' ] ) ) {
    update_post_meta( $post_id, 'charity_fundraiser_pro_posttype_donator_donated', sanitize_text_field($_POST[ 'charity_fundraiser_pro_posttype_donator_donated']) );
  }
}

add_action( 'save_post', 'charity_fundraiser_pro_posttype_bn_metadonate_save' );

/*------------------------ Team Shortcode --------------------------*/
function charity_fundraiser_pro_posttype_team_func( $atts ) {
    $team = ''; 
    $team = '<div class="row">';
      $new = new WP_Query( array( 'post_type' => 'team') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = charity_fundraiser_pro_string_limit_words(get_the_excerpt(),20);
          $designation = get_post_meta($post_id,'meta-designation',true);
          $call = get_post_meta($post_id,'meta-call',true);
          $email = get_post_meta($post_id,'meta-desig',true);
          $facebookurl = get_post_meta($post_id,'meta-facebookurl',true);
          $linkedin = get_post_meta($post_id,'meta-linkdenurl',true);
          $twitter = get_post_meta($post_id,'meta-twitterurl',true);
          $googleplus = get_post_meta($post_id,'meta-googleplusurl',true);

          $team .= '<div class="team_outer col-lg-6 col-sm-6 mb-4">
            <div class="team_wrap row">';        
                  if (has_post_thumbnail()){
                  $team .= '<div class=" col-md-6 team-image">
                   <img src="'.esc_url($url).'"></div>
                
                <div class="col-md-6"> 
                 <h4 class="team_name"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                  <div class="team-socialbox">';
                   $team .= '<div class="shrt_socio">';                           
                      if($facebookurl != '' || $linkedin != '' || $twitter != '' || $googleplus != ''){?>
                          <?php if($facebookurl != ''){
                            $team .= '<a class="" href="'.esc_url($facebookurl).'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                           } if($twitter != ''){
                            $team .= '<a class="" href="'.esc_url($twitter).'" target="_blank"><i class="fab fa-twitter"></i></a>';                          
                           } if($linkedin != ''){
                           $team .= ' <a class="" href="'.esc_url($linkedin).'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
                          }if($googleplus != ''){
                            $team .= '<a class="" href="'.esc_url($googleplus).'" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
                          }
                        }
                    $team .= '</div>
                  </div>
                  ';
                  if($designation != ''){
                  $team .= '<p class="mt-2">'.esc_html($designation).'</p>';
                  }
                  if($call != ''){
                  $team .= '<p class="mt-2">'.esc_html($call).'</p>';
                  }
                  if($email != ''){
                  $team .= '<p class="mt-2">'.esc_html($email).'</p>';
                  }
                }                    
              $team .='</div></div></div>';
            if($k%4 == 0){
            $team.= '<div class="clearfix"></div>'; 
          } 
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $team.= '</div>';
      else :
        $team = '<div id="team" class="team_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','charity-fundraiser-pro-posttype').'</h2></div>';
      endif;
    return $team;
}
add_shortcode( 'charity-fundraiser-pro-team', 'charity_fundraiser_pro_posttype_team_func' );

/*------------------- Testimonial Shortcode -------------------------*/
function charity_fundraiser_pro_posttype_testimonials_func( $atts ) {
    $testimonial = ''; 
    $testimonial = '<div id="testimonials"><div class="row inner-test-bg">';
      $new = new WP_Query( array( 'post_type' => 'testimonials') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = charity_fundraiser_pro_string_limit_words(get_the_excerpt(),20);
          $designation = get_post_meta($post_id,'charity_fundraiser_pro_posttype_testimonial_desigstory',true);

          $testimonial .= '<div class="col-lg-6 col-md-6 mt-4"> 
                <div class="row m-0 shrtcod-pg">
                  <div class="col-md-3 pt-3">';
                    if (has_post_thumbnail()){
                    $testimonial.= '<img src="'.esc_url($url).'">';
                    }
                    $testimonial.= '</div>
                  <div class="col-md-9 pt-3">
                    <h4><a href="'.get_the_permalink().'">'.get_the_title().'</a> <cite>'.esc_html($designation).'</cite></h4>
                  </div>
                  <div class="content_box pl-3 pr-3 w-100">
                    <div class="short_text pb-3">'.$excerpt.'</div>
                  </div>
                </div>
              </div><div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $testimonial.= '</div>';
      else :
        $testimonial = '<div id="testimonial" class="testimonial_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','charity-fundraiser-pro-posttype').'</h2></div></div></div>';
      endif;
    return $testimonial;
}
add_shortcode( 'charity-fundraiser-pro-testimonials', 'charity_fundraiser_pro_posttype_testimonials_func' );

/*------------------- Causes Shortcode -------------------------*/
function charity_fundraiser_pro_posttype_causes_func( $atts ) {
    $causes = ''; 
    $causes = '<div id="causes"><div class="row inner-test-bg">';
      $new = new WP_Query( array( 'post_type' => 'causes') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = charity_fundraiser_pro_string_limit_words(get_the_excerpt(),20);
          $goal=get_post_meta($post_id,'meta-goal',true);
          $raised=get_post_meta($post_id,'meta-raised',true);
          $goal_title = esc_html('Goal: ');
          $raised_title = esc_html('Raised: ');
          $overlaybtn = get_theme_mod('charity_fundraiser_pro_causes_overlaybtntext',__('Donate Now','charity-fundraiser-pro'));
          $causes .= '<div class="causes_content col-lg-4 col-md-4 mt-4"> 
                <div class="row m-0 shrtcod-pg">
                  <div class=" p-3">';
                    if (has_post_thumbnail()){
                    $causes.= '<img src="'.esc_url($url).'">';
                    }
                    $causes.= '
                  
                    <h6><a href="'.get_the_permalink().'">'.get_the_title().'</a>
                    </h6>
                    <div class="content_box w-100">
                      <div class="short_text pb-3">'.$excerpt.'</div>
                    </div>
                    <div class="post_meta mt-2 pb-3 mb-2 row">';
                        if($goal != ''){
                         $causes .=  '<span class="font-weight-bold col-md-6 goal">'.esc_html($goal_title . $goal).'</span>';
                        } if($raised != ''){
                        $causes .= '<span class="font-weight-bold text-right col-md-6 collected" >'.esc_html($raised_title . $raised).'</span>';
                        }
                      $causes .= '
                      
                      </div> 
                      <div class="text-center">
                        <a class="read-more font-weight-bold btn btn-primary theme_button" href="'.get_the_permalink().'"><span>'.$overlaybtn.'</span></a>
                      </div> 
                  </div>
                </div>
              </div><div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $causes.= '</div>';
      else :
        $causes = '<div id="causes" class="col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','charity-fundraiser-pro-posttype').'</h2></div></div></div>';
      endif;
    return $causes;
}
add_shortcode( 'charity-fundraiser-pro-causes', 'charity_fundraiser_pro_posttype_causes_func' );

/*---------------- Events Shortcode ---------------------*/
function charity_fundraiser_pro_posttype_events_func( $atts ) {
    $events = ''; 
    $events = '<div class="row inner-test-bg">';
      $new = new WP_Query( array( 'post_type' => 'events') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = charity_fundraiser_pro_string_limit_words(get_the_excerpt(),20);
          $location= get_post_meta($post_id,'meta-location',true);

          $events .= '<div class="col-lg-6 col-md-6 mt-4"> 
                <div class="row m-0 shrtcod-pg">
                  <div class="col-md-6 pt-3">';
                    if (has_post_thumbnail()){
                    $events.= '<img src="'.esc_url($url).'">';
                    }
                    $events.= '</div>
                  <div class="col-md-6">
                    <h6 class="font-weight-bold"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>
                    <div class="content_box w-100">
                      <div class="short_text pb-3">'.$excerpt.'</div>
                      <p class="event-detail"><i class="fa fa-map-marker pl-2 pr-2" aria-hidden="true"></i>'.esc_html($location).'</p>
                      <p class="event-detail"><i class="fa fa-calendar pl-2 pr-2" aria-hidden="true"></i> '.get_the_date().'
                      <i class="fas fa-clock pl-2 pr-2" aria-hidden="true"></i>'.get_the_time().'
                      </p>
                    </div>
                  </div>
                </div>
              </div><div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $events.= '</div>';
      else :
        $events = '<div id="events" class="col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','charity-fundraiser-pro-posttype').'</h2></div></div>';
      endif;
    return $events;
}
add_shortcode( 'charity-fundraiser-pro-events', 'charity_fundraiser_pro_posttype_events_func' );


/*---------------- Top Donars Shortcode ---------------------*/
function charity_fundraiser_pro_posttype_donator_func( $atts ) {
    $donator = ''; 
    $donator = '<div class="row inner-test-bg">';
      $new = new WP_Query( array( 'post_type' => 'donator') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = charity_fundraiser_pro_string_limit_words(get_the_excerpt(),20);
          $designation= get_post_meta($post_id,'charity_fundraiser_pro_posttype_donator_desigstory',true);
          $donated=get_post_meta($post_id,'charity_fundraiser_pro_posttype_donator_donated',true);
          $donated_title = esc_html('Donated: ');

          $donator .= '<div class="col-lg-4 col-md-4 p-0 mt-4"> 
                <div class="row box-donar">
                  <div class="donar-image col-lg-4">';
                    if (has_post_thumbnail()){
                    $donator.= '<img src="'.esc_url($url).'">';
                    }
                    $donator.= '</div>
                  <div class="box-content col-lg-8">
                    <h6 class="title font-weight-bold"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>
                    
                      <p>'.esc_html($designation).'</p>
                      <span class="donated">'.esc_html($donated_title . $donated).'</span>
                   
                  </div>
                </div>
              </div><div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $donator.= '</div>';
      else :
        $donator = '<div id="donator" class="col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','charity-fundraiser-pro-posttype').'</h2></div></div>';
      endif;
    return $donator;
}
add_shortcode( 'charity-fundraiser-pro-donator', 'charity_fundraiser_pro_posttype_donator_func' );