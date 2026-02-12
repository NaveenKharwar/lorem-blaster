<?php
/**
 * Plugin Name: Lorem Blaster
 * Plugin URI: https://github.com/NaveenKharwar/lorem-blaster/blob/main/README.md
 * Description: Generate block-based sample posts, pages, products, or custom post types with full control over length, images, and taxonomies.
 * Version: 1.0.1
 * Author: Naveen Kharwar
 * License: GPLv2 or later
 * Text Domain: lorem-blaster
 * Domain Path: /languages
 */

if (!defined("ABSPATH")) {
    exit();
}

class Lorem_Blaster
{
    public function __construct()
    {
        add_action("admin_menu", [$this, "add_admin_page"]);
        add_action("admin_post_lorem_blaster_generate", [
            $this,
            "handle_generate",
        ]);
        add_action("admin_enqueue_scripts", [$this, "enqueue_admin_assets"]);
    }

    /* ---------------------------------------------------------
     * Assets
     * --------------------------------------------------------- */

    public function enqueue_admin_assets($hook)
    {
        $allowed_hooks = ["toplevel_page_lorem-blaster"];

        if (!in_array($hook, $allowed_hooks, true)) {
            return;
        }

        wp_enqueue_style(
            "lorem-blaster-admin",
            plugin_dir_url(__FILE__) . "assets/admin.css",
            [],
            "1.0.1",
        );
    }

    /* ---------------------------------------------------------
     * Admin Page
     * --------------------------------------------------------- */

    public function add_admin_page()
    {
        add_menu_page(
            esc_html__("Lorem Blaster", "lorem-blaster"),
            esc_html__("Lorem Blaster", "lorem-blaster"),
            "manage_options",
            "lorem-blaster",
            [$this, "render_admin_page"],
            $this->get_menu_icon(),
            58,
        );
    }

    public function render_admin_page()
    {
        $post_types = get_post_types(["public" => true], "objects"); ?>
		<div class="lb-wrap">

			<div class="lb-title-wrap">
				<h1 class="lb-title"><?php esc_html_e("Lorem Blaster", "lorem-blaster"); ?></h1>
				<span class="lb-author-tag"><?php esc_html_e(
        "By Naveen Kharwar",
        "lorem-blaster",
    ); ?></span>
			</div>

			<p class="description">
				<?php esc_html_e(
        "Lorem Blaster helps you generate realistic demo content for themes, layouts, and WooCommerce stores. All content is created using block editor markup and public placeholder APIs.",
        "lorem-blaster",
    ); ?>
			</p>

			<div class="lb-notice lb-notice--spaced">
				<strong><?php esc_html_e(
        "Important notes before generating content",
        "lorem-blaster",
    ); ?></strong>
				<ul>
					<li><?php esc_html_e(
         "Some content sources rely on external APIs and may fall back to classic Lorem Ipsum if unavailable.",
         "lorem-blaster",
     ); ?></li>
					<li><?php esc_html_e(
         "Images are fetched from public placeholder services and stored locally in your Media Library.",
         "lorem-blaster",
     ); ?></li>
					<li><?php esc_html_e(
         "Character limits are approximate to preserve paragraph and block structure.",
         "lorem-blaster",
     ); ?></li>
				</ul>
			</div>

			<?php
   $last_run = get_transient("lorem_blaster_last_run");
   if ($last_run && is_array($last_run)):
       delete_transient("lorem_blaster_last_run"); ?>
				<div class="lb-notice">
					<strong><?php esc_html_e(
         "Content generated successfully",
         "lorem-blaster",
     ); ?></strong>
					<ul>
						<?php foreach ($last_run as $post_id): ?>
							<li>
								<a href="<?php echo esc_url(get_edit_post_link($post_id)); ?>">
									<?php echo esc_html(get_the_title($post_id)); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php
   endif;
   ?>

			<?php
   $run_notices = get_transient("lorem_blaster_last_run_notices");
   $has_notice = is_array($run_notices) && array_sum($run_notices) > 0;
   if ($has_notice):
       delete_transient("lorem_blaster_last_run_notices"); ?>
				<div class="lb-notice">
					<strong><?php esc_html_e("Generation notes", "lorem-blaster"); ?></strong>
					<ul>
						<?php if (!empty($run_notices["text_fallback"])): ?>
							<li>
								<?php echo esc_html(
            sprintf(
                /* translators: %d: number of posts */
                _n(
                    "Used offline Lorem Ipsum for %d post because the selected text API did not respond.",
                    "Used offline Lorem Ipsum for %d posts because the selected text API did not respond.",
                    $run_notices["text_fallback"],
                    "lorem-blaster",
                ),
                $run_notices["text_fallback"],
            ),
        ); ?>
							</li>
						<?php endif; ?>

						<?php if (!empty($run_notices["image_fallback"])): ?>
							<li>
								<?php echo esc_html(
            sprintf(
                /* translators: %d: number of images */
                _n(
                    "Switched to Picsum for %d image because the selected source failed.",
                    "Switched to Picsum for %d images because the selected source failed.",
                    $run_notices["image_fallback"],
                    "lorem-blaster",
                ),
                $run_notices["image_fallback"],
            ),
        ); ?>
							</li>
						<?php endif; ?>

						<?php if (!empty($run_notices["image_failed"])): ?>
							<li>
								<?php echo esc_html(
            sprintf(
                /* translators: %d: number of images */
                _n(
                    "Could not download an image for %d post.",
                    "Could not download images for %d posts.",
                    $run_notices["image_failed"],
                    "lorem-blaster",
                ),
                $run_notices["image_failed"],
            ),
        ); ?>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			<?php
   endif;
   ?>

			<form method="post" action="<?php echo esc_url(
       admin_url("admin-post.php"),
   ); ?>" class="lb-card">
				<input type="hidden" name="action" value="lorem_blaster_generate">
				<?php wp_nonce_field("lorem_blaster_nonce", "lorem_blaster_nonce_field"); ?>

				<div class="lb-grid">

					<div>
						<label><?php esc_html_e("Content Source", "lorem-blaster"); ?></label>
						<select name="source">
							<option value="lorem"><?php esc_html_e(
           "Lorem Ipsum (offline safe)",
           "lorem-blaster",
       ); ?></option>
							<option value="bacon"><?php esc_html_e(
           "Bacon Ipsum (API)",
           "lorem-blaster",
       ); ?></option>
							<option value="hipster"><?php esc_html_e(
           "Hipster Ipsum (API)",
           "lorem-blaster",
       ); ?></option>
							<option value="dummyjson"><?php esc_html_e(
           "DummyJSON (API)",
           "lorem-blaster",
       ); ?></option>
						</select>
						<p class="description">
							<?php esc_html_e(
           "Select where the placeholder text should come from. API-based sources may fall back automatically.",
           "lorem-blaster",
       ); ?>
						</p>
					</div>

					<div>
						<label><?php esc_html_e("Number of Posts", "lorem-blaster"); ?></label>
						<input type="number" name="count" min="1" max="100" value="5">
						<p class="description">
							<?php esc_html_e(
           "How many items should be generated in one run. Large numbers may take longer.",
           "lorem-blaster",
       ); ?>
						</p>
					</div>

					<div>
						<label><?php esc_html_e("Max Characters per Post", "lorem-blaster"); ?></label>
						<input type="number" name="char_limit" min="50" max="5000" value="500">
						<p class="description">
							<?php esc_html_e(
           "Approximate content length. Text is trimmed safely to preserve block structure.",
           "lorem-blaster",
       ); ?>
						</p>
					</div>

					<div>
						<label><?php esc_html_e("Post Type", "lorem-blaster"); ?></label>
						<select name="post_type">
							<?php foreach ($post_types as $type): ?>
								<option value="<?php echo esc_attr($type->name); ?>">
									<?php echo esc_html($type->labels->singular_name); ?>
								</option>
							<?php endforeach; ?>
						</select>
						<p class="description">
							<?php esc_html_e(
           "Choose which post type should receive the generated content.",
           "lorem-blaster",
       ); ?>
						</p>
					</div>

					<div>
						<label><?php esc_html_e("Image Source", "lorem-blaster"); ?></label>
						<select name="image_source">
							<option value="picsum">Picsum</option>
							<option value="unsplash">Unsplash</option>
							<option value="placehold">Placehold</option>
						</select>
						<p class="description">
							<?php esc_html_e(
           "Images are downloaded and stored locally to avoid hotlinking.",
           "lorem-blaster",
       ); ?>
						</p>
					</div>

				</div>

				<div class="lb-checkbox">
					<strong><?php esc_html_e("Generation Options", "lorem-blaster"); ?></strong>

					<label>
						<input type="checkbox" name="content_image">
						<?php esc_html_e("Include image block inside content", "lorem-blaster"); ?>
					</label>

					<label>
						<input type="checkbox" name="featured_image">
						<?php esc_html_e("Set featured image", "lorem-blaster"); ?>
					</label>

					<label>
						<input type="checkbox" name="auto_terms" checked>
						<?php esc_html_e(
          "Automatically assign taxonomies and tags",
          "lorem-blaster",
      ); ?>
					</label>

					<p class="description">
						<?php esc_html_e(
          "These options control how content is enhanced after generation.",
          "lorem-blaster",
      ); ?>
					</p>
				</div>

				<button type="submit" class="lb-button">
					<?php esc_html_e("Generate Content", "lorem-blaster"); ?>
				</button>
			</form>
		</div>
		<?php
    }

    /* ---------------------------------------------------------
     * Generator
     * --------------------------------------------------------- */

    public function handle_generate()
    {
        // Check if this is a POST request
        if (
            !isset($_SERVER["REQUEST_METHOD"]) ||
            "POST" !== $_SERVER["REQUEST_METHOD"]
        ) {
            wp_die(esc_html__("Invalid request method.", "lorem-blaster"));
        }

        // Verify nonce FIRST before processing any $_POST data
        $raw_nonce = isset($_POST["lorem_blaster_nonce_field"])
            ? sanitize_text_field(
                wp_unslash($_POST["lorem_blaster_nonce_field"]),
            )
            : "";

        if (
            "" === $raw_nonce ||
            !wp_verify_nonce($raw_nonce, "lorem_blaster_nonce")
        ) {
            wp_die(esc_html__("Security check failed.", "lorem-blaster"));
        }

        // Check user permissions AFTER nonce verification
        if (!current_user_can("manage_options")) {
            wp_die(
                esc_html__(
                    "You are not allowed to do this action.",
                    "lorem-blaster",
                ),
            );
        }

        // Load media dependencies only when needed
        $this->load_media_dependencies();

        // Process ONLY the specific fields needed (not the whole $_POST)
        $count = isset($_POST["count"])
            ? max(1, min(100, absint($_POST["count"])))
            : 5;
        $char_limit = isset($_POST["char_limit"])
            ? max(50, min(5000, absint($_POST["char_limit"])))
            : 500;
        $source = isset($_POST["source"])
            ? sanitize_key(wp_unslash($_POST["source"]))
            : "lorem";
        $post_type = isset($_POST["post_type"])
            ? sanitize_key(wp_unslash($_POST["post_type"]))
            : "post";
        $image_src = isset($_POST["image_source"])
            ? sanitize_key(wp_unslash($_POST["image_source"]))
            : "picsum";

        // Validate source
        $allowed_sources = ["lorem", "bacon", "hipster", "dummyjson"];
        if (!in_array($source, $allowed_sources, true)) {
            $source = "lorem";
        }

        // Validate image source
        $allowed_images = ["picsum", "unsplash", "placehold"];
        if (!in_array($image_src, $allowed_images, true)) {
            $image_src = "picsum";
        }

        // Validate post type
        if (!post_type_exists($post_type)) {
            wp_die(esc_html__("Invalid post type selected.", "lorem-blaster"));
        }

        // Process checkboxes
        $content_image = isset($_POST["content_image"]);
        $featured_image = isset($_POST["featured_image"]);
        $auto_terms = isset($_POST["auto_terms"]);

        $created_posts = [];
        $run_notices = [
            "text_fallback" => 0,
            "image_fallback" => 0,
            "image_failed" => 0,
        ];

        for ($i = 0; $i < $count; $i++) {
            $used_text_fallback = false;
            $text = mb_substr(
                trim(
                    $this->get_content(
                        $source,
                        $char_limit,
                        $used_text_fallback,
                    ),
                ),
                0,
                $char_limit,
            );
            if ($used_text_fallback) {
                $run_notices["text_fallback"]++;
            }

            $image_id = 0;
            if ($content_image || $featured_image) {
                $used_image_fallback = false;
                $image_failed = false;
                $image_id = $this->download_image(
                    $image_src,
                    $used_image_fallback,
                    $image_failed,
                );

                if ($used_image_fallback) {
                    $run_notices["image_fallback"]++;
                }

                if ($image_failed) {
                    $run_notices["image_failed"]++;
                }
            }

            $blocks = $this->build_block_content(
                $text,
                $content_image,
                $image_id,
            );

            $post_title = wp_trim_words($text, 6, "...");
            if ("" === trim($post_title)) {
                $post_title = esc_html__("Sample Content", "lorem-blaster");
            }

            $post_id = wp_insert_post([
                "post_title" => $post_title,
                "post_content" => $blocks,
                "post_status" => "publish",
                "post_type" => $post_type,
            ]);

            if (is_wp_error($post_id)) {
                continue;
            }

            if ($post_id && $featured_image && $image_id) {
                set_post_thumbnail($post_id, $image_id);
            }

            if ($post_id && $auto_terms) {
                $this->assign_auto_terms($post_id, $post_type);
            }

            if ($post_id) {
                $created_posts[] = $post_id;
            }
        }

        set_transient(
            "lorem_blaster_last_run",
            $created_posts,
            MINUTE_IN_SECONDS,
        );
        set_transient(
            "lorem_blaster_last_run_notices",
            $run_notices,
            MINUTE_IN_SECONDS,
        );
        wp_safe_redirect(admin_url("admin.php?page=lorem-blaster"));
        exit();
    }

    /* ---------------------------------------------------------
     * Helpers
     * --------------------------------------------------------- */

    private function get_content($source, $char_limit, &$used_fallback = false)
    {
        $fallback_seed = __(
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "lorem-blaster",
        );
        $fallback = trim(
            str_repeat(
                $fallback_seed . " ",
                max(
                    1,
                    (int) ceil($char_limit / max(1, mb_strlen($fallback_seed))),
                ),
            ),
        );

        $desired_paras = max(2, min(12, (int) ceil($char_limit / 300)));
        $dummy_limit = max(1, min(10, (int) ceil($char_limit / 200)));

        $urls = [
            "bacon" =>
                "https://baconipsum.com/api/?paras=" .
                $desired_paras .
                "&type=meat-and-filler",
            "hipster" =>
                "https://hipsum.co/api/?paras=" .
                $desired_paras .
                "&type=hipster-centric",
            "dummyjson" => "https://dummyjson.com/posts?limit=" . $dummy_limit,
        ];

        if (!isset($urls[$source])) {
            $used_fallback = true;
            return $fallback;
        }

        $max_attempts = 5;
        $combined = "";

        for ($attempt = 0; $attempt < $max_attempts; $attempt++) {
            $chunk = $this->fetch_content_from_api($urls[$source]);
            if ("" !== $chunk) {
                $combined =
                    "" === $combined ? $chunk : $combined . "\n\n" . $chunk;
            }

            if (mb_strlen($combined) >= $char_limit) {
                break;
            }
        }

        if ("" !== trim($combined)) {
            return $combined;
        }

        $used_fallback = true;
        return $fallback;
    }

    private function fetch_content_from_api($url)
    {
        $response = wp_remote_get($url, [
            "timeout" => 10,
            "redirection" => 5,
            "user-agent" => "Lorem Blaster WordPress Plugin",
            "headers" => [
                "Accept" => "application/json",
            ],
        ]);

        if (is_wp_error($response)) {
            return "";
        }

        $code = wp_remote_retrieve_response_code($response);
        if ($code < 200 || $code >= 300) {
            return "";
        }

        $body = wp_remote_retrieve_body($response);
        if ("" === trim((string) $body)) {
            return "";
        }

        $data = json_decode($body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return "";
        }

        if (is_array($data)) {
            if (isset($data["posts"]) && is_array($data["posts"])) {
                $parts = [];
                foreach ($data["posts"] as $post) {
                    if (
                        is_array($post) &&
                        isset($post["body"]) &&
                        is_string($post["body"])
                    ) {
                        $parts[] = trim($post["body"]);
                    }
                }

                if ($parts) {
                    return implode("\n\n", $parts);
                }
            }

            if (isset($data["body"]) && is_string($data["body"])) {
                return trim($data["body"]);
            }

            $parts = [];
            foreach ($data as $item) {
                if (is_string($item) && "" !== trim($item)) {
                    $parts[] = trim($item);
                }
            }

            if ($parts) {
                return implode("\n\n", $parts);
            }
        }

        if (is_string($data) && "" !== trim($data)) {
            return trim($data);
        }

        return "";
    }

    private function build_block_content($text, $include_image, $image_id)
    {
        $output = "";

        foreach (preg_split("/\n\s*\n/", $text) as $para) {
            $output .=
                "<!-- wp:paragraph -->\n<p>" .
                esc_html(trim($para)) .
                "</p>\n<!-- /wp:paragraph -->\n";
        }

        if ($include_image && $image_id) {
            $url = wp_get_attachment_url($image_id);
            $output .=
                "<!-- wp:image -->\n<figure class=\"wp-block-image\"><img src=\"" .
                esc_url($url) .
                "\" alt=\"\" /></figure>\n<!-- /wp:image -->\n";
        }

        return $output;
    }

    private function load_media_dependencies()
    {
        // Only load if functions don't already exist
        if (!function_exists("media_handle_sideload")) {
            require_once ABSPATH . "wp-admin/includes/file.php";
            require_once ABSPATH . "wp-admin/includes/media.php";
            require_once ABSPATH . "wp-admin/includes/image.php";
        }
    }

    private function download_image(
        $source,
        &$used_fallback = false,
        &$failed = false,
    ) {
        $urls = [
            "unsplash" => "https://source.unsplash.com/1200x800/?design",
            "placehold" => "https://placehold.co/1200x800/png",
            "picsum" => "https://picsum.photos/1200/800",
        ];

        $primary = $urls[$source] ?? $urls["picsum"];
        $candidates = [$primary];
        if ($primary !== $urls["picsum"]) {
            $candidates[] = $urls["picsum"];
        }

        foreach ($candidates as $index => $candidate) {
            $tmp = download_url($candidate, 10);

            if (is_wp_error($tmp)) {
                continue;
            }

            $mime = wp_get_image_mime($tmp);
            if (!$mime || 0 !== strpos($mime, "image/")) {
                wp_delete_file($tmp);
                continue;
            }

            $ext = $this->map_image_extension($mime);

            $file = [
                "name" => "lorem-blaster-" . time() . "." . $ext,
                "tmp_name" => $tmp,
            ];

            $id = media_handle_sideload($file, 0);

            if (is_wp_error($id)) {
                wp_delete_file($tmp);
                continue;
            }

            if (0 < $index) {
                $used_fallback = true;
            }

            return $id;
        }

        $failed = true;
        return 0;
    }

    private function get_menu_icon()
    {
        return plugin_dir_url(__FILE__) . "assets/icon.png";
    }

    private function map_image_extension($mime)
    {
        $map = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/gif" => "gif",
            "image/webp" => "webp",
        ];

        return $map[$mime] ?? "jpg";
    }

    private function assign_auto_terms($post_id, $post_type)
    {
        foreach (get_object_taxonomies($post_type) as $taxonomy) {
            wp_set_object_terms(
                $post_id,
                ["Sample", "Demo", ucfirst($post_type)],
                $taxonomy,
                false,
            );
        }
    }
}

new Lorem_Blaster();
