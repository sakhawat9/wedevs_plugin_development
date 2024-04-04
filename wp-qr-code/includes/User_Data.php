<?php

namespace Fixolab\WpQrCode;

class User_Data {
	public function __construct() {
		add_action(
			'show_user_profile',
			array( $this, 'custom_user_profile_fields' )
		);
		add_action(
			'edit_user_profile',
			array( $this, 'custom_user_profile_fields' )
		);
		add_action(
			'personal_options_update',
			array( $this, 'save_custom_user_profile_fields' )
		);
		add_action(
			'edit_user_profile_update',
			array( $this, 'save_custom_user_profile_fields' )
		);
	}

	function custom_user_profile_fields( $user ) {
		?>
		<h3><?php echo 'Extra Profile Information'; ?></h3>
	
		<table class="form-table">
			<tr>
				<th><label for="twitter_handle"><?php echo 'Twitter Handle'; ?></label></th>
				<td>
					<input type="text" name="twitter_handle" id="twitter_handle" value="<?php echo esc_attr( get_user_meta( $user->ID, 'twitter_handle', true ) ); ?>" class="regular-text" />
				</td>
			</tr>
		</table>
		<?php
	}

	function save_custom_user_profile_fields( $user_id ) {
		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}
	
		update_user_meta( $user_id, 'twitter_handle', $_POST[ 'twitter_handle' ] );
	}
}