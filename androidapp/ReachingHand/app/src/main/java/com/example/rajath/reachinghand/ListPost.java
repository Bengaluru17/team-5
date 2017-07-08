package com.example.rajath.reachinghand;

/**
 * Created by rajath on 08-07-2017.
 */

public class ListPost {
    private String productName;
    private String productQuantity;
    private String price;
    private String userName;
    public ListPost(){}

    public ListPost(String product, String quantity, String name){
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

    public void setName(String name){
        userName = name;
    }
}
