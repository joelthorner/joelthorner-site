<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?= $title ?></title>

		
		<?php if (isset($customIcon)): ?>
			<link rel="icon" type="image/png" href="<?=$customIcon?>" sizes="16x16">
		<?php else: ?>
			<link rel="apple-touch-icon" sizes="57x57" href="<?=base_url()?>img/favicon/apple-touch-icon-57x57.png">
			<link rel="apple-touch-icon" sizes="60x60" href="<?=base_url()?>img/favicon/apple-touch-icon-60x60.png">
			<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url()?>img/favicon/apple-touch-icon-72x72.png">
			<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>img/favicon/apple-touch-icon-76x76.png">
			<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url()?>img/favicon/apple-touch-icon-114x114.png">
			<link rel="apple-touch-icon" sizes="120x120" href="<?=base_url()?>img/favicon/apple-touch-icon-120x120.png">
			<link rel="apple-touch-icon" sizes="144x144" href="<?=base_url()?>img/favicon/apple-touch-icon-144x144.png">
			<link rel="apple-touch-icon" sizes="152x152" href="<?=base_url()?>img/favicon/apple-touch-icon-152x152.png">
			<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>img/favicon/apple-touch-icon-180x180.png">
			<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/favicon-32x32.png" sizes="32x32">
			<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/android-chrome-192x192.png" sizes="192x192">
			<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/favicon-96x96.png" sizes="96x96">
			<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/favicon-16x16.png" sizes="16x16">
			<link rel="manifest" href="<?=base_url()?>img/favicon/manifest.json">
			<link rel="mask-icon" href="<?=base_url()?>img/favicon/safari-pinned-tab.svg" color="#5bbad5">
			<meta name="msapplication-TileColor" content="#25262b">
			<meta name="msapplication-TileImage" content="/mstile-144x144.png">
		<?php endif; ?>
		
		
		<meta name="theme-color" content="#3e7fcf">
		<meta name="description" content="<?= $descMeta ?>">
		<meta name="keywords" content="<?= $keyWordsMeta ?>">
		<meta name="author" content="Joel Thorner">

      <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
		<link href="css/joelthorner.min.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script src="<?= base_url();?>js/modernizr-custom.js"></script>

	</head>
	<body id="body-<?= $zone ?>" data-zone="<?= $zone ?>">

		<?php if($zone != 'home'): ?>
			<a href="/" class="logo-m hidden-md hidden-lg">
				<img src="<?=base_url()?>img/logo.png" class="logo-mobile">
			</a>
		<?php endif; ?>

		<aside id="menu">
			
			<div id="menu-toggler">
				<div class="inset init">
					<i class="line line-1"></i>
					<i class="line line-2"></i>
					<i class="line line-3"></i>
				</div>
			</div>

			<div class="inset scrollbar-inner black">

				<div class="logo-section">
					<a href="<?=base_url()?>" title="joelthorner.com">
						<img src="<?=base_url();?>img/logo.png" alt="Joelthorner logo">
					</a>
				</div>
				
				<div class="menu-section">
					<ul class="list-unstyled" id="menu-lvl-1">
						<?php foreach ($menu as $key => $value): ?>

							<li class="<?php if(isset($value->submenus)): ?>has-submenu<?php endif; ?> <?php if ($key == $zone):?>thisZone<?php endif; ?>">
								<a href="<?=base_url();?><?=$value->url?>">
									<?=$value->icon?>
									<span class="title"><?=$value->name?></span>
								</a>

								<?php if(isset($value->submenus)): ?>
									<a role="button" 
									   data-toggle="collapse" 
									   href="#collapse-<?=$key?>" 
									   aria-expanded="false" 
									   aria-controls="collapse-<?=$key?>"
									   class="collapsed init">
										<i class="material-icons">chevron_right</i>
									</a>
									<div class="collapse" id="collapse-<?=$key?>">
										<ul class="list-unstyled">
											<?php foreach ($value->submenus as $key2 => $value2): ?>
												<li>
													<a href="<?=base_url();?><?=$value2->url?>"><span class="title"><?=$value2->name?></span></a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				
				<div class="search">
					<span class="text">Search</span>
					<div class="input-wraper">
						<input id="menu-search" class="search-input form-control" type="text" autocomplete="off" placeholder="Search something...">
						<button class="clear btn hidden" id="clear-search-menu"><i class="material-icons">&#xE5CD;</i></button>
					</div>
					<div id="menu-search-output">
						<div class="scrollbar-inner blue">
							<div class="results-search results-0"></div>
						</div>
					</div>
				</div>
				<div class="working-on">
					<span class="title">Working on...</span>
					<p>
						Working in jQuery plugin for convert &lt;table&gt; into accordion or divs Html. n_n
					</p>
				</div>
				<div class="needscroll">
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<!-- Go OUT of here! satan solution 666 (easter egg) -->
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
				</div>
			</div>
		</aside>

		<?php if ($zone != 'plugin' && $zone != 'snippet'): ?>
			<div class="social-inset">
				<a href="https://github.com/joelthorner"
				   target="_blank"
				   rel="nofollow"
				   title="Joelthorner GitHub profile">
					<i class="fa fa-github-alt" aria-hidden="true"></i>
				</a>

				<a href="https://twitter.com/joelthorner"
				   target="_blank"
				   rel="nofollow"
				   title="Joelthorner Twitter profile">
					<i class="fa fa-twitter" aria-hidden="true"></i>
				</a>

				<a href="https://www.instagram.com/joelthorner"
				   target="_blank"
				   rel="nofollow"
				   title="Joelthorner Instagram profile">
					<i class="fa fa-instagram" aria-hidden="true"></i>
				</a>
			</div>
		<?php endif; ?>

		<main id="main-content">
			<?php echo $body; ?>
		</main>

		<?php if ($zone != 'plugin' && $zone != 'snippet'): ?>
			<div class="md-modal" id="quickViewIframes">
				<div class="md-content"></div>
				<div class="md-close">
					<div class="inset init">
						<i class="line line-1"></i>
						<i class="line line-2"></i>
						<i class="line line-3"></i>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="md-overlay"></div>

		
		<script src="<?=base_url();?>js/joelthorner.min.js"></script>
		
		<?php if ($zone == 'home' || $zone == 'plugin' || $zone == 'snippet'): ?>
			<script async defer src="https://buttons.github.io/buttons.js"></script>
		<?php endif ?>

		<div id="base_url" data-url="<?=base_url()?>"></div>
	</body>
</html>
