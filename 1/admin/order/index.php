<?php
	$title = 'Quản lý đơn hàng';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');
	$sql = "SELECT * FROM orders";
	$listOrder = executeResult($sql);
?>
<style> 
	.nav-item:nth-child(5) {
		background-color: #c1c1c1;
	}
</style>
<div class="row">
	<div class="col-md-12 table-responsive" style="margin-top: 30px;">
		<h3>Quản lý đơn hàng</h3>
		<table class="table table-bordered table-hover" style="margin-top: 15px;">
				<tr>
					<th>STT</th>
					<th>Họ & tên</th>
					<th>STĐ</th>
					<th>Địa chỉ</th>
					<th>Nội dung</th>
					<th>Ngày đặt</th>
					<th>Tổng tiền</th>
					<th>Trạng thái</th>
				</tr>
				<?php
					
					$index = 0;
					foreach($listOrder as $order) {
						$user_name = $order['user_name'];
						// Lấy sản phẩm đã đặt hang
						echo '
							<tr>
								<th>'.($index++).'</th>
								<td>'.$user_name.'</td>
								<td>'.$order['phone_number'].'</td>
								<td>'.$order['xa_phuong'].','.$order['quan_huyen'].','.$order['tinh_tp'].'</td>
								<td >
									<a href="" class="tag-a">
									<button class="btn btn btn-warning">Xem</button>
									</a>
								</td>
								<td>'.$order['created_at'].'</td>
								<td>'.number_format($order['total_money']).' <sup>đ</sup></td>
								<td >
									<button class="btn btn btn-danger">Đang xử lí</button>
								</td>
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
</script>