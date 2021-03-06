<?php
$this->load->view('templates/headers/main_header', $title);
?>
<div class="container">
	<?php
	if($settings["ads_code"] != ""):
	?>
	<div class="ad_block">
		<?php echo $settings["ads_code"]; ?>
	</div>
	<?php
	endif;
	?>
	<div class="row">
		<div class="pull-left">
        	<h3><?php echo $title; ?></h3>
        </div>
	</div>
	<div class="row">
		<div class="main_container">
			<div class="alert alert-info alert-center">
				<?php echo $this->lang->line("last_visitors_subtitle"); ?>
			</div>
			<div id="userslst" class="clearfix">
				<?php
		    	$cpt = 1;
		    	?>
		    	<?php foreach($visitors as $user): ?>

		    	<?php
		    	$birthdate = new DateTime($user["birthday"]);
				$today     = new DateTime();
				$interval  = $today->diff($birthdate);
				$age	   = $interval->format('%y');

				if($user["gender"] == 0) {
					$gender_color = "male_color";
				} else {
					$gender_color = "female_color";
				}

				if($user["thumb_url"] == "" || $user["thumb_url"] == NULL) {
					$user["thumb_url"] = "images/avatar.png";
				}
				?>

				<div class="col-lg-3 col-md-4 col-xs-6 clearfix user_block" data-user-id="<?php echo $user["uid"]; ?>" data-cpt="<?php echo $cpt; ?>">
					<div class="thumb">
		                <a class="" href="<?php echo base_url(); ?>user/profile/<?php echo $user["uid"]; ?>">
			              <!--  <img src="<?php echo base_url() . $user["thumb_url"]; ?>" alt="Photo User" /> -->
											<div class="" style="background-image: url(<?php echo base_url() . $user["thumb_url"]; ?>);
												height: 200px;
												width: 100%;
												border-top-left-radius: 50px;
												border-top-right-radius: 50px;
												background-position: center;
												background-size: cover;">



												<?php
					            if($user["st_love"] == 1)
					            {
						        ?>
						        <div class="love_button loved indiv-btn" data-profile-id="<?php echo $user["uid"]; ?>"><i class="fa fa-heart"></i></div>
						        <?php
							    } else {
								?>
								<div class="love_button indiv-btn" data-profile-id="<?php echo $user["uid"]; ?>"><i class="fa fa-heart"></i></div>
								<?php
							    }
					            ?>
				                <?php
					                if($user["is_online"] == 1):
					            ?>
				                <div class="online_status indiv-btn"><i class="fa fa-circle"></i></div>
				                <?php
					                endif;
					            ?>
											</div>

		               	</a>
					   	<div class="userslst_infos">
						   	<a href="<?php echo base_url(); ?>user/profile/<?php echo $user["uid"]; ?>" class="userslst_username <?php echo $gender_color; ?>"><?php echo $user["username"]; ?></a>
						   	<?php
							if($user["city"] == "") {
				                $user["city"] = $this->lang->line("unknown_city");
			                }
			                ?>
						   	<div class="userslst_age"><?php echo $age; ?> &#8226; <?php if($settings["hide_country"] == 0): ?><?php echo get_country_name_by_code($user["country"]); ?><?php else: ?><?php echo $user["city"]; ?><?php endif; ?></div>
						</div>
					</div>
	            </div>
				<?php
				$cpt++;
				endforeach;
				?>
			</div>
        </div>
	</div>
</div>
<?php
$this->load->view('templates/footers/main_footer');
?>
