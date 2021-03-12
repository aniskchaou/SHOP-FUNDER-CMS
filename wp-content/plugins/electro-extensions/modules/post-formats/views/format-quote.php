<div class="cf-elm-block" id="cfpf-format-quote-fields" style="display: none;">
	<div id="postbox-container-postformat" class="postbox-container">
		<div id="meta-box-postformat-video" class="postbox" style="display: block;">
			<div class="handlediv"><br></div>
			<h3><span><?php esc_html_e( 'Quote', 'electro-extensions' ); ?></span></h3>
			
			<div class="inside">

				<table class="form-table">
					<tbody>
						<tr>
							<th>
								<label for="postformat_quote_text">
									<strong><?php esc_html_e( 'Quote', 'electro-extensions' ); ?></strong>
									<span><?php esc_html_e( 'The text being quoted.', 'electro-extensions' ); ?></span>
								</label>
							</th>
							<td>
								<textarea name="postformat_quote_text" id="postformat_quote_text" rows="8" cols="5"><?php echo esc_attr( get_post_meta( $post->ID, 'postformat_quote_text', true ) ); ?></textarea>
							</td>
						</tr>
						<tr>
							<th>
								<label for="postformat_quote_source">
									<strong><?php esc_html_e( 'Source Name', 'electro-extensions' ); ?></strong>
									<span><?php esc_html_e( 'The person being cited.', 'electro-extensions' ); ?></span>
								</label>
							</th>
							<td>
								<input type="text" name="postformat_quote_source" id="postformat_quote_source" value="<?php echo esc_attr( get_post_meta( $post->ID, 'postformat_quote_source', true ) ); ?>" size="30">
							</td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>