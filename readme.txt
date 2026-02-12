=== Lorem Blaster ===
Contributors: naveenkharwar
Tags: lorem ipsum, dummy content, demo content, block editor, woocommerce
Requires at least: 6.0
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Generate realistic, block-based demo content for posts, pages, products, and custom post types — directly from your WordPress dashboard.

== Description ==

Lorem Blaster helps developers, designers, and site builders generate realistic demo content for WordPress websites. It creates block editor–compatible content, supports multiple text sources, downloads placeholder images locally, and can automatically assign taxonomies and featured images.

== Features ==

* Generate multiple posts in one click
* Supports posts, pages, products, and public custom post types
* Block editor (Gutenberg) compatible output
* Multiple content sources (offline and API-based)
* Downloads placeholder images locally
* Optional featured image and inline image block
* Automatic taxonomy assignment
* Translation ready (i18n)

== External Services ==

This plugin optionally connects to third-party services to generate placeholder content **only when explicitly selected by the user** in the plugin settings. You can choose to use only the built-in offline Lorem Ipsum generator and avoid all external services.

**Text Generation Services:**

**Bacon Ipsum API**
- Service: Bacon Ipsum (https://baconipsum.com/)
- Purpose: Generates meat-themed placeholder text
- Data Sent: Number of paragraphs requested (integer only, no personal data)
- When Used: Only when user selects "Bacon Ipsum" as the text source
- API Documentation: https://baconipsum.com/json-api/
- Privacy: No user data is collected or transmitted
- Terms of Service: https://baconipsum.com/ (see footer)

**Hipster Ipsum API**
- Service: Hipster Ipsum (https://hipsum.co/)
- Purpose: Generates hipster-themed placeholder text
- Data Sent: Number of paragraphs requested (integer only, no personal data)
- When Used: Only when user selects "Hipster Ipsum" as the text source
- API Documentation: https://hipsum.co/api/
- Privacy: No user data is collected or transmitted
- Terms: Available at https://hipsum.co/

**DummyJSON API**
- Service: DummyJSON (https://dummyjson.com/)
- Purpose: Provides sample post data and content
- Data Sent: Limit parameter for number of posts (integer only, no personal data)
- When Used: Only when user selects "DummyJSON" as the content source
- API Documentation: https://dummyjson.com/docs
- Privacy: No user data is collected or transmitted
- GitHub: https://github.com/Ovi/DummyJSON

**Image Generation Services:**

**Picsum Photos**
- Service: Lorem Picsum (https://picsum.photos/)
- Purpose: Provides random placeholder images
- Data Sent: Image dimensions in URL (e.g., /1200/800), no personal data
- When Used: Only when user selects "Picsum" as the image source
- Privacy: No user data is collected or transmitted
- Images are downloaded and stored locally in your WordPress Media Library
- Terms: https://picsum.photos/

**Unsplash Source**
- Service: Unsplash Source API (https://source.unsplash.com/)
- Purpose: Provides high-quality random placeholder images
- Data Sent: Image dimensions and optional category in URL, no personal data
- When Used: Only when user selects "Unsplash" as the image source
- Privacy Policy: https://unsplash.com/privacy
- Terms of Service: https://unsplash.com/terms
- Images are downloaded and stored locally in your WordPress Media Library
- License: Unsplash License (https://unsplash.com/license)

**Placehold.co**
- Service: Placehold.co (https://placehold.co/)
- Purpose: Provides simple, solid-color placeholder images
- Data Sent: Image dimensions in URL (e.g., /1200x800/png), no personal data
- When Used: Only when user selects "Placehold" as the image source
- Privacy: No user data is collected or transmitted
- Images are downloaded and stored locally in your WordPress Media Library
- Website: https://placehold.co/

**Important Privacy Notes:**
- No personal data, IP addresses, or user information is ever transmitted to these services
- All API calls are made server-side from your WordPress installation
- All fetched images are downloaded once and stored permanently in your local WordPress Media Library
- No cookies or tracking mechanisms are used
- You can use the built-in offline Lorem Ipsum generator to avoid all external service calls

== Installation ==

1. Upload the `lorem-blaster` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Go to **Lorem Blaster** in the admin menu to generate content.

== Frequently Asked Questions ==

= Does this plugin create real content? =
Yes. All generated content is saved as real WordPress posts, pages, or products.

= Does it work without an internet connection? =
Yes. The default Lorem Ipsum source works fully offline. External services are optional.

= Are images hotlinked? =
No. All images are downloaded locally and stored in the Media Library.

= What data is sent to external services? =
Only the parameters needed to generate content (like number of paragraphs or image dimensions). No personal data, IP addresses, or user information is transmitted.

= Can I avoid using external services? =
Yes. You can use the built-in offline Lorem Ipsum generator and skip image generation, or use locally uploaded images instead.

== Screenshots ==

1. Lorem Blaster dashboard inside WordPress admin

== Changelog ==

= 1.0.1 =
* Enhanced external services documentation
* Improved security with proper nonce verification
* Fixed direct core file loading issues
* Optimized $_POST data processing
* Added capability checks for better security

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.1 =
Security improvements and WordPress.org compliance updates.

= 1.0.0 =
Initial release.
