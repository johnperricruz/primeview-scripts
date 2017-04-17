<?php
 class ScriptController{
	public function __construct(){
		add_action('admin_menu',array(&$this, 'createPage'));
		add_action( 'admin_init',array(&$this, 'pv_scripts_save_settings_post')); 
		add_action( 'wp_footer',array(&$this, 'optimizeGa')); 
	}
	public function createPage(){
		add_menu_page( 
			'PV Scripts', 							 // Page Title
			'PV Scripts',           				 // Navbar Title
			'manage_options',      					 // Permission 
			'primeview-scripts',      				 // Page ID
			array(&$this, 'settingsPage'),            // Function call
			'dashicons-media-text',   				 // Favicon
			2                				 		 // Order
		);
 
	}
	public function settingsPage(){
	?>
			<h2>Primeview Scripts</h2>
			<form method="post" action="options.php">
				<?=settings_fields( 'pv-scripts-option-group' );?>
				<?=do_settings_sections( 'pv-scripts-option-group' );?>
				<?php
					echo '<h3>Google Analytics</h3>';
					echo '<table width="50%">
							<tr>
								<td>Google Analytics (UA Code)</td>
								<td><input style="width:100%;" placeholder="UA-********-*" type="text" name="ga_ua" value="'. esc_attr( get_option('ga_ua') ).'" /></td>
							</tr>
						</table>
						</table>
					';
				?>
				
				<?php submit_button(); ?>
			</form>
		<?php
	}
	function pv_scripts_save_settings_post(){
		register_setting( 'pv-scripts-option-group', 'ga_ua' );
	}	
	function optimizeGa(){
		if(get_option('ga_ua')!=null){
			echo "<!-- Optimized GA Code -->";
			if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false){
			?>
				<script type="text/javascript" data-cfasync="false">
					(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
					ga('create', '<?php echo get_option('ga_ua');?>', 'auto');		 
					ga('send', 'pageview');
				</script> 
			<?php
			}	
			echo "<!-- End Optimized Tracker Code -->";
		}
	}
}
?>