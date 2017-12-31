	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Text Color', 'slz-core' ); ?></label></th>
		<td>
			<?php echo ( $this->text_field( $taxonomy_opt .'[color]',
										$this->get_field( $data_meta, 'color' ),
										array('class' => 'slzcore-meta-color') ) );?>
			<p><?php esc_html_e('Text color is how it appears on each property item. Leaving empty will using default style.', 'slz-core');?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Background Color', 'slz-core' ); ?></label></th>
		<td>
			<?php echo ( $this->text_field( $taxonomy_opt .'[background_color]',
										$this->get_field( $data_meta, 'background_color' ),
										array('class' => 'slzcore-meta-color') ) );?>
			<p><?php esc_html_e('Background color is how it appears on each property item. Leaving empty will using default style.', 'slz-core');?></p>
		</td>
	</tr>
