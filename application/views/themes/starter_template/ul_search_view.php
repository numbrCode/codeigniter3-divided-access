<?php
/*
 * This file is the view of list <input> Search
 * (Этот файл является view списка <input> Search)
 * 
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
									<?php if ($count_find_articles_with_input_search > 0): ?>
										 <ul class="list-unstyled form-control own-ul-search">
												<?php foreach ($find_articles_with_input_search as $value): ?>
													 <li class="own-li-search"><?php echo $value; ?></li>
												<?php endforeach; ?>
										 </ul>
									<?php endif; ?>
