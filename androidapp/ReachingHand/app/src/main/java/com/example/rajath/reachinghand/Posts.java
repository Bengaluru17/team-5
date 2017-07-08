package com.example.rajath.reachinghand;

/**
 * Created by rajath on 08-07-2017.
 */

public class Posts {
    private String productName;
    private String productQuantity;
    private String price;
    private String username;
    private String approve;
    public Posts(){
    }

    public Posts(String product, String quantity, String pri,String usr,String appro){
        productName = product;
        productQuantity = quantity;
        price = pri;
        username=usr;
        approve=appro;

    }

    public String getProductName(){
        return productName;
    }

    public String getProductQuantity(){
        return productQuantity;
    }

    public void setProductName(String product){
        productName = product;
    }

    public void setProductQuantity(String quantity){
        productQuantity = quantity;
    }

    public String getPrice(){
        return price;
    }

    public void setPrice(String p){
        price = p;
    }

    public String getusr(){
        return username;
    }
    public void setusr(String p){
        username= p;
    }

    public String getappro(){
        return approve;
    }
    public void setappro(String p){
        approve= p;
    }
}
