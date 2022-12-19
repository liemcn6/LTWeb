<?php
	$title = 'Quản lý sản phẩm';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');
	$sql = "SELECT product.*, category.name as category_name from product left join category on product.category_id = category.id";
	$data = executeResult($sql);
?>
<style> 
	.nav-item:nth-child(4) {
		background-color: #c1c1c1;
	}
	.thumnail {
		max-width: 80px;
		max-height: 80px;
		object-fit: cover;
	}
	.description h1,
	.description h2,
	.description h3,
	.description h4,
	.description h5,
	.description h6,
	.description li,
	.description span,
	.description p,
	.description b
	{
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
		max-width: 100px;
	}
	.description ul {
		padding: 0 !important;
	}
</style>
<div class="row">
	<div class="col-md-12 table-responsive" style="margin-top: 30px;">
		<h3>Quản lý sản phẩm</h3>
		<a href="editor.php"><button type="submit" class="btn btn-success" style="margin-top: 10px;">Thêm sản phẩm</button></a>
		<table class="table table-bordered table-hover" style="margin-top: 15px;">
			<!-- <thead> -->
				<tr>
					<th>STT</th>
					<th>Tên sp</th>
					<th>Tên loại sản phẩm</th>
					<th>Giá cũ</th>
					<th>Giá mới</th>
					<th>Ảnh chỉnh</th>
					<th>Mô tả</th>
					<th style="width: 50px;">Tùy chỉnh</th>
					<th style="width: 50px;">Tùy chỉnh</th>
				</tr>
				<!-- <td><img class="thumnail" src="'.'../../'.$item['thumnail'].'" alt=""></td> -->
				<!-- ../../assets/photos/244746673_668612887369866_6774119670192200319_n.jpg -->
				<?php
				$index = 0;
				foreach($data as $item) {
					echo '
						<tr>
						<th>'.(++$index).'</th>
						<td>'.$item['title'].'</td>
						<td>'.$item['product_type'].'</td>
						<td>'.number_format($item['price']).' <sup>đ</sup></td>
						<td>'.number_format($item['discount']).' <sup>đ</sup></td>
						<td><img class="thumnail" src="'.fixUrl($item['thumnail']).'" alt=""></td>
						<td class="description">'.$item['description'].'</td>
						<th style="width: 40px; height:40px;" >
							<a href="editor.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
						</th>
						<th style="width: 50px;" >
							<button onclick = deleteProduct('.$item['id'].') class="btn btn-danger">Xóa</button>
						</th>
						</tr>
					';
				}
				?>
		</table>
	</div>
</div>

<?php
	require_once($baseUrl.'layouts/footer.php');
?>
<script>
	// Dùng ajax
	function deleteProduct(id) {
		option = confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')
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