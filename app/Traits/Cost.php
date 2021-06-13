<?php

namespace App\Traits;
use App\Price;
use App\Offer;
trait Cost
{
    public function calculateAdCost($offer_id,$category,$page_size,$width,$height,$price_type,$has_design=1){
        $cat_name=$category->name;$price=0; $design_cost=0; $offerOnDesign=0;
        $cm_price=Price::where('item','سعر سنتيمتر مربع')->value('price');
        if($cat_name!='اعلانات تجارية'&&$cat_name!='اعلانات المناسبات'){
            $price= $category->price;
        }
        if($cat_name!='اعلانات تجارية'&&$cat_name!='اعلانات المناسبات'){
            $price= $category->price;
        }elseif($price_type=='page_size'){
            $price=Price::where('item',$page_size)->value('price');
        }elseif($price_type='centimeter'){
            $price=(($height /38) * ($width /38))* $cm_price;
        }
        if($offer_id){
            $price_type='offer';
            $offer=Offer::findorfail($offer_id);
            if($offer->price>0){
                $price=$offer->price;
            }elseif($offer->discount>0){
                $price=$price-(($offer->discount/100)*$price);
            }
            
            $offerOnDesign=$offer->with_design;
        }
        if($has_design==0 && $offerOnDesign==0 ){
            $design_cost= Price::where('item','عمل ديزاين جديد')->value('price');
        }

        $vat=(($price+$design_cost)*Price::where('item','ضريبة القيمة المضافة')->value('price'))/100;
            $total=$price+$design_cost+$vat;
            return [
                'price_type'=>$price_type,
                'cm_price'=>(double) $cm_price,
                'price'=>(double)round($price,2),
                'design_cost'=>(double)round($design_cost,2),
                'vat'=>(double)round($vat,2),
                'total'=>(double)round($total,2)];
         
            
           
     
    }

  
}
