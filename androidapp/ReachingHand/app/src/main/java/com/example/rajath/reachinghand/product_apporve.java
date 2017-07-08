package com.example.rajath.reachinghand;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

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

        Posts posts = new Posts(title,body,amount);
        mMessageReference.push().setValue(posts);
        finish();
    }
}
