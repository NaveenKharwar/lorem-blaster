# Lorem Blaster

Generate block-based demo content for posts, pages, products, or custom post types with control over length, images, and taxonomies.

## Table of Contents
1. Description
2. Features
3. Requirements
4. Installation
5. Usage
6. Configuration
7. External Services
8. Privacy
9. Screenshots
10. Frequently Asked Questions
11. Troubleshooting
12. Development
13. Roadmap
14. Contributing
15. Security
16. License
17. Credits

## Description
Lorem Blaster is a WordPress admin utility for quickly generating realistic demo content. It creates block editor–compatible content, can pull text from public placeholder APIs, downloads images into the Media Library, and optionally assigns taxonomies and featured images.

## Features
- Generate multiple posts in one run
- Supports posts, pages, products, and public custom post types
- Block editor (Gutenberg) compatible output
- Multiple content sources, including an offline-safe option
- Downloads placeholder images to avoid hotlinking
- Optional featured image and inline image block
- Automatic taxonomy and tag assignment
- Translation ready

## Requirements
- WordPress 6.0+
- PHP 7.4+

## Installation
1. Upload the `lorem-blaster` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through **Plugins** in the WordPress admin.
3. Go to **Lorem Blaster** in the admin menu.

## Usage
1. Choose a content source and image source.
2. Select a post type and set the number of posts and character limit.
3. Optionally enable inline images, featured images, and auto taxonomy assignment.
4. Click **Generate Content**.

## Configuration
There are no settings pages or stored options. All configuration is per-run on the generation form.

## External Services
This plugin may connect to the following third-party services **only when selected by the user**:
- Bacon Ipsum — https://baconipsum.com/
- Hipster Ipsum — https://hipsum.co/
- DummyJSON — https://dummyjson.com/
- Picsum Photos — https://picsum.photos/
- Unsplash Source — https://source.unsplash.com/
- Placehold — https://placehold.co/

## Privacy
No personal data is transmitted. All fetched images are downloaded and stored locally in the Media Library.

## Screenshots
1. Admin dashboard (Lorem Blaster tool)
2. Content source and generation options
3. Generated block-based post content

## Frequently Asked Questions
**Does this plugin create real content?**
Yes. All generated content is saved as real WordPress posts, pages, or products.

**Does it work without an internet connection?**
Yes. The default Lorem Ipsum source works fully offline.

**Are images hotlinked?**
No. All images are downloaded locally and stored in the Media Library.

**Does it work with WooCommerce?**
Yes. If WooCommerce is active, you can generate demo products.

## Troubleshooting
- If external APIs are unavailable, the plugin will fall back to offline Lorem Ipsum.
- If image downloads fail, try a different image source or check network connectivity.

## Development
Local development uses standard WordPress plugin conventions. There are no build steps.

## Roadmap
- One-click cleanup for generated content
- Block pattern presets (landing page, product page, blog post)
- Media packs with higher-resolution, less-repetitive imagery
- More realistic taxonomies and excerpts
- WooCommerce product recipes (attributes, pricing, variations)

## Contributing
Contributions are welcome.
1. Fork the repo.
2. Create a feature branch.
3. Open a pull request with a clear description.

## Security
Please report security issues privately via GitHub issues or a security advisory.

## License
GPLv2 or later. See `LICENSE`.

## Credits
Created by Naveen Kharwar.
