package com.example.rajath.reachinghand;

import android.content.Intent;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class Splash_activity extends AppCompatActivity {
    private static  int SPLASH_TIME_OUT = 4000;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


        setContentView(R.layout.activity_splash_activity);

        new Handler().postDelayed(
                new Runnable() {
                    @Override
                    public void run() {
                        Intent homeIntent = new Intent(Splash_activity.this, MainActivity.class);
                        startActivity(homeIntent);
                        finish();
                    }
                },SPLASH_TIME_OUT);
    }
}




