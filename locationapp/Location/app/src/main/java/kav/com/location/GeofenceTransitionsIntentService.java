package kav.com.location;
import android.app.IntentService;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.TaskStackBuilder;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.support.v4.app.NotificationCompat;
import android.text.TextUtils;
import android.util.Log;

import com.google.android.gms.location.Geofence;
import com.google.android.gms.location.GeofenceStatusCodes;
import com.google.android.gms.location.GeofencingEvent;

import java.util.ArrayList;
import java.util.List;


/**
 * Created by kav on 7/9/17.
 */

public class GeofenceTransitionsIntentService extends IntentService{
    protected static final String TAG = "GeofenceTransitionsIS";



    public GeofenceTransitionsIntentService() {
        super(TAG);
    }

    @Override
    protected void onHandleIntent(Intent intent) {
        GeofencingEvent event = GeofencingEvent.fromIntent(intent);
        if (event.hasError()) {
            Log.e(TAG, "GeofencingEvent Error: " + event.getErrorCode());
            return;
        }
        String description = getGeofenceTransitionDetails(event);
        Log.d(TAG, "onHandleIntent: "+event);
        sendNotification(description);
    }



    private static String getGeofenceTransitionDetails(GeofencingEvent event) {
        String transitionString =
                GeofenceStatusCodes.getStatusCodeString(event.getGeofenceTransition());
        Log.d(TAG, "getGeofenceTransitionDetails: "+transitionString);
        List triggeringIDs = new ArrayList();
        for (Geofence geofence : event.getTriggeringGeofences()) {
            triggeringIDs.add(geofence.getRequestId());
            Log.d(TAG, "getGeofenceTransitionDetails: "+geofence);
        }
        return String.format("%s: %s", "Message  ", TextUtils.join(", ", triggeringIDs));
    }



    private void sendNotification(String notificationDetails) {
        // Create an explicit content Intent that starts MainActivity.
        Intent notificationIntent = new Intent(getApplicationContext(), StartActivity.class);

        // Get a PendingIntent containing the entire back stack.
        TaskStackBuilder stackBuilder = TaskStackBuilder.create(this);
        stackBuilder.addParentStack(StartActivity.class).addNextIntent(notificationIntent);
        PendingIntent notificationPendingIntent =
                stackBuilder.getPendingIntent(0, PendingIntent.FLAG_UPDATE_CURRENT);

        // Get a notification builder that's compatible with platform versions >= 4
        NotificationCompat.Builder builder = new NotificationCompat.Builder(this);
        long[] pattern = {500,500,500,500,500,500,500,500,500,500,500,500,500,500,500,500,500,500,5000,500};
        // Define the notification settings.
        builder.setColor(Color.WHITE)
                .setSmallIcon(R.mipmap.logo)
                .setContentTitle(notificationDetails)
                .setContentText("Click notification to return to App")
                .setContentIntent(notificationPendingIntent)
                //.setAutoCancel(true)
                .setVibrate(pattern )
                .setLights(Notification.DEFAULT_LIGHTS,1000,500)
                .setDefaults(Notification.DEFAULT_SOUND);
        // .setFullScreenIntent(notificationPendingIntent,true);




        // Fire and notify the built Notification.
        NotificationManager notificationManager =
                (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);
        notificationManager.notify(0, builder.build());
    }

}
