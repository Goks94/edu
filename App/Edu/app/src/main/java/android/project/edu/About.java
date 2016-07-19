package android.project.edu;

import android.app.Activity;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;

/**
 * Created by Gokul_2 on 26-02-2015.
 */
public class About extends ActionBarActivity  {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.about);
        getSupportActionBar().setTitle("ABOUT");
    }
}
