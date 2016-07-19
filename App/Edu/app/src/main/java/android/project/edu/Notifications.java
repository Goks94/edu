package android.project.edu;

import android.app.Activity;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;

/**
 * Created by Gokul_2 on 27-01-2015.
 */
public class Notifications extends ActionBarActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.notifications);
        getSupportActionBar().setTitle("NOTIFICATIONS");
    }
}
