<?php
/**
* Fragment - Displays a search form
*
* @package EasyChirp
* @subpackage Views
* @author EasyChirp Dev Team 
*/
?>
<form id="frmSearch" action="/search_results" method="post">
	<label for="query" class="hide"><?php echo $xliff_reader->get('search-tweets-query'); ?></label>
	<input x-webkit-speech name="query" id="query" type="text" size="35" maxlength="50" class="input1" required aria-required="true" <?php
		if (isset($meta->query)) {
			echo 'value="' . urldecode($meta->query) . '"';
		}
		?> />
	<button type="submit" class="btnSmall"><?php echo $xliff_reader->get('search-tweets-submit'); ?></button>
</form>
