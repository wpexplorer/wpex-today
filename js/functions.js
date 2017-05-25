 /**
 * Theme functions
 * Initialize all scripts and adds custom js
 *
 * @since 1.0.0
 *
 */

( function( $ ) {

	'use strict';

	var wpexFunctions = {

		/**
		 * Define cache var
		 *
		 * @since 1.0.0
		 */
		cache: {},

		/**
		 * Main Function
		 *
		 * @since 1.0.0
		 */
		init: function() {
			this.cacheElements();
			this.bindEvents();
		},

		/**
		 * Cache Elements
		 *
		 * @since 1.0.0
		 */
		cacheElements: function() {
			this.cache = {
				$window   : $( window ),
				$document : $( document )
			};
		},

		/**
		 * Bind Events
		 *
		 * @since 1.0.0
		 */
		bindEvents: function() {

			// Get sef
			var self = this;

			// Run on document ready
			self.cache.$document.on( 'ready', function() {
				self.coreFunctions();
				self.scrollTop();
				self.mobileMenu();
			} );
		},

		/**
		 * Main theme functions
		 *
		 * @since 1.0.0
		 */
		coreFunctions: function() {

			var self = this;
		   
			// Add class to last pingback for styling purposes
			$( ".commentlist li.pingback" ).last().addClass( 'last' );

			// Touch event for dropdowns
			$( '.wpex-dropdown-menu li.menu-item-has-children' ).on( 'touchstart', function( event ) {
				$( this ).toggleClass( 'wpex-touched' );
			} );

			// Responsive videos
			$( '.wpex-responsive-embed' ).fitVids( {
				ignore: '.wpex-fitvids-ignore'
			} );
			$( '.wpex-responsive-embed' ).addClass( 'wpex-show' );

			// Social share scroll to
			$( '.wpex-post-share .wpex-comment a, .single .comments-link' ).click( function() {
				var $target = $( '#comments' );
				if ( $target.length ) {
					$( 'html,body' ).animate({
						scrollTop: $target.offset().top - 30
					}, 1000 );
			      }
				return false;
			} );

		},

		/**
		 * Mobile menu
		 *
		 * Custom code by WPExplorer.com - do not steal !!!
		 *
		 * @since 1.0.0
		 */
		mobileMenu: function() {

			self = this;

			// Site nav
			var $siteNav = $( '.wpex-site-nav' );

			// No site nav
			if ( ! $siteNav.length ) {
				return;
			}

			// Prepend Mobile menu
			$siteNav.after( '<nav class="wpex-mobile-nav"></nav>' );

			// Nav content
			if ( $( '.wpex-mobile-menu-alt' ).length ) {
				var $menuContainer = $( '.wpex-mobile-menu-alt .wpex-dropdown-menu' );
			} else {
				var $menuContainer = $siteNav.find( '.wpex-dropdown-menu' );
			}

			// Return if no nav
			if ( ! $menuContainer.length ) {
				return;
			}

			// Grab all content from menu
			var $menuContents = $menuContainer.html();

			// Get mobile nav object
			var $mobileNav = $( '.wpex-mobile-nav' );

			// Add all content to mobile nav
			$mobileNav.html( '<ul class="wpex-mobile-nav-ul wpex-container">' + $menuContents + '</ul>' );

			// Declare mobile nav ul
			var $mobileNavUl = $( '.wpex-mobile-nav-ul' );

			// Remove all classes inside prepended nav
			$( '.wpex-mobile-nav-ul, .wpex-mobile-nav-ul *' ).children().each(function() {
				var attributes = this.attributes;
				$( this ).removeAttr( 'style' );
			} );

			// Declare vars
			var $mobileNavToggle = $( '.wpex-mobile-nav-toggle' ),
				$mobileNavIcon   = $( '.wpex-mobile-nav-toggle-icon' );

			// Main toggle
			$mobileNavToggle.on( 'click', function() {
				if ( $mobileNav.hasClass( 'wpex-visible' ) ) {
					$mobileNav.removeClass( 'wpex-visible' );
					$mobileNavIcon.addClass( 'fa-bars' );
					$mobileNavIcon.removeClass( 'fa-times' );
				} else {
					$mobileNav.addClass( 'wpex-visible' );
					$mobileNavIcon.addClass( 'fa-times' );
					$mobileNavIcon.removeClass( 'fa-bars' );
				}
				return false; // Better support for theme customizer
			} );

			// Close on orientation change
			$( window ).on( 'orientationchange', function() {
				if ( $mobileNav.hasClass( 'wpex-visible' ) ) {
					$mobileNav.hide();
					$mobileNavIcon.removeClass( 'fa-times' );
					$mobileNavIcon.addClass( 'fa-bars' );
					$mobileNavText.text( wpexLocalize.mobileMenuOpen );
				}
			} );

			// All items with dropdowns
			var $mobileNavSubMenuParents = $mobileNavUl.find( 'li.menu-item-has-children' );

			// Add plus icons to menu items with children
			$mobileNavSubMenuParents.each( function() {
				$( this ).children( 'a' ).append( '<span class="wpex-mobile-nav-plus-icon fa fa-plus"></span>' );
			} );

			// Add toggle click event
			$mobileNavUl.find( 'li.menu-item-has-children > a' ).on( 'click', function( ) {

				// Define toggle vars
				var $toggleParentLi = $( this ).parent( 'li' ),
					$allParentLis   = $toggleParentLi.parents( 'li' ),
					$dropdown       = $toggleParentLi.children( 'ul' );

				// Toogle items
				if ( ! $toggleParentLi.hasClass( 'wpex-active' ) ) {
					$mobileNavSubMenuParents.not( $allParentLis ).removeClass( 'wpex-active' ).children( 'ul' ).removeClass( 'wpex-visible' );
					$toggleParentLi.addClass( 'wpex-active' ).children( 'ul' ).addClass( 'wpex-visible' );
				} else {
					$toggleParentLi.removeClass( 'wpex-active' ).children( 'ul' ).removeClass( 'wpex-visible' );
				}

				// Return false
				return false;

			} );

		},

		/**
		 * Scroll top function
		 *
		 * @since 1.0.0
		 */
		scrollTop: function() {

			var $scrollTopLink = $( 'a.wpex-site-scroll-top' );

			this.cache.$window.scroll(function () {
				if ( $( this ).scrollTop() > 100 ) {
					$scrollTopLink.addClass( 'show' );
				} else {
					$scrollTopLink.removeClass( 'show' );
				}
			} );

			$scrollTopLink.on( 'click', function() {
				$( 'html, body' ).animate( {
					scrollTop : 0
				}, 400 );
				return false;
			} );

		},

	}; // END wpexFunctions

	// Get things going
	wpexFunctions.init();

} ) ( jQuery );