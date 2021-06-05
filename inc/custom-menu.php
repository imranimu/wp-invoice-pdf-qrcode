<?php 
/**
 * Register a custom menu page.
 */
add_action( 'admin_menu', 'wpdocs_register_stocks_menu_page' );
function wpdocs_register_stocks_menu_page(){
    add_menu_page( 
        __( 'Stocks Status', 'salimbrothers' ),
        'Stocks',
        'manage_options',
        'stocks',
        'stocks_menu_page',
        'dashicons-chart-bar',
        40
    ); 
} 
/**
 * Display a custom menu page
 */
function stocks_menu_page(){    
    ?>
        <div class="wrap p-5">
            
            <div class="title mb-3">
                <h3>AVAILABLE IN STOCK</h3>
            </div>

            <table class="stock_table table table-striped table-light">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Size</th>
                        <th>Quantity(CFT)</th>
                        <th>Price(CFT)</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $args = array(
                            'post_type'=> 'products',                                
                            'posts_per_page'    => -1,
                            'order'             => 'DESC',  
                            'post_status'       => 'publish', 
                        );               
    
                        $query = new WP_Query( $args);   
                         
                        if ( $query->have_posts() ) {
                            
                            $count = 0; 
                            while ( $query->have_posts() ) : $query->the_post();  $count++; 
                            
                                $getPrice = get_post_meta( get_the_ID(), '_cmb_Price', true );
                                if ($getPrice) {
                                    $Price = $getPrice;
                                }else{
                                    $Price = 0;
                                }
                                $getProduct_qnt = get_post_meta( get_the_ID(), '_cmb_product_qnt', true); 
                                if ($getProduct_qnt) {
                                    $product_qnt = $getProduct_qnt;
                                }else{
                                    $product_qnt = 0;
                                }
                                
                                $totalPrice = $product_qnt  * $Price ;

                                $subQnt += $product_qnt; 
                                $subTotal += $totalPrice; 

                                ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo get_the_title(); ?></td>
                                        <td><?php echo number_format($product_qnt,0);?></td>
                                        <td><?php echo currency_price($Price, 0);?></td>
                                        <td><?php echo currency_price($totalPrice, 0); ?> </td>
                                        <td>  
                                            <?php 
                                                if ($product_qnt == 0) {
                                                    echo '<span class="badge badge-danger">Stock Out</span>';
                                                }elseif ($product_qnt <= 100) {
                                                    echo '<span class="badge badge-warning">Low</span>';
                                                }else{
                                                    echo '<span class="badge badge-success">In Stock</span>';
                                                }
                                            ?>  
                                        </td>
                                    </tr>
                                <?php

                            endwhile; 
                        }
                    ?>                     
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right">Total Quantity</td>
                        <td><?php echo number_format($subQnt,0);?></td>
                        <td class="text-right">Total Price</td>
                        <td><?php echo currency_price($subTotal,0); ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php
}


/*
 * Submenu for 
 */

add_action('admin_menu', 'register_my_update_listing_submenu_page');

function register_my_update_listing_submenu_page() {
    add_submenu_page( 'stocks', 'Update Stock', 'Update Stock', 'manage_options', 'update-stock', 'update_stock_data_function' );
}

function update_stock_data_function(){
    ?>
    <div class="p-5">
        <div class="title mb-3">
                <h3>BUYING STONE</h3>
            </div>
        <div class="row">
            <div class="col-md-4">
                <form action="#">
                    <div class="form-group">
                        <label for="from">From</label>
                        <input id="from" class="form-control" type="text" name="from">
                    </div>
                    <div class="form-group">
                        <label for="size">Size</label>
                        <input id="size" class="form-control" type="text" name="size">
                    </div>
                    <div class="form-group">
                        <label for="truck_load">Truck Loads</label>
                        <input id="truck_load" class="form-control" type="text" name="truck_load">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity (CFT)</label>
                        <input id="quantity" class="form-control" type="text" name="quantity">
                    </div>
                    <div class="form-group">
                        <label for="price">Price (CFT)</label>
                        <input id="price" class="form-control" type="text" name="price">
                    </div>
                    <div class="form-group">
                        <label for="total">Total Price</label>
                        <input id="total" class="form-control" type="text" name="total">
                    </div>                    
                </form>
            </div>
        </div>
    </div>
    <?php
}