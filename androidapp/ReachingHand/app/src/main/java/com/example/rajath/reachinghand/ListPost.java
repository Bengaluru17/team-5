package com.example.rajath.reachinghand;

/**
 * Created by rajath on 08-07-2017.
 */

public class ListPost {
    private String productName;
    private String productQuantity;
    private String price;
    private String userName;
    private String appro;
    public ListPost(){}

    public ListPost(String arr, String pri, String product,String quantity,String name){
        appro=arr;
        price=pri;
        productName = product;
        productQuantity = quantity;
        userName = name;

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

    public String getName(){
        return userName;
    }

    public void setappr(String name){
        appro = name;
    }
    public String getappro(){
        return appro;
    }

    public void setName(String name){
        userName = name;
    }


}
