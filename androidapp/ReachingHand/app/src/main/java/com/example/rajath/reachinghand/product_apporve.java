package com.example.rajath.reachinghand;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

public class product_apporve extends AppCompatActivity {

    private static final String TAG = "NewPostActivity";
    private static final String REQUIRED = "Required";
    private FirebaseDatabase mFirebaseDatabase;
    private DatabaseReference mMessageReference;
    // [START declare_database_ref]
    // private DatabaseReference mDatabase;
    // [END declare_database_ref]

    private EditText mTitleField;
    private EditText mBodyField;
    private EditText mBodyFieldAmount;
    private EditText musername;
    private boolean isapprove;
    private String appr;
    Posts posts;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product_apporve);

        // [START initialize_database_ref]
        // mDatabase = FirebaseDatabase.getInstance().getReference();
        // [END initialize_database_ref]

        mFirebaseDatabase = FirebaseDatabase.getInstance();

        mMessageReference = mFirebaseDatabase.getReference().child("posts");

        mTitleField = (EditText) findViewById(R.id.field_title);
        mBodyField = (EditText) findViewById(R.id.field_body);
        mBodyFieldAmount = (EditText) findViewById(R.id.field_title_price);
        musername = (EditText) findViewById(R.id.field_usr);
        findViewById(R.id.fab_submit_post).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                submitPost();
            }
        });
    }

    private void submitPost() {
        final String title = mTitleField.getText().toString();
        final String body = mBodyField.getText().toString();
        final String amount = mBodyFieldAmount.getText().toString();
        final String usr = musername.getText().toString();
        Admin_approve obj = new Admin_approve(usr,amount,body);
        isapprove = obj.checkuser();

        // Title is required
        if (TextUtils.isEmpty(title)) {
            mTitleField.setError(REQUIRED);
            return;
        }

        // Body is required
        if (TextUtils.isEmpty(body)) {
            mBodyField.setError(REQUIRED);
            return;
        }




        if (isapprove)
        {
            Toast.makeText(this, "Purchase approved",
                    Toast.LENGTH_LONG).show();

             posts = new Posts(title,body,amount,usr,appr="1");

        }
        else
        {
            Toast.makeText(this, "Purchase notApporved",
                    Toast.LENGTH_LONG).show();
            posts = new Posts(title,body,amount,usr,appr="0");
        }
        mMessageReference.push().setValue(posts);
        finish();
    }


}
