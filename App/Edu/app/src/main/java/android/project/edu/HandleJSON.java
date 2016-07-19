package android.project.edu;

/**
 * Created by Gokul_2 on 24-02-2015.
 */
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.StringWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import org.json.JSONArray;
import org.json.JSONObject;
import org.xmlpull.v1.XmlPullParser;
import org.xmlpull.v1.XmlPullParserFactory;

import android.annotation.SuppressLint;
import android.content.SharedPreferences;
import android.util.Log;

public class HandleJSON {

    int id;



    private String EN501 = "EN501";
    private String EN502 = "EN502";
    private String EN503 = "EN503";
    private String EN504 = "EN504";
    private String EN505 = "EN505";
    private String EN506 = "EN506";
    private String EN507 = "EN507";
    private String EN508 = "EN508";
    private String urlString = null;
    JSONArray internals;

    public volatile boolean parsingComplete = true;
    public HandleJSON(String url,int user){
        this.urlString = url; id = user;
    }
    public String getEN501(){
        return EN501;
    }
    public String getEN502(){
        return EN502;
    }
    public String getEN504(){
        return EN504;
    }
    public String getEN503(){
        return EN503;
    }
    public String getEN505(){
        return EN505;
    }
    public String getEN506(){
        return EN506;
    }
    public String getEN507(){
        return EN507;
    }
    public String getEN508(){
        return EN508;
    }


    @SuppressLint("NewApi")
    public void readAndParseJSON(String in) {
        try {


            JSONObject reader = new JSONObject(in);
            internals = reader.getJSONArray("internals");
            //id=Integer.parseInt(user);
           // id%=100;
            id-=1;
            JSONObject sys  = internals.getJSONObject(id);
            EN501 = sys.getString("sub1");

            // JSONObject main  = reader.getJSONObject("main");
            EN502 = sys.getString("sub2");

            EN503 = sys.getString("sub3");
            EN504 = sys.getString("sub4");
            EN505 = sys.getString("sub5");

            EN506 = sys.getString("sub6");
            EN507 = sys.getString("sub7");
            EN508 = sys.getString("sub8");

            parsingComplete = false;



        } catch (Exception e) {
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