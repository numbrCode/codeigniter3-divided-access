<?php
/*
 * This file is the view ща left menu
 * (Этот файл является view левого меню)
 * 
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
						<div class="sidebar content-box" style="display: block;">
							 <ul class="nav">
									<!-- Left menu -->
									<?php foreach ($pages_group_access as $key => $value): ?>
										 <?php if ($key != 0): ?>
												<?php if ($key == 1): ?>
															<?php //print_r($value); ?>
															<?php //echo'<br>'.$value[0]; ?>
													 <!--<li class="own-current"><a class="own-name-page" href="" data-own-name-page='<?php //echo $value[0]; ?>'><i class="glyphicon glyphicon-hand-right"></i> <?php //echo $value[1]; ?></a></li>-->
													 <li><a class="btn btn-default own-name-page own-current" href="#" role="button" data-own-name-page='<?php echo $value[0]; ?>'><i class="glyphicon glyphicon-hand-right"></i> <?php echo $value[1]; ?></a></li>									 
												<?php else: ?>
													 <li><a class="btn btn-default own-name-page" href="#" role="button" data-own-name-page='<?php echo $value[0]; ?>'><i class="glyphicon glyphicon-thumbs-up"></i> <?php echo $value[1]; ?></a></li>
												<?php endif; ?>
										 <?php endif; ?>
									<?php endforeach; ?>
							 </ul>
						</div>
