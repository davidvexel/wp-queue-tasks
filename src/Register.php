<?php

namespace WPQueueTasks;
/**
 * Class Register
 */
class Register {

	/**
	 * Sets up all of the functionality to run in the proper hook
	 */
	public function setup() {

		// Registers the "queue" taxonomy
		add_action( 'init', [ $this, 'register_taxonomy' ] );

		// Registers the "task" post type
		add_action( 'init', [ $this, 'register_post_type' ] );

	}

	/**
	 * Registers the post-queue taxonomy
	 *
	 * @access public
	 * @return void
	 */
	public function register_taxonomy() {

		$labels = [
			'name'                       => __( 'Task queues', 'wp-queue-tasks' ),
			'singular_name'              => _x( 'Task queue', 'taxonomy general name', 'wp-queue-tasks' ),
			'search_items'               => __( 'Search task queues', 'wp-queue-tasks' ),
			'popular_items'              => __( 'Popular task queues', 'wp-queue-tasks' ),
			'all_items'                  => __( 'All task queues', 'wp-queue-tasks' ),
			'parent_item'                => __( 'Parent task queue', 'wp-queue-tasks' ),
			'parent_item_colon'          => __( 'Parent task queue:', 'wp-queue-tasks' ),
			'edit_item'                  => __( 'Edit task queue', 'wp-queue-tasks' ),
			'update_item'                => __( 'Update task queue', 'wp-queue-tasks' ),
			'add_new_item'               => __( 'New task queue', 'wp-queue-tasks' ),
			'new_item_name'              => __( 'New task queue', 'wp-queue-tasks' ),
			'separate_items_with_commas' => __( 'Separate task queues with commas', 'wp-queue-tasks' ),
			'add_or_remove_items'        => __( 'Add or remove task queues', 'wp-queue-tasks' ),
			'choose_from_most_used'      => __( 'Choose from the most used task queues', 'wp-queue-tasks' ),
			'not_found'                  => __( 'No task queues found.', 'wp-queue-tasks' ),
			'menu_name'                  => __( 'Task queues', 'wp-queue-tasks' ),
		];

		$args = [
			'hierarchical'          => false,
			'public'                => false,
			'show_in_nav_menus'     => true,
			'show_ui'               => Utils::debug_on(),
			'show_admin_column'     => false,
			'query_var'             => true,
			'rewrite'               => false,
			'labels'                => $labels,
			'show_in_rest'          => true,
			'rest_base'             => 'task-queue',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
			'show_in_graphql'       => true,
			'graphql_single_name'   => 'queue',
			'graphql_plural_name'   => 'queues',
		];

		register_taxonomy( 'task-queue', 'wpqt-task', $args );

	}

	/**
	 * Registers the task post type
	 *
	 * @access public
	 * @return void
	 */
	public function register_post_type() {

		$labels = [
			'name'               => __( 'Queue Tasks', 'wp-queue-tasks' ),
			'singular_name'      => __( 'Queue Task', 'wp-queue-tasks' ),
			'all_items'          => __( 'All Queue Tasks', 'wp-queue-tasks' ),
			'new_item'           => __( 'New Queue Task', 'wp-queue-tasks' ),
			'add_new'            => __( 'Add New', 'wp-queue-tasks' ),
			'add_new_item'       => __( 'Add New Queue Task', 'wp-queue-tasks' ),
			'edit_item'          => __( 'Edit Queue Task', 'wp-queue-tasks' ),
			'view_item'          => __( 'View Queue Task', 'wp-queue-tasks' ),
			'search_items'       => __( 'Search Queue Tasks', 'wp-queue-tasks' ),
			'not_found'          => __( 'No Queue Tasks found', 'wp-queue-tasks' ),
			'not_found_in_trash' => __( 'No Queue Tasks found in trash', 'wp-queue-tasks' ),
			'parent_item_colon'  => __( 'Parent Queue Task', 'wp-queue-tasks' ),
			'menu_name'          => __( 'Queue Tasks', 'wp-queue-tasks' ),
		];

		$args = [
			'labels'                => $labels,
			'public'                => false,
			'hierarchical'          => false,
			'show_ui'               => Utils::debug_on(),
			'show_in_nav_menus'     => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'show_in_menu'          => true,
			'supports'              => [ 'title', 'editor' ],
			'has_archive'           => false,
			'rewrite'               => false,
			'query_var'             => true,
			'capabilities'          => [
				'edit_posts'    => 'read',
				'publish_posts' => 'read',
			],
			'show_in_rest'          => true,
			'rest_base'             => 'wpqt-task',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'show_in_graphql'       => true,
			'graphql_single_name'   => 'task',
			'graphql_plural_name'   => 'tasks',
		];

		register_post_type( 'wpqt-task', $args );

	}

}
