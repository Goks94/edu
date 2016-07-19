package android.project.edu;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

/**
 * Created by Gokul_2 on 30-01-2015.
 */
public class Profile extends ActionBarActivity implements View.OnClickListener /*implements View.OnClickListener, AdapterView.OnItemSelectedListener*/ {

    //Spinner spinner;
    SharedPreferences prefs,data,pref;
    Button save;
    String usernamee;
    EditText name,dob,reg,pin,district,state,address1,address2,post,email,pass,mobile;
    //public static final String batch[] = {"2011-2015","2012-2016","2013-2017","2014-2018"};



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.profile);

        //spinner=(Spinner)findViewById(R.id.spinner);
        name=(EditText)findViewById(R.id.user_et);
        dob=(EditText)findViewById(R.id.dob_et);
        reg=(EditText)findViewById(R.id.reg_et);
        address1=(EditText)findViewById(R.id.address1_et);
        address2=(EditText)findViewById(R.id.address2_et);
        post=(EditText)findViewById(R.id.post_et);
        pin=(EditText)findViewById(R.id.pin_et);
        district=(EditText)findViewById(R.id.district_et);
        state=(EditText)findViewById(R.id.state_et);
        mobile=(EditText)findViewById(R.id.mobile_et);
        email=(EditText)findViewById(R.id.email_et);
        pass=(EditText)findViewById(R.id.confirmpass_et);

        save=(Button)findViewById(R.id.save_bt);
        save.setOnClickListener(this);
        getSupportActionBar().setTitle("PROFILE");

        /*Bundle gotBasket = getIntent().getExtras();
        usernamee=gotBasket.getString("key");*/

        prefs = getSharedPreferences("file",0);
        data = getSharedPreferences("file",0);
        pref = getSharedPreferences("file",0);

        /*ArrayAdapter<String> adapter = new ArrayAdapter<String>(Profile.this,
                R.layout.spinner_item,batch);

       adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        spinner.setAdapter(adapter);
        spinner.setOnItemSelectedListener(this);*/

    }

    @Override
    public void onClick(View v) {



        String namee = name.getText().toString();
        String emaill = email.getText().toString();
        String dobb = dob.getText().toString();
        String regg = reg.getText().toString();
        String mobilee = mobile.getText().toString();
        String address11 = address1.getText().toString();
        String address22 = address2.getText().toString();
        String postt = post.getText().toString();
        String pinn = pin.getText().toString();
        String districtt = district.getText().toString();
        String statee = state.getText().toString();
        String passs = pass.getText().toString();

        SharedPreferences.Editor editor = prefs.edit();
        editor.putString("reg",regg);
        editor.commit();

        data=getSharedPreferences("file",0);
        usernamee = data.getString("key","couldnt load");



       /* if(namee.equals("")&&emaill.equals("")&&dobb.equals("")&&regg.equals("")&&mobilee.equals("")&&address11.equals("")&&address22.equals("")&&
                postt.equals("")&&pinn.equals("")&&districtt.equals("")&&statee.equals("")&&passs.equals(""))

            Toast.makeText(this,"Fill every details",Toast.LENGTH_SHORT).show();

        else*/

        new UpdateEntry(this).execute(namee, emaill, dobb, regg,mobilee,address11,address22,postt,pinn,districtt,statee,passs,usernamee);
    }

    public void done() {
        finish();
    }

    /*@Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

        SharedPreferences.Editor editor = pref.edit();
        editor.putString("batch",batch[position]);
        editor.commit();
        Log.d("Batch",batch[position]);
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }*/
}
