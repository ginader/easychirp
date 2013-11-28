<?php
	$th_style = ' style="background-color: #c0c0c0; " ';
	
	$_headers = getallheaders();
?>
<h1 class="rounded">Test Page</h1>


<div class="box1 rounded">
	<h2>Test Page</h2>
	<p id="tblSyntaxSummary">This is a test page to help diagnose possible data issues.</p>
	<table aria-describedby="tblSyntaxSummary">
	<thead>
		<tr>
			<th scope="col" <?php echo $th_style; ?>>Name</th>
			<th scope="col" <?php echo $th_style; ?>>Value</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th scope="col" <?php echo $th_style; ?>>Name</th>
			<th scope="col" <?php echo $th_style; ?>>Value</th>
		</tr>
	</tfoot>
	<tbody>
		<tr>
			<th scope="row">Username</th>
			<td><?php echo $screen_name; ?></td>
		</tr>
		<tr>
			<th scope="row">User languages</th>
			<td><?php echo implode(', ', $user_langs); ?></td>
		</tr>
		<tr>
			<th scope="row">Time Zone</th>
			<td><?php echo $time_zone; ?></td>
		</tr>
		<tr>
			<th scope="row">UTC Offset</th>
			<td><?php echo $utc_offset; ?></td>
		</tr>
		<tr>
			<th scope="row">Headers</th>
			<td><?php debug_object($_headers); ?></td>
		</tr>
	</tbody>
	</table>
</div>



