<?php



/****************************
## Invoice Options Meta
*****************************/
add_action( 'cmb2_admin_init', 'sb_register_invoice_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function sb_register_invoice_metabox() {
	
	$prefix = '_cmb_';

	$doday = time();

	$clients = array();

	$args = array(
	    'post_status' => 'publish',
	    'post_type'   => 'clients'
	);
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$clients[get_the_ID()] .= get_the_title();

		}
	}

	// echo "<pre>";
	// print_r($clients);
	// echo "</pre>";

	$invoiceMeta = new_cmb2_box( array(
		'id'            => 'sb_invoice_metabox',
		'title'         => esc_html__( 'Basic Information', 'cmb2' ),
		'object_types'  => array( 'invoice' ), // Post type		 
	));

	$invoiceMeta->add_field(
		array(
			'name'         => __( 'Invoice Date', 'salimbrothers' ),
			//'desc'         => __( 'Input Invoice Date ', 'salimbrothers' ),
			'id'           => $prefix . 'invoice_date',
			'type'         => 'text_date_timestamp',
	        'date_format'  => 'F j, Y',
			'default' 	   => $doday,
		)
	);

	$invoiceMeta->add_field(
		array(
			'name'         => __( 'Invoice Due Date', 'salimbrothers' ),
			//'desc'         => __( 'Input Invoice Due Date ', 'salimbrothers' ),
			'id'           => $prefix . 'invoice_due_date',
			'type'         => 'text_date_timestamp',
	        'date_format'  => 'F j, Y', 
		)
	);	 
	 	 
} 

/****************************
## Invoice Options Meta
*****************************/
add_action( 'cmb2_admin_init', 'sb_register_invoice_company_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function sb_register_invoice_company_metabox() {

	$prefix = '_cmb_';	 

	$clients = array();

	$args = array(
	    'post_status' => 'publish',
	    'post_type'   => 'clients'
	);
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$clients[get_the_ID()] .= get_the_title();

		}
	}	 

	$invoiceMeta = new_cmb2_box( array(
		'id'            => 'sb_invoice_company_metabox',
		'title'         => esc_html__( 'Client Information', 'cmb2' ),
		'object_types'  => array( 'invoice' ), // Post type		 
	));

	$invoiceMeta->add_field( 
		array(
			'name'         => __( 'Select Client Name ', 'salimbrothers' ),
			//'desc'         => __( 'Please select a client for make invoice', 'salimbrothers' ),
			'id'           => $prefix . 'client_name',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'custom',
			'options'          => $clients,
		)
	);	

	$invoiceMeta->add_field( array(
		'name' => esc_html__( 'Phone', 'sb' ),		
		'id'   => 'company_phone',
		'type' => 'text_medium',		 		
	));
	$invoiceMeta->add_field( array(
		'name' => esc_html__( 'Email', 'sb' ),		
		'id'   => 'company_email',
		'type' => 'text_medium',		 		
	));
	$invoiceMeta->add_field( array(
		'name' => esc_html__( 'Address', 'sb' ),		
		'id'   => 'company_address',
		'type' => 'text_medium',		 		
	));
}

/****************************
## Product Options Meta
*****************************/
add_action( 'cmb2_admin_init', 'sb_register_product_metabox' );
 
function sb_register_product_metabox() {
	$prefix = '_cmb_';
	 
	$productMeta = new_cmb2_box( array(
		'id'            => 'sb_product_metabox',
		'title'         => esc_html__( 'Basic Information', 'sb' ),
		'object_types'  => array( 'products' ), // Post type		 
	));	 
	$productMeta->add_field( 
		array(
			'name'         => __( 'Price(CFT)', 'salimbrothers' ),
			'desc'         => __( 'Input Price per CFT', 'salimbrothers' ),
			'id'           => $prefix . 'Price',
			'type'         => 'text_medium'	
		)
	);
	$productMeta->add_field( 
		array(
			'name'         => __( 'Selling Price(CFT)', 'salimbrothers' ),
			'desc'         => __( 'Input Selling Price per CFT', 'salimbrothers' ),
			'id'           => $prefix . 'sell_price',
			'type'         => 'text_medium'	
		),
	);
	$productMeta->add_field(
		array(
			'name'         => __( 'Product Quantity (CFT)', 'salimbrothers' ),
			'desc'         => __( 'Input Product Quantity (CFT)', 'salimbrothers' ),
			'id'           => $prefix . 'product_qnt',
			'type'         => 'text_medium'	
		)
	);
	$productMeta->add_field(
		array(
			'name'         => __( 'Per Truck Load (CFT)', 'salimbrothers' ),
			'desc'         => __( 'Input Per Truck Load (CFT)', 'salimbrothers' ),
			'id'           => $prefix . 'truck_load_capacity',
			'type'         => 'text_medium'	
		)
	);
}

/****************************
## Clients Options Meta
*****************************/
add_action( 'cmb2_admin_init', 'sb_register_clients_metabox' );
 
function sb_register_clients_metabox() {
	 
	$clientsMeta = new_cmb2_box( array(
		'id'            => 'sb_clients_metabox',
		'title'         => esc_html__( 'Basic Information', 'sb' ),
		'object_types'  => array( 'clients' ), // Post type		 
	));
	 
	$clientsMeta->add_field( array(
		'name' => esc_html__( 'Company Name', 'sb' ),
		'desc' => esc_html__( 'Input The Company Name', 'sb' ),
		'id'   => 'company_name',
		'type' => 'text_medium',		 		
	));
	$clientsMeta->add_field( array(
		'name' => esc_html__( 'Phone', 'sb' ),
		'desc' => esc_html__( 'Input Company Phone Number', 'sb' ),
		'id'   => 'company_phone',
		'type' => 'text_medium',		 		
	));
	$clientsMeta->add_field( array(
		'name' => esc_html__( 'Email', 'sb' ),
		'desc' => esc_html__( 'Input Company Email Address', 'sb' ),
		'id'   => 'company_email',
		'type' => 'text_medium',		 		
	));
	$clientsMeta->add_field( array(
		'name' => esc_html__( 'Address', 'sb' ),
		'desc' => esc_html__( 'Input Company Address', 'sb' ),
		'id'   => 'company_address',
		'type' => 'text_medium',		 		
	));
}

/*
## Meta Init Funtions
**************************/
if ( file_exists( dirname( __FILE__ ) . '/meta/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/meta/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/meta/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/meta/init.php';
} 