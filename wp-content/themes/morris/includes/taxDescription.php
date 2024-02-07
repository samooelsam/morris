<?php 
$tax = get_queried_object();
$brandName = $_GET['filter_brands'];
if($brandName){
    $termBrand = get_term_by('slug', $brandName, 'pa_brands');
    if( $termBrand){
        techvertu_description_template($termBrand->description);
    }
    
}
if($tax){
    techvertu_description_template($tax->description);
}
