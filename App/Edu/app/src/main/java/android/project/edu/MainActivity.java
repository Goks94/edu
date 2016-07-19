package android.project.edu;
import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends Activity {

    public static String filename = "file";
    SharedPreferences data;

    private EditText usernameField,password;
    //private TextView status;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        usernameField = (EditText)findViewById(R.id.username_et);
        password=(EditText)findViewById( R.id.password_et);
       // status=(TextView)findViewById(R.id.stat);

        data = getSharedPreferences(filename,0);

    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    public void loginPost(View view){
        String username = usernameField.getText().toString();
        String pass = password.getText().toString();

        SharedPreferences.Editor editor = data.edit();
        editor.putString("key",username);
        editor.commit();

        new SigninActivity(this,username).execute(username,pass);


    }
    public void done() {
        finish();
    }


}