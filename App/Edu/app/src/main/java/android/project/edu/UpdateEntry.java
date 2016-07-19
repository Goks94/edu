package android.project.edu;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

/**
 * Created by Gokul_2 on 24-02-2015.
 */
public class UpdateEntry extends AsyncTask<String,Void,String>  {

    String usernamee;
    ProgressDialog progress;
    private Context context;
    private int byGetOrPost = 0;
    //flag 0 means get and 1 means post.(By default it is get.)
    public UpdateEntry(Context context) {
        this.context = context;
        progress= new ProgressDialog(this.context);
    }

    protected void onPreExecute(){

        progress.setTitle("Saving");
        progress.setCanceledOnTouchOutside(false);
        progress.setCancelable(false);
        progress.setMessage("Connecting");
        progress.show();
    }
    @Override
    protected String doInBackground(String... arg0) {

        try{

            String namee = (String)arg0[0];
            String emaill = (String)arg0[1];
            String dobb = (String)arg0[2];
            String regg = (String)arg0[3];
            String mobilee = (String)arg0[4];
            String address11 = (String)arg0[5];
            String address22 = (String)arg0[6];
            String postt = (String)arg0[7];
            String pinn = (String)arg0[8];
            String districtt = (String)arg0[9];
            String statee = (String)arg0[10];
            String passs = (String)arg0[11];
             usernamee = (String)arg0[12];


            String link="http://edu.2fh.co/update.php";
            String data  = URLEncoder.encode("name", "UTF-8")
                    + "=" + URLEncoder.encode(namee, "UTF-8");
            data += "&" + URLEncoder.encode("email", "UTF-8")
                    + "=" + URLEncoder.encode(emaill, "UTF-8");
            data += "&" + URLEncoder.encode("dob", "UTF-8")
                    + "=" + URLEncoder.encode(dobb, "UTF-8");
            data += "&" + URLEncoder.encode("reg", "UTF-8")
                    + "=" + URLEncoder.encode(regg, "UTF-8");

            data += "&" + URLEncoder.encode("mobile", "UTF-8")
                    + "=" + URLEncoder.encode(mobilee, "UTF-8");
            data += "&" + URLEncoder.encode("address1", "UTF-8")
                    + "=" + URLEncoder.encode(address11, "UTF-8");
            data += "&" + URLEncoder.encode("address2", "UTF-8")
                    + "=" + URLEncoder.encode(address22, "UTF-8");
            data += "&" + URLEncoder.encode("post", "UTF-8")
                    + "=" + URLEncoder.encode(postt, "UTF-8");
            data += "&" + URLEncoder.encode("pin", "UTF-8")
                    + "=" + URLEncoder.encode(pinn, "UTF-8");
            data += "&" + URLEncoder.encode("district", "UTF-8")
                    + "=" + URLEncoder.encode(districtt, "UTF-8");
            data += "&" + URLEncoder.encode("state", "UTF-8")
                    + "=" + URLEncoder.encode(statee, "UTF-8");
            data += "&" + URLEncoder.encode("pass", "UTF-8")
                    + "=" + URLEncoder.encode(passs, "UTF-8");
            data += "&" + URLEncoder.encode("username", "UTF-8")
                    + "=" + URLEncoder.encode(usernamee, "UTF-8");


            URL url = new URL(link);
            URLConnection conn = url.openConnection();
            conn.setDoOutput(true);
            OutputStreamWriter wr = new OutputStreamWriter
                    (conn.getOutputStream());
            wr.write( data );
            wr.flush();
            BufferedReader reader = new BufferedReader
                    (new InputStreamReader(conn.getInputStream()));
            StringBuilder sb = new StringBuilder();
            String line = null;
            // Read Server Response
            while((line = reader.readLine()) != null)
            {
                sb.append(line);
                break;
            }

            return sb.toString();

        }catch(Exception e){
            return new String("Exception: " + e.getMessage());
        }
    }

    @Override
    protected void onPostExecute(String result){

        Log.d("RESULT", result);
        if(result.equals("success")) {





            Intent i = new Intent(context, Menu.class);
            context.startActivity(i);

            Toast.makeText(context,"Successfuly saved",Toast.LENGTH_SHORT).show();
            progress.dismiss();
        }
        else
        {
            Toast.makeText(context,"Error while saving",Toast.LENGTH_SHORT).show();
            progress.dismiss();
        }
    }
}


