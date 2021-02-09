<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\Core\Imaging\IconProvider;

use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconProviderInterface;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class FontawesomeIconProvider
 */
class FontawesomeIconProvider implements IconProviderInterface
{
    public const MARKUP_IDENTIFIER_INLINE = 'inline';

    private FrontendInterface $cache;

    /**
     * Map of font-awesome names to unicode numbers
     *
     * Generated with:
     *  sed -n "s/@fa-var-\(.*\): \"\\\\f\(.*\)\";/        '\1' => 0xf\2,/p" \
     *    Build/node_modules/font-awesome/less/variables.less
     */
    private array $unicodeMap = [
        '500px' => 0xf26e,
        'address-book' => 0xf2b9,
        'address-book-o' => 0xf2ba,
        'address-card' => 0xf2bb,
        'address-card-o' => 0xf2bc,
        'adjust' => 0xf042,
        'adn' => 0xf170,
        'align-center' => 0xf037,
        'align-justify' => 0xf039,
        'align-left' => 0xf036,
        'align-right' => 0xf038,
        'amazon' => 0xf270,
        'ambulance' => 0xf0f9,
        'american-sign-language-interpreting' => 0xf2a3,
        'anchor' => 0xf13d,
        'android' => 0xf17b,
        'angellist' => 0xf209,
        'angle-double-down' => 0xf103,
        'angle-double-left' => 0xf100,
        'angle-double-right' => 0xf101,
        'angle-double-up' => 0xf102,
        'angle-down' => 0xf107,
        'angle-left' => 0xf104,
        'angle-right' => 0xf105,
        'angle-up' => 0xf106,
        'apple' => 0xf179,
        'archive' => 0xf187,
        'area-chart' => 0xf1fe,
        'arrow-circle-down' => 0xf0ab,
        'arrow-circle-left' => 0xf0a8,
        'arrow-circle-o-down' => 0xf01a,
        'arrow-circle-o-left' => 0xf190,
        'arrow-circle-o-right' => 0xf18e,
        'arrow-circle-o-up' => 0xf01b,
        'arrow-circle-right' => 0xf0a9,
        'arrow-circle-up' => 0xf0aa,
        'arrow-down' => 0xf063,
        'arrow-left' => 0xf060,
        'arrow-right' => 0xf061,
        'arrow-up' => 0xf062,
        'arrows' => 0xf047,
        'arrows-alt' => 0xf0b2,
        'arrows-h' => 0xf07e,
        'arrows-v' => 0xf07d,
        'asl-interpreting' => 0xf2a3,
        'assistive-listening-systems' => 0xf2a2,
        'asterisk' => 0xf069,
        'at' => 0xf1fa,
        'audio-description' => 0xf29e,
        'automobile' => 0xf1b9,
        'backward' => 0xf04a,
        'balance-scale' => 0xf24e,
        'ban' => 0xf05e,
        'bandcamp' => 0xf2d5,
        'bank' => 0xf19c,
        'bar-chart' => 0xf080,
        'bar-chart-o' => 0xf080,
        'barcode' => 0xf02a,
        'bars' => 0xf0c9,
        'bath' => 0xf2cd,
        'bathtub' => 0xf2cd,
        'battery' => 0xf240,
        'battery-0' => 0xf244,
        'battery-1' => 0xf243,
        'battery-2' => 0xf242,
        'battery-3' => 0xf241,
        'battery-4' => 0xf240,
        'battery-empty' => 0xf244,
        'battery-full' => 0xf240,
        'battery-half' => 0xf242,
        'battery-quarter' => 0xf243,
        'battery-three-quarters' => 0xf241,
        'bed' => 0xf236,
        'beer' => 0xf0fc,
        'behance' => 0xf1b4,
        'behance-square' => 0xf1b5,
        'bell' => 0xf0f3,
        'bell-o' => 0xf0a2,
        'bell-slash' => 0xf1f6,
        'bell-slash-o' => 0xf1f7,
        'bicycle' => 0xf206,
        'binoculars' => 0xf1e5,
        'birthday-cake' => 0xf1fd,
        'bitbucket' => 0xf171,
        'bitbucket-square' => 0xf172,
        'bitcoin' => 0xf15a,
        'black-tie' => 0xf27e,
        'blind' => 0xf29d,
        'bluetooth' => 0xf293,
        'bluetooth-b' => 0xf294,
        'bold' => 0xf032,
        'bolt' => 0xf0e7,
        'bomb' => 0xf1e2,
        'book' => 0xf02d,
        'bookmark' => 0xf02e,
        'bookmark-o' => 0xf097,
        'braille' => 0xf2a1,
        'briefcase' => 0xf0b1,
        'btc' => 0xf15a,
        'bug' => 0xf188,
        'building' => 0xf1ad,
        'building-o' => 0xf0f7,
        'bullhorn' => 0xf0a1,
        'bullseye' => 0xf140,
        'bus' => 0xf207,
        'buysellads' => 0xf20d,
        'cab' => 0xf1ba,
        'calculator' => 0xf1ec,
        'calendar' => 0xf073,
        'calendar-check-o' => 0xf274,
        'calendar-minus-o' => 0xf272,
        'calendar-o' => 0xf133,
        'calendar-plus-o' => 0xf271,
        'calendar-times-o' => 0xf273,
        'camera' => 0xf030,
        'camera-retro' => 0xf083,
        'car' => 0xf1b9,
        'caret-down' => 0xf0d7,
        'caret-left' => 0xf0d9,
        'caret-right' => 0xf0da,
        'caret-square-o-down' => 0xf150,
        'caret-square-o-left' => 0xf191,
        'caret-square-o-right' => 0xf152,
        'caret-square-o-up' => 0xf151,
        'caret-up' => 0xf0d8,
        'cart-arrow-down' => 0xf218,
        'cart-plus' => 0xf217,
        'cc' => 0xf20a,
        'cc-amex' => 0xf1f3,
        'cc-diners-club' => 0xf24c,
        'cc-discover' => 0xf1f2,
        'cc-jcb' => 0xf24b,
        'cc-mastercard' => 0xf1f1,
        'cc-paypal' => 0xf1f4,
        'cc-stripe' => 0xf1f5,
        'cc-visa' => 0xf1f0,
        'certificate' => 0xf0a3,
        'chain' => 0xf0c1,
        'chain-broken' => 0xf127,
        'check' => 0xf00c,
        'check-circle' => 0xf058,
        'check-circle-o' => 0xf05d,
        'check-square' => 0xf14a,
        'check-square-o' => 0xf046,
        'chevron-circle-down' => 0xf13a,
        'chevron-circle-left' => 0xf137,
        'chevron-circle-right' => 0xf138,
        'chevron-circle-up' => 0xf139,
        'chevron-down' => 0xf078,
        'chevron-left' => 0xf053,
        'chevron-right' => 0xf054,
        'chevron-up' => 0xf077,
        'child' => 0xf1ae,
        'chrome' => 0xf268,
        'circle' => 0xf111,
        'circle-o' => 0xf10c,
        'circle-o-notch' => 0xf1ce,
        'circle-thin' => 0xf1db,
        'clipboard' => 0xf0ea,
        'clock-o' => 0xf017,
        'clone' => 0xf24d,
        'close' => 0xf00d,
        'cloud' => 0xf0c2,
        'cloud-download' => 0xf0ed,
        'cloud-upload' => 0xf0ee,
        'cny' => 0xf157,
        'code' => 0xf121,
        'code-fork' => 0xf126,
        'codepen' => 0xf1cb,
        'codiepie' => 0xf284,
        'coffee' => 0xf0f4,
        'cog' => 0xf013,
        'cogs' => 0xf085,
        'columns' => 0xf0db,
        'comment' => 0xf075,
        'comment-o' => 0xf0e5,
        'commenting' => 0xf27a,
        'commenting-o' => 0xf27b,
        'comments' => 0xf086,
        'comments-o' => 0xf0e6,
        'compass' => 0xf14e,
        'compress' => 0xf066,
        'connectdevelop' => 0xf20e,
        'contao' => 0xf26d,
        'copy' => 0xf0c5,
        'copyright' => 0xf1f9,
        'creative-commons' => 0xf25e,
        'credit-card' => 0xf09d,
        'credit-card-alt' => 0xf283,
        'crop' => 0xf125,
        'crosshairs' => 0xf05b,
        'css3' => 0xf13c,
        'cube' => 0xf1b2,
        'cubes' => 0xf1b3,
        'cut' => 0xf0c4,
        'cutlery' => 0xf0f5,
        'dashboard' => 0xf0e4,
        'dashcube' => 0xf210,
        'database' => 0xf1c0,
        'deaf' => 0xf2a4,
        'deafness' => 0xf2a4,
        'dedent' => 0xf03b,
        'delicious' => 0xf1a5,
        'desktop' => 0xf108,
        'deviantart' => 0xf1bd,
        'diamond' => 0xf219,
        'digg' => 0xf1a6,
        'dollar' => 0xf155,
        'dot-circle-o' => 0xf192,
        'download' => 0xf019,
        'dribbble' => 0xf17d,
        'drivers-license' => 0xf2c2,
        'drivers-license-o' => 0xf2c3,
        'dropbox' => 0xf16b,
        'drupal' => 0xf1a9,
        'edge' => 0xf282,
        'edit' => 0xf044,
        'eercast' => 0xf2da,
        'eject' => 0xf052,
        'ellipsis-h' => 0xf141,
        'ellipsis-v' => 0xf142,
        'empire' => 0xf1d1,
        'envelope' => 0xf0e0,
        'envelope-o' => 0xf003,
        'envelope-open' => 0xf2b6,
        'envelope-open-o' => 0xf2b7,
        'envelope-square' => 0xf199,
        'envira' => 0xf299,
        'eraser' => 0xf12d,
        'etsy' => 0xf2d7,
        'eur' => 0xf153,
        'euro' => 0xf153,
        'exchange' => 0xf0ec,
        'exclamation' => 0xf12a,
        'exclamation-circle' => 0xf06a,
        'exclamation-triangle' => 0xf071,
        'expand' => 0xf065,
        'expeditedssl' => 0xf23e,
        'external-link' => 0xf08e,
        'external-link-square' => 0xf14c,
        'eye' => 0xf06e,
        'eye-slash' => 0xf070,
        'eyedropper' => 0xf1fb,
        'fa' => 0xf2b4,
        'facebook' => 0xf09a,
        'facebook-f' => 0xf09a,
        'facebook-official' => 0xf230,
        'facebook-square' => 0xf082,
        'fast-backward' => 0xf049,
        'fast-forward' => 0xf050,
        'fax' => 0xf1ac,
        'feed' => 0xf09e,
        'female' => 0xf182,
        'fighter-jet' => 0xf0fb,
        'file' => 0xf15b,
        'file-archive-o' => 0xf1c6,
        'file-audio-o' => 0xf1c7,
        'file-code-o' => 0xf1c9,
        'file-excel-o' => 0xf1c3,
        'file-image-o' => 0xf1c5,
        'file-movie-o' => 0xf1c8,
        'file-o' => 0xf016,
        'file-pdf-o' => 0xf1c1,
        'file-photo-o' => 0xf1c5,
        'file-picture-o' => 0xf1c5,
        'file-powerpoint-o' => 0xf1c4,
        'file-sound-o' => 0xf1c7,
        'file-text' => 0xf15c,
        'file-text-o' => 0xf0f6,
        'file-video-o' => 0xf1c8,
        'file-word-o' => 0xf1c2,
        'file-zip-o' => 0xf1c6,
        'files-o' => 0xf0c5,
        'film' => 0xf008,
        'filter' => 0xf0b0,
        'fire' => 0xf06d,
        'fire-extinguisher' => 0xf134,
        'firefox' => 0xf269,
        'first-order' => 0xf2b0,
        'flag' => 0xf024,
        'flag-checkered' => 0xf11e,
        'flag-o' => 0xf11d,
        'flash' => 0xf0e7,
        'flask' => 0xf0c3,
        'flickr' => 0xf16e,
        'floppy-o' => 0xf0c7,
        'folder' => 0xf07b,
        'folder-o' => 0xf114,
        'folder-open' => 0xf07c,
        'folder-open-o' => 0xf115,
        'font' => 0xf031,
        'font-awesome' => 0xf2b4,
        'fonticons' => 0xf280,
        'fort-awesome' => 0xf286,
        'forumbee' => 0xf211,
        'forward' => 0xf04e,
        'foursquare' => 0xf180,
        'free-code-camp' => 0xf2c5,
        'frown-o' => 0xf119,
        'futbol-o' => 0xf1e3,
        'gamepad' => 0xf11b,
        'gavel' => 0xf0e3,
        'gbp' => 0xf154,
        'ge' => 0xf1d1,
        'gear' => 0xf013,
        'gears' => 0xf085,
        'genderless' => 0xf22d,
        'get-pocket' => 0xf265,
        'gg' => 0xf260,
        'gg-circle' => 0xf261,
        'gift' => 0xf06b,
        'git' => 0xf1d3,
        'git-square' => 0xf1d2,
        'github' => 0xf09b,
        'github-alt' => 0xf113,
        'github-square' => 0xf092,
        'gitlab' => 0xf296,
        'gittip' => 0xf184,
        'glass' => 0xf000,
        'glide' => 0xf2a5,
        'glide-g' => 0xf2a6,
        'globe' => 0xf0ac,
        'google' => 0xf1a0,
        'google-plus' => 0xf0d5,
        'google-plus-circle' => 0xf2b3,
        'google-plus-official' => 0xf2b3,
        'google-plus-square' => 0xf0d4,
        'google-wallet' => 0xf1ee,
        'graduation-cap' => 0xf19d,
        'gratipay' => 0xf184,
        'grav' => 0xf2d6,
        'group' => 0xf0c0,
        'h-square' => 0xf0fd,
        'hacker-news' => 0xf1d4,
        'hand-grab-o' => 0xf255,
        'hand-lizard-o' => 0xf258,
        'hand-o-down' => 0xf0a7,
        'hand-o-left' => 0xf0a5,
        'hand-o-right' => 0xf0a4,
        'hand-o-up' => 0xf0a6,
        'hand-paper-o' => 0xf256,
        'hand-peace-o' => 0xf25b,
        'hand-pointer-o' => 0xf25a,
        'hand-rock-o' => 0xf255,
        'hand-scissors-o' => 0xf257,
        'hand-spock-o' => 0xf259,
        'hand-stop-o' => 0xf256,
        'handshake-o' => 0xf2b5,
        'hard-of-hearing' => 0xf2a4,
        'hashtag' => 0xf292,
        'hdd-o' => 0xf0a0,
        'header' => 0xf1dc,
        'headphones' => 0xf025,
        'heart' => 0xf004,
        'heart-o' => 0xf08a,
        'heartbeat' => 0xf21e,
        'history' => 0xf1da,
        'home' => 0xf015,
        'hospital-o' => 0xf0f8,
        'hotel' => 0xf236,
        'hourglass' => 0xf254,
        'hourglass-1' => 0xf251,
        'hourglass-2' => 0xf252,
        'hourglass-3' => 0xf253,
        'hourglass-end' => 0xf253,
        'hourglass-half' => 0xf252,
        'hourglass-o' => 0xf250,
        'hourglass-start' => 0xf251,
        'houzz' => 0xf27c,
        'html5' => 0xf13b,
        'i-cursor' => 0xf246,
        'id-badge' => 0xf2c1,
        'id-card' => 0xf2c2,
        'id-card-o' => 0xf2c3,
        'ils' => 0xf20b,
        'image' => 0xf03e,
        'imdb' => 0xf2d8,
        'inbox' => 0xf01c,
        'indent' => 0xf03c,
        'industry' => 0xf275,
        'info' => 0xf129,
        'info-circle' => 0xf05a,
        'inr' => 0xf156,
        'instagram' => 0xf16d,
        'institution' => 0xf19c,
        'internet-explorer' => 0xf26b,
        'intersex' => 0xf224,
        'ioxhost' => 0xf208,
        'italic' => 0xf033,
        'joomla' => 0xf1aa,
        'jpy' => 0xf157,
        'jsfiddle' => 0xf1cc,
        'key' => 0xf084,
        'keyboard-o' => 0xf11c,
        'krw' => 0xf159,
        'language' => 0xf1ab,
        'laptop' => 0xf109,
        'lastfm' => 0xf202,
        'lastfm-square' => 0xf203,
        'leaf' => 0xf06c,
        'leanpub' => 0xf212,
        'legal' => 0xf0e3,
        'lemon-o' => 0xf094,
        'level-down' => 0xf149,
        'level-up' => 0xf148,
        'life-bouy' => 0xf1cd,
        'life-buoy' => 0xf1cd,
        'life-ring' => 0xf1cd,
        'life-saver' => 0xf1cd,
        'lightbulb-o' => 0xf0eb,
        'line-chart' => 0xf201,
        'link' => 0xf0c1,
        'linkedin' => 0xf0e1,
        'linkedin-square' => 0xf08c,
        'linode' => 0xf2b8,
        'linux' => 0xf17c,
        'list' => 0xf03a,
        'list-alt' => 0xf022,
        'list-ol' => 0xf0cb,
        'list-ul' => 0xf0ca,
        'location-arrow' => 0xf124,
        'lock' => 0xf023,
        'long-arrow-down' => 0xf175,
        'long-arrow-left' => 0xf177,
        'long-arrow-right' => 0xf178,
        'long-arrow-up' => 0xf176,
        'low-vision' => 0xf2a8,
        'magic' => 0xf0d0,
        'magnet' => 0xf076,
        'mail-forward' => 0xf064,
        'mail-reply' => 0xf112,
        'mail-reply-all' => 0xf122,
        'male' => 0xf183,
        'map' => 0xf279,
        'map-marker' => 0xf041,
        'map-o' => 0xf278,
        'map-pin' => 0xf276,
        'map-signs' => 0xf277,
        'mars' => 0xf222,
        'mars-double' => 0xf227,
        'mars-stroke' => 0xf229,
        'mars-stroke-h' => 0xf22b,
        'mars-stroke-v' => 0xf22a,
        'maxcdn' => 0xf136,
        'meanpath' => 0xf20c,
        'medium' => 0xf23a,
        'medkit' => 0xf0fa,
        'meetup' => 0xf2e0,
        'meh-o' => 0xf11a,
        'mercury' => 0xf223,
        'microchip' => 0xf2db,
        'microphone' => 0xf130,
        'microphone-slash' => 0xf131,
        'minus' => 0xf068,
        'minus-circle' => 0xf056,
        'minus-square' => 0xf146,
        'minus-square-o' => 0xf147,
        'mixcloud' => 0xf289,
        'mobile' => 0xf10b,
        'mobile-phone' => 0xf10b,
        'modx' => 0xf285,
        'money' => 0xf0d6,
        'moon-o' => 0xf186,
        'mortar-board' => 0xf19d,
        'motorcycle' => 0xf21c,
        'mouse-pointer' => 0xf245,
        'music' => 0xf001,
        'navicon' => 0xf0c9,
        'neuter' => 0xf22c,
        'newspaper-o' => 0xf1ea,
        'object-group' => 0xf247,
        'object-ungroup' => 0xf248,
        'odnoklassniki' => 0xf263,
        'odnoklassniki-square' => 0xf264,
        'opencart' => 0xf23d,
        'openid' => 0xf19b,
        'opera' => 0xf26a,
        'optin-monster' => 0xf23c,
        'outdent' => 0xf03b,
        'pagelines' => 0xf18c,
        'paint-brush' => 0xf1fc,
        'paper-plane' => 0xf1d8,
        'paper-plane-o' => 0xf1d9,
        'paperclip' => 0xf0c6,
        'paragraph' => 0xf1dd,
        'paste' => 0xf0ea,
        'pause' => 0xf04c,
        'pause-circle' => 0xf28b,
        'pause-circle-o' => 0xf28c,
        'paw' => 0xf1b0,
        'paypal' => 0xf1ed,
        'pencil' => 0xf040,
        'pencil-square' => 0xf14b,
        'pencil-square-o' => 0xf044,
        'percent' => 0xf295,
        'phone' => 0xf095,
        'phone-square' => 0xf098,
        'photo' => 0xf03e,
        'picture-o' => 0xf03e,
        'pie-chart' => 0xf200,
        'pied-piper' => 0xf2ae,
        'pied-piper-alt' => 0xf1a8,
        'pied-piper-pp' => 0xf1a7,
        'pinterest' => 0xf0d2,
        'pinterest-p' => 0xf231,
        'pinterest-square' => 0xf0d3,
        'plane' => 0xf072,
        'play' => 0xf04b,
        'play-circle' => 0xf144,
        'play-circle-o' => 0xf01d,
        'plug' => 0xf1e6,
        'plus' => 0xf067,
        'plus-circle' => 0xf055,
        'plus-square' => 0xf0fe,
        'plus-square-o' => 0xf196,
        'podcast' => 0xf2ce,
        'power-off' => 0xf011,
        'print' => 0xf02f,
        'product-hunt' => 0xf288,
        'puzzle-piece' => 0xf12e,
        'qq' => 0xf1d6,
        'qrcode' => 0xf029,
        'question' => 0xf128,
        'question-circle' => 0xf059,
        'question-circle-o' => 0xf29c,
        'quora' => 0xf2c4,
        'quote-left' => 0xf10d,
        'quote-right' => 0xf10e,
        'ra' => 0xf1d0,
        'random' => 0xf074,
        'ravelry' => 0xf2d9,
        'rebel' => 0xf1d0,
        'recycle' => 0xf1b8,
        'reddit' => 0xf1a1,
        'reddit-alien' => 0xf281,
        'reddit-square' => 0xf1a2,
        'refresh' => 0xf021,
        'registered' => 0xf25d,
        'remove' => 0xf00d,
        'renren' => 0xf18b,
        'reorder' => 0xf0c9,
        'repeat' => 0xf01e,
        'reply' => 0xf112,
        'reply-all' => 0xf122,
        'resistance' => 0xf1d0,
        'retweet' => 0xf079,
        'rmb' => 0xf157,
        'road' => 0xf018,
        'rocket' => 0xf135,
        'rotate-left' => 0xf0e2,
        'rotate-right' => 0xf01e,
        'rouble' => 0xf158,
        'rss' => 0xf09e,
        'rss-square' => 0xf143,
        'rub' => 0xf158,
        'ruble' => 0xf158,
        'rupee' => 0xf156,
        's15' => 0xf2cd,
        'safari' => 0xf267,
        'save' => 0xf0c7,
        'scissors' => 0xf0c4,
        'scribd' => 0xf28a,
        'search' => 0xf002,
        'search-minus' => 0xf010,
        'search-plus' => 0xf00e,
        'sellsy' => 0xf213,
        'send' => 0xf1d8,
        'send-o' => 0xf1d9,
        'server' => 0xf233,
        'share' => 0xf064,
        'share-alt' => 0xf1e0,
        'share-alt-square' => 0xf1e1,
        'share-square' => 0xf14d,
        'share-square-o' => 0xf045,
        'shekel' => 0xf20b,
        'sheqel' => 0xf20b,
        'shield' => 0xf132,
        'ship' => 0xf21a,
        'shirtsinbulk' => 0xf214,
        'shopping-bag' => 0xf290,
        'shopping-basket' => 0xf291,
        'shopping-cart' => 0xf07a,
        'shower' => 0xf2cc,
        'sign-in' => 0xf090,
        'sign-language' => 0xf2a7,
        'sign-out' => 0xf08b,
        'signal' => 0xf012,
        'signing' => 0xf2a7,
        'simplybuilt' => 0xf215,
        'sitemap' => 0xf0e8,
        'skyatlas' => 0xf216,
        'skype' => 0xf17e,
        'slack' => 0xf198,
        'sliders' => 0xf1de,
        'slideshare' => 0xf1e7,
        'smile-o' => 0xf118,
        'snapchat' => 0xf2ab,
        'snapchat-ghost' => 0xf2ac,
        'snapchat-square' => 0xf2ad,
        'snowflake-o' => 0xf2dc,
        'soccer-ball-o' => 0xf1e3,
        'sort' => 0xf0dc,
        'sort-alpha-asc' => 0xf15d,
        'sort-alpha-desc' => 0xf15e,
        'sort-amount-asc' => 0xf160,
        'sort-amount-desc' => 0xf161,
        'sort-asc' => 0xf0de,
        'sort-desc' => 0xf0dd,
        'sort-down' => 0xf0dd,
        'sort-numeric-asc' => 0xf162,
        'sort-numeric-desc' => 0xf163,
        'sort-up' => 0xf0de,
        'soundcloud' => 0xf1be,
        'space-shuttle' => 0xf197,
        'spinner' => 0xf110,
        'spoon' => 0xf1b1,
        'spotify' => 0xf1bc,
        'square' => 0xf0c8,
        'square-o' => 0xf096,
        'stack-exchange' => 0xf18d,
        'stack-overflow' => 0xf16c,
        'star' => 0xf005,
        'star-half' => 0xf089,
        'star-half-empty' => 0xf123,
        'star-half-full' => 0xf123,
        'star-half-o' => 0xf123,
        'star-o' => 0xf006,
        'steam' => 0xf1b6,
        'steam-square' => 0xf1b7,
        'step-backward' => 0xf048,
        'step-forward' => 0xf051,
        'stethoscope' => 0xf0f1,
        'sticky-note' => 0xf249,
        'sticky-note-o' => 0xf24a,
        'stop' => 0xf04d,
        'stop-circle' => 0xf28d,
        'stop-circle-o' => 0xf28e,
        'street-view' => 0xf21d,
        'strikethrough' => 0xf0cc,
        'stumbleupon' => 0xf1a4,
        'stumbleupon-circle' => 0xf1a3,
        'subscript' => 0xf12c,
        'subway' => 0xf239,
        'suitcase' => 0xf0f2,
        'sun-o' => 0xf185,
        'superpowers' => 0xf2dd,
        'superscript' => 0xf12b,
        'support' => 0xf1cd,
        'table' => 0xf0ce,
        'tablet' => 0xf10a,
        'tachometer' => 0xf0e4,
        'tag' => 0xf02b,
        'tags' => 0xf02c,
        'tasks' => 0xf0ae,
        'taxi' => 0xf1ba,
        'telegram' => 0xf2c6,
        'television' => 0xf26c,
        'tencent-weibo' => 0xf1d5,
        'terminal' => 0xf120,
        'text-height' => 0xf034,
        'text-width' => 0xf035,
        'th' => 0xf00a,
        'th-large' => 0xf009,
        'th-list' => 0xf00b,
        'themeisle' => 0xf2b2,
        'thermometer' => 0xf2c7,
        'thermometer-0' => 0xf2cb,
        'thermometer-1' => 0xf2ca,
        'thermometer-2' => 0xf2c9,
        'thermometer-3' => 0xf2c8,
        'thermometer-4' => 0xf2c7,
        'thermometer-empty' => 0xf2cb,
        'thermometer-full' => 0xf2c7,
        'thermometer-half' => 0xf2c9,
        'thermometer-quarter' => 0xf2ca,
        'thermometer-three-quarters' => 0xf2c8,
        'thumb-tack' => 0xf08d,
        'thumbs-down' => 0xf165,
        'thumbs-o-down' => 0xf088,
        'thumbs-o-up' => 0xf087,
        'thumbs-up' => 0xf164,
        'ticket' => 0xf145,
        'times' => 0xf00d,
        'times-circle' => 0xf057,
        'times-circle-o' => 0xf05c,
        'times-rectangle' => 0xf2d3,
        'times-rectangle-o' => 0xf2d4,
        'tint' => 0xf043,
        'toggle-down' => 0xf150,
        'toggle-left' => 0xf191,
        'toggle-off' => 0xf204,
        'toggle-on' => 0xf205,
        'toggle-right' => 0xf152,
        'toggle-up' => 0xf151,
        'trademark' => 0xf25c,
        'train' => 0xf238,
        'transgender' => 0xf224,
        'transgender-alt' => 0xf225,
        'trash' => 0xf1f8,
        'trash-o' => 0xf014,
        'tree' => 0xf1bb,
        'trello' => 0xf181,
        'tripadvisor' => 0xf262,
        'trophy' => 0xf091,
        'truck' => 0xf0d1,
        'try' => 0xf195,
        'tty' => 0xf1e4,
        'tumblr' => 0xf173,
        'tumblr-square' => 0xf174,
        'turkish-lira' => 0xf195,
        'tv' => 0xf26c,
        'twitch' => 0xf1e8,
        'twitter' => 0xf099,
        'twitter-square' => 0xf081,
        'umbrella' => 0xf0e9,
        'underline' => 0xf0cd,
        'undo' => 0xf0e2,
        'universal-access' => 0xf29a,
        'university' => 0xf19c,
        'unlink' => 0xf127,
        'unlock' => 0xf09c,
        'unlock-alt' => 0xf13e,
        'unsorted' => 0xf0dc,
        'upload' => 0xf093,
        'usb' => 0xf287,
        'usd' => 0xf155,
        'user' => 0xf007,
        'user-circle' => 0xf2bd,
        'user-circle-o' => 0xf2be,
        'user-md' => 0xf0f0,
        'user-o' => 0xf2c0,
        'user-plus' => 0xf234,
        'user-secret' => 0xf21b,
        'user-times' => 0xf235,
        'users' => 0xf0c0,
        'vcard' => 0xf2bb,
        'vcard-o' => 0xf2bc,
        'venus' => 0xf221,
        'venus-double' => 0xf226,
        'venus-mars' => 0xf228,
        'viacoin' => 0xf237,
        'viadeo' => 0xf2a9,
        'viadeo-square' => 0xf2aa,
        'video-camera' => 0xf03d,
        'vimeo' => 0xf27d,
        'vimeo-square' => 0xf194,
        'vine' => 0xf1ca,
        'vk' => 0xf189,
        'volume-control-phone' => 0xf2a0,
        'volume-down' => 0xf027,
        'volume-off' => 0xf026,
        'volume-up' => 0xf028,
        'warning' => 0xf071,
        'wechat' => 0xf1d7,
        'weibo' => 0xf18a,
        'weixin' => 0xf1d7,
        'whatsapp' => 0xf232,
        'wheelchair' => 0xf193,
        'wheelchair-alt' => 0xf29b,
        'wifi' => 0xf1eb,
        'wikipedia-w' => 0xf266,
        'window-close' => 0xf2d3,
        'window-close-o' => 0xf2d4,
        'window-maximize' => 0xf2d0,
        'window-minimize' => 0xf2d1,
        'window-restore' => 0xf2d2,
        'windows' => 0xf17a,
        'won' => 0xf159,
        'wordpress' => 0xf19a,
        'wpbeginner' => 0xf297,
        'wpexplorer' => 0xf2de,
        'wpforms' => 0xf298,
        'wrench' => 0xf0ad,
        'xing' => 0xf168,
        'xing-square' => 0xf169,
        'y-combinator' => 0xf23b,
        'y-combinator-square' => 0xf1d4,
        'yahoo' => 0xf19e,
        'yc' => 0xf23b,
        'yc-square' => 0xf1d4,
        'yelp' => 0xf1e9,
        'yen' => 0xf157,
        'yoast' => 0xf2b1,
        'youtube' => 0xf167,
        'youtube-play' => 0xf16a,
        'youtube-square' => 0xf166,
    ];

    public function __construct(FrontendInterface $assetsCache)
    {
        $this->cache = $assetsCache;
    }

    /**
     * @param Icon $icon
     * @param array $options
     */
    public function prepareIconMarkup(Icon $icon, array $options = [])
    {
        $icon->setMarkup($this->generateMarkup($icon, $options));
        $icon->setAlternativeMarkup(self::MARKUP_IDENTIFIER_INLINE, $this->generateInlineMarkup($options));
    }

    protected function getName(array $options): string
    {
        $name = (string)($options['name'] ?? '');
        if (strlen($name) === 0) {
            throw new \InvalidArgumentException('The option "name" is required and must not be empty', 1440754978);
        }
        /* Not available in font-awesome, used as a (blank) placeholder icon */
        if ($name === 'empty-empty') {
            return $name;
        }
        if (!isset($this->unicodeMap[$name])) {
            throw new \InvalidArgumentException('The FontAwesome icon name "' . $name . '" is not defined', 1440754979);
        }
        return $name;
    }

    /**
     * @param Icon $icon
     * @param array $options
     *
     * @throws \InvalidArgumentException
     * @return string
     */
    protected function generateMarkup(Icon $icon, array $options)
    {
        return '<span class="icon-unify"><i class="fa fa-' . htmlspecialchars($this->getName($options), ENT_QUOTES, 'UTF-8') . '"></i></span>';
    }

    /**
     * @param array $options
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function generateInlineMarkup(array $options): string
    {
        $icons = $this->getSvgIcons();
        return $icons[$this->getName($options)] ?? '';
    }

    protected function getCacheIdentifier(): string
    {
        return 'FontawesomeSvgIcons_' . sha1((string)(new Typo3Version()) . Environment::getProjectPath() . 'FontawesomeSvgIcons');
    }

    protected function getSvgIcons(): array
    {
        $icons = $this->cache->get($this->getCacheIdentifier());
        if ($icons !== false) {
            return $icons;
        }

        return $this->createSvgIcons();
    }

    protected function createSvgIcons(): array
    {
        $icons = [];
        $doc = $this->getSvgContents('EXT:backend/Resources/Public/Fonts/FontAwesome/fontawesome-webfont.svg');
        if ($doc === null) {
            throw new \RuntimeException('Fontawsome SVG webfont could not be loaded.', 1612868955);
        }
        $defaultUnitsPerEm = 1000; // https://www.w3.org/TR/SVG11/fonts.html#FontFaceElementUnitsPerEmAttribute
        $defaultHeight = (int)($doc->xpath('//font-face')[0]['units-per-em'] ?? $defaultUnitsPerEm);
        $defaultWidth = (int)($doc->xpath('//font')[0]['horiz-adv-x']);
        $viewBoxXOffset = 0;
        $viewBoxYOffset = (int)($doc->xpath('//font-face')[0]['descent']);

        foreach ($this->unicodeMap as $name => $unicode) {
            $elements = $doc->xpath('//glyph[@unicode="' . html_entity_decode('&#x' . dechex($unicode) . ';', ENT_NOQUOTES, 'UTF-8') . '"]');
            if ($elements === false || count($elements) === 0) {
                throw new \RuntimeException('Fontawsome SVG glyph ' . $name . ' not found.', 1612868954);
            }
            $element = $elements[0];

            $path = (string)($element['d'] ?? '');
            $width = (int)($element['horiz-adv-x'] ?? $defaultWidth);
            $height = $defaultHeight;
            $transformOriginX = $width / 2 + $viewBoxXOffset;
            $transformOriginY = $height / 2 + $viewBoxYOffset;

            $svg = vsprintf(
                '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="%s %s %s %s" class="icon-unify"><path transform="scale(1 -1)" transform-origin="%s %s" class="icon-color" d="%s" /></svg>',
                $this->escape([
                    $viewBoxXOffset,
                    $viewBoxYOffset,
                    $width,
                    $height,
                    $transformOriginX,
                    $transformOriginY,
                    $path,
                ])
            );

            $icons[$name] = $svg;
        }

        $this->cache->set($this->getCacheIdentifier(), $icons);
        return $icons;
    }

    protected function getSvgContents(string $source): ?\SimpleXMLElement
    {
        $source = GeneralUtility::getFileAbsFileName($source);
        if (!file_exists($source)) {
            return null;
        }

        $svgContent = file_get_contents($source);
        if ($svgContent === false) {
            return null;
        }
        // Disables the functionality to allow external entities to be loaded when parsing the XML, must be kept
        $previousValueOfEntityLoader = null;
        if (PHP_MAJOR_VERSION < 8) {
            $previousValueOfEntityLoader = libxml_disable_entity_loader(true);
        }
        $svgElement = simplexml_load_string($svgContent);
        if (PHP_MAJOR_VERSION < 8) {
            libxml_disable_entity_loader($previousValueOfEntityLoader);
        }
        if ($svgElement === false) {
            return null;
        }

        return $svgElement;
    }

    protected function escape(array $strings): array
    {
        return array_map(
            function (string $value): string {
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            },
            $strings
        );
    }
}
