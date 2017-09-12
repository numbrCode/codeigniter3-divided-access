<?php
/*
 * This file is the view of content page
 * (Этот файл является view содержимого страницы)
 * 
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
						<?php foreach ($content_page as $key => $value): ?>
							 <div class="row">
									<div class="col-xs-12 panel-warning">
										 <!--<div class="content-box-header panel-heading">-->
												<!--<div class="panel-title ">111111</div>-->
										 <!--</div>-->
										 <div class="panel-body text-justify bg-warning own-first-page">
											 <?php echo $value['article']; ?>
										 </div>
									</div>
							 </div>
						<?php endforeach; ?>
