package kav.com.location;

import android.app.AlertDialog;
import android.app.PendingIntent;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.Address;
import android.location.Geocoder;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.EditText;

import android.widget.Toast;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.common.api.ResultCallback;
import com.google.android.gms.common.api.Status;
import com.google.android.gms.location.Geofence;
import com.google.android.gms.location.GeofencingRequest;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.model.LatLng;


import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class MapsActivity extends AppCompatActivity implements
        GoogleApiClient.ConnectionCallbacks,
        GoogleApiClient.OnConnectionFailedListener,
        ResultCallback<Status> {
    EditText txt;
    //public static SQLiteDatabase db;
    public String location;
    public DbHelper dbhelp;
    private GoogleMap mMap;
    public String txt1;
    LatLng latLng;
    Address address;
    EditText location_tf;
    ArrayList<DbHelper.data> array = new ArrayList<>();
    protected ArrayList<Geofence> mGeofenceList;
    protected GoogleApiClient mGoogleApiClient;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // LocationSettingsRequest.Builder builder = new LocationSettingsRequest.Builder();
        // builder.setAlwaysShow(true);
        setContentView(R.layout.activity_maps);
        dbhelp = new DbHelper(this);
        dbhelp.getWritableDatabase();
        mGeofenceList = new ArrayList<Geofence>();

        buildGoogleApiClient();


    }


    @Override
    protected void onResume() {
        super.onResume();
    }


    public void onSearch(View view) {
        location_tf = (EditText) findViewById(R.id.TFaddress);
        location = location_tf.getText().toString();
        List<Address> addressList = null;
        if (location != null || !location.equals("")) {
            Geocoder geocoder = new Geocoder(this);
            try {
                addressList = geocoder.getFromLocationName(location, 1);


            } catch (IOException e) {
                e.printStackTrace();
            }

            try {
                address = addressList.get(0);
                latLng = new LatLng(address.getLatitude(), address.getLongitude());


                AlertDialog.Builder alertbox = new AlertDialog.Builder(this);
                alertbox.setTitle("Enter message");
                txt = new EditText(this);
                alertbox.setView(txt);
                alertbox.setPositiveButton("Submit", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                        txt1 = txt.getText().toString();
                        dbhelp.insert(location, txt1);
                        Constants.LANDMARKS.put(txt1, new LatLng(address.getLatitude(), address.getLongitude()));
                        Toast.makeText(getApplicationContext(), "Added", Toast.LENGTH_SHORT).show();
                        populateGeofenceList();
                        addGeofencesButtonHandler();
                        dbhelp.getAllLabels();

                    }
                });

                alertbox.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();
                    }
                });
                alertbox.show();

            } catch (IndexOutOfBoundsException e) {
                Toast.makeText(MapsActivity.this, "Location not found", Toast.LENGTH_SHORT).show();
            } catch (NullPointerException e) {
                Toast.makeText(MapsActivity.this, "Location not found", Toast.LENGTH_SHORT).show();
            }

        }
    }



    private void buildGoogleApiClient() {
        mGoogleApiClient = new GoogleApiClient.Builder(this)
                .addConnectionCallbacks(this)
                .addOnConnectionFailedListener(this)
                .addApi(LocationServices.API)
                .build();

    }

    private void populateGeofenceList() {
        for (Map.Entry<String, LatLng> entry : Constants.LANDMARKS.entrySet()) {
            mGeofenceList.add(new Geofence.Builder()
                    .setRequestId(entry.getKey())
                    .setCircularRegion(
                            entry.getValue().latitude,
                            entry.getValue().longitude,
                            Constants.GEOFENCE_RADIUS_IN_METERS
                    )
                    .setExpirationDuration(Geofence.NEVER_EXPIRE)
                    .setTransitionTypes(Geofence.GEOFENCE_TRANSITION_ENTER |
                            Geofence.GEOFENCE_TRANSITION_EXIT)
                    .build());
        }

    }

    @Override
    protected void onStart() {
        super.onStart();
        if (!mGoogleApiClient.isConnecting() || !mGoogleApiClient.isConnected()) {
            mGoogleApiClient.connect();
        }
    }

    @Override
    protected void onStop() {
        super.onStop();
        if (mGoogleApiClient.isConnecting() || mGoogleApiClient.isConnected()) {
            mGoogleApiClient.disconnect();
        }
    }


    @Override
    public void onResult(Status status) {
        if (status.isSuccess()) {
            Toast.makeText(
                    this,
                    "Geofences Added",
                    Toast.LENGTH_SHORT
            ).show();
        } else {

        }

    }

    private PendingIntent getGeofencePendingIntent() {
        Intent intent = new Intent(this, GeofenceTransitionsIntentService.class);
        // We use FLAG_UPDATE_CURRENT so that we get the same pending intent back when calling addgeoFences()
        return PendingIntent.getService(this, 0, intent, PendingIntent.FLAG_UPDATE_CURRENT);

    }

    private GeofencingRequest getGeofencingRequest() {
        GeofencingRequest.Builder builder = new GeofencingRequest.Builder();
        builder.setInitialTrigger(GeofencingRequest.INITIAL_TRIGGER_ENTER);
        builder.addGeofences(mGeofenceList);
        return builder.build();
    }

    public void addGeofencesButtonHandler() {

        for (int i = 0; i < mGeofenceList.size(); i++)
            Log.d("TAG1", "addGeofencesButtonHandler: " + mGeofenceList.get(i));
        if (!mGoogleApiClient.isConnected()) {

            Toast.makeText(this, "Google API Client not connected!", Toast.LENGTH_SHORT).show();
            return;
        }

        try {
            LocationServices.GeofencingApi.addGeofences(mGoogleApiClient,getGeofencingRequest(),
                    getGeofencePendingIntent()
            ).setResultCallback(this);
            // Result processed in onResult().

        } catch (SecurityException securityException) {
            // Catch exception generated if the app does not use ACCESS_FINE_LOCATION permission.
        }
    }


    @Override
    public void onConnected(@Nullable Bundle bundle) {

    }

    @Override
    public void onConnectionSuspended(int i) {

    }

    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {

    }


    public void next(View view) {
        Intent intent = new Intent(MapsActivity.this, StartActivity.class);
        startActivity(intent);
        finish();

    }
}




