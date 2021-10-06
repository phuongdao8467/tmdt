<?php
							$conn=mysqli_connect("localhost","root","root");
							if(!$conn){
								die(mysqli_error($conn));
							}
							$result=mysqli_select_db($conn,"smartfood");
							$conn->set_charset('utf8');
							$status2='1';
							$result=mysqli_query($conn,"select SUM(num) as sum from orderlist where user_id=$user_id and status2=$status2;");
							$total_cart_items=mysqli_fetch_array($result);
						?>
							<span class="header-icons-noti"><?php if($total_cart_items['sum']) echo $total_cart_items['sum']; else echo '0';?></span>
							<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
						<?php
							$conn=mysqli_connect("localhost","root","root");
							if(!$conn){
								die(mysqli_error($conn));
							}
							$food_id=mysqli_select_db($conn,"smartfood");
							$food_prop=mysqli_select_db($conn,"smartfood");
							$conn->set_charset('utf8');
							$order=mysqli_query($conn,"select * from orderlist where user_id=$user_id;");
							$total_price = 0;
							while($row=mysqli_fetch_array($order)){
								$food_item_id = $row['food_id'];
								$food_item ='';
								$status=$row['status2'];
								if($status!='1') continue;
								$food_prop=mysqli_query($conn,"select * from food where food_id=$food_item_id;");
								$food_item =mysqli_fetch_array($food_prop);
								$total_price = intval($total_price) + intval($row['num'])*intval($food_item['price']);						
							?>
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="<?php echo "images/".$food_item['image'];?>" style="height: 80px; width: 80px;"  alt="IMG">
									</div>
									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											<?php echo $food_item['name']; ?>
										</a>

										<span class="header-cart-item-info">
											<?php echo $row['num'].'x'. $food_item['price'];?>
										</span>
									</div>
								</li>
							</ul>
							
						<?php
							}
						?>
							<div class="header-cart-total">
								<?php echo $total_price; ?>
							</div>