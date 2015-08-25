<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9">
			<h1><?php echo _("Add New System Recording")?></h1>
			<div class="fpbx-container">
				<div class="display full-border">
					<form id="recordings-frm" class="fpbx-submit" name="recordings-frm" action="config.php?display=recordings" method="post" <?php if(isset($data['id'])) {?>data-fpbx-delete="config.php?display=recordings&amp;action=del"<?php } ?> role="form">
						<input type="hidden" name="id" id="id" value="<?php echo isset($data['id']) ? $data['id'] : ''?>">
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="name"><?php echo _("Name")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="name"></i>
											</div>
											<div class="col-md-9"><input type="text" class="form-control" id="name" name="name" value="<?php echo isset($data['displayname']) ? $data['displayname'] : ''?>"></div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="name-help" class="help-block fpbx-help-block"><?php echo _("The name of the system recording on the file system. If it conflicts with another file then this will overwrite it.")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="description"><?php echo _("Description")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="description"></i>
											</div>
											<div class="col-md-9"><input type="text" class="form-control" id="description" name="description" value="<?php echo isset($data['description']) ? $data['description'] : ''?>"></div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="description-help" class="help-block fpbx-help-block"><?php echo _("Describe this recording")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="list"><?php echo sprintf(_("File List for %s"),"<span class='language'>".$langs[$default]."</span>")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="list"></i>
											</div>
											<div class="col-md-9">
												<select class="form-control" id="language" name="language">
													<?php foreach($langs as $code => $lang) {?>
														<option value="<?php echo $code?>" <?php echo ($code == $default) ? 'SELECTED': ''?>><?php echo $lang?></option>
													<?php } ?>
												</select>
												<div id="file-alert" class="alert alert-info <?php echo !empty($data['soundlist']) ? "hidden" : ""?>" role="alert"><?php echo sprintf(_("No files for %s"),"<span class='language'>".$langs[$default]."</span>")?></div>
												<ul id="files">
													<?php if(isset($data['soundlist'])) { foreach($data['soundlist'] as $item) {?>
														<li id="file-<?php echo $item['name']?>" class="file" data-filenames='<?php echo json_encode($item['filenames'])?>' data-name="<?php echo $item['name']?>" data-system="<?php echo $item['system'] ? 1 : 0?>" data-languages="<?php echo json_encode($item['languages'])?>"><?php echo $item['name']?><i class="fa fa-times-circle pull-right text-danger delete-file"></i></li>
													<?php } } ?>
												</ul>
												<div id="missing-file-alert" class="alert alert-warning hidden" role="alert"><?php echo _("You have a missing file for this language. Click any red file above to replace it with a file below")?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="list-help" class="help-block fpbx-help-block"><?php echo _("Sortable File List/Play order. The playback will be done starting from the top to the bottom. If combine is set to yes then these files will be combined into one single file with playback from top to bottom")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="fileupload"><?php echo _("Upload Recording")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="fileupload"></i>
											</div>
											<div class="col-md-9">
												<input id="fileupload" type="file" name="files[]" data-url="ajax.php?module=recordings&amp;command=upload" class="form-control" multiple>
												<div id="upload-progress" class="progress">
													<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
												</div>
												<div id="dropzone">
													<div class="message"><?php echo _("Drop Multiple Files or Archives Here")?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="fileupload-help" class="help-block fpbx-help-block"><?php echo sprintf(_("Upload files from our local system. Supported upload formats are: %s. This includes archives (that include multiple files) and multiple files"),"<i><strong>".implode(", ",$supported['in'])."</strong></i>")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="record-container" class="element-container hidden">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="record"><?php echo _("Record In Browser")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="record"></i>
											</div>
											<div class="col-md-9">
												<div id="browser-recorder">
													<div id="jquery_jplayer_1" class="jp-jplayer"></div>
													<div id="jp_container_1" data-player="jquery_jplayer_1" class="jp-audio-freepbx" role="application" aria-label="media player">
														<div class="jp-type-single">
															<div class="jp-gui jp-interface">
																<div class="jp-controls">
																	<i class="fa fa-play jp-play"></i>
																	<i id="record" class="fa fa-circle"></i>
																</div>
																<div class="jp-progress">
																	<div class="jp-seek-bar progress">
																		<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
																		<div class="progress-bar progress-bar-striped active" style="width: 100%;"></div>
																		<div class="jp-play-bar progress-bar"></div>
																		<div class="jp-play-bar">
																			<div class="jp-ball"></div>
																		</div>
																		<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
																	</div>
																</div>
																<div class="jp-volume-controls">
																	<i class="fa fa-volume-up jp-mute"></i>
																	<i class="fa fa-volume-off jp-unmute"></i>
																</div>
															</div>
															<div class="jp-details">
																<div class="jp-title" aria-label="title"><?php echo _("Hit the red record button to start recording from your browser")?></div>
															</div>
															<div class="jp-no-solution">
																<span><?php echo _("Update Required")?></span>
																<?php echo sprintf(_("To play the media you will need to either update your browser to a recent version or update your %s"),'<a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>')?>
															</div>
														</div>
													</div>
												</div>
												<div id="browser-recorder-progress" class="progress fade hidden">
													<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
													</div>
												</div>
												<div id="browser-recorder-save" class="fade hidden">
													<div class="input-group">
														<input type="text" class="form-control" id="save-recorder-input" placeholder="Name this file">
														<span class="input-group-btn">
															<button class="btn btn-default" type="button" id="save-recorder">Save!</button>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="record-help" class="help-block fpbx-help-block"><?php echo _("This will initate a WebRTC request so that you will be able to record from you computer in your browser")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="record-phone"><?php echo _("Record Over Extension")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="record-phone"></i>
											</div>
											<div class="col-md-9">
												<div id="dialer-message" class="alert alert-warning hidden" role="alert"></div>
												<div id="dialer" class="fade in">
													<div class="input-group">
														<input type="text" class="form-control" id="record-phone" placeholder="<?php echo _("Enter Extension")?>...">
														<span class="input-group-btn">
															<button class="btn btn-default" type="button" id="dial-phone"><?php echo _("Call")?></button>
														</span>
													</div>
												</div>
												<div id="dialer-save" class="fade hidden">
													<div class="input-group">
														<input type="text" class="form-control" id="save-phone-input" placeholder="<?php echo _("Name this file")?>">
														<span class="input-group-btn">
															<button class="btn btn-default" type="button" id="save-phone"><?php echo _("Save")?></button>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="record-phone-help" class="help-block fpbx-help-block"><?php echo _("The system will call the extension you specify to the left. Upon hangup you will be able to name the file and it will be placed in the list above")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="systemrecording"><?php echo _("Add System Recording")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="systemrecording"></i>
											</div>
											<div class="col-md-9">
												<select name="systemrecording" id="systemrecording" class="autocomplete-combobox form-control">
													<option></option>
													<?php foreach($sysrecs as $key => $sr) {?>
														<option value="<?php echo $key?>"><?php echo $sr['name']?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="systemrecording-help" class="help-block fpbx-help-block"><?php echo _("Add any previously created system recording or a recording that was added previously")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="combine"><?php echo _("Combine Files")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="combine"></i>
											</div>
											<div class="col-md-9">
												<span class="radioset">
													<input type="radio" id="combine-yes1" name="combine" value="yes">
													<label for="combine-yes1"><?php echo _("Yes")?></label>
													<input type="radio" id="combine-no1" name="combine" value="no" checked>
													<label for="combine-no1"><?php echo _("No")?></label>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="combine-help" class="help-block fpbx-help-block"><?php echo _("Instead of chaining files together (of which some applications do not support playback) combine the files above into a single file. After this is done you will not be able to resort or remove the files from the list above but you will be able to add files to the end of or the beginning of this file. This will not destroy any previously existing files listed above.")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						-->
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="convert"><?php echo _("Convert To")?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="convert"></i>
											</div>
											<div class="col-md-9 text-center">
												<span class="radioset">
													<?php $c=0;foreach($supported['out'] as $k => $v) { ?>
														<?php if(($c % 5) == 0 && $c != 0) { ?></span></br><span class="radioset"><?php } ?>
														<input type="checkbox" id="<?php echo $k?>" name="codec[]" class="codec" value="<?php echo $k?>" <?php echo ($k == 'wav') ? 'CHECKED' : ''?>>
														<label for="<?php echo $k?>"><?php echo $v?></label>
													<?php $c++; } ?>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span id="convert-help" class="help-block fpbx-help-block"><?php echo _("Check all file formats you would like this system recording to be encoded into")?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-3 hidden-xs bootnav">
			<div class="list-group">
				<a href="?display=recordings" class="list-group-item"><?php echo _("List Recordings")?></a>
			</div>
		</div>
	</div>
</div>
<script>var supportedHTML5 = "<?php echo $supportedHTML5?>";var supportedFormats = <?php echo json_encode($supported['in'])?>;var supportedRegExp = "<?php echo implode("|",array_keys($supported['in']))?>";var systemRecordings = <?php echo json_encode($sysrecs)?>;var soundList = <?php echo isset($data['soundlist']) ? json_encode($data['soundlist']) : "{}"?>;</script>
<div id="playbacks">
</div>
