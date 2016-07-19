package android.project.edu;

import android.content.Context;
import android.os.AsyncTask;

import org.apache.http.HttpConnection;
import org.apache.http.HttpRequest;
import org.apache.http.HttpResponse;

/**
 * Created by Gokul_2 on 07-02-2015.
 */
public class Connect extends AsyncTask<Void,Void,Void>
{

    Context context;
    String url;
    HttpConnection connection;
    HttpResponse response;
    HttpRequest request;
    Connect(Context context, String url)
    {
        this.context= context;
        this.url = url;
    }
    @Override
    protected void onPreExecute()
    {

    }

    @Override
    protected Void doInBackground(Void... voids)
    {
        return null;
    }
    @Override
    protected void onPostExecute(Void v)
    {

    }




}
