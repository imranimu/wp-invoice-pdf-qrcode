<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SalimBrothers
 */

get_header(); 

 	?>
 	<div class="InvoiceWrap mb-5">
 		<div class="container">

		 <?php
			while ( have_posts() ) :

				the_post();
				
				$post_id = get_the_ID();		

				$metaData = get_post_meta($post_id);

				/*echo "<pre>";
				print_r($metaData);
				echo "</pre>";*/

				$client_id 		= get_post_meta($post_id, '_cmb_client_name', true );
				$address		= get_post_meta($post_id, 'company_address', true );
				$email			= get_post_meta($post_id, 'company_email', true );
				$phone			= get_post_meta($post_id, 'company_phone', true );
				
				$order_date 	= get_post_meta($post_id, 'order_date', true );
				$product_size 	= get_post_meta($post_id, 'product_size', true );
				$truck_number 	= get_post_meta($post_id, 'truck_number', true );
				$get_qty		= get_post_meta($post_id, 'quantity', true );
				$get_price		= get_post_meta($post_id, 'price', true );
				$get_total	 	= get_post_meta($post_id, 'total_price', true );

				$tax	 		= get_post_meta($post_id, 'tax', true );
				$tax_amount	 	= get_post_meta($post_id, 'tax_amount', true );
				$pre_due	 	= get_post_meta($post_id, 'pre_due', true );
				$deposite	 	= get_post_meta($post_id, 'deposite', true );

				$grand_total	= get_post_meta($post_id, 'grand_total', true );
				$less_amount	= get_post_meta($post_id, 'less_amount', true );

				$paid_amount	= get_post_meta($post_id, 'paid_amount', true );	
				$total_due		= get_post_meta($post_id, 'total_due', true );	

				$quantity 		= ($get_qty) ? $get_qty : 0;	
				$price 			= ($get_price) ? $get_price : 0;	
				$unit_total 	= ($get_total) ? $get_total : 0;
				$total_due		= ($total_due) ? $total_due : 0;				 

				$type_nb 		= get_post_meta($post_id, 'type_nb', true );

				$headerImage 	= get_template_directory_uri().'/inc/invoice/tutorial/header.png';
				$padImage 		= get_template_directory_uri().'/inc/invoice/tutorial/pad_03.jpg';
    			$footerImage 	= get_template_directory_uri().'/inc/invoice/tutorial/footer.png';
				?>

				<div class="pdf_header" style="width: 110%; margin-left: -5%;">
					<img src="<?php echo $headerImage;?>" alt="">
				</div>

				<div class="row mb-4" style="margin-top: -50px;">
					<div class="col-md-6">
						<p style="font-size: 17px;">INVOICE TO: <br>
						<strong><?php echo get_the_title($client_id);?></strong><br>
						<?php echo $email; ?><br>
						<?php echo $phone; ?><br>
						<?php echo $address;?></p>
					</div>

					<div class="col-md-6 text-right">
						<h3 class="m-0">Invoice #<?php echo $post_id; ?></h3>
						<p class="text-right">Date: <?php echo $order_date; ?><br>
						www.salimbrothersbd.com</p>	
					</div>
				</div>

				<table class="table table-striped mb-4" style="background-image:url(<?php echo $padImage;?>);">
				  	<thead>
					   <tr>					    	 
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
							$subtotal += $unit_total;
							$total_qty += $quantity;						
							?>					    	 
							<td>1</td>
							<td>
								<?php echo $order_date;?>
							</td>
							<td>
								<?php echo $product_size;?>
							</td>
							<td class="text-center">
								<?php echo $truck_number;?>
							</td>
							<td class="text-center">
								<?php echo $quantity;?>								 
							</td>
							<td class="text-center">
								<?php echo currency_price($price, 0); ?>
							</td>
							<td class="text-right">
								<?php echo currency_price($unit_total, 0); ?>
							</td>
					   </tr>
					 
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
									<td><?php echo $counter + 1;?></td>
									<td>
										<?php echo ${'order_date'.$counter};?>
									</td>
									<td>
										<?php echo ${'product_size'.$counter};?>
									</td>
									<td class="text-center">
										<?php echo ${'truck_number'.$counter}; ?>
									</td>
									<td class="text-center">
										<?php echo ${'quantity'.$counter}; ?>
									</td>
									<td class="text-center">
										<?php echo currency_price(${'price'.$counter}, 0); ?>
									</td>
									<td class="text-right">
										<?php echo currency_price(${'unit_total'.$counter}, 0); ?>
									</td>		
							    </tr>
				    			<?php
				    		}
				    	?>			    	
				   </tbody>			    
				  	
				  	<tfoot class="invoice_footer">
				  		<tr>
				  			<td colspan="3"></td>
				  			<td class="text-right">Total Quantity :</td>
				  			<td class="text-center"><?php echo $total_qty; ?></td>
				  			<td class="text-right">Subtotal :</td>
				  			<td class="text-right subtotal_price" id="sub_total"><?php echo currency_price($subtotal, 0); ?></td>
				  		</tr>
				  		<tr class="tax_amount">
				  			<td colspan="4"></td>
				  			<td class="text-right" colspan="2">Tax (<?php echo $tax;?>%) :</td>
				  			<td class="text-right">
				  				<?php echo currency_price($tax_amount, 0);?>
				  			</td>
				  		</tr>
				  		<tr class="due_amount">
				  			<td colspan="4"><input type="hidden" id="oldDue" value="<?php echo $pre_due; ?>"></td>
				  			<td class="text-right" colspan="2">Prev. Due :</td>
				  			<td class="text-right"><?php echo currency_price($pre_due, 0); ?></td>
				  		</tr>
				  		<tr class="deposite_amount">
				  			<td colspan="4"><input type="hidden" id="depositeAmount" value="<?php echo $deposite;?>"></td>
				  			<td class="text-right" colspan="2">Deposite :</td>
				  			<td class="text-right"><?php echo currency_price($deposite, 0); ?></td>
				  		</tr>
				  		<tr>
				  			<td colspan="4"></td>
				  			<td class="text-right" colspan="2">Grand Total :</td>		  			 
				  			<td class="text-right" id="grand_total">
				  				<?php 
				  					echo currency_price($grand_total, 0); 
				  				?>				  				
				  			</td>
				  		</tr> 

				  		<tr class="deposite_amount">
				  			<td colspan="4"></td>
				  			<td class="text-right" colspan="2">Paid Amount :</td>
				  			<td class="text-right">
				  				<?php echo currency_price($paid_amount, 0); ?>
				  			</td>
				  		</tr>

				  		<tr>
				  			<td colspan="4"></td>
				  			<td class="text-right" colspan="2">Less :</td>
				  			<td class="text-right">
				  				<?php echo currency_price($less_amount, 0); ?>
				  			</td>
				  		</tr>
				  		 
				  		<tr class="due_amount">
				  			<td colspan="4"></td>
				  			<td class="text-right" colspan="2">Total Due :</td>
				  			 
				  			<td class="text-right" id="total_amount"><?php echo currency_price($total_due, 0); ?></td>
				  		</tr>
				  		 
				  	</tfoot>
				</table>

				<form method="post" class="pt-4">

					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
			        
			        <a class="button mr-3" href="<?php echo get_edit_post_link($post_id);?>">
                    	<span class="button-text">Edit Invoice</span>
                        <span class="button-icon fa fa-pencil-square-o"></span>
                    </a>

			        <button type="submit" class="button" name="generate_invoice_pdf">
                        <span class="button-text">Download</span>
                        <span class="button-icon fa fa-file-pdf-o"></span>
                    </button>

			    </form>

				<?php				 

			endwhile; // End of the loop. 
		?>

		</div>
	</div>
	<?php

get_footer();
