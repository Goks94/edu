package android.project.edu;

import android.annotation.SuppressLint;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Created by Gokul_2 on 26-02-2015.
 */
public class HandleJSONt {

    private String m1 = "one";
    private String m2 = "two";
    private String m3 = "three";
    private String m4 = "four";
    private String m5 = "five";
    private String m6 = "six";
    private String m7 = "one";
    private String m8 = "two";
    private String m9 = "three";
    private String m10 = "four";
    private String m11 = "five";
    private String m12 = "six";
    private String m13 = "one";
    private String m14 = "two";
    private String m15 = "three";
    private String m16 = "four";
    private String m17 = "five";
    private String m18 = "six";
    private String m19 = "one";
    private String m20 = "two";
    private String m21 = "three";
    private String m22 = "four";
    private String m23 = "five";
    private String m24 = "six";
    private String m25 = "one";
    private String m26 = "two";
    private String m27 = "three";
    private String m28 = "four";
    private String m29 = "five";
    private String m30 = "six";
    private String urlString = null;
    JSONArray timetable;

    public volatile boolean parsingComplete = true;
    public HandleJSONt(String url){
        this.urlString = url;
    }
    public String getm1(){
        return m1;
    }
    public String getm2(){
        return m2;
    }
    public String getm3(){
        return m3;
    }
    public String getm4(){
        return m4;
    }
    public String getm5(){
        return m5;
    }
    public String getm6(){
        return m6;
    }
    public String getm7(){
        return m7;
    }
    public String getm8(){
        return m8;
    }
    public String getm9(){
        return m9;
    }
    public String getm10(){
        return m10;
    }
    public String getm11(){
        return m11;
    }
    public String getm12(){
        return m12;
    }
    public String getm13(){
        return m13;
    }
    public String getm14(){
        return m14;
    }
    public String getm15(){
        return m15;
    }
    public String getm16(){
        return m16;
    }
    public String getm17(){
        return m17;
    }
    public String getm18(){
        return m18;
    }
    public String getm19(){
        return m19;
    }
    public String getm20(){
        return m20;
    }
    public String getm21(){
        return m21;
    }
    public String getm22(){
        return m22;
    }
    public String getm23(){
        return m23;
    }
    public String getm24(){
        return m24;
    }
    public String getm25(){
        return m25;
    }
    public String getm26(){
        return m26;
    }
    public String getm27(){
        return m27;
    }
    public String getm28(){
        return m28;
    }
    public String getm29(){
        return m29;
    }
    public String getm30(){
        return m30;
    }




    @SuppressLint("NewApi")
    public void readAndParseJSON(String in) {
        try {


            JSONObject reader = new JSONObject(in);
            timetable = reader.getJSONArray("timetable");



                JSONObject sys = timetable.getJSONObject(0);


                // JSONObject main  = reader.getJSONObject("main");
                m1 = sys.getString("one");
                m2 = sys.getString("two");
                m3 = sys.getString("three");
                m4 = sys.getString("four");
                m5 = sys.getString("five");
                m6 = sys.getString("six");

            JSONObject sys1 = timetable.getJSONObject(1);
            m7 = sys1.getString("one");
            m8 = sys1.getString("two");
            m9 = sys1.getString("three");
            m10 = sys1.getString("four");
            m11= sys1.getString("five");
            m12= sys1.getString("six");

            JSONObject sys2 = timetable.getJSONObject(2);
            m13 = sys2.getString("one");
            m14= sys2.getString("two");
            m15= sys2.getString("three");
            m16= sys2.getString("four");
            m17= sys2.getString("five");
            m18= sys2.getString("six");

            JSONObject sys3 = timetable.getJSONObject(3);
            m19= sys3.getString("one");
            m20= sys3.getString("two");
            m21= sys3.getString("three");
            m22= sys3.getString("four");
            m23= sys3.getString("five");
            m24= sys3.getString("six");

            JSONObject sys4 = timetable.getJSONObject(4);
            m25= sys4.getString("one");
            m26= sys4.getString("two");
            m27= sys4.getString("three");
            m28= sys4.getString("four");
            m29= sys4.getString("five");
            m30= sys4.getString("six");



                parsingComplete = false;



        }catch (Exception e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }

    }
    public void fetchJSON(){
        Thread thread = new Thread(new Runnable(){
            @Override
            public void run() {
                try {
                    URL url = new URL(urlString);
                    HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                    conn.setReadTimeout(10000 /* milliseconds */);
                    conn.setConnectTimeout(15000 /* milliseconds */);
                    conn.setRequestMethod("GET");
                    conn.setDoInput(true);
                    // Starts the query
                    conn.connect();
                    InputStream stream = conn.getInputStream();

                    String data = convertStreamToString(stream);

                    readAndParseJSON(data);
                    stream.close();

                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        });

        thread.start();
    }
    static String convertStreamToString(java.io.InputStream is) {
        java.util.Scanner s = new java.util.Scanner(is).useDelimiter("\\A");
        return s.hasNext() ? s.next() : "";
    }
}

