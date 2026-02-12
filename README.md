# Lorem Blaster

Generate block-based demo content for posts, pages, products, or custom post types with control over length, images, and taxonomies.

**Version:** 1.0.1  
**Requires:** WordPress 6.0+, PHP 7.4+  
**License:** GPLv2 or later

## Table of Contents
1. [Description](#description)
2. [Features](#features)
3. [Requirements](#requirements)
4. [Installation](#installation)
5. [Usage](#usage)
6. [Configuration](#configuration)
7. [External Services](#external-services)
8. [Privacy](#privacy)
9. [Screenshots](#screenshots)
10. [Frequently Asked Questions](#frequently-asked-questions)
11. [Troubleshooting](#troubleshooting)
12. [Development](#development)
13. [Changelog](#changelog)
14. [Roadmap](#roadmap)
15. [Contributing](#contributing)
16. [Security](#security)
17. [License](#license)
18. [Credits](#credits)

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
- Translation ready (i18n)

## Requirements
- WordPress 6.0+
- PHP 7.4+

## Installation

### From WordPress.org (recommended)
1. Go to **Plugins > Add New** in your WordPress admin
2. Search for "Lorem Blaster"
3. Click **Install Now** and then **Activate**

### Manual Installation
1. Upload the `lorem-blaster` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through **Plugins** in the WordPress admin
3. Go to **Lorem Blaster** in the admin menu

## Usage
1. Navigate to **Lorem Blaster** in your WordPress admin menu
2. Choose a content source (Lorem Ipsum, Bacon Ipsum, Hipster Ipsum, or DummyJSON)
3. Select an image source (Picsum, Unsplash, or Placehold)
4. Select a post type and set the number of posts and character limit
5. Optionally enable:
   - Inline images within content
   - Featured images
   - Auto taxonomy assignment
6. Click **Generate Content**
7. Review the generated posts in the success notification

## Configuration
There are no settings pages or stored options. All configuration is per-run on the generation form, giving you full control each time you generate content.

## External Services

This plugin optionally connects to third-party services to generate placeholder content **only when explicitly selected by the user** in the plugin settings. You can choose to use only the built-in offline Lorem Ipsum generator and avoid all external services.

### Text Generation Services

#### Bacon Ipsum API
- **Service:** Bacon Ipsum (https://baconipsum.com/)
- **Purpose:** Generates meat-themed placeholder text
- **Data Sent:** Number of paragraphs requested (integer only, no personal data)
- **When Used:** Only when user selects "Bacon Ipsum" as the text source
- **API Documentation:** https://baconipsum.com/json-api/
- **Privacy:** No user data is collected or transmitted

#### Hipster Ipsum API
- **Service:** Hipster Ipsum (https://hipsum.co/)
- **Purpose:** Generates hipster-themed placeholder text
- **Data Sent:** Number of paragraphs requested (integer only, no personal data)
- **When Used:** Only when user selects "Hipster Ipsum" as the text source
- **API Documentation:** https://hipsum.co/api/
- **Privacy:** No user data is collected or transmitted

#### DummyJSON API
- **Service:** DummyJSON (https://dummyjson.com/)
- **Purpose:** Provides sample post data and content
- **Data Sent:** Limit parameter for number of posts (integer only, no personal data)
- **When Used:** Only when user selects "DummyJSON" as the content source
- **API Documentation:** https://dummyjson.com/docs
- **Privacy:** No user data is collected or transmitted
- **GitHub:** https://github.com/Ovi/DummyJSON

### Image Generation Services

#### Picsum Photos
- **Service:** Lorem Picsum (https://picsum.photos/)
- **Purpose:** Provides random placeholder images
- **Data Sent:** Image dimensions in URL (e.g., /1200/800), no personal data
- **When Used:** Only when user selects "Picsum" as the image source
- **Privacy:** No user data is collected or transmitted
- **Images:** Downloaded and stored locally in your WordPress Media Library

#### Unsplash Source
- **Service:** Unsplash Source API (https://source.unsplash.com/)
- **Purpose:** Provides high-quality random placeholder images
- **Data Sent:** Image dimensions and optional category in URL, no personal data
- **When Used:** Only when user selects "Unsplash" as the image source
- **Privacy Policy:** https://unsplash.com/privacy
- **Terms of Service:** https://unsplash.com/terms
- **License:** Unsplash License (https://unsplash.com/license)
- **Images:** Downloaded and stored locally in your WordPress Media Library

#### Placehold.co
- **Service:** Placehold.co (https://placehold.co/)
- **Purpose:** Provides simple, solid-color placeholder images
- **Data Sent:** Image dimensions in URL (e.g., /1200x800/png), no personal data
- **When Used:** Only when user selects "Placehold" as the image source
- **Privacy:** No user data is collected or transmitted
- **Images:** Downloaded and stored locally in your WordPress Media Library

## Privacy

### Data Protection
- **No Personal Data Transmitted:** No personal data, IP addresses, or user information is ever transmitted to external services
- **Server-Side Only:** All API calls are made server-side from your WordPress installation
- **Local Storage:** All fetched images are downloaded once and stored permanently in your local WordPress Media Library
- **No Tracking:** No cookies or tracking mechanisms are used
- **Offline Option:** You can use the built-in offline Lorem Ipsum generator to avoid all external service calls

### User Control
- External services are **opt-in only** - they are only used when you explicitly select them
- You can generate content entirely offline by using the default "Lorem Ipsum (offline safe)" option
- No data is shared without your knowledge or consent

## Screenshots

1. **Admin Dashboard** - Lorem Blaster tool interface
2. **Content Options** - Content source and generation options
3. **Generated Content** - Example of generated block-based post content
4. **WooCommerce Products** - Demo product content with images

## Frequently Asked Questions

### Does this plugin create real content?
Yes. All generated content is saved as real WordPress posts, pages, or products in your database.

### Does it work without an internet connection?
Yes. The default Lorem Ipsum source works fully offline. External services are optional.

### Are images hotlinked?
No. All images are downloaded locally and stored permanently in your WordPress Media Library, ensuring your site won't break if external services go down.

### Does it work with WooCommerce?
Yes. If WooCommerce is active, you can generate demo products with all the same options (images, taxonomies, etc.).

### What data is sent to external services?
Only the parameters needed to generate content (like number of paragraphs or image dimensions). No personal data, IP addresses, user information, or site data is transmitted.

### Can I avoid using external services completely?
Yes. Select "Lorem Ipsum (offline safe)" as your text source and skip image generation (or upload your own images). This allows you to generate content entirely offline.

### Can I delete generated content easily?
Currently, you'll need to delete posts manually from the WordPress admin. A bulk cleanup feature is planned for a future release.

### Does this work with custom post types?
Yes. Any public custom post type registered on your site will appear in the post type dropdown.

## Troubleshooting

### External API Not Responding
If external APIs are unavailable, the plugin will automatically fall back to offline Lorem Ipsum text generation. You'll see a notification about the fallback.

### Image Downloads Failing
- Try a different image source from the dropdown
- Check your server's network connectivity and firewall settings
- Verify your server can make outbound HTTPS requests
- Check PHP memory limits and execution time settings

### Generated Content Not Appearing
- Verify you have the correct permissions to create posts
- Check that the selected post type is valid and public
- Look for the success notification after generation
- Check your WordPress Posts/Pages list for the new content

### Character Limit Not Exact
The character limit is approximate to preserve paragraph structure and block markup. The plugin prioritizes readable content over exact character counts.

## Development

### Local Setup
```bash
# Clone the repository
git clone https://github.com/NaveenKharwar/lorem-blaster.git

# Navigate to your WordPress plugins directory
cd /path/to/wordpress/wp-content/plugins/

# Create symlink (or copy the folder)
ln -s /path/to/lorem-blaster lorem-blaster
```

### File Structure
```
lorem-blaster/
├── assets/
│   ├── admin.css
│   └── icon.png
├── languages/
│   └── lorem-blaster.pot
├── lorem-blaster.php (main plugin file)
├── readme.txt (WordPress.org readme)
├── README.md (GitHub readme)
└── LICENSE
```

### Coding Standards
- Follows WordPress Coding Standards
- All text strings are internationalized (i18n ready)
- Uses WordPress core functions for all operations
- Comprehensive input sanitization and validation

## Changelog

### 1.0.1 - 2026
- Enhanced external services documentation
- Improved security with proper nonce verification order
- Fixed direct core file loading issues
- Optimized $_POST data processing for better performance
- Added proper capability checks for enhanced security
- Updated readme with comprehensive service documentation

### 1.0.0 - 2026
- Initial release
- Support for posts, pages, and custom post types
- Multiple text and image sources
- Block editor compatibility
- Automatic taxonomy assignment
- Featured image support

## Roadmap

### Short Term
- ✅ WordPress.org compliance improvements
- ⬜ One-click cleanup for generated content
- ⬜ Bulk delete option with filtering

### Medium Term
- ⬜ Block pattern presets (landing page, product page, blog post)
- ⬜ Custom taxonomy term generation
- ⬜ More realistic excerpts generation
- ⬜ User role support (generate content as specific user)

### Long Term
- ⬜ Media packs with higher-resolution, less-repetitive imagery
- ⬜ WooCommerce product recipes (attributes, pricing, variations, stock)
- ⬜ Multisite support
- ⬜ Import/export generation presets
- ⬜ Scheduled content generation via WP-Cron

## Contributing

Contributions are welcome! Here's how you can help:

1. **Report Bugs:** Open an issue with detailed reproduction steps
2. **Suggest Features:** Describe your use case and proposed solution
3. **Submit Pull Requests:**
   - Fork the repository
   - Create a feature branch (`git checkout -b feature/AmazingFeature`)
   - Commit your changes (`git commit -m 'Add some AmazingFeature'`)
   - Push to the branch (`git push origin feature/AmazingFeature`)
   - Open a Pull Request with a clear description

### Code Contribution Guidelines
- Follow WordPress Coding Standards
- Include inline documentation for new functions
- Test with the latest WordPress version
- Ensure backwards compatibility with WordPress 6.0+
- Update README.md and readme.txt if needed

## Security

### Reporting Security Issues
If you discover a security vulnerability, please report it privately:
- **GitHub Security Advisory:** Use GitHub's private security reporting
- **Email:** Contact through GitHub profile
- **Do Not:** Create public issues for security vulnerabilities

### Security Features
- Nonce verification on all form submissions
- Capability checks before content generation
- Input sanitization and validation
- Safe handling of external API responses
- No direct file execution outside WordPress context

## License

This plugin is licensed under the GNU General Public License v2.0 or later.

```
Lorem Blaster - Generate demo content for WordPress
Copyright (C) 2024 Naveen Kharwar

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
```

See the [LICENSE](LICENSE) file for full license text.

## Credits

**Created by:** [Naveen Kharwar](https://github.com/NaveenKharwar)

### Acknowledgments
- WordPress Community
- External service providers (Bacon Ipsum, Hipster Ipsum, DummyJSON, Picsum, Unsplash, Placehold.co)
- All contributors and testers

### External Services
This plugin wouldn't be as versatile without these excellent free placeholder services:
- [Bacon Ipsum](https://baconipsum.com/) - Meat-themed Lorem Ipsum
- [Hipster Ipsum](https://hipsum.co/) - Hipster-themed placeholder text
- [DummyJSON](https://dummyjson.com/) - Realistic JSON placeholder data
- [Lorem Picsum](https://picsum.photos/) - Random placeholder images
- [Unsplash](https://unsplash.com/) - High-quality free photos
- [Placehold.co](https://placehold.co/) - Simple placeholder images

---

**Support this project:** ⭐ Star it on GitHub | 📝 Leave a review on WordPress.org | 🐛 Report issues | 💡 Suggest features
