<div class="cf-elm-block" id="cfpf-format-audio-fields" style="display: none;">
	<div id="postbox-container-postformat" class="postbox-container">
		<div id="meta-box-postformat-video" class="postbox" style="display: block;">
			
			<div class="handlediv"><br></div>
			<h3><span><?php esc_html_e('Audio Options', 'electro-extensions'); ?></span></h3>
			
			<div class="inside">

				<p style="padding:10px 0 0 0;"><?php esc_html_e('Enter the paths to your audio files in the fields below', 'electro-extensions'); ?></p>

				<table class="form-table">
					<tbody>
						<tr>
							<th>
								<label for="postformat_audio_mp3">
									<strong><?php esc_html_e('MP3 File URL', 'electro-extensions'); ?></strong>
									<span><?php esc_html_e('URL to an .mp3 file', 'electro-extensions'); ?></span>
								</label>
							</th>
							<td>
								<input type="text" name="postformat_audio_mp3" id="postformat_audio_mp3" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_audio_mp3', true)); ?>" size="30">
							</td>
						</tr>
						<tr>
							<th>
								<label for="postformat_audio_ogg">
									<strong><?php esc_html_e('OGA File URL', 'electro-extensions'); ?></strong>
									<span><?php esc_html_e('URL to an .oga or .ogg file', 'electro-extensions'); ?></span>
								</label>
							</th>
							<td>
								<input type="text" name="postformat_audio_ogg" id="postformat_audio_ogg" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_audio_ogg', true)); ?>" size="30">
							</td>
						</tr>
						<tr>
							<th>
								<label for="postformat_audio_embedded">
									<strong><?php esc_html_e('Embedded Audio', 'electro-extensions'); ?></strong>
									<span><?php esc_html_e('Add embedded audio formats.', 'electro-extensions'); ?></span>
								</label>
							</th>
							<td>
								<textarea name="postformat_audio_embedded" id="postformat_audio_embedded" rows="8" cols="5"><?php echo esc_textarea(get_post_meta($post->ID, 'postformat_audio_embedded', true)); ?></textarea>
							</td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>	