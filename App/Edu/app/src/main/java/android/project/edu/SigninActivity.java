package android.project.edu;

/**
 * Created by Gokul_2 on 15-02-2015.
 */
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URI;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import static android.support.v4.app.ActivityCompat.startActivity;

public class SigninActivity  extends AsyncTask<String,Void,String>{

    SharedPreferences prefs;



    String usernamee;
    ProgressDialog progress;
    private Context context;
    private int byGetOrPost = 0;
    //flag 0 means get and 1 means post.(By default it is get.)
    public SigninActivity(Context context,String username) {
        this.context = context; //this.statuss = status;
        progress= new ProgressDialog(this.context);
        usernamee=username;


    }

    protected void onPreExecute(){



        progress.setTitle("Logging In");
        progress.setCanceledOnTouchOutside(false);
        progress.setCancelable(false);
        progress.setMessage("Authenticating User");
        progress.show();
    }
    @Override
    protected String doInBackground(String... arg0) {

        try{
            String username = (String)arg0[0];
            String password = (String)arg0[1];

            String link="http://edu.2fh.co/login.php";
            String data  = URLEncoder.encode("username", "UTF-8")
                    + "=" + URLEncoder.encode(username, "UTF-8");
            data += "&" + URLEncoder.encode("password", "UTF-8")
                    + "=" + URLEncoder.encode(password, "UTF-8");
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

        SharedPreferences prefs =
                context.getSharedPreferences("file",Context.MODE_PRIVATE);
        String returned = prefs.getString("profile","couldnt load");


        Log.d("RESULT",result);
        if(result.equals("success")) {

            if (returned.equals("set")) {
                Intent i = new Intent(context, Menu.class);
                context.startActivity(i);

            } else {

               /* Bundle basket = new Bundle();
                basket.putString("key", usernamee);*/

                Intent i = new Intent(context, Profile.class);

               /* i.putExtras(basket);*/
                context.startActivity(i);

                //this.statuss.setText(" ");
                Toast.makeText(context, "Successfuly Logged in !", Toast.LENGTH_SHORT).show();
                progress.dismiss();
            }
        }
        else
        {
            Toast.makeText(context,"Invalid user credentials !",Toast.LENGTH_SHORT).show();
            //this.statuss.setText("Invalid Credentials!!!");
            progress.dismiss();
        }
    }
}
