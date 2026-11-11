# Online Registration Form

## Requirements
- PHP 7.4 or later
- A web server with PHP support (Apache, XAMPP, WAMP, or a PHP hosting provider)
- Internet connection to load the jQuery CDN

## Run locally using PHP
1. Open Terminal in this folder.
2. Run: `php -S localhost:8000`
3. Open `http://localhost:8000` in your browser.
4. Fill in the form and click **Submit Application**.

Do not open `index.php` by double-clicking it; PHP must run through a PHP-enabled server.

## Cloud hosting
Use a PHP-supported hosting provider. Create a hosting account, create a website/domain, and upload
`index.php`, `style.css`, and `script.js` into the website's public web directory (often named
`htdocs` or `public_html`). Visit the website URL and test a submission.

This is a demonstration form: it validates and displays submitted data but does not save it to a
database or send a confirmation email. Avoid entering real sensitive personal information on a
public demo.
