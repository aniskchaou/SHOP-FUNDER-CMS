<?php

namespace VisualComposer\Modules\Vendors;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use VisualComposer\Framework\Container;
use VisualComposer\Framework\Illuminate\Support\Module;
use VisualComposer\Helpers\Traits\WpFiltersActions;

class DashboardController extends Container implements Module
{
    use WpFiltersActions;

    protected $itemsCount = 3;

    public function __construct()
    {
        $this->wpAddAction('wp_dashboard_setup', 'createNewsWidget', 1000);
        $this->wpAddAction('wp_network_dashboard_setup', 'createNewsWidget', 1000);
    }

    /**
     * Create Visual Composer News Widget in WordPress Dashboard, and place it at top
     */
    protected function createNewsWidget()
    {
        wp_add_dashboard_widget(
            'visualcomposer-blog-dashboard',
            esc_html__('Visual Composer News', 'visualcomposer'),
            function () {
                $rssItems = $this->getRssData();
                evcview('vendors/dashboard', ['rssItems' => $rssItems]);
            }
        );

        // @codingStandardsIgnoreLine
        global $wp_meta_boxes;

        // @codingStandardsIgnoreLine
        $dashboardWidgets = $wp_meta_boxes['dashboard']['normal']['core'];
        $visualcomposerBlogDashboard = ['visualcomposer-blog-dashboard' => $dashboardWidgets['visualcomposer-blog-dashboard']];

        unset($dashboardWidgets['visualcomposer-blog-dashboard']);
        $sortedDashboardWidgets = array_merge($visualcomposerBlogDashboard, $dashboardWidgets);

        // @codingStandardsIgnoreLine
        $wp_meta_boxes['dashboard']['normal']['core'] = $sortedDashboardWidgets;
    }

    /**
     * Get RSS Data
     * @return array|bool|null
     */
    protected function getRssData()
    {
        $result = false;
        $rss = fetch_feed('https://visualcomposer.com/blog/feed/');
        if (!is_wp_error($rss)) {
            $maxItems = $rss->get_item_quantity($this->itemsCount);
            $result = $rss->get_items(0, $maxItems);
        }

        return $result;
    }
}
