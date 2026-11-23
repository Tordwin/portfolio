# Edwin Chen's portfolio

A PHP portfolio showcasing personal and school projects. No database, Node.js,
Composer, or build step is required.

## Run locally on Windows

Install PHP from the [official Windows downloads](https://www.php.net/downloads.php?os=windows).
For the built-in development server, choose an x64 Non Thread Safe ZIP. Extract
its contents so that `php.exe` is at `.local\php\php.exe`, or add your existing
PHP installation to `PATH`. The `.local` directory is ignored by Git.
The Windows builds also require the Visual C++ Redistributable linked on the
PHP download page.

From PowerShell in this directory:

```powershell
.\start.cmd
```

Open <http://127.0.0.1:8080>. Stop the server with Ctrl+C. To use another port,
run `.\start.cmd -Port 8081`. To check PHP syntax without starting a server,
run `.\start.cmd -Check`.

The launcher uses a process-scoped PowerShell execution policy so it works
when local scripts are disabled, without changing the system policy. It
resolves the document root from its own location, so it can also be called
from another directory.

## Other platforms

With PHP installed, run this command from the project directory:

```sh
php -S 127.0.0.1:8080 -t .
```

Use a PHP server rather than opening `index.php` as a file or using a static
preview server: PHP assembles the header and footer and renders the year.
The built-in server is for local development. Deploy the PHP files and assets
to a PHP-capable web host for production.
