package com.example.rajath.reachinghand;

/**
 * Created by kkara on 09-07-2017.
 */

public class Attendences {

    private String student;
    private String check;
    public Attendences()
    {

    }
    public Attendences(String usr,String att)
    {
        student=usr;
        check=att;

    }

    public String getusr(){
        return student;
    }

    public void setuser(String usr){
        student=usr;

    }

    public String getatten(){
        return check;
    }

    public void getatten(String usr){
        check=usr;

    }

}
