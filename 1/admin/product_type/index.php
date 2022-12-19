<?php
	$title = 'Loại danh mục';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');
	require_once('form_save.php');
    $id = $name = '';
	if(isset($_GET['id'])) {
		$id = getGet('id');
		$sql = "SELECT * FROM product_type WHERE id = $id";
		$data = executeResult($sql,true);
		if($data != null) {
			$name = $data['name'];
		}
	}
	$sql = "SELECT * from product_type";
	$data = executeResult($sql);
?>
<style> 
	.nav-item:nth-child(3) {
		background-color: #c1c1c1;
	}
</style>
<div class="row">
	<div class="col-md-12" style="margin-top: 30px;">
		<h3>Quản lý loại sản phẩm</h3>
	</div>
	
	<div class="col-md-7 " style="margin-top: 15px;">
		<table class="table table-bordered table-hover" >
				<tr>
					<th>STT</th>
					<th>Tên danh mục</th>
					<th>Tên loại sản phẩm</th>
					<th style="width: 50px;">Tùy chỉnh</th>
					<th style="width: 50px;">Tùy chỉnh</th>
				</tr>
				<?php
				$index = 0;
				foreach($data as $item) {
                    $category_id = $item['category_id'];
                    $sql = "SELECT name FROM category WHERE id = '$category_id'";
                    $category_name =  executeResult($sql,true);
					echo '
						<tr>
							<th>'.(++$index).'</th>
							<th>'.$category_name['name'].'</th>
							<td>'.$item['name'].'</td>
							<th style="width: 50px;" >
								<a href="?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
							</th>
							<th style="width: 50px;" >
								<button class="btn btn-danger" onclick = deleteCategory('.$item['id'].')>Xóa</button>
							</th>
						</tr>
					';
				}
				?>
		</table>
	</div>
	<div class="col-md-5" >
		<form method="post" action="" >
            <div class="form-group">
				<label for="" style="font-weight: bold;">Tên danh mục:</label>
				<select name="category_id" id="category_id" class="form-control" required="true">
                    <option value="">-- Chọn --</option>
                    <?php 
                        $sql = "select * from category";
                        $categoryItems = executeResult($sql);
                        foreach($categoryItems as $item) {
                            if($id >0 && $item['id'] == $category_id) {
                                echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
                            } else {
                                echo '<option  value="'.$item['id'].'">'.$item['name'].'</option>';
                            }
                        }
                    ?>
                </select>
			</div>
			<div class="form-group">
				<label for="" style="font-weight: bold;">Tên loại sản phẩm:</label>
				<input type="text" required="true" class="form-control" name="name" value="<?=$name?>" placeholder="Nhập tên danh mục">
				<input type="text" class="form-control" name="id" value="<?=$id?>" hidden="true" >
			</div>
			<button type="submit" class="btn btn-success">Lưu</button>
		</form>
	</div>
</div>
<?php
	require_once($baseUrl.'layouts/footer.php');
?>
<script>
	// Dùng ajax
	function deleteCategory(id) {
		option = confirm('Bạn có chắc chắn muốn xóa danh mục này không?')
		if(!option) return;
		$.post('form_api.php', {
			'id': id,
			'action': 'delete'
		}, function(data) {
			if(data != null && data != '') {
				alert(data);
			}
			location.reload()
		})
	}
</script>