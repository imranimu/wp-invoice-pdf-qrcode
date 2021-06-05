<?php

/*
## Get Client Information
## Call Ajax Funtion
## #phone, #company_email, #company_address
************************************************/
add_action( 'wp_ajax_get_client_information', 'get_client_information' );
add_action( 'wp_ajax_nopriv_get_client_information', 'get_client_information' );

function get_client_information() {
    $client_id = $_REQUEST['client_id'];    

    $output['phone'] = get_post_meta( $client_id, 'company_phone', true );

    $output['company_email'] = get_post_meta( $client_id, 'company_email', true );

    $output['company_address'] = get_post_meta( $client_id, 'company_address', true );

    echo json_encode($output);     

die();
}


/*
## Ajax Function
## Function: invoice_item_ajax
## Meta fileds append
*********************************************/
add_action( 'wp_ajax_nopriv_invoice_item_ajax', 'invoice_item_ajax' );
add_action( 'wp_ajax_invoice_item_ajax', 'invoice_item_ajax' );

if( !function_exists('invoice_item_ajax') ): 

function invoice_item_ajax() { 

    $type_nb = $_REQUEST['type_nb'];  

    $form_counter = $type_nb + 1;

    $item_counter = $form_counter + 1;

    $output .= '<tr id="field_'.$form_counter.'">
                    <td>
                        <a href="#" class="removeField" field-id="'.$form_counter.'"><i class="fa fa-minus-circle"></i></a>
                    </td>
                    <td>'.$item_counter.'</td>
                    <td>
                        <input type="text" id="order_date'.$form_counter.'" name="order_date'.$form_counter.'" class="form-control datepicker" placeholder="mm/dd/yyyy" value="">
                    </td>
                    <td>
                        <input type="text" id="product_size'.$form_counter.'" name="product_size'.$form_counter.'" placeholder="Size" class="form-control" value="">
                    </td>
                    <td>
                        <input type="text" name="truck_number'.$form_counter.'" class="form-control text-center" placeholder="Number of Truck" value="" onkeypress="validate(event)">
                    </td>
                    <td>
                        <input type="text" id="quantity'.$form_counter.'" name="quantity'.$form_counter.'" class="form-control qty_cft text-center" value="" placeholder="Qty(CFT)" onkeypress="validate(event)">
                    </td>
                    <td>
                        <input type="text" id="price'.$form_counter.'" name="price'.$form_counter.'" placeholder="Price(CFT)" class="form-control price_cft text-center" value="" onkeypress="validate(event)">
                    </td>
                    <td>
                        <input type="text" id="total_price'.$form_counter.'" name="total_price'.$form_counter.'" placeholder="" class="form-control unit_total text-right" value="">
                    </td>
                </tr>'; 

    $return_string = array('msg' => $output, 'count_form' => $form_counter);

    $data['result'] = $return_string;
    
    echo json_encode($data);

    die();

}

endif; 