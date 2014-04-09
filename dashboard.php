<div class="wrap">
    <h2>C2AP for WordPress</h2>
    <!---<p>Oh I'm on camera? Guitar Solo!!!</p>
    <p><img src="http://i.imgur.com/2Jbvvj3.gif" alt="Guitar Solo!" style="border-radius: .5em;">!--->
    <hr size="1" />
    <div class="leftInfo" style="float: left; width:49%; border-right: 1px solid #ccc;">
        <h2>Template issues</h2>
        <p>Issues with the departments WordPress them are submitted and tracked on <a href="https://github.com/CentralCollege/departments-wordpress-theme/issues">GitHub</a>. If you are a <a href="http://github.com">GitHub</a> user, you can submit new issues or pull requests at any time.</p>
	</div>
	<div class="rightInfo" style="float:right; width: 49%;">    
        <h2>Plugin issues</h2>
        <p>Issues are submitted and tracked on <a href="https://github.com/CentralCollege/C2AP-for-wordpress/issues">GitHub</a>. If you are a <a href="http://github.com">GitHub</a> user, you can submit new issues or pull requests at any time.</p>
 	</div>
    <div class="clearBoth" style="clear: both;"></div>
    <hr size="1" />
    <h2>Directory API</h2>
    <?php 
		//$nonce_check = check_admin_referer('nonceaction', 'cui-apicron');
		//print_r($nonce_check);
	
        if (isset($_POST['apiurl'])){
            update_option('apiurl',	$_POST['apiurl']);
            if (isset($_POST['apicron']) && $_POST['apicron'] == true){
				update_option('apicron', true);
			}else{
				update_option('apicron', false);
			}
            ?>
            <div class="updated">API information has been updated</div>
            <?php
        }
    ?>
    <form name="form1" method="post" action="">
    	<?php wp_nonce_field('nonceaction', 'cui-apicron');?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th align="right">
                        <label for="apiurl">Directory API URL:</label>
                    </th>
                    <td>
                        <input type="text" name="apiurl" id="apiurl" value="<?php echo get_option( 'apiurl'); ?>" size="50" /><br />
                        <span class="description">Enter the URL to get the directory information from.</span>
                    </td>
                </tr>
                <tr>
                    <th align="right">
                        <label for="apiurl">Update via cron:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="apicron" id="apicron" value="true" <?php if (get_option('apicron') == true){?>checked="checked"<?php }?> /><br />
                        <span class="description">Should this directory update automatically?</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input id="submit" class="button button-primary" type="submit" value="Update API information" name="submit"></td>
                </tr>            
            </tbody>
        </table>
    </form>
    
    <?php 
    //Admin notification of plugin functions
    if(current_user_can('manage_options')){?>
    <hr size="1" />
    <h2>Behind the scenes, I do:</h2>
    <ul>
        <li>Disables trackbacks and pings.</li>
        <li>Removes color scheme options.</li>
        <li>Sets session timeout to 20 minutes.</li>
    </ul>
    <?php }?>
</div>