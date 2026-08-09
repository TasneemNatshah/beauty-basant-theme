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
2. Activate the theme. On first activation it:
   - seeds 3 demo Hero Slides, 3 demo Testimonials, 3 demo Benefits, and 4
     demo Services so nothing looks empty;
   - auto-creates the "Contact Us" and "Services" pages (with their
     templates already assigned) and the "Terms and Conditions" and
     "Privacy Policy" pages (with placeholder legal text — see Notes below).
3. Install & activate the WooCommerce plugin, then add products. Go to
   Appearance > Customize > Homepage > Our Collection to pick exactly which
   products appear in the homepage grid (or leave empty to auto-show
   Featured products, falling back to the latest products).
4. Go to Appearance > Menus and assign menus to the "Primary Menu",
   "Footer — Quick Links" and "Footer — Customer Care" locations.
5. Go to Appearance > Customize to edit:
   - Homepage > Section Visibility — show/hide each homepage section
     (Hero Slider, Our Collection, Latest Posts, Our Story, Testimonials,
     Benefits Bar) with a checkbox.
   - Homepage > Our Collection — which products show + product/post card
     image height.
   - Homepage > Our Story Section — text + image.
   - Top Bar announcement message.
   - Contact & Social Links — email, phone, address, Google Maps embed URL,
     social links (used on the Contact page and footer).
   - Footer about text & copyright.
   - Site logo (Site Identity).
6. Edit content via wp-admin:
   - "Hero Slides" — slide title, eyebrow tag, description, button, and
     background image (featured image). Add/remove slides freely.
   - "Testimonials" — reviewer name (title), review text (content), star
     rating. Add/remove freely.
   - "Benefits Bar" — icon + label. Add/remove freely.
   - "Services" — icon, description, price, duration, photo. Shown on the
     Services page. Add/remove freely.
   - The homepage automatically shows your latest 3 blog Posts as cards.

== Page Templates ==

- "Contact Us" (template-contact.php): info cards (email/phone/address),
  an AJAX contact form that emails the address set in Contact & Social
  Links, and an optional embedded Google Map.
- "Services" (template-services.php): a grid of your Services CPT entries.
- Products (Shop), Single Product, and My Account pages use WooCommerce's
  default templates, restyled by this theme (two-column My Account layout,
  styled product gallery/tabs/related products, styled shop grid/sorting/
  pagination) — no template files were overridden, so WooCommerce updates
  stay compatible.

== Notes ==

- Set a static "Front page" in Settings > Reading pointing at any page (or
  leave default) — front-page.php always renders the full homepage layout
  regardless of which page is assigned, so any page works as the front page.
- Set a "Posts page" in Settings > Reading so the homepage's "View All
  Posts" button and blog archive work as expected.
- WooCommerce is optional: without it, the homepage shows 3 static demo
  products and the cart/account top-bar links become inert.
- The Terms and Conditions / Privacy Policy page content is generic
  placeholder boilerplate, not legal advice — have it reviewed by a
  qualified professional before relying on it.
- Fully responsive down to mobile, with dedicated tablet/iPad breakpoints.
