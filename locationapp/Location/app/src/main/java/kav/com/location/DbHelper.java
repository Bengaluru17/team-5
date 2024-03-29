package kav.com.location;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;



import java.util.ArrayList;

public class DbHelper extends SQLiteOpenHelper {
    public DbHelper(Context context) {
        super(context, "LocationMessage" , null, 1);
        Log.d("hi","inside db");

    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createUsersQuery = "create table" + " PLACE"+"("+ "LOCATION"+ " string,"+"MESSAGE"+" string)";
        db.execSQL(createUsersQuery);
        Log.d("hi","table created succesfully");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

    }

    public boolean insert(String loc, String mess){
        String query = "INSERT INTO place VALUES('" + loc + "','" + mess + "')";
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL(query);
        Log.d("h", "location" + loc + mess + "" + "inserted successfully");
        return true;
    }






    public static class data{
        String a;
        String s;
    }
    public ArrayList<data> getAllLabels() {
        Log.d("TAGGGG", "getAllLabels: ");
        ArrayList<data> labelsList = new ArrayList<>();

        SQLiteDatabase db = this.getReadableDatabase();

        Cursor cursor = db.rawQuery("select * from PLACE " , null);
        cursor.moveToFirst();

        while (!cursor.isAfterLast()){

            data tasks = new data();

            tasks.a= cursor.getString(cursor.getColumnIndex("LOCATION"));
            tasks.s = cursor.getString(cursor.getColumnIndex("MESSAGE"));
            Log.d("TAG", "getAllLabels: "+tasks.s);
            labelsList.add(tasks);

            cursor.moveToNext();
        }

        cursor.close();

        return labelsList;

    }

    void delete(String location){
        SQLiteDatabase db = this.getWritableDatabase();
        Log.d("TAGd", "Delete: "+location);
        db.delete("place","LOCATION='"+location+"'",null);
        // mAdapter.notifyDataSetChanged();
    }

}
