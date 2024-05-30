package com.baharara.app;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        WebView web_v = findViewById(R.id.webv);
        String siteUrl = "https://perfumeara.com/webapp/app2";
        web_v.loadUrl(siteUrl);
        web_v.getSettings().setJavaScriptEnabled(true);
        web_v.setWebViewClient(new mWebViewClient());
    }

    private static class mWebViewClient extends WebViewClient {
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url) {
            view.loadUrl(url);
            return true;
        }
    }
}