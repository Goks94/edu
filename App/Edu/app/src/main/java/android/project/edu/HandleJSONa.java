package android.project.edu;

import android.annotation.SuppressLint;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Created by Gokul_2 on 02-03-2015.
 */
public class HandleJSONa {

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
    int id;

    private String urlString = null;
    JSONArray attendance;

    public volatile boolean parsingComplete = true;
    public HandleJSONa(String url,int user){
        this.urlString = url;id=user;
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





    @SuppressLint("NewApi")
    public void readAndParseJSON(String in) {
        try {


            JSONObject reader = new JSONObject(in);
            attendance = reader.getJSONArray("attendance");


            id-=1;
            JSONObject sys = attendance.getJSONObject(id);


            // JSONObject main  = reader.getJSONObject("main");
            m1 = sys.getString("sub1");
            m2 = sys.getString("tot1");
            m3 = sys.getString("sub2");
            m4 = sys.getString("tot2");
            m5 = sys.getString("sub3");
            m6 = sys.getString("tot3");


            m7 = sys.getString("sub4");
            m8 = sys.getString("tot4");
            m9 = sys.getString("sub5");
            m10 = sys.getString("tot5");
            m11= sys.getString("sub6");
            m12= sys.getString("tot6");


            m13 = sys.getString("sub7");
            m14= sys.getString("tot7");
            m15= sys.getString("sub8");
            m16= sys.getString("tot8");
            m17= sys.getString("sub9");
            m18= sys.getString("tot9");


            m19= sys.getString("total1");
            m20= sys.getString("total2");



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


