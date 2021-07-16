import 'script-loader!jquery';
import 'script-loader!jquery-match-height';
import 'script-loader!bootstrap';
import 'script-loader!lightslider';
import 'script-loader!slick-carousel';
import 'script-loader!sticky-scroll';
import 'script-loader!smartmenus';
import 'script-loader!table2csv';
import 'hamburgers/dist/hamburgers.css';
import retina from 'retinajs';
import AOS from 'aos';
import velocity from 'velocity-animate';
import fontawesome from '@fortawesome/fontawesome';
import faSolid from '@fortawesome/fontawesome-free-solid';
import faBrands from '@fortawesome/fontawesome-free-brands';
import fancybox from '@fancyapps/fancybox';
import 'smartmenus/dist/css/sm-core-css.css';
import 'smartmenus/dist/css/sm-simple/sm-simple.scss';
import 'slick-carousel/slick/slick.scss';
import 'slick-carousel/slick/slick-theme.scss';
import '../scss/entry.scss';

jQuery(document).ready(function($) {

	// tab content block
	$('.ffw-tabber').on('click', function() {
		$(this).siblings().removeClass('active');
	});

	// hamburger stuffs
	var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};
	var hamburgers = document.querySelectorAll(".hamburger");
	if (hamburgers.length > 0) {
		forEach(hamburgers, function(hamburger) {
			hamburger.addEventListener("click", function() {
				this.classList.toggle("is-active");
			}, false);
		});
	}

	// accordions
	$('.accordion-toggle').on('click', function() {
		$(this).next('.accordion-toggled').slideToggle('fast');
		$(this).siblings('.swoop').toggleClass('swoop-bottom swoop-top');
		$(this).children('.accordion-arrow').toggleClass('arrow-down arrow-up');
	});

	// match height
	$(function() {
		$('.match-height').matchHeight();
	});

	// header search toggle
	$('#search-toggle').on('click', function() {
		$(this).toggleClass('glass').toggleClass('close');
		$('#search-box').toggleClass('open');
		$('#top-search').focus();
	});

	// fancybox
	$(document).ready(function() {
		$("a.fancybox").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	false
		});
	});

	// add responsive class to all images
	$(function() {
		$('img').addClass('img-fluid');
	});

	// primary menu
	$(function() {
		$('.sm').smartmenus({
			subMenusSubOffsetX: 1,
			subMenusSubOffsetY: -3
		});
	});

	// primary navigation toggle
	$('.nav-toggle').on('click', function() {
		$('.primary-nav-wrap').slideToggle('fast');
	});

	// scroll back to top button
	$(document).ready(function($){
		// browser window scroll (in pixels) after which the "back to top" link is shown
		var offset = 300,
			//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
			offset_opacity = 1200,
			//duration of the top scrolling animation (in ms)
			scroll_top_duration = 300,
			//grab the "back to top" link
			$back_to_top = $('.cd-top');
		//hide or show the "back to top" link
		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
			if( $(this).scrollTop() > offset_opacity ) { 
				$back_to_top.addClass('cd-fade-out');
			}
		});
		//smooth scroll to top
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
				}, scroll_top_duration
			);
		});
	});

	// acf slider
	$('.slider-prev').on('click', function(){
		$(this).parent().prev().slick('slickPrev');
	});
	$('.slider-next').on('click', function(){
		$(this).parent().prev().slick('slickNext');
	});

	// csv exports
	$(document).ready(function() {
		$('#example-dl').on('click', function() {
			$("#example-csv").table2csv({
				filename: 'example'
			});
		});
	});

	// animate on scroll init
	AOS.init({ once: true, duration: 700 });

});