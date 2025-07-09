# Custom CSS Addon for Friendica

This addon allows the site administrator to globally inject custom CSS into every page of the site.

## Features
- Admin-only settings interface
- Saves and injects CSS through the `<head>` tag
- Clean and safe method to style the site without modifying core or theme files

## Installation

1. Place the `customcss` folder into your `friendica/addon/` directory.
2. Enable the addon from the Admin Panel → Addons.
3. Navigate to Admin Panel → Addon Settings → Custom CSS Injector.
4. Add your CSS and click **Save**.

## Security Note
Only the site admin can inject CSS. Malicious or broken styles can still affect the frontend, so edit carefully.

## Author
Vibrillo Team
