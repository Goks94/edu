package android.project.edu;

import android.app.Activity;
import android.app.ListActivity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.Configuration;
import android.os.Bundle;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBarDrawerToggle;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

/**
 * Created by Gokul_2 on 27-01-2015.
 */
public class  Menu extends ActionBarActivity implements AdapterView.OnItemClickListener {

    SharedPreferences pref;


    private DrawerLayout drawerLayout;
    private ListView listview;
    private String[] menus;
    private ActionBarDrawerToggle drawerListener;
    ListView l;


    TextView tv;
    private String url1 = "http://edu.2fh.co/upcomings.php";
    private HandleJSONu obj;



    // Button marks,attendance,notifications,timetable;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.menu);



        tv = (TextView)findViewById(R.id.text);
        String finalUrl = url1;

        for(int i=0;i<2;i++) {
            obj = new HandleJSONu(finalUrl, i);
            obj.fetchJSON();

            while (obj.parsingComplete) ;
            tv.setText((tv.getText().toString())+"\n"+
                    obj.getEN501() +"\t"+"\t"+"\t"+"\t"+"--"+"\t"+"\t"+"\t"+"\t"+
                    obj.getEN502() +"\t"+"\t"+"\t"+"\t"+""+"\t"+"\t"+"\t"+"\t"+"\n"+
                    obj.getEN503() +"\t"+"\t"+"\t"+"\t"+"--"+"\t"+"\t"+"\t"+"\t"+
                    obj.getEN504() +
                    "\n"+"\n" );

        }




        menus = getResources().getStringArray(R.array.menus);
        listview = (ListView) findViewById(R.id.drawerList);
        listview.setAdapter(new ArrayAdapter<>(this, R.layout.newstyle, menus));
        getSupportActionBar().setTitle("UPCOMINGS");
        listview.setOnItemClickListener(this);

        drawerLayout = (DrawerLayout) findViewById(R.id.drawerLayout);

        drawerListener=new ActionBarDrawerToggle(this,drawerLayout,R.string.drawer_open,R.string.drawer_close){
            @Override
            public void onDrawerOpened(View drawerView) {
                super.onDrawerOpened(drawerView);

            }

            @Override
            public void onDrawerClosed(View drawerView) {
                super.onDrawerClosed(drawerView);

            }
            /* @Override
        public void onDrawerClosed(View drawerView) {
            Toast.makeText(Menu.this, "closed", Toast.LENGTH_LONG).show();
        }

        @Override
        public void onDrawerOpened(View drawerView) {
            Toast.makeText(Menu.this,"opened",Toast.LENGTH_LONG).show();  */
    };
    drawerLayout.setDrawerListener(drawerListener);

    getSupportActionBar().setHomeButtonEnabled(true);
    getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        pref = getSharedPreferences("file",0);
        SharedPreferences.Editor editor = pref.edit();
        editor.putString("profile","set");
        editor.commit();


}


    @Override
    public boolean onCreateOptionsMenu(android.view.Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.

       getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;

    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (drawerListener.onOptionsItemSelected(item))
            return true;
        //return super.onOptionsItemSelected(item);



            int id = item.getItemId();

            //noinspection SimplifiableIfStatement
            if (id == R.id.editprofile) {
                Intent i;
                i = new Intent(this,Profile.class);
                this.startActivity(i);
            }

            if (id == R.id.logout) {
                Intent i = new Intent(this,MainActivity.class);
                this.startActivity(i);
            }

        if (id == R.id.about) {
            Intent i = new Intent("android.project.edu.About");
            startActivity(i);
        }

            return super.onOptionsItemSelected(item);



    }

    @Override
    public void onConfigurationChanged(Configuration newConfig) {
        super.onConfigurationChanged(newConfig);
        drawerListener.onConfigurationChanged(newConfig);
    }

    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);
        drawerListener.syncState();
    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        if(position==3){
            Intent next=new Intent("android.project.edu.Menu");
            startActivity(next);

        }

        else{

        Intent next=new Intent("android.project.edu."+menus[position]);
        startActivity(next);}
    }







}


