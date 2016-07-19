package android.project.edu;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

/**
 * Created by Gokul_2 on 27-01-2015.
 */
public class Attendance extends ActionBarActivity implements View.OnClickListener {

    SharedPreferences prefs;
    Button email;
    String mail;
    private String url1 = "http://edu.2fh.co/attend.php";
    private TextView m1,m2,m3,m4,m5,m6,m7,m8,m9,m10,m11,m12,m13,m14,m15,m16,m17,m18,m19,m20,m21,m22,m23,m24,m25,m26,m27,m28,m29,m30;
    private HandleJSONa obj;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.attendance);
        getSupportActionBar().setTitle("ATTENDANCE");

        email=(Button)findViewById(R.id.email_bt);
        email.setOnClickListener(this);

        m1 = (TextView)findViewById(R.id.att1);
        m2 = (TextView)findViewById(R.id.tot1);
        m3 = (TextView)findViewById(R.id.att2);
        m4 = (TextView)findViewById(R.id.tot2);
        m5 = (TextView)findViewById(R.id.att3);
        m6 = (TextView)findViewById(R.id.tot3);
        m7 = (TextView)findViewById(R.id.att4);
        m8 = (TextView)findViewById(R.id.tot4);
        m9 = (TextView)findViewById(R.id.att5);
        m10 = (TextView)findViewById(R.id.tot5);
        m11 = (TextView)findViewById(R.id.att6);
        m12 = (TextView)findViewById(R.id.tot6);
        m13 = (TextView)findViewById(R.id.att7);
        m14 = (TextView)findViewById(R.id.tot7);
        m15 = (TextView)findViewById(R.id.att8);
        m16 = (TextView)findViewById(R.id.tot8);
        m17 = (TextView)findViewById(R.id.att9);
        m18 = (TextView)findViewById(R.id.tot9);
        m19 = (TextView)findViewById(R.id.total1);
        m20 = (TextView)findViewById(R.id.total2);

        prefs=getSharedPreferences("file",0);
        String returned = prefs.getString("key","couldnt load");
        int user = Integer.parseInt(returned);

        mail=prefs.getString("mailid","couldnt load");

        String finalUrl=url1;
        //EN501.setText(finalUrl);
        obj = new HandleJSONa(finalUrl,user);
        obj.fetchJSON();


        while(obj.parsingComplete);
        m1.setText(obj.getm1()+" / ");
        m2.setText(obj.getm2());
        m3.setText(obj.getm3()+" / ");
        m4.setText(obj.getm4());
        m5.setText(obj.getm5()+" / ");
        m6.setText(obj.getm6());
        m7.setText(obj.getm7()+" / ");
        m8.setText(obj.getm8());
        m9.setText(obj.getm9()+" / ");
        m10.setText(obj.getm10());
        m11.setText(obj.getm11()+" / ");
        m12.setText(obj.getm12());
        m13.setText(obj.getm13()+" / ");
        m14.setText(obj.getm14());
        m15.setText(obj.getm15()+" / ");
        m16.setText(obj.getm16());
        m17.setText(obj.getm17()+" / ");
        m18.setText(obj.getm18());
        m19.setText(obj.getm19()+" / ");
        m20.setText(obj.getm20());
    }

    @Override
    public void onClick(View v) {
        String id[] = {mail};
        String message = "©Edu 2015-16";
        String subject = "Attendance Review";

        Intent emailIntent = new Intent(Intent.ACTION_SEND);
        emailIntent.putExtra(Intent.EXTRA_EMAIL,id);
        emailIntent.putExtra(Intent.EXTRA_SUBJECT,subject);
        emailIntent.setType("plain/text");
        emailIntent.putExtra(Intent.EXTRA_TEXT,message);
        startActivity(emailIntent);

    }
}
