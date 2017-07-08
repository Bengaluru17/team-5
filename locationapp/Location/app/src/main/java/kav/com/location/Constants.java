package kav.com.location;

import com.google.android.gms.maps.model.LatLng;

import java.util.HashMap;


/**
 * Created by kav on 7/8/17.
 */

public class Constants {

    public static final long GEOFENCE_EXPIRATION_IN_MILLISECONDS = 12 * 60 * 60 * 1000;
    public static final float GEOFENCE_RADIUS_IN_METERS = 1000;

    public static final HashMap<String, LatLng> LANDMARKS = new HashMap<String, LatLng>();
    static {

    }

}

