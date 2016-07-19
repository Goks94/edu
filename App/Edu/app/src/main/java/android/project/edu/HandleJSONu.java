package android.project.edu;

import android.annotation.SuppressLint;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Created by Gokul_2 on 01-03-2015.
 */
public class HandleJSONu {



    private String EN501 = "EN501";
    private String EN502 = "EN502";
    private String EN503 = "EN503";
    private String EN504 = "EN504";

    private String urlString = null;
    JSONArray internals;
    int id;

    public volatile boolean parsingComplete = true;
    public HandleJSONu(String url,int i){
        this.urlString = url;id = i;
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


    @SuppressLint("NewApi")
    public void readAndParseJSON(String in) {
        try {


            JSONObject reader = new JSONObject(in);
            internals = reader.getJSONArray("upcomings");
            //id=Integer.parseInt(user);
            // id%=100;

            JSONObject sys  = internals.getJSONObject(id);
            EN501 = sys.getString("date");

            // JSONObject main  = reader.getJSONObject("main");
            EN502 = sys.getString("type");

            EN503 = sys.getString("title");
            EN504 = sys.getString("message");


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

