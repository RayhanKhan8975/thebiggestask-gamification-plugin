<?php
/**
 * Displays the Approve Topics.
 *
 * @return void
 */
function display_approve_topics() {

	$output = '';

	$unapproved_topics = get_option( 'topics_for_approval' );

	if ( ! empty( $unapproved_topics ) ) {
		?>
		<div style="text-align:center;margin:1%;" ><h1>Topics Waiting for Approval</h1></div>
		<?php
		foreach ( $unapproved_topics as $topic ) {
			$post = get_post( $topic );

			$post_title    = $post->post_title;
			$post_date     = $post->post_date;
			$post_content  = $post->post_content;
			$post_url      = $post->guid;
			$post_author   = get_the_author_meta( 'display_name', $post->post_author );
			$tba_user_info = get_user_meta( $post->post_author, 'tba_points_info' );
			?>
	 <div id="card-<?php echo $topic; ?>" class="card" style="min-width:99%;">
	  <div class="card-body">
		<h5 class="card-title"><a href="<?php echo $post_url; ?>" ><?php echo $post_title; ?></a></h5>
		<p class="card-text"><?php echo $post_content; ?></p>   
		<h6>Posted by <?php echo $post_author; ?> on <?php echo $post_date; ?> Last Question Asked at:- <?php echo date( 'F j, Y, g:i a', $tba_user_info[0]['last_question_asked'] ); ?></h6>
		<button data-id=<?php echo $topic; ?> class="approve-topic btn btn-primary" >Approve</button>
		<button data-id=<?php echo $topic; ?> class="disapprove-topic btn btn-danger" >Disapprove</button>
	  </div>
	</div>
			<?php
		}
	} else {
		?>
		<div style="text-align:center;margin:1%;" ><h1>No Topics Available for Approval</h1></div>
		<?php
	}

}
