package android.project.edu;

import android.app.Activity;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.widget.TextView;

/**
 * Created by Gokul_2 on 27-01-2015.
 */
public class Timetable extends ActionBarActivity {

    private String url1 = "http://edu.2fh.co/timetable.php";
    private TextView m1,m2,m3,m4,m5,m6,m7,m8,m9,m10,m11,m12,m13,m14,m15,m16,m17,m18,m19,m20,m21,m22,m23,m24,m25,m26,m27,m28,m29,m30;
    private HandleJSONt obj;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.timetable);
        getSupportActionBar().setTitle("TIME TABLE");



        m1 = (TextView)findViewById(R.id.mon1);
        m2 = (TextView)findViewById(R.id.mon2);
        m3 = (TextView)findViewById(R.id.mon3);
        m4 = (TextView)findViewById(R.id.mon4);
        m5 = (TextView)findViewById(R.id.mon5);
        m6 = (TextView)findViewById(R.id.mon6);
        m7 = (TextView)findViewById(R.id.tue1);
        m8 = (TextView)findViewById(R.id.tue2);
        m9 = (TextView)findViewById(R.id.tue3);
        m10 = (TextView)findViewById(R.id.tue4);
        m11 = (TextView)findViewById(R.id.tue5);
        m12 = (TextView)findViewById(R.id.tue6);
        m13 = (TextView)findViewById(R.id.wed1);
        m14 = (TextView)findViewById(R.id.wed2);
        m15 = (TextView)findViewById(R.id.wed3);
        m16 = (TextView)findViewById(R.id.wed4);
        m17 = (TextView)findViewById(R.id.wed5);
        m18 = (TextView)findViewById(R.id.wed6);
        m19 = (TextView)findViewById(R.id.thu1);
        m20 = (TextView)findViewById(R.id.thu2);
        m21 = (TextView)findViewById(R.id.thu3);
        m22 = (TextView)findViewById(R.id.thu4);
        m23 = (TextView)findViewById(R.id.thu5);
        m24 = (TextView)findViewById(R.id.thu6);
        m25 = (TextView)findViewById(R.id.fri1);
        m26 = (TextView)findViewById(R.id.fri2);
        m27 = (TextView)findViewById(R.id.fri3);
        m28 = (TextView)findViewById(R.id.fri4);
        m29 = (TextView)findViewById(R.id.fri5);
        m30 = (TextView)findViewById(R.id.fri6);






        String finalUrl=url1;
        //EN501.setText(finalUrl);
        obj = new HandleJSONt(finalUrl);
        obj.fetchJSON();

        while(obj.parsingComplete);
        m1.setText(obj.getm1());
        m2.setText(obj.getm2());
        m3.setText(obj.getm3());
        m4.setText(obj.getm4());
        m5.setText(obj.getm5());
        m6.setText(obj.getm6());
        m7.setText(obj.getm7());
        m8.setText(obj.getm8());
        m9.setText(obj.getm9());
        m10.setText(obj.getm10());
        m11.setText(obj.getm11());
        m12.setText(obj.getm12());
        m13.setText(obj.getm13());
        m14.setText(obj.getm14());
        m15.setText(obj.getm15());
        m16.setText(obj.getm16());
        m17.setText(obj.getm17());
        m18.setText(obj.getm18());
        m19.setText(obj.getm19());
        m20.setText(obj.getm20());
        m21.setText(obj.getm21());
        m22.setText(obj.getm22());
        m23.setText(obj.getm23());
        m24.setText(obj.getm24());
        m25.setText(obj.getm25());
        m26.setText(obj.getm26());
        m27.setText(obj.getm27());
        m28.setText(obj.getm28());
        m29.setText(obj.getm29());
        m30.setText(obj.getm30());


    }
}
