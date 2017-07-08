package com.example.rajath.reachinghand;

import java.util.ArrayList;

/**
 * Created by kkara on 09-07-2017.
 */

public class Admin_approve {
    public static int price ;
    public static int quan;
    public static long amn=10000;
    String usr;
    int count=3;
    int c=0;
  public Admin_approve(String user,String price,String quantity)
  {
      this.price =Integer.parseInt(price);
      quan = Integer.parseInt(quantity);
      usr=user;
      c=c+1;
  }
  public boolean checkuser()
  {
      if ((price<amn )&& c<count){
          amn=amn-price;
        return true;
      }
      else {
          c=0;
          return false;
      }
  }


}
