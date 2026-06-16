<?php
/**
 * GitHub Theme Auto-Updater
 *
 * @package RareFolk
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Rarefolk_Theme_Updater {

    private $theme_slug;
    private $github_repo;
    private $branch;
    private $theme_path;

    public function __construct() {
        $this->theme_slug  = 'rarefolk-theme';
        $this->github_repo = 'Hunter28-lucky/Rare-Folk-Luxury-E-Commerce';
        $this->branch      = 'main';
        $this->theme_path  = 'rarefolk-theme';

        // Check for updates
        add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_update' ) );
        
        // Correct source selection for subdirectory
        add_filter( 'upgrader_source_selection', array( $this, 'correct_source_selection' ), 10, 4 );
    }

    /**
     * Get local theme version
     */
    private function get_local_version() {
        $theme = wp_get_theme( $this->theme_slug );
        return $theme->exists() ? $theme->get( 'Version' ) : '0.0.0';
    }

    /**
     * Check GitHub for a newer version
     */
    public function check_update( $transient ) {
        if ( empty( $transient->checked ) ) {
            return $transient;
        }

        $local_version = $this->get_local_version();
        $cache_key     = 'rarefolk_theme_update_check';
        $update_data   = get_transient( $cache_key );

        if ( false === $update_data ) {
            // Get style.css from GitHub to check version
            $url = "https://raw.githubusercontent.com/{$this->github_repo}/{$this->branch}/{$this->theme_path}/style.css";
            $response = wp_safe_remote_get( $url );

            if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
                $content = wp_remote_retrieve_body( $response );
                preg_match( '/Version:\s*(.*)/i', $content, $matches );
                
                if ( ! empty( $matches[1] ) ) {
                    $remote_version = trim( $matches[1] );
                    $update_data = array(
                        'version' => $remote_version,
                    );
                    set_transient( $cache_key, $update_data, 12 * HOUR_IN_SECONDS );
                }
            }
        }

        if ( ! empty( $update_data['version'] ) ) {
            $remote_version = $update_data['version'];

            // Compare versions
            if ( version_compare( $local_version, $remote_version, '<' ) ) {
                $download_url = "https://github.com/{$this->github_repo}/archive/refs/heads/{$this->branch}.zip";
                
                $transient->response[ $this->theme_slug ] = array(
                    'theme'       => $this->theme_slug,
                    'new_version' => $remote_version,
                    'url'         => "https://github.com/{$this->github_repo}",
                    'package'     => $download_url,
                );
            }
        }

        return $transient;
    }

    /**
     * Correct selection of subdirectory from zipped repository
     */
    public function correct_source_selection( $source, $remote_source, $upgrader, $hook_extra ) {
        global $wp_filesystem;

        $source_dir = trailingslashit( $source );
        
        // Check if selection contains repository name or ZIP name
        if ( strpos( basename( $source_dir ), 'Rare-Folk-Luxury-E-Commerce' ) !== false ) {
            $subdir = $source_dir . $this->theme_path . '/';
            if ( $wp_filesystem->exists( $subdir . 'style.css' ) ) {
                return $subdir;
            }
        }

        return $source;
    }
}

new Rarefolk_Theme_Updater();
