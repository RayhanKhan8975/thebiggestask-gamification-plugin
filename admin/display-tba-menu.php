<?php
/**
 * Displays the Menu.
 *
 * @return void
 */
function display_tba_menu() {

	$sc   = get_option( 'tba_start_conversation' );
	$aq   = get_option( 'tba_answer_question_like' );
	$aqa  = get_option( 'tba_answer_question_like_additonal' );
	$lew  = get_option( 'tba_likes_every_week' );
	$pfg  = get_option( 'tba_points_for_giftcard' );
	$esq  = get_option( 'tba_es_questions' );
	$eipq = get_option( 'tba_eip_questions' );
	$csq  = get_option( 'tba_cs_questions' );
	$vcl  = get_option( 'tba_vc_likes' );
	?>


<div class=""><div id="tba-form-heading" class=" text-center mt-5 ">
	<h1>Settings</h1>
</div>
<div id="tba-settings-success-message" class=" text-center" ></div>
<div class="row ">

	<div class=" mx-auto" style="min-width:100%;">
		<div class="card mt-2 mx-auto p-4 " style="min-width:100%;">
			<div class="card-body">
				<div class="container">
					<form id="tba-settings-form" role="form">
						<?php wp_nonce_field( 'verify_tba_values' ); ?>
						<input type="hidden" name="action" value="send_tba_settings" />
						<div class="controls">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Points for starting a conversation</label> <input id="form_name" type="text" name="tba_start_conversation" class="form-control" value="<?php echo $sc; ?>" required="required" data-error=""> </div>
								</div>
						  
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Points for answering a question AND getting a "like"</label> <input id="form_name" type="text" name="tba_answer_question_like" class="form-control" value="<?php echo $aq; ?>" required="required" data-error=""> </div>
								</div>
						  
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Points for answering a question AND getting a "like" Additonal</label> <input id="form_name" type="text" name="tba_answer_question_like_additonal" class="form-control" value="<?php echo $aqa; ?>" required="required" data-error=""> </div>
								</div>
						  
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Likes Awarded Every Week</label> <input id="form_name" type="text" name="tba_likes_every_week" class="form-control" value="<?php echo $lew; ?>" required="required" data-error=""> </div>
								</div>
						  
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Every X points user will recieve a gift card</label> <input id="form_name" type="text" name="tba_points_for_giftcard" class="form-control" value="<?php echo $pfg; ?>" required="required" data-error=""> </div>
								</div>
						  
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Experienced surrogate: a profile member who is a surrogate and has answered X questions</label> <input id="form_name" type="text" name="tba_es_questions" class="form-control" value="<?php echo $esq; ?>" required="required" data-error=""> </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Experienced intended parent: a profile member who is an intended parent and has answered X questions</label> <input id="form_name" type="text" name="tba_eip_questions" class="form-control" value="<?php echo $eipq; ?>" required="required" data-error=""> </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Conversation starter: a profile member who has asked X questions</label> <input id="form_name" type="text" name="tba_cs_questions" class="form-control" value="<?php echo $csq; ?>" required="required" data-error=""> </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group"> <label for="form_name">Valued contributor: a profile member who received a “like” X times on their comment</label> <input id="form_name" type="text" name="tba_vc_likes" class="form-control" value="<?php echo $vcl; ?>" required="required" data-error=""> </div>
								</div>
							</div>
							<div class="row" >
			<div class="col-sm-12" style="display:flex;justify-content:center;"> <input style=""  type="submit" class="btn btn-lg  btn-success " value="Submit"> </div></div>
						</div>
					</form>
				</div>
			</div>
		</div> <!-- /.8 -->
	</div> <!-- /.row-->
</div>
</div>
	<?php
}
