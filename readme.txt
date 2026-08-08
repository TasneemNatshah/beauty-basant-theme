=== Beauty Basant ===
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 8.2
License: GPLv2 or later

A custom WordPress theme for Beauty Basant, a Dead Sea minerals skincare brand.
Converted from a static HTML/CSS mockup into a full WooCommerce-ready theme.

== Installation ==

1. Copy this "BeautyBasantTheme" folder into wp-content/themes/, or zip it and
   upload via Appearance > Themes > Add New > Upload Theme.
2. Activate the theme. On first activation it seeds 3 demo Hero Slides and
   3 demo Testimonials so the homepage isn't empty.
3. Install & activate the WooCommerce plugin, then add products and mark a
   few as "Featured" — the homepage collection grid shows featured products
   (falls back to the 3 latest products if none are featured).
4. Go to Appearance > Menus and assign menus to the "Primary Menu",
   "Footer — Quick Links" and "Footer — Customer Care" locations.
5. Go to Appearance > Customize to edit:
   - Top bar announcement message
   - Homepage "Our Story" section (text + image)
   - Homepage newsletter section text
   - Benefits bar (3 icons + labels)
   - Contact info & social links
   - Footer about text & copyright
   - Site logo (Site Identity)
6. Edit content via wp-admin:
   - "Hero Slides" menu — slide title, eyebrow tag, description, button,
     and background image (featured image).
   - "Testimonials" menu — reviewer name (title), review text (content),
     star rating.
   - Newsletter signups are stored under "Subscribers" (grouped with Hero
     Slides in the admin menu) — export or connect to your ESP as needed.

== Notes ==

- Set a static "Front page" in Settings > Reading pointing at any page (or
  leave default) — front-page.php always renders the full homepage layout
  regardless of which page is assigned, so any page works as the front page.
- WooCommerce is optional: without it, the homepage shows 3 static demo
  products and the cart/account top-bar links become inert.
