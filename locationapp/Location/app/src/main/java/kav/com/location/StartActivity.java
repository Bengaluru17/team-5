package kav.com.location;

import android.content.Intent;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.StaggeredGridLayoutManager;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.common.api.ResultCallback;
import com.google.android.gms.common.api.Status;
import com.google.android.gms.location.LocationServices;


import java.util.ArrayList;

public class StartActivity extends AppCompatActivity implements
        GoogleApiClient.ConnectionCallbacks,
        GoogleApiClient.OnConnectionFailedListener,
        ResultCallback<Status> {
    public DbHelper dbhelp;
    ArrayList<DbHelper.data> array1 = new ArrayList<>();
    ArrayList<String> list;
    ArrayList<String> address = new ArrayList<>();
    public ArrayList<String> listgeo = new ArrayList<>();
    protected GoogleApiClient mGoogleApiClient;
    RecyclerView recyclerView;
    FloatingActionButton fab;


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_start);
//        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
//        setSupportActionBar(toolbar);
        listgeo = new ArrayList<>();

        buildGoogleApiClient();
        fab = (FloatingActionButton) findViewById(R.id.fab);

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(StartActivity.this, MapsActivity.class);
                startActivity(intent);
                finish();
            }
        });
        dbhelp = new DbHelper(this);
        dbhelp.getWritableDatabase();
    }


    private void buildGoogleApiClient() {
        mGoogleApiClient = new GoogleApiClient.Builder(this)
                .addConnectionCallbacks(this)
                .addOnConnectionFailedListener(this)
                .addApi(LocationServices.API)
                .build();

    }


    @Override
    protected void onResume() {
        super.onResume();

        list = new ArrayList<>();

        array1 = dbhelp.getAllLabels();
        for (int i = 0; i < array1.size(); i++) {
            list.add("Location : " + array1.get(i).a + "\n" + "Message : " + array1.get(i).s);
            Log.d("TAG", "onCreate: " + array1.get(i).a);
            address.add(array1.get(i).a);
        }
        setUpRecView();

    }

    private void setUpRecView() {
        recyclerView = (RecyclerView) findViewById(R.id.recView);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(StartActivity.this);
        RecyclerView.LayoutManager grid = new StaggeredGridLayoutManager(1, StaggeredGridLayoutManager.HORIZONTAL);
        recyclerView.setLayoutManager(layoutManager);

        recyclerView.setAdapter(new MyAdapter());
    }

    @Override
    public void onConnected(@Nullable Bundle bundle) {
        Log.d("TAG", "onConnected: ");

    }

    @Override
    protected void onStart() {
        super.onStart();
        if (!mGoogleApiClient.isConnecting() || !mGoogleApiClient.isConnected()) {
            mGoogleApiClient.connect();
        }
    }

    @Override
    public void onConnectionSuspended(int i) {
        Log.d("TAG", "onConnectionSuspended: ");
    }

    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {

        Log.d("TAG", "onConnectionFailed: " + connectionResult.getErrorMessage());

    }

    @Override
    public void onResult(@NonNull Status status) {

    }


    public class MyAdapter extends RecyclerView.Adapter<MyAdapter.Holder> {

        @Override
        public Holder onCreateViewHolder(ViewGroup parent, int viewType) {
            return new Holder(LayoutInflater.from(StartActivity.this).inflate(R.layout.single_view, parent, false));
        }

        @Override
        public void onBindViewHolder(Holder holder, final int position) {
            Log.d("TAG12", "onBindViewHolder: " + list.get(position));
            holder.textView.setText(list.get(position));
            holder.button.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Log.d("TAG111", "onClick: " + position);
                    dbhelp.delete(address.get(position));
                    listgeo.add(address.get(position));
                    for (int i = 0; i < listgeo.size(); i++) {
                        Log.d("tagnew", "added :" + listgeo.get(i));
                    }


                    list.remove(position);
                    address.remove(position);
                    LocationServices.GeofencingApi.removeGeofences(mGoogleApiClient, listgeo);

                    notifyDataSetChanged();
                }
            });

        }

        @Override
        public int getItemCount() {
            return list.size();
        }

        public class Holder extends RecyclerView.ViewHolder {

            TextView textView;
            ImageView button;

            public Holder(View itemView) {
                super(itemView);

                textView = (TextView) itemView.findViewById(R.id.text);
                button = (ImageView) itemView.findViewById(R.id.del);



            }


        }
    }

}
