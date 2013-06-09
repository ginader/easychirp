<h1 class="rounded"><?php echo $xliff_reader->get('search-h1'); ?></h1>

<div class="p-row-r">
	<div class="p-col-1-2">

<div class="box1 rounded">
	
	<h2><?php echo $xliff_reader->get('search-h2-tweets'); ?></h2>
	<form id="frmSearch" action="#" method="post">
		<label for="query" class="hide"><?php echo $xliff_reader->get('search-tweets-query'); ?></label>
		<input name="query" id="query" type="text" size="35" maxlength="50" class="input1" aria-required="true" />
		<button type="submit" class="btnSmall"><?php echo $xliff_reader->get('search-tweets-submit'); ?></button>
	</form>

	<h3><?php echo $xliff_reader->get('search-h3-hints'); ?></h3>
	<table>
		<thead>
		<tr>
			<th scope="col"><?php echo $xliff_reader->get('search-th-operator'); ?></th>
			<th scope="col"><?php echo $xliff_reader->get('search-th-example'); ?></th>
			<th scope="col"><?php echo $xliff_reader->get('search-th-result'); ?></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th scope="row">space</th>
			<td>twitter search</td>
			<td><?php echo $xliff_reader->get('search-result-space'); ?></td>
		</tr>
		<tr>
			<th scope="row">OR</th>
			<td>love OR hate</td>
			<td><?php echo $xliff_reader->get('search-result-or'); ?></td>
		</tr>
		<tr>
			<th scope="row">-</th>
			<td>beer -root</td>
			<td><?php echo $xliff_reader->get('search-result-hyphen'); ?></td>
		</tr>
		<tr>
			<th scope="row">#</th>
			<td>#haiku</td>
			<td><?php echo $xliff_reader->get('search-result-hash'); ?></td>
		</tr>
		<tr>
			<th scope="row">from:</th>
			<td>from:alexiskold</td>
			<td><?php echo $xliff_reader->get('search-result-from'); ?></td>
		</tr>
		<tr>
			<th scope="row">to:</th>
			<td>to:techcrunch</td>
			<td><?php echo $xliff_reader->get('search-result-to'); ?></td>
		</tr>
		</tbody>
	</table>
</div>

	</div>
	<div class="p-col-1-2">

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('search-h2-saved'); ?></h2>
	<p><?php echo $xliff_reader->get('search-saved-none'); ?></p>
	<ul>
		<li><a href="#">screen reader twitter</a> <a href="#" class="delete-link delete-search"><span aria-hidden="true" class="icon-close1"></span> Delete</a></li>
		<li><a href="#">#a11y css</a> <a href="#" class="delete-link delete-search"><span aria-hidden="true" class="icon-close1"></span> Delete</a></li>
		<li><a href="#">your mama and papa</a> <a href="#" class="delete-link delete-search"><span aria-hidden="true" class="icon-close1"></span> Delete</a></li>
	</ul>
</div>

<div class="box1 rounded" style="padding-bottom: 1.5rem;">
	<h2><?php echo $xliff_reader->get('search-h2-users'); ?></h2>
	<form id="frmSearchUsers" action="#" method="post">
		<label for="queryUsers" class="hide"><?php echo $xliff_reader->get('search-users-query'); ?></label>
		<input name="queryUsers" id="queryUsers" type="text" size="35" maxlength="50" class="input1" aria-required="true" />
		<button type="submit" class="btnSmall"><?php echo $xliff_reader->get('search-users-submit'); ?></button>
	</form>
</div>

	</div>
</div>

