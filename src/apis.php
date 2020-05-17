<?php

namespace ebaypackage;

class ebay
{

    public function getEbayOrders($token)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild Token"
            }';
            return $error_response;
        }
        $url = "https://api.sandbox.ebay.com/sell/fulfillment/v1/order";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }

    public function getEbayInventoryItems($token)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild Token"
            }';
            return $error_response;
        }
        $url = "https://api.sandbox.ebay.com/sell/inventory/v1/inventory_item?limit=20&offset=0";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }

    public function createOrUpdateInventoryItem($token,$sku,$requestProductData)
    {
        if(!$token){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild Token"
            }';
            return $error_response;
        }else if(!$sku){
            $error_response = '{
                    "category": "REQUEST",
                    "message": "Please enter vaild SKU"
            }';
            return $error_response;
        }else if(!$requestProductData){
            $error_response = '{
                "category": "REQUEST",
                "message": "Request data can not be null"
            }';
            return $error_response;
        }
        $url = "https://api.sandbox.ebay.com/sell/inventory/v1/inventory_item/".$sku;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        $headers = array();
        $headers[] = "Authorization: Bearer .'$token'.";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Content-Language: en-US";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$requestProductData);
        $result = curl_exec($ch);
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        if($response_code == 204){
            $sucess_response = '{
                "code":204
            }';
            return $sucess_response;
        }else{
            return $result;

        }
    }


}