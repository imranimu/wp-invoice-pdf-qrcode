jQuery(document).ready(function(jQuery) {

    jQuery("#quantity , #price").change(function(){
        
        var quantity = jQuery("#quantity").val(); 

        var price = jQuery("#price").val(); 

        if(quantity && price){
            jQuery("#total").val( quantity * price); 
        }
    });

    /*
    ## Add Client Information into Invoice
    ## Ajax Function: get_client_information();
    ## Funtion Source: custom-fuction.php
    ## Json Type Data Response
    **********************************************/
    jQuery("#_cmb_client_name").change(function(){

        var client_id = jQuery(this).val();

        jQuery.ajax({
            
                url: ajaxurl,
                data: {
                      'action': 'get_client_information',
                      'dataType' : 'json',
                      'client_id' : client_id,                      
                },

                success:function(msg) {

                    console.log(msg);  

                    var objJSON =  jQuery.parseJSON(msg);    

                    if (objJSON.phone) {
                        jQuery("#company_phone").val(objJSON.phone); 
                    } 

                    if (objJSON.company_email) {
                        jQuery("#company_email").val(objJSON.company_email); 
                    }

                    if (objJSON.company_address) {
                        jQuery("#company_address").val(objJSON.company_address); 
                    }
                },

                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });

    });   

    /*
    ## jQurey UI Datepicker
    ****************************/
    jQuery("body").on("click", ".datepicker", function(){
        jQuery(this).datepicker({
            beforeShow: function( input, inst){
              jQuery(inst.dpDiv).addClass('cmb2-element');
            },
        });
        jQuery(this).datepicker("show");
    });

    /*
    ## 
    */
    jQuery('.addmore_type').click(function(){

        var type_nb = jQuery("#type_nb").val();        

        jQuery.ajax({
            type: 'POST',                
            url: ajaxurl,
            data: {
                'action'    : 'invoice_item_ajax',
                'type_nb'   : type_nb,               
            },

            success: function(msg) { 

                var res = jQuery.parseJSON(msg);

                //console.log(res);

                var form_content = res.result.msg;  

                var form_count = res.result.count_form;

                jQuery('#type_nb').val(form_count);

                jQuery('.more_add').append(form_content);

                //jQuery(".less_certificates_type").css("display", "inline-block");     

            },
            error: function(errorThrown) {
                console.log(errorThrown);                     
            }

        }); 
        return false;
        
    });

    /*
    ## Less More Contact Info
    *******************************/        
    jQuery(document).on('click', '.removeField', function(e){
        
        var field_id = jQuery(this).attr('field-id'); 

        var type_nb = jQuery("#type_nb").val();         

        jQuery('#field_'+field_id).remove();   

        jQuery("#type_nb").val(type_nb - 1);

        return false; 
    });

    jQuery('.invoiceTable tbody').on('keyup change',function(){
        calc();
    });

    jQuery('#paid_amount').on('keyup change',function(){
        calc();
    });

    calc();
    
}); 


function calc(){
    jQuery('.invoiceTable tbody tr').each(function(i, element) {
        var html = jQuery(this).html();
        if(html!='')
        {
            var qty = jQuery(this).find('.qty_cft').val();
            var price = jQuery(this).find('.price_cft').val();

            jQuery(this).find('.unit_total').val(qty*price);
            
            calc_total();
        }
    });
}

function calc_total(){

    total = 0;

    jQuery('.unit_total').each(function() {
        total += parseInt(jQuery(this).val());        
    });

    jQuery('#sub_total').html('Tk. '+ total.toFixed(0));

    var paid_amount = jQuery("#paid_amount").val();

    total_sum= total - jQuery("#depositeAmount").val();           
    
    var preDue = parseInt(jQuery("#oldDue").val());    

    totaldue = Number( total_sum ) +  Number( preDue );   

    var grandTotal = (totaldue - paid_amount ).toFixed(0);  

    // tax_sum=total/100*jQuery('#tax').val();
    // jQuery('#tax_amount').val(tax_sum.toFixed(2));

    jQuery('#total_amount').html( 'Tk. '+ grandTotal);
}


function validate(evt) {

    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }

    var regex = /[0-9]|\./;

    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

