package com.example.rajath.reachinghand;

import android.app.Activity;
import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.List;

/**
 * Created by rajath on 08-07-2017.
 */

public class ListAdapter extends ArrayAdapter<Posts> {
    public ListAdapter(Context context, int resource, List<Posts> objects) {
        super(context, resource, objects);
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = ((Activity) getContext()).getLayoutInflater().inflate(R.layout.list_row, parent, false);
        }

        TextView approv = (TextView) convertView.findViewById(R.id.appro);
        TextView product = (TextView) convertView.findViewById(R.id.product);
        TextView name = (TextView) convertView.findViewById(R.id.user);
        TextView quantity = (TextView) convertView.findViewById(R.id.quantity);

        Posts message = getItem(position);
        product.setText(message.getProductName());
        quantity.setText(message.getProductQuantity());
        name.setText(message.getusr());
        approv.setText(message.getappro());

        return convertView;
    }
}