<?php 
	use \Michelf\Markdown;
	use \Michelf\MarkdownExtra;
/*

	types of grid : 
		{
			'slider-100', // only slider images and html 
			'block-2x2',  // only repo github
			'block-1x1',  // only repo github
			'block-1x4',  // only repos other people (starred)
			'block-3x1',  // tag cloud (footer)
		}
 
 */

 ?>
<div class="container-fluid home-container">
	<div class="row">
		<?php $home_i = 0; ?>
		<?php foreach ($homeItems->items as $key => $value): ?>
			
			<?php if ($home_i==1): ?><div id="go-to-content"></div><?php endif ?>
			
			<?php if ($value->type == 'slider-100'): ?>
				<div class="swiper-container first-slider">

					<div class="swiper-wrapper">
						<?php foreach ($value->sliderItems as $siKey => $siValue): ?>
							<div class="swiper-slide">

								<?php if (isset($siValue->title) || isset($siValue->content)): ?>
									<div class="content">
										<?php if (isset($siValue->title)): ?><?=$siValue->title?><?php endif ?>
										<?php if (isset($siValue->content)): ?><?=$siValue->content?><?php endif ?>
									</div>
								<?php endif ?>

								<?php if (isset($siValue->footer)): ?>
									<div class="footer"><?=$siValue->footer?></div>
								<?php endif ?>

								<picture>
									<source media="(min-width: 1800px)" srcset="<?=base_url()?><?=$siValue->lg?>">
									<source media="(min-width: 650px)" srcset="<?=base_url()?><?=$siValue->md?>">
									<img src="<?=base_url()?><?=$siValue->xs?>" alt="<?=$siValue->alt?>">
								</picture>

							</div>
						<?php endforeach; ?>
					</div>
					
					<div class="swiper-pagination"></div>
				</div>
			<?php endif; ?>
			
			<?php /* BLOCK 2 x 2 ------------------------------------------------------------------ */ ?>
			<?php if ($value->type == 'block-2x2'): ?>
				<div class="square square2x2" 
				     style="background-image:url('<?=base_url().$value->repo->image?>');"
				     data-demo-source="<?=$value->repo->source?>" rel="nofollow">

					<div class="header-top">
						<a class="github-button" 
						   href="https://github.com/<?=$value->repo->gitContent->owner->login?><?=$value->repo->gitContent->name?>/issues" 
						   data-icon="octicon-issue-opened" 
						   data-count-api="/repos/<?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?>#open_issues_count" 
						   data-count-aria-label="# issues on GitHub" 
						   aria-label="Issue <?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?> on GitHub">Issue</a>
						
						<a class="github-button" 
						   href="https://github.com/<?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?>archive/master.zip" 
						   data-icon="octicon-cloud-download" 
						   aria-label="Download <?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?> on GitHub">Download</a>
						
						<a href="<?=$value->repo->gitContent->html_url?>" target="_blank" title='View on GitHub' class='btn-git'>
							<i class="fa fa-github" aria-hidden="true"></i> View on GitHub
						</a>
					</div>

					<div class="item-content">

						<div class="tags clearfix">
							<?php foreach (explode(',', $value->repo->tags) as $tag): ?>
								<a href="<?=base_url().'tag/'. $tag?>">
									<span class="tag <?=$tag?>"><?=str_replace('-', ' ', $tag)?></span>
								</a>
							<?php endforeach; ?>
						</div>

						<a title='Go to <?=$value->repo->gitContent->name?> page' 
							class="title" 
							href="<?=base_url().$value->repo->workType?>/<?=$value->repo->gitContent->name?>">
							<h3 class="name"><?=$value->repo->gitContent->name?></h3>
						</a>

						<p><?=$value->repo->gitContent->description?></p>

						<p class="footer">
							<span class="by">By:&nbsp;
								<a data-toggle="tooltip" 
				             	title="<?=$value->repo->gitContent->owner->login?>" 
				             	href="<?=$value->repo->gitContent->owner->html_url?>"
				             	target="_blank">
				             		<img src="<?=$value->repo->gitContent->owner->avatar_url?>&s=20" 
				             			  alt="<?=$value->repo->gitContent->owner->login?> avatar"
				             			  height="20" width="20">
				            </a>
				         </span>
				         <?php if($value->repo->gitContent->_lastRelease != NULL): ?>
					         <?php $dateLastRelease = new DateTime($value->repo->gitContent->_lastRelease->published_at); 
					         		$dateLastRelease = $dateLastRelease->format('Y-m-d');
					         ?>
					         <?php 
					         	$lastReleasepreHTML = $value->repo->gitContent->_lastRelease->body;
									$parser = new MarkdownExtra;
									$parser->fn_id_prefix = "post22-";
									$_RELEASE = $parser->transform($lastReleasepreHTML);
					         ?>
								<span class="last-version">
									<a tabindex="0" role="button" data-toggle="popover" data-placement="top" 
									   data-trigger="focus" title="Changelog" data-html-origin="#html-origin-<?=$value->repo->gitContent->id?>">
										Last version <span class="version"><?=$value->repo->gitContent->_lastRelease->name?></span>
									</a>
								</span>
								<span class="date"><?=$dateLastRelease?></span>
				         <?php else: ?>
				         	<?php $dateLastRelease = new DateTime($value->repo->gitContent->updated_at); 
					         		$dateLastRelease = $dateLastRelease->format('Y-m-d');
					         ?>
								<span class="date"><?=$dateLastRelease?></span>
				         <?php endif;?>
						</p>
						<div id="html-origin-<?=$value->repo->gitContent->id?>" class="hidden"><?=$_RELEASE?></div>

						<div class="buttons">
							<button title='Quick view' 
									  class='ajax-demo-preview btn-outiline hidden-xs'>Quick view</button>
							<a class='btn-outiline' 
								title='Go to <?=$value->repo->gitContent->name?> page' 
								href="<?=base_url().$value->repo->workType?>/<?=$value->repo->gitContent->name?>">full demo</a>
						</div>

					</div>
				</div>
			<?php endif; ?>
			<?php /* end BLOCK 2 x 2 ------------------------------------------------------------------ */ ?>


			<?php if ($value->type == 'open-1x2'): ?><div class="column1x2"><div class="inset"><?php endif ?>


			<?php if ($value->type == 'block-1x1'): ?>
				<div class="square square1x1" 
				     style="background-image:url('<?=base_url().$value->repo->image?>');"
				     data-demo-source="<?=$value->repo->source?>" rel="nofollow">
				   
				   <div class="header-top hidden-lg hidden-md">
						<a class="github-button" 
						   href="https://github.com/<?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?>/issues" 
						   data-icon="octicon-issue-opened" 
						   data-count-api="/repos/<?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?>#open_issues_count" 
						   data-count-aria-label="# issues on GitHub" 
						   aria-label="Issue <?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?> on GitHub">Issue</a>
						
						<a class="github-button" 
						   href="https://github.com/<?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?>/archive/master.zip" 
						   data-icon="octicon-cloud-download" 
						   aria-label="Download <?=$value->repo->gitContent->owner->login?>/<?=$value->repo->gitContent->name?> on GitHub">Download</a>
						
						<a href="<?=$value->repo->gitContent->html_url?>" target="_blank" title='View on GitHub' class='btn-git'>
							<i class="fa fa-github" aria-hidden="true"></i> View on GitHub
						</a>
					</div>

					<div class="item-content">

						<div class="tags clearfix">
							<?php foreach (explode(',', $value->repo->tags) as $tag): ?>
								<a href="<?=base_url().'tag/'. $tag?>">
									<span class="tag <?=$tag?>"><?=str_replace('-', ' ', $tag)?></span>
								</a>
							<?php endforeach; ?>
						</div>

						<a title='Go to <?=$value->repo->gitContent->name?> page' 
							class="title" 
							href="<?=base_url().$value->repo->workType?>/<?=$value->repo->gitContent->name?>">
							<h3 class="name"><?=$value->repo->gitContent->name?></h3>
						</a>

						<p class="hidden-lg hidden-md"><?=$value->repo->gitContent->description?></p>

						<p class="footer hidden-lg hidden-md">
							<span class="by">By:&nbsp;
								<a data-toggle="tooltip" 
				             	title="<?=$value->repo->gitContent->owner->login?>" 
				             	href="<?=$value->repo->gitContent->owner->html_url?>"
				             	target="_blank">
				             		<img src="<?=$value->repo->gitContent->owner->avatar_url?>&s=20" 
				             			  alt="<?=$value->repo->gitContent->owner->login?> avatar"
				             			  height="20" width="20">
				            </a>
				         </span>
				         <?php if($value->repo->gitContent->_lastRelease != NULL): ?>
					         <?php $dateLastRelease = new DateTime($value->repo->gitContent->_lastRelease->published_at); 
					         		$dateLastRelease = $dateLastRelease->format('Y-m-d');
					         ?>
					         <?php 
					         	$lastReleasepreHTML = $value->repo->gitContent->_lastRelease->body;
									$parser = new MarkdownExtra;
									$parser->fn_id_prefix = "post22-";
									$_RELEASE = $parser->transform($lastReleasepreHTML);
					         ?>
								<span class="last-version">
									<a tabindex="0" role="button" data-toggle="popover" data-placement="top" 
									   data-trigger="focus" title="Changelog" data-html-origin="#html-origin-<?=$value->repo->gitContent->id?>">
										Last version <span class="version"><?=$value->repo->gitContent->_lastRelease->name?></span>
									</a>
								</span>
								<span class="date"><?=$dateLastRelease?></span>
				         <?php else: ?>
				         	<?php $dateLastRelease = new DateTime($value->repo->gitContent->updated_at); 
					         		$dateLastRelease = $dateLastRelease->format('Y-m-d');
					         ?>
								<span class="date"><?=$dateLastRelease?></span>
				         <?php endif;?>
						</p>

						<div id="html-origin-<?=$value->repo->gitContent->id?>" class="hidden"><?=$_RELEASE?></div>

						<div class="buttons hidden-lg hidden-md">
							<button title='Quick view' 
									  class='ajax-demo-preview btn-outiline hidden-xs'>Quick view</button>
							<a class='btn-outiline' 
								title='Go to <?=$value->repo->gitContent->name?> page' 
								href="<?=base_url().$value->repo->workType?>/<?=$value->repo->gitContent->name?>">full demo</a>
						</div>
					</div>

				</div>
			<?php endif ?>


			<?php if ($value->type == 'close-1x2'): ?></div></div><?php endif ?>


			<?php if ($value->type == 'block-1x3'): ?>

				<div class="column1x3">
					<div class="inset scrollbar-inner">
						
						<h4>My last stars</h4>

						<ul class="content-items list-unstyled">
							<?php $star_i = 0; ?>
							<?php foreach ($myStarred as $key_s => $value_s): ?>
								<li class="item-<?=$star_i?>">
									<div class="media">
										<div class="media-left media-middle">
											<a href="<?=$value_s->html_url?>" target="_blank">
												<img class="media-object" src="<?=$value_s->owner->avatar_url?>&s=50" alt="<?=$value_s->name?> repository">
											</a>
										</div>
										<div class="media-body media-middle">
											<a href="<?=$value_s->html_url?>" target="_blank" class="owner">
												<span><?=$value_s->owner->login?></span>
											</a>
											<a href="<?=$value_s->html_url?>" target="_blank" class="title">
												<h5 class="media-heading"><?=$value_s->name?></h5>
											</a>
										</div>
									</div>
									<?php if ($value_s->homepage != ""): ?>
										<!-- <p></p> -->
									<?php endif ?>
								</li>
								<?php $star_i++;  if ($star_i == $value->lastGitStars) break; ?>
							<?php endforeach ?>
						</ul>
					</div>
				</div>
			<?php endif ?>

			<?php if ($value->type == 'block-3x1'): ?>
				<div class="square square3x1">
					<div class="item-content clearfix">
						<h4>All tags</h4>
						<?php foreach ($allTags as $keyTag => $valueTag): ?>
							<?php if($valueTag): ?>
								<a href="<?=base_url()?>tag/<?=$valueTag?>" title="Tag <?=$valueTag?>">
									<span class="tag <?=$valueTag?>"><?=str_replace('-', ' ', $valueTag)?></span>
								</a>
							<?php endif ?>
						<?php endforeach ?>
					</div>
				</div>
			<?php endif ?>

				
			<?php $home_i++; ?>
		<?php endforeach; ?>

	</div><!-- / row -->
</div><!-- /container home -->
