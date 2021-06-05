<?php
/*****************************************************
## Post Type: Product
*****************************************************/

add_action('init', 'selimbrothers_product');

function selimbrothers_product() {
    register_post_type(
        'products',
        array(
            'labels' => array(
                'name' => 'Products',			
                'all_items' => 'All Products',
                'singular_name' => 'Product',
                'add_new_item'=>'Add New Product'
            ),
            'public' => true,
            'menu_icon' => 'dashicons-products',
            'has_archive' => true,
            'rewrite' => array('slug' => 'product'),
            'supports' => array('title', 'thumbnail' ),
            'can_export' => true,
            'hierachical' => true,                        
        )
    );   
}

/*
## Custom Columns Add 
## Post Type: products
****************************************************/
add_filter( 'manage_products_posts_columns', 'sb_filter_posts_columns');

function sb_filter_posts_columns( $columns ) {
	$columns['Price'] = __( 'Price (CFT)' );
	$columns['sell_price'] = __( 'Selling Price (CFT)' );
	$columns['product_qnt'] = __( 'Quantity (CFT)', 'mli' ); 
	$columns['status'] = __( 'Status', 'mli' ); 

	return $columns;
}

/*
## Custom Column data dynamic
## Post Type: products
****************************************************/
add_action( 'manage_products_posts_custom_column', 'sb_courses_column', 10, 2);

function sb_courses_column( $column, $post_id ) {  	

	if ( 'Price' === $column ) {

		$Price = get_post_meta( $post_id, '_cmb_Price', true );

		echo currency_price($Price, 0); 

	}
    
	if ( 'sell_price' === $column ) {

		$sell_price = get_post_meta( $post_id, '_cmb_sell_price', true );

		echo currency_price($sell_price, 0); 

	}
	
	if('product_qnt' === $column){

		$product_qnt = get_post_meta( $post_id, '_cmb_product_qnt', true);        
        
        echo $product_qnt; 
		
	}	

	if('status' === $column){

		$product_qnt = get_post_meta( $post_id, '_cmb_product_qnt', true); 		
         
        if ($product_qnt == 0) {
            echo '<span class="badge badge-danger">Stock Out</span>';
        }elseif ($product_qnt <= 100) {
            echo '<span class="badge badge-warning">Low</span>';
        }else{
            echo '<span class="badge badge-success">In Stock</span>';
        }		
		
	}	 
}


/*****************************************************
## Post Type: client
*****************************************************/

add_action('init', 'selimbrothers_client');

function selimbrothers_client() {
    register_post_type(
        'clients',
        array(
            'labels' => array(
                'name' => 'Clients',			
                'all_items' => 'All Clients',
                'singular_name' => 'Client',
                'add_new_item'=>'Add New Client'
            ),
            'public' => true,
            'menu_icon' => 'dashicons-businessman',
            'has_archive' => true,
            'rewrite' => array('slug' => 'client'),
            'supports' => array('title', 'thumbnail' ),
            'can_export' => true,
            'hierachical' => true,                        
        )
    );   
}

/*****************************************************
## Post Type: invoice
*****************************************************/

add_action('init', 'selimbrothers_invoice');

function selimbrothers_invoice() {
    register_post_type(
        'invoice',
        array(
            'labels' => array(
                'name' => 'Invoice',			
                'all_items' => 'All Invoice',
                'singular_name' => 'Invoice',
                'add_new_item'=>'Add New Invoice'
            ),
            'public' => true,
            'menu_icon' => 'dashicons-pdf',
            'has_archive' => true,
            'rewrite' => array('slug' => 'invoice'),
            'supports' => array('title'),
            'can_export' => true,
            'hierachical' => true,                        
        )
    );   
}