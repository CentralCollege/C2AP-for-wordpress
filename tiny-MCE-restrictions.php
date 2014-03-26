<?php 
//Initialize the plugin
	function test_init(){
    	add_action( 'init', 'test_admin_init');
	}
 
	function test_admin_init() {
		echo "Admin Init Inside Init";
	}

//Set TinyMCE restrictions
$tinyMCE_restrictions = get_option( 'jco_tinyMCE_restrictions' );
if (is_null($tinyMCE_restrictions)){
	$tinyMCE_restrictions = '';	
}
$opt_value = $tinyMCE_restrictions;
?>
<div class="wrap">
    <h2>TinyMCE restrictions</h2>	
    <p><strong>Current Restrictions:</strong> <?php echo get_option( $opt_name ); ?> </p>
    <hr size="1"/>
    <h3>Update Restrictions</h3></div>
    <p><a href="http://www.tinymce.com/wiki.php/configuration:valid_elements">See the TinyMCE doucmentation</a> for formatting of valid elements.</p>
    <p>Allow only these tags:</p>
	<form name="form1" method="post" action="">
	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
    <input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="150">
	
		<p class="submit">
	<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
	</p>
	
	</form>
</div>