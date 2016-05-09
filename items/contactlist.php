<?php 
include_once 'index.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>QC ITEMS DATABASE</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function ConfirmDelete(){
	var d = confirm('Do you really want to delete data?');
	if(d == false){
		return false;
	}
}
</script>
</head>
<body>
	<div class="wrapper">
		<div class="content" >
			<?php include 'header.php'; ?><br/>
			<table class="sortable">
				<thead>
					<tr>
						<th>
							Brand
						</td>
						<th>
							Item Nr
						</th>
						<th>
							SAP Nr
						</th>
						<th>
							Supplier
						</th>
						<th>
							Supplier Item Nr
						</th>
                                                <th>
							Status
						</th>
						<th></th><th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($item_list as $item_info) : ?>
						<tr>
							<td>
								<?php echo $item_info["BRAND"]; ?>
							</td>
							<td>
								<?php echo $item_info["ITEM"]; ?>
							</td>
                                                        <td>
								<?php echo $item_info["SAP"]; ?>
							</td>
							<td>
								<?php echo $item_info["SUPPLIER"]; ?>
							</td>
							<td>
								<?php echo $item_info["ITEM_S"]; ?>
							</td>
							<td>
								<?php echo $item_info["STATUS"]; ?>
							</td>
							<td>
								<form method="post" action="index.php">
									<input type="hidden" name="ci" 
									value="<?php echo $item_info["ID"]; ?>" />
									<input type="hidden" name="action" value="edit" />
									<input type="submit" value="Edit" />
								</form> 
							</td>
							<td>
								<form method="POST" action="index.php" 
								onSubmit="return ConfirmDelete();">
									<input type="hidden" name="ci" 
									value="<?php echo $item_info["ID"]; ?>" />
									<input type="hidden" name="action" value="delete" />
									<input type="submit" value="Delete" />
								</form>
							</td>
						<tr>
					<?php endforeach; ?>
				</tbody>
			</table><br/>
			<a href="update.php" class="link-btn">Add New Item</a>
		</div>
	</div>
</body>
</html>