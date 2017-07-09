package com.example.rajath.reachinghand;

import android.app.Activity;
import android.content.Context;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.util.ArrayList;

public class attendence extends AppCompatActivity {

    ListView listview;
    Button attend;
    String[] foody;
    Attendences attnd;
    private FirebaseDatabase mFirebaseDatabase;
    private DatabaseReference mMessageReference;
    ArrayList<String> attendedstu = new ArrayList<String>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_attendence);
        mFirebaseDatabase = FirebaseDatabase.getInstance();
                mMessageReference = mFirebaseDatabase.getReference().child("attendance");
        attend = (Button) findViewById(R.id.button1);
        listview = (ListView)findViewById(R.id.listView1);
        listview.setChoiceMode(ListView.CHOICE_MODE_MULTIPLE);
        //string array
        String[] student = { "Jhon", "Tom", "Sham", "Ram"};
        // set adapter for listview
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, R.layout.list_item, student);
        listview.setAdapter(adapter);
        listview.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                String selectedItem = ((TextView)view).getText().toString();
                attendedstu.add(selectedItem);

            }
        });
        // we want multiple clicks
    attend.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            for (String e:attendedstu){
            attnd= new Attendences(e,"p");
                mMessageReference.push().setValue(attnd);


                finish();
            }

        }
    });


    }

    @Override
    protected void onDestroy() {
        Toast.makeText(this,"Attendence Taken",Toast.LENGTH_LONG).show();
        super.onDestroy();
    }
}
