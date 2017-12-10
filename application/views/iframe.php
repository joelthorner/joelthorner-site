<div id="menuTogglerSmallCont" class="hidden-xs hidden-sm">
	<div id="menuTogglerSmall">
		<div class="inset init">
			<i class="line line-1"></i>
			<i class="line line-2"></i>
			<i class="line line-3"></i>
		</div>
	</div>
	<div class="githubButtons">
		<a target="_blank" href="https://github.com/<?=$repo->gitOwner?>/<?=$repo->gitRepo?>" aria-label="View <?=$repo->gitOwner?>/<?=$repo->gitRepo?> on GitHub" data-toggle="tooltip" data-placement="right" title="View on GitHub">
			<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
		</a>

		<a href="https://github.com/<?=$repo->gitOwner?>/<?=$repo->gitRepo?>/archive/master.zip" aria-label="Download <?=$repo->gitOwner?>/<?=$repo->gitRepo?> on GitHub" data-toggle="tooltip" data-placement="right" title="Download" class="blue">
			
			<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16"><path d="M9 12h2l-3 3-3-3h2V7h2v5zm3-8c0-.44-.91-3-4.5-3C5.08 1 3 2.92 3 5 1.02 5 0 6.52 0 8c0 1.53 1 3 3 3h3V9.7H3C1.38 9.7 1.3 8.28 1.3 8c0-.17.05-1.7 1.7-1.7h1.3V5c0-1.39 1.56-2.7 3.2-2.7 2.55 0 3.13 1.55 3.2 1.8v1.2H12c.81 0 2.7.22 2.7 2.2 0 2.09-2.25 2.2-2.7 2.2h-2V11h2c2.08 0 4-1.16 4-3.5C16 5.06 14.08 4 12 4z"/></svg>
		</a>
	</div>
</div>
<div id="readme" class="sr-only"><?=$readme?></div>
<iframe src="<?=base_url().$iframe?>" frameborder="0" class="full-iframe"></iframe>