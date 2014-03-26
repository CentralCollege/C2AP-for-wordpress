<?php
	if (strlen(get_option( 'apiurl')) < 1){
		?>
        <div class="error">
        	<p>We can't work with your directory listing unless an API url is set. Contact <a href="mailto:oyenj@central.edu">Jacob Oyen</a> at x5339.</p>
        </div>
        <?php
	}else{
	
		//Delete page if pageID is set
		if(isset($_GET['pageid'])){
			$page = get_page_by_path('department-directory');
			wp_delete_post($page->ID, true);
		}
		//Refresh page
		if(isset($_GET['refresh']) && $_GET['refresh'] = true ){
			//Get page ID
			$page = get_page_by_path('department-directory');	
	
			//Get directory info
			$xml = simplexml_load_file(get_option( 'apiurl'));
			$directoryOutput = "";
			foreach($xml->employee as $emp){
				$directoryOutput = $directoryOutput . "<div class='staffListing' style='border-bottom: 1px solid #ccc; min-height: 200px;'>";
				if ($emp->hasPhoto == "yes"){
					$directoryOutput = $directoryOutput . "<img src='http://www.central.edu/humanresources/photodirectory/images/" . $emp->username . ".jpg' alt='" . $emp->firstName . " " . $emp->lastName. "' style='float:right; padding: 1px; margin: 1px; border: 1px solid #ccc;'/>";
				}
				$directoryOutput = $directoryOutput . "<h4>" . $emp->firstName . " " . $emp->lastName. "</h4>";
				$directoryOutput = $directoryOutput . "<p>" .  $emp->title . "<br />";
				$directoryOutput = $directoryOutput . "<strong>Office:</strong> " . $emp->officeLocation . "<br />";
				$directoryOutput = $directoryOutput . "<strong>Phone:</strong> " . $emp->phoneNumber . "<br />";
				$directoryOutput = $directoryOutput . "<strong>Email:</strong> <a href='mailto:" . $emp->email . "'>" . $emp->email . "</a></p>";
				$directoryOutput = $directoryOutput . "</div>";
			}
			
			$update_directory_page = array(
				'ID' 			=> $page->ID,
				'post_content'	=> $directoryOutput
			);
			wp_update_post($update_directory_page);
		}
		
		
	//If this site doesn't have a directory page, go ahead and make one.
	if(get_page_by_path('department-directory') == NULL){
		echo "Page does not exist!"	;
		// Get current user's ID
		$user_ID = get_current_user_id();
		
		// Query the API to get directory information
		$xml = simplexml_load_file('http://dev.central.edu/api/people/?department=central%20Communications%20Office');
		$directoryOutput = "";
		foreach($xml->employee as $emp){
			$directoryOutput = $directoryOutput . "<div class='staffListing' style='border-bottom: 1px solid #ccc; min-height: 200px;'>";
			if ($emp->hasPhoto == "yes"){
				$directoryOutput = $directoryOutput . "<img src='http://www.central.edu/humanresources/photodirectory/images/" . $emp->username . ".jpg' alt='" . $emp->firstName . " " . $emp->lastName. "' style='float:right; padding: 1px; margin: 1px; border: 1px solid #ccc;'/>";
			}
			$directoryOutput = $directoryOutput . "<h4>" . $emp->firstName . " " . $emp->lastName. "</h4>";
			$directoryOutput = $directoryOutput . "<p>" .  $emp->title . "<br />";
			$directoryOutput = $directoryOutput . "<strong>Office:</strong> " . $emp->officeLocation . "<br />";
			$directoryOutput = $directoryOutput . "<strong>Phone:</strong> " . $emp->phoneNumber . "<br />";
			$directoryOutput = $directoryOutput . "<strong>Email:</strong> <a href='mailto:" . $emp->email . "'>" . $emp->email . "</a></p>";
			$directoryOutput = $directoryOutput . "</div>";
		}
		
		// It doesn't exist so we need to create it.
		$add_directory_to_site = array(
			'post_title'	=> 'Department Directory',
			'post_content'	=> $directoryOutput,
			'post_name'		=> 'department-directory',
			'post_status'	=> 'draft',
			'post_type'		=> 'page',
			'post_author'	=> $user_ID,
			'ping_status'	=> 'closed'
		);		
		wp_insert_post($add_directory_to_site);
		?>
		<div class="updated">
			<p>It looks like you don't have a directory page created so we went ahead and made one for you.</p>            
		</div>
		<?php	
		}else{
			//This site has a page so lets output the info to screen with additional options.
			$page = get_page_by_path('department-directory');
			?><div class="error">
					<h2>You already have a directory page created.</h2>
					<p><a href="<?php echo get_site_url();?>/department-directory/" class="button button-large">View your page</a></li> &nbsp;&nbsp;&nbsp; <a href="<?php echo get_site_url();?>/wp-admin/post.php?post=<?php echo $page->ID;?>&action=edit" class="button button-large">Edit your page</a></p>
					</a>
					<h2>Additional options</h2>
					<p><a href="##" class="button button-primary button-large">Refresh my directory page</a>&nbsp;&nbsp;&nbsp;<a href="##" class="button button-large">Delete this page</a></p>
				</div>
				<h2>Department Directory</h2>
				<?php echo $page->post_content; ?>
			<?php
		}
	}
?>