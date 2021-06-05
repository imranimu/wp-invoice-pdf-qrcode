<?php

/*
## Post Type : invoice
## Add Custom Meta Box
*************************************/
function select_type_metaboxes( ) {
   
   global $wp_meta_boxes;

   add_meta_box('postfunctiondiv', __('Invoice Details'), 'select_invoice_type', 'invoice', 'normal', 'high');

}
add_action( 'add_meta_boxes_invoice', 'select_type_metaboxes' );

/*
## Function : select_invoice_type
## Custom Metaboxes Fields
## Post type: invoice
***********************************************/
function select_invoice_type(){ 
	?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php

	global $post;

	$post_id 			= $post->ID;

	$order_date 	= get_post_meta($post_id, 'order_date', true );
	$product_size 	= get_post_meta($post_id, 'product_size', true );
	$truck_number 	= get_post_meta($post_id, 'truck_number', true );
	$get_qty		= get_post_meta($post_id, 'quantity', true );
	$get_price			= get_post_meta($post_id, 'price', true );
	$get_total	 	= get_post_meta($post_id, 'total_price', true );

	$paid_amount	 	= get_post_meta($post_id, 'paid_amount', true );	

	$quantity 		= ($get_qty) ? $get_qty : 0;	
	$price 			= ($get_price) ? $get_price : 0;	
	$unit_total 	= ($get_total) ? $get_total : 0;

	$type_nb 		= get_post_meta($post_id, 'type_nb', true );	

	// $qrCodeText = '#'.$post_id.' - tk.350000/-';

	// $qr_image = qr_code($qrCodeText);

	?>

	<div class="wrap">		 

		<table class="table table-striped invoiceTable">
		  	<thead>
			   <tr>
			    	<th></th>
					<th>#</th>
					<th>Date</th>
					<th>Size</th>
					<th>Truck Loads</th>
					<th class="text-center">Qty(CFT)</th>
					<th class="text-center">Price(CFT)</th>
					<th class="text-center">Total (Tk.)</th>
			   </tr>
			</thead>
			<tbody>
			   <tr>
			   	<?php 				   	
			   		$pre_due = 150000;
			   		$deposite = 100000;

						$subtotal += $unit_total;

						$total_qty += $quantity;						
					?>
			    	<td>
			    		<div class="add_more">
							<input type="hidden" value="<?php if($type_nb){ echo $type_nb;}else{echo 0;} ?>">
							<a class="addmore_type" href="#"><i class="fa fa-plus-circle"></i></a>	
						</div>			    		 
			    	</td>
					<td>1</td>
					<td>
						<input type="text" name="order_date" class="form-control datepicker" placeholder="mm/dd/yyy" value="<?php echo $order_date;?>">
					</td>
					<td>
						<input type="text" name="product_size" class="form-control" placeholder="Size" value="<?php echo $product_size;?>">
					</td>
					<td>
						<input type="text" name="truck_number" class="form-control text-center" placeholder="Number of Truck" value="<?php echo $truck_number;?>" onkeypress='validate(event)'>
					</td>
					<td>

						<input type="text" name="quantity" class="form-control text-center qty_cft" placeholder="Qty(CFT)" value="<?php echo $quantity;?>" onkeypress='validate(event)'>
					</td>
					<td>
						<input type="text" name="price" class="form-control price_cft text-center" placeholder="Price(CFT)" value="<?php echo $price; ?>" onkeypress='validate(event)'>
					</td>
					<td>
						<input type="text" name="total_price" class="form-control unit_total text-right "  value="<?php echo $unit_total; ?>">
					</td>
			   </tr>
			</tbody>

		   <tbody class="more_add">
		    	<?php 
		    		for ($counter = 1; $counter <= $type_nb; $counter++) {

		    			${'order_date'.$counter} = get_post_meta($post_id, 'order_date'.$counter.'', true ); 
						${'product_size'.$counter} = get_post_meta($post_id, 'product_size'.$counter.'', true ); 
						${'truck_number'.$counter} = get_post_meta($post_id, 'truck_number'.$counter.'', true ); 
						${'get_qty'.$counter} = get_post_meta($post_id, 'quantity'.$counter.'', true );
						${'get_price'.$counter} = get_post_meta($post_id, 'price'.$counter.'', true );
						${'get_total'.$counter} = get_post_meta($post_id, 'total_price'.$counter.'', true );

						${'quantity'.$counter} = (${'get_qty'.$counter}) ? ${'get_qty'.$counter} : 0;	
						${'price'.$counter}  = (${'get_price'.$counter}) ? ${'get_price'.$counter} : 0;	
						${'unit_total'.$counter} = (${'get_total'.$counter}) ? ${'get_total'.$counter} : 0;

		    			$subtotal += ${'unit_total'.$counter};

		    			$total_qty += ${'quantity'.$counter};

		    			?>
		    			<tr id="field_<?php echo $counter;?>">
					    	<td>
					    		<a href="#" class="removeField" field-id="<?php echo $counter;?>"><i class="fa fa-minus-circle"></i></a>
					    	</td>
							<td><?php echo $counter + 1;?></td>
							<td>
								<input type="text" name="order_date<?php echo $counter;?>" class="form-control datepicker" placeholder="mm/dd/yyy" value="<?php echo ${'order_date'.$counter};?>">
							</td>
							<td>
								<input type="text" name="product_size<?php echo $counter;?>" class="form-control" placeholder="Size" value="<?php echo ${'product_size'.$counter};?>">
							</td>
							<td>
								<input type="text" name="truck_number<?php echo $counter;?>" class="form-control text-center" placeholder="Number of Truck" value="<?php echo ${'truck_number'.$counter}; ?>" onkeypress='validate(event)'>
							</td>
							<td>
								<input type="text" name="quantity<?php echo $counter;?>" class="form-control qty_cft text-center" placeholder="Qty(CFT)" value="<?php echo ${'quantity'.$counter}; ?>" onkeypress='validate(event)'>
							</td>
							<td>
								<input type="text" name="price<?php echo $counter;?>" class="form-control text-center price_cft" placeholder="Price(CFT)" value="<?php echo ${'price'.$counter};?>" onkeypress='validate(event)'>
							</td>
							<td>
								<input type="text" name="total_price<?php echo $counter;?>" class="form-control text-right unit_total"  value="<?php echo ${'unit_total'.$counter}; ?>">
							</td>		
					    </tr>
		    			<?php
		    		}
		    	?>			    	
		   </tbody>			    
		  	
		  	<tfoot class="invoice_footer">
		  		<tr>
		  			<td colspan="4">
		  				<div class="add_more">
							<input type="hidden" name="type_nb" id="type_nb" value="<?php if($type_nb){ echo $type_nb;}else{echo 0;} ?>">
							<a class="addmore_type button button-primary button-large" href="#"><i class="fa fa-plus-circle"></i></a>	
						</div>
		  			</td>
		  			<td class="text-right">Total Quantity :</td>
		  			<td class="text-center"><?php echo $total_qty; ?></td>
		  			<td class="text-right">Subtotal :</td>
		  			<td class="text-right subtotal_price" id="sub_total">Tk. <?php echo  $subtotal;?></td>
		  		</tr>
		  		<tr class="due_amount">
		  			<td colspan="5"><input type="hidden" id="oldDue" value="<?php echo $pre_due; ?>"></td>
		  			<td class="text-right" colspan="2">Prev. Due :</td>
		  			<td class="text-right">Tk. <?php echo $pre_due;?></td>
		  		</tr>
		  		<tr class="deposite_amount">
		  			<td colspan="5"></td>
		  			<td class="text-right" colspan="2">Paid Amount :</td>
		  			<td class="text-right">
		  				<span>Tk. </span><input id="paid_amount" type="text" class="form-control text-right" placeholder="0" name="paid_amount" value="<?php echo $paid_amount; ?>">
		  			</td>
		  		</tr>
		  		<tr class="deposite_amount">
		  			<td colspan="5"><input type="hidden" id="depositeAmount" value="<?php echo $deposite;?>"></td>
		  			<td class="text-right" colspan="2">Deposite (20 Jan 2021) :</td>
		  			<td class="text-right">Tk. <?php echo $deposite;?></td>
		  		</tr>
		  		<tr class="due_amount">
		  			<td colspan="5"></td>
		  			<td class="text-right" colspan="2">Total Due :</td>
		  			<?php 
		  				$total_due = ($subtotal + $pre_due) - $deposite;
		  			?>
		  			<td class="text-right" id="total_amount">Tk. <?php echo $total_due; ?></td>
		  		</tr>
		  	</tfoot>
		</table>		

		<?php if ($post_id): ?>			
		
		<hr>

		<div class="pt-5">

			<!-- <a class="btn btn-primary" style="color: #fff" href="edit.php?post_type=invoice&page=as-fdpf-tutorial&post_id=81" target="_blank">Download Invoice</a> -->

			<a class="btn btn-primary" style="color: #fff" href="<?php echo get_the_permalink($post_id);?>" target="_blank">Download Invoice</a>

		</div>
		<?php endif ?>
	</div>

	<?php
}


/*
## Save Custom metabox data
## Post Type : invoice
## Save dynamic field data
*********************************/
function invoice_meta_save_post(){

   if(empty($_POST)) return;

   global $post;

 	update_post_meta($post->ID, "order_date", $_POST["order_date"]);
 	update_post_meta($post->ID, "product_size", $_POST["product_size"]);
 	update_post_meta($post->ID, "truck_number", $_POST["truck_number"]);
 	update_post_meta($post->ID, "quantity", $_POST["quantity"]);
 	update_post_meta($post->ID, "price", $_POST["price"]);
 	update_post_meta($post->ID, "total_price", $_POST["total_price"]);
 	update_post_meta($post->ID, "paid_amount", $_POST["paid_amount"]); 

	update_post_meta($post->ID, "type_nb", $_POST["type_nb"]);

 	for ($count = 1; $count <= $_POST["type_nb"]; $count++) {
		
		${'order_date'.$count} = $_POST['order_date'.$count.''];
		${'product_size'.$count} = $_POST['product_size'.$count.''];
		${'truck_number'.$count} = $_POST['truck_number'.$count.''];
		${'quantity'.$count} = $_POST['quantity'.$count.''];
		${'price'.$count} = $_POST['price'.$count.'']; 
		${'total_price'.$count} = $_POST['total_price'.$count.'']; 
		
		update_post_meta($post->ID, 'order_date'.$count.'', ${'order_date'.$count});
		update_post_meta($post->ID, 'product_size'.$count.'', ${'product_size'.$count});
		update_post_meta($post->ID, 'truck_number'.$count.'', ${'truck_number'.$count});
		update_post_meta($post->ID, 'quantity'.$count.'', ${'quantity'.$count});
		update_post_meta($post->ID, 'price'.$count.'', ${'price'.$count});
		update_post_meta($post->ID, 'total_price'.$count.'', ${'total_price'.$count});
		
	}

}   

add_action( 'save_post_invoice', 'invoice_meta_save_post' );