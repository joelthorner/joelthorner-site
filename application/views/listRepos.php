<div class="listRepos clearfix">
	<div class="title">
		<h1><?=$h1?></h1>
	</div>

	<?php $iLoop = 1; $isMixed = false; ?>
	<?php if($typeView == "mixed") $isMixed = true ?>

	<?php foreach ($repos as $repo): ?>
		<?php if($isMixed) $typeView = $repo->workType ?>
		
		<div class="listItem clearfix">
			<div class="media">
				<div class="media-left">
					<?php 
						if ($iLoop == 4) $iLoop = 1;
						$style = "background-image: url('".base_url()."img/icons/hover_codes/".$iLoop.".png');"; 
					?>
					<a href="<?=base_url() . $typeView . '/' . $repo->gitRepo?>" style="<?=$style?>">
						<img class="media-object" src="<?=base_url().$repo->image?>" alt="<?=$repo->gitRepo?>">
					</a>
				</div>
				<div class="media-body">
					<div class="inset-body">
						
						<a href="<?=base_url() . $typeView . '/' . $repo->gitRepo?>">
							<h2 class="media-heading"><?=$repo->gitRepo?></h2>
						</a>

						<p class="desc"><?=$repo->gitContent->description?></p>

						<div class="tags clearfix">
							<?php foreach (explode(',', $repo->tags) as $tag): ?>
								<a href="<?=base_url().'tag/'. $tag?>">
									<span class="tag <?=$tag?>"><?=str_replace('-', ' ', $tag)?></span>
								</a>
							<?php endforeach; ?>
						</div>

						<div class="footerLateral hidden-xs">
							<a href="<?=base_url() . $typeView . '/' . $repo->gitRepo?>" data-toggle="tooltip" data-placement="left" title="View">
								<i class="material-icons">&#xE417;</i>
							</a>
							<a href="https://github.com/<?=$repo->gitOwner?>/<?=$repo->gitRepo?>/archive/master.zip" aria-label="Download <?=$repo->gitOwner?>/<?=$repo->gitRepo?> on GitHub" data-toggle="tooltip" data-placement="left" title="Download">
								<i class="material-icons">&#xE2C0;</i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $iLoop++; ?>
	<?php endforeach; ?>

</div>