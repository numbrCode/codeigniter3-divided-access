<?php
/*
 * This file is the view content of page for divided access
 * (Этот файл является содержимым страницы для разделенного доступа)
 * 
 * Author       numbrCode
 * Copyright   2017 numbrCode
 * Licensed under MIT.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	 <div class="header">
			<div class="container">
				 <div class="row">
						<div class="col-md-5 col-md-offset-1">
							 <!-- Logo -->
							 <div class="logo">
									<h1><a href="https://divided-access.yoursite.com/">Разделённый доступ</a><span class="text-center own-exit"><a href="index.php/divided_access/exit_content_divided_access" title="Выход (exit)."><button id="btnExitAdmin" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></button></a>
		</span></h1>
									
							 </div>
						</div>
						
						<div class="col-md-5">
							 <div class="row">
								<div class="col-xs-8">
									      <input type="text" class="form-control own-inpt-search" placeholder="Сквозной поиск от 3-х символов">
								</div>
								<div class="col-xs-4">
									      <span class="input-group-btn">
										      <button class="btn btn-primary own-button-search" type="button">Поиск</button>
										      
									      </span>
								</div>
							 </div>
							 
							 <!-- Список поиска -->
							 <div class="row">
								<div class="col-xs-8" id="own-dv-search"></div>
							 </divb>
							 <!-- ./Список поиска -->
						</div>
						
				 </div>
			</div>

    <div class="container own-container">
    	<div class="row">
				 <div class="col-md-2 col-md-offset-1">
						<?php echo $left_menu ;?>
				 </div>

				 <div class="col-md-8" id="own-content-page">
						<?php echo $content_first_page_group; ?>
				 </div>
			</div>

        <!-- Modal Search -->
        <div class="modal fade bs-example-modal-lg" id="myModal-search" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="self-color-demand">Ответ на запрос для ПОИСКА.</h4>
              </div>
        
              <div class="modal-body">
                <div class="container-fluid">

                    <div class="col-md-2 text-center">
                    </div>
                    
                    <!-- modal-Search -->
                    <div class="col-md-8 text-center">
                      <div id="search-mdl" class="text-center"></div>
                    </div>
                    <!-- (end) modal-Search -->
                    
                    <div class="col-md-2">
                    </div>

                </div>
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
              </div>
            </div>
          </div>
        </div>
        <!-- (end) Modal Search -->
