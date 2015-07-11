package android.project.edu;

import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;

public class MainActivity extends Activity implements OnClickListener {

	Button button;
	EditText username, password;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		button = (Button) findViewById(R.id.loginbutton);
		username = (EditText) findViewById(R.id.usernameet);
		password = (EditText) findViewById(R.id.passwordet);
		button.setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		String text1 = username.getText().toString();
		String text2 = password.getText().toString();
		FileOutputStream fos=null;
		try {
			fos = openFileOutput("login.txt", Context.MODE_PRIVATE);
			fos.write(text1.getBytes());
			fos.write(text2.getBytes());

		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		finally{
			try {
				fos.close();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}

		Intent next = new Intent("android.project.edu.MENU");
		startActivity(next);

	}

}
