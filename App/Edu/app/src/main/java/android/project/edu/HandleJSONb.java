package android.project.edu;

import android.annotation.SuppressLint;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Created by Gokul_2 on 22-03-2015.
 */
public class HandleJSONb {

    String id;



    private String EN501 = "EN501";

    private String urlString = null;
    JSONArray internals;

    public volatile boolean parsingComplete = true;
    public HandleJSONb(String url,String batch){
        this.urlString = url; id = batch;
    }
    public String getEN501(){
        return EN501;
    }



    @SuppressLint("NewApi")
    public void readAndParseJSON(String in) {
        try {


            JSONObject reader = new JSONObject(in);
            internals = reader.getJSONArray("internals");
            //id=Integer.parseInt(user);
            // id%=100;
            for(int i = 0;;i++) {
                JSONObject sys = internals.getJSONObject(i);
                EN501 = sys.getString("tutor");

                if(id.equals(EN501)){
                    EN501 = sys.getString("email");
                    break;}
            }



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
