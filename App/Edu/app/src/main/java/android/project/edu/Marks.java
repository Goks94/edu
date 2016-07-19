package android.project.edu;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

/**
 * Created by Gokul_2 on 27-01-2015.
 */
public class Marks extends ActionBarActivity implements View.OnClickListener {

    SharedPreferences data;
    private String url1 = "http://edu.2fh.co/fetchmarks.php";
    private String url2 = "http://edu.2fh.co/batch.php";
    private String url3 = "http://edu.2fh.co/teacher.php";
    private TextView EN501,EN502,EN503,EN504,EN505,EN506,EN507,EN508;
    private HandleJSON obj;
    private HandleJSONe obj1;
    private HandleJSONb obj2;
    Button email;
    public String batch,mail;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.marks);
        getSupportActionBar().setTitle("MARKS");

        EN501 = (TextView)findViewById(R.id.marks501);
        EN502 = (TextView)findViewById(R.id.marks502);
        EN503 = (TextView)findViewById(R.id.marks503);
        EN504 = (TextView)findViewById(R.id.marks504);
        EN505 = (TextView)findViewById(R.id.marks505);
        EN506 = (TextView)findViewById(R.id.marks506);
        EN507 = (TextView)findViewById(R.id.marks507);
        EN508 = (TextView)findViewById(R.id.marks508);
        email = (Button)findViewById(R.id.email_bt);
        email.setOnClickListener(this);


        data=getSharedPreferences("file",0);
        String returned = data.getString("key","couldnt load");
        int user = Integer.parseInt(returned);



        String finalUrl=url1;
        //EN501.setText(finalUrl);
        obj = new HandleJSON(finalUrl,user);
        obj.fetchJSON();


        while(obj.parsingComplete);
        EN501.setText(obj.getEN501());
        EN502.setText(obj.getEN502());
        EN503.setText(obj.getEN503());
        EN504.setText(obj.getEN504());
        EN505.setText(obj.getEN505());
        EN506.setText(obj.getEN506());
        EN507.setText(obj.getEN507());
        EN508.setText(obj.getEN508());



        String finalUrl2=url2;
        obj1 = new HandleJSONe(finalUrl2,user);
        obj1.fetchJSON();

        while(obj1.parsingComplete);
        SharedPreferences.Editor editor = data.edit();
        editor.putString("batch",obj1.getEN501());
        editor.commit();

        data=getSharedPreferences("file",0);
        batch = data.getString("batch","couldnt load");


        String finalUrl3=url3;
        obj2 = new HandleJSONb(finalUrl3,batch);
        obj2.fetchJSON();

        while(obj2.parsingComplete);
        editor.putString("mailid",obj2.getEN501());
        editor.commit();

        data=getSharedPreferences("file",0);
        mail = data.getString("mailid","couldnt load");








    }

    @Override
    public void onClick(View v) {
        String id[] = {mail};
        String message = "©Edu 2015-16";
        String subject = "Marks Review";

        Intent emailIntent = new Intent(Intent.ACTION_SEND);
        emailIntent.putExtra(Intent.EXTRA_EMAIL,id);
        emailIntent.putExtra(Intent.EXTRA_SUBJECT,subject);
        emailIntent.setType("plain/text");
        emailIntent.putExtra(Intent.EXTRA_TEXT,message);
        startActivity(emailIntent);

    }
}
