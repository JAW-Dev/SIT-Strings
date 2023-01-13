<?php

/**
 * SIT Strings functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SIT Strings
 * @since 1.0.0
 */

define('LOCAL_DOMAIN', 'sit-strings.local');

/**
 * Includes
 */
array_map(function ($file) {
  if ('blocks' === $file) :
    foreach (glob(get_stylesheet_directory() . "/includes/blocks/*.php") as $filename) :
      require_once($filename);
    endforeach;
  endif;
  $filepath = "/includes/{$file}.php";
  require_once(get_stylesheet_directory() . $filepath);
}, ['blocks', 'post-types', 'taxonomies']);

/**
 * Define Constants
 */
define('SIT_STRINGS_VERSION', '1.0.0');

define('SIT_STRINGS_RED', '#bf1e2e');
define('SIT_STRINGS_RED_LIGHT', '#f85857');
define('SIT_STRINGS_RED_DARK', '#870006');
define('SIT_STRINGS_ORANGE', '#fb5543');
define('SIT_STRINGS_ORANGE_LIGHT', '#ff886f');
define('SIT_STRINGS_ORANGE_DARK', '#c1191a');
define('SIT_STRINGS_PURPLE', '#7b61ff');
define('SIT_STRINGS_PURPLE_LIGHT', '#b290ff');
define('SIT_STRINGS_PURPLE_DARK', '#3f35cb');
define('SIT_STRINGS_BLUE', '#74d3f5');
define('SIT_STRINGS_BLUE_LIGHT', '#a9ffff');
define('SIT_STRINGS_BLUE_DARK', '#3aa2c2');
define('SIT_STRINGS_GRAY', '#303030');
define('SIT_STRINGS_GRAY_LIGHT', '#626262');
define('SIT_STRINGS_GRAY_DARK', '#0e0e0e');
define('SIT_STRINGS_GRAY_LIGHTER', '#ced4da');
define('SIT_STRINGS_GRAY_LIGHTEST', '#e9ecef');
define('SIT_STRINGS_WHITE', '#ffffff');

//from https://developers.google.com/public-data/docs/canonical/countries_csv
define(
  'COUNTRY_LOCATIONS_MAP',
  [
    'andorra' => ['lat' => 42.546245, 'lng' => 1.601554],
    'united arab emirates' => ['lat' => 23.424076, 'lng' => 53.847818],
    'afghanistan' => ['lat' => 33.93911, 'lng' => 67.709953],
    'antigua and barbuda' => ['lat' => 17.060816, 'lng' => -61.796428],
    'anguilla' => ['lat' => 18.220554, 'lng' => -63.068615],
    'albania' => ['lat' => 41.153332, 'lng' => 20.168331],
    'armenia' => ['lat' => 40.069099, 'lng' => 45.038189],
    'netherlands antilles' => ['lat' => 12.226079, 'lng' => -69.060087],
    'angola' => ['lat' => -11.202692, 'lng' => 17.873887],
    'antarctica' => ['lat' => -75.250973, 'lng' => -0.071389],
    'argentina' => ['lat' => -38.416097, 'lng' => -63.616672],
    'american samoa' => ['lat' => -14.270972, 'lng' => -170.132217],
    'austria' => ['lat' => 47.516231, 'lng' => 14.550072],
    'australia' => ['lat' => -25.274398, 'lng' => 133.775136],
    'aruba' => ['lat' => 12.52111, 'lng' => -69.968338],
    'azerbaijan' => ['lat' => 40.143105, 'lng' => 47.576927],
    'bosnia and herzegovina' => ['lat' => 43.915886, 'lng' => 17.679076],
    'barbados' => ['lat' => 13.193887, 'lng' => -59.543198],
    'bangladesh' => ['lat' => 23.684994, 'lng' => 90.356331],
    'belgium' => ['lat' => 50.503887, 'lng' => 4.469936],
    'burkina faso' => ['lat' => 12.238333, 'lng' => -1.561593],
    'bulgaria' => ['lat' => 42.733883, 'lng' => 25.48583],
    'bahrain' => ['lat' => 25.930414, 'lng' => 50.637772],
    'burundi' => ['lat' => -3.373056, 'lng' => 29.918886],
    'benin' => ['lat' => 9.30769, 'lng' => 2.315834],
    'bermuda' => ['lat' => 32.321384, 'lng' => -64.75737],
    'brunei' => ['lat' => 4.535277, 'lng' => 114.727669],
    'bolivia' => ['lat' => -16.290154, 'lng' => -63.588653],
    'brazil' => ['lat' => -14.235004, 'lng' => -51.92528],
    'bahamas' => ['lat' => 25.03428, 'lng' => -77.39628],
    'bhutan' => ['lat' => 27.514162, 'lng' => 90.433601],
    'bouvet island' => ['lat' => -54.423199, 'lng' => 3.413194],
    'botswana' => ['lat' => -22.328474, 'lng' => 24.684866],
    'belarus' => ['lat' => 53.709807, 'lng' => 27.953389],
    'belize' => ['lat' => 17.189877, 'lng' => -88.49765],
    'canada' => ['lat' => 56.130366, 'lng' => -106.346771],
    'cocos [keeling] islands' => ['lat' => -12.164165, 'lng' => 96.870956],
    'congo [drc]' => ['lat' => -4.038333, 'lng' => 21.758664],
    'central african republic' => ['lat' => 6.611111, 'lng' => 20.939444],
    'congo [republic]' => ['lat' => -0.228021, 'lng' => 15.827659],
    'switzerland' => ['lat' => 46.818188, 'lng' => 8.227512],
    "côte d'ivoire" => ['lat' => 7.539989, 'lng' => -5.54708],
    'cook islands' => ['lat' => -21.236736, 'lng' => -159.777671],
    'chile' => ['lat' => -35.675147, 'lng' => -71.542969],
    'cameroon' => ['lat' => 7.369722, 'lng' => 12.354722],
    'china' => ['lat' => 35.86166, 'lng' => 104.195397],
    'colombia' => ['lat' => 4.570868, 'lng' => -74.297333],
    'costa rica' => ['lat' => 9.748917, 'lng' => -83.753428],
    'cuba' => ['lat' => 21.521757, 'lng' => -77.781167],
    'cape verde' => ['lat' => 16.002082, 'lng' => -24.013197],
    'christmas island' => ['lat' => -10.447525, 'lng' => 105.690449],
    'cyprus' => ['lat' => 35.126413, 'lng' => 33.429859],
    'czech republic' => ['lat' => 49.817492, 'lng' => 15.472962],
    'germany' => ['lat' => 51.165691, 'lng' => 10.451526],
    'djibouti' => ['lat' => 11.825138, 'lng' => 42.590275],
    'denmark' => ['lat' => 56.26392, 'lng' => 9.501785],
    'dominica' => ['lat' => 15.414999, 'lng' => -61.370976],
    'dominican republic' => ['lat' => 18.735693, 'lng' => -70.162651],
    'algeria' => ['lat' => 28.033886, 'lng' => 1.659626],
    'ecuador' => ['lat' => -1.831239, 'lng' => -78.183406],
    'estonia' => ['lat' => 58.595272, 'lng' => 25.013607],
    'egypt' => ['lat' => 26.820553, 'lng' => 30.802498],
    'western sahara' => ['lat' => 24.215527, 'lng' => -12.885834],
    'eritrea' => ['lat' => 15.179384, 'lng' => 39.782334],
    'spain' => ['lat' => 40.463667, 'lng' => -3.74922],
    'ethiopia' => ['lat' => 9.145, 'lng' => 40.489673],
    'finland' => ['lat' => 61.92411, 'lng' => 25.748151],
    'fiji' => ['lat' => -16.578193, 'lng' => 179.414413],
    'falkland islands [islas malvinas]' => ['lat' => -51.796253, 'lng' => -59.523613],
    'micronesia' => ['lat' => 7.425554, 'lng' => 150.550812],
    'faroe islands' => ['lat' => 61.892635, 'lng' => -6.911806],
    'france' => ['lat' => 46.227638, 'lng' => 2.213749],
    'gabon' => ['lat' => -0.803689, 'lng' => 11.609444],
    'united kingdom' => ['lat' => 55.378051, 'lng' => -3.435973],
    'grenada' => ['lat' => 12.262776, 'lng' => -61.604171],
    'georgia' => ['lat' => 42.315407, 'lng' => 43.356892],
    'french guiana' => ['lat' => 3.933889, 'lng' => -53.125782],
    'guernsey' => ['lat' => 49.465691, 'lng' => -2.585278],
    'ghana' => ['lat' => 7.946527, 'lng' => -1.023194],
    'gibraltar' => ['lat' => 36.137741, 'lng' => -5.345374],
    'greenland' => ['lat' => 71.706936, 'lng' => -42.604303],
    'gambia' => ['lat' => 13.443182, 'lng' => -15.310139],
    'guinea' => ['lat' => 9.945587, 'lng' => -9.696645],
    'guadeloupe' => ['lat' => 16.995971, 'lng' => -62.067641],
    'equatorial guinea' => ['lat' => 1.650801, 'lng' => 10.267895],
    'greece' => ['lat' => 39.074208, 'lng' => 21.824312],
    'south georgia and the south sandwich islands' => ['lat' => -54.429579, 'lng' => -36.587909],
    'guatemala' => ['lat' => 15.783471, 'lng' => -90.230759],
    'guam' => ['lat' => 13.444304, 'lng' => 144.793731],
    'guinea-bissau' => ['lat' => 11.803749, 'lng' => -15.180413],
    'guyana' => ['lat' => 4.860416, 'lng' => -58.93018],
    'gaza strip' => ['lat' => 31.354676, 'lng' => 34.308825],
    'hong kong' => ['lat' => 22.396428, 'lng' => 114.109497],
    'heard island and mcdonald islands' => ['lat' => -53.08181, 'lng' => 73.504158],
    'honduras' => ['lat' => 15.199999, 'lng' => -86.241905],
    'croatia' => ['lat' => 45.1, 'lng' => 15.2],
    'haiti' => ['lat' => 18.971187, 'lng' => -72.285215],
    'hungary' => ['lat' => 47.162494, 'lng' => 19.503304],
    'indonesia' => ['lat' => -0.789275, 'lng' => 113.921327],
    'ireland' => ['lat' => 53.41291, 'lng' => -8.24389],
    'israel' => ['lat' => 31.046051, 'lng' => 34.851612],
    'isle of man' => ['lat' => 54.236107, 'lng' => -4.548056],
    'india' => ['lat' => 20.593684, 'lng' => 78.96288],
    'british indian ocean territory' => ['lat' => -6.343194, 'lng' => 71.876519],
    'iraq' => ['lat' => 33.223191, 'lng' => 43.679291],
    'iran' => ['lat' => 32.427908, 'lng' => 53.688046],
    'iceland' => ['lat' => 64.963051, 'lng' => -19.020835],
    'italy' => ['lat' => 41.87194, 'lng' => 12.56738],
    'jersey' => ['lat' => 49.214439, 'lng' => -2.13125],
    'jamaica' => ['lat' => 18.109581, 'lng' => -77.297508],
    'jordan' => ['lat' => 30.585164, 'lng' => 36.238414],
    'japan' => ['lat' => 36.204824, 'lng' => 138.252924],
    'kenya' => ['lat' => -0.023559, 'lng' => 37.906193],
    'kyrgyzstan' => ['lat' => 41.20438, 'lng' => 74.766098],
    'cambodia' => ['lat' => 12.565679, 'lng' => 104.990963],
    'kiribati' => ['lat' => -3.370417, 'lng' => -168.734039],
    'comoros' => ['lat' => -11.875001, 'lng' => 43.872219],
    'saint kitts and nevis' => ['lat' => 17.357822, 'lng' => -62.782998],
    'north korea' => ['lat' => 40.339852, 'lng' => 127.510093],
    'south korea' => ['lat' => 35.907757, 'lng' => 127.766922],
    'kuwait' => ['lat' => 29.31166, 'lng' => 47.481766],
    'cayman islands' => ['lat' => 19.513469, 'lng' => -80.566956],
    'kazakhstan' => ['lat' => 48.019573, 'lng' => 66.923684],
    'laos' => ['lat' => 19.85627, 'lng' => 102.495496],
    'lebanon' => ['lat' => 33.854721, 'lng' => 35.862285],
    'saint lucia' => ['lat' => 13.909444, 'lng' => -60.978893],
    'liechtenstein' => ['lat' => 47.166, 'lng' => 9.555373],
    'sri lanka' => ['lat' => 7.873054, 'lng' => 80.771797],
    'liberia' => ['lat' => 6.428055, 'lng' => -9.429499],
    'lesotho' => ['lat' => -29.609988, 'lng' => 28.233608],
    'lithuania' => ['lat' => 55.169438, 'lng' => 23.881275],
    'luxembourg' => ['lat' => 49.815273, 'lng' => 6.129583],
    'latvia' => ['lat' => 56.879635, 'lng' => 24.603189],
    'libya' => ['lat' => 26.3351, 'lng' => 17.228331],
    'morocco' => ['lat' => 31.791702, 'lng' => -7.09262],
    'monaco' => ['lat' => 43.750298, 'lng' => 7.412841],
    'moldova' => ['lat' => 47.411631, 'lng' => 28.369885],
    'montenegro' => ['lat' => 42.708678, 'lng' => 19.37439],
    'madagascar' => ['lat' => -18.766947, 'lng' => 46.869107],
    'marshall islands' => ['lat' => 7.131474, 'lng' => 171.184478],
    'macedonia [fyrom]' => ['lat' => 41.608635, 'lng' => 21.745275],
    'mali' => ['lat' => 17.570692, 'lng' => -3.996166],
    'myanmar [burma]' => ['lat' => 21.913965, 'lng' => 95.956223],
    'mongolia' => ['lat' => 46.862496, 'lng' => 103.846656],
    'macau' => ['lat' => 22.198745, 'lng' => 113.543873],
    'northern mariana islands' => ['lat' => 17.33083, 'lng' => 145.38469],
    'martinique' => ['lat' => 14.641528, 'lng' => -61.024174],
    'mauritania' => ['lat' => 21.00789, 'lng' => -10.940835],
    'montserrat' => ['lat' => 16.742498, 'lng' => -62.187366],
    'malta' => ['lat' => 35.937496, 'lng' => 14.375416],
    'mauritius' => ['lat' => -20.348404, 'lng' => 57.552152],
    'maldives' => ['lat' => 3.202778, 'lng' => 73.22068],
    'malawi' => ['lat' => -13.254308, 'lng' => 34.301525],
    'mexico' => ['lat' => 23.634501, 'lng' => -102.552784],
    'malaysia' => ['lat' => 4.210484, 'lng' => 101.975766],
    'mozambique' => ['lat' => -18.665695, 'lng' => 35.529562],
    'namibia' => ['lat' => -22.95764, 'lng' => 18.49041],
    'new caledonia' => ['lat' => -20.904305, 'lng' => 165.618042],
    'niger' => ['lat' => 17.607789, 'lng' => 8.081666],
    'norfolk island' => ['lat' => -29.040835, 'lng' => 167.954712],
    'nigeria' => ['lat' => 9.081999, 'lng' => 8.675277],
    'nicaragua' => ['lat' => 12.865416, 'lng' => -85.207229],
    'netherlands' => ['lat' => 52.132633, 'lng' => 5.291266],
    'norway' => ['lat' => 60.472024, 'lng' => 8.468946],
    'nepal' => ['lat' => 28.394857, 'lng' => 84.124008],
    'nauru' => ['lat' => -0.522778, 'lng' => 166.931503],
    'niue' => ['lat' => -19.054445, 'lng' => -169.867233],
    'new zealand' => ['lat' => -40.900557, 'lng' => 174.885971],
    'oman' => ['lat' => 21.512583, 'lng' => 55.923255],
    'panama' => ['lat' => 8.537981, 'lng' => -80.782127],
    'peru' => ['lat' => -9.189967, 'lng' => -75.015152],
    'french polynesia' => ['lat' => -17.679742, 'lng' => -149.406843],
    'papua new guinea' => ['lat' => -6.314993, 'lng' => 143.95555],
    'philippines' => ['lat' => 12.879721, 'lng' => 121.774017],
    'pakistan' => ['lat' => 30.375321, 'lng' => 69.345116],
    'poland' => ['lat' => 51.919438, 'lng' => 19.145136],
    'saint pierre and miquelon' => ['lat' => 46.941936, 'lng' => -56.27111],
    'pitcairn islands' => ['lat' => -24.703615, 'lng' => -127.439308],
    'puerto rico' => ['lat' => 18.220833, 'lng' => -66.590149],
    'palestinian territories' => ['lat' => 31.952162, 'lng' => 35.233154],
    'portugal' => ['lat' => 39.399872, 'lng' => -8.224454],
    'palau' => ['lat' => 7.51498, 'lng' => 134.58252],
    'paraguay' => ['lat' => -23.442503, 'lng' => -58.443832],
    'qatar' => ['lat' => 25.354826, 'lng' => 51.183884],
    'réunion' => ['lat' => -21.115141, 'lng' => 55.536384],
    'romania' => ['lat' => 45.943161, 'lng' => 24.96676],
    'serbia' => ['lat' => 44.016521, 'lng' => 21.005859],
    'russia' => ['lat' => 61.52401, 'lng' => 105.318756],
    'rwanda' => ['lat' => -1.940278, 'lng' => 29.873888],
    'saudi arabia' => ['lat' => 23.885942, 'lng' => 45.079162],
    'solomon islands' => ['lat' => -9.64571, 'lng' => 160.156194],
    'seychelles' => ['lat' => -4.679574, 'lng' => 55.491977],
    'sudan' => ['lat' => 12.862807, 'lng' => 30.217636],
    'sweden' => ['lat' => 60.128161, 'lng' => 18.643501],
    'singapore' => ['lat' => 1.352083, 'lng' => 103.819836],
    'saint helena' => ['lat' => -24.143474, 'lng' => -10.030696],
    'slovenia' => ['lat' => 46.151241, 'lng' => 14.995463],
    'svalbard and jan mayen' => ['lat' => 77.553604, 'lng' => 23.670272],
    'slovakia' => ['lat' => 48.669026, 'lng' => 19.699024],
    'sierra leone' => ['lat' => 8.460555, 'lng' => -11.779889],
    'san marino' => ['lat' => 43.94236, 'lng' => 12.457777],
    'senegal' => ['lat' => 14.497401, 'lng' => -14.452362],
    'somalia' => ['lat' => 5.152149, 'lng' => 46.199616],
    'suriname' => ['lat' => 3.919305, 'lng' => -56.027783],
    'são tomé and príncipe' => ['lat' => 0.18636, 'lng' => 6.613081],
    'el salvador' => ['lat' => 13.794185, 'lng' => -88.89653],
    'syria' => ['lat' => 34.802075, 'lng' => 38.996815],
    'swaziland' => ['lat' => -26.522503, 'lng' => 31.465866],
    'turks and caicos islands' => ['lat' => 21.694025, 'lng' => -71.797928],
    'chad' => ['lat' => 15.454166, 'lng' => 18.732207],
    'french southern territories' => ['lat' => -49.280366, 'lng' => 69.348557],
    'togo' => ['lat' => 8.619543, 'lng' => 0.824782],
    'thailand' => ['lat' => 15.870032, 'lng' => 100.992541],
    'tajikistan' => ['lat' => 38.861034, 'lng' => 71.276093],
    'tokelau' => ['lat' => -8.967363, 'lng' => -171.855881],
    'timor-leste' => ['lat' => -8.874217, 'lng' => 125.727539],
    'turkmenistan' => ['lat' => 38.969719, 'lng' => 59.556278],
    'tunisia' => ['lat' => 33.886917, 'lng' => 9.537499],
    'tonga' => ['lat' => -21.178986, 'lng' => -175.198242],
    'turkey' => ['lat' => 38.963745, 'lng' => 35.243322],
    'trinidad and tobago' => ['lat' => 10.691803, 'lng' => -61.222503],
    'tuvalu' => ['lat' => -7.109535, 'lng' => 177.64933],
    'taiwan' => ['lat' => 23.69781, 'lng' => 120.960515],
    'tanzania' => ['lat' => -6.369028, 'lng' => 34.888822],
    'ukraine' => ['lat' => 48.379433, 'lng' => 31.16558],
    'uganda' => ['lat' => 1.373333, 'lng' => 32.290275],
    'united states' => ['lat' => 37.09024, 'lng' => -95.712891],
    'uruguay' => ['lat' => -32.522779, 'lng' => -55.765835],
    'uzbekistan' => ['lat' => 41.377491, 'lng' => 64.585262],
    'vatican city' => ['lat' => 41.902916, 'lng' => 12.453389],
    'saint vincent and the grenadines' => ['lat' => 12.984305, 'lng' => -61.287228],
    'venezuela' => ['lat' => 6.42375, 'lng' => -66.58973],
    'british virgin islands' => ['lat' => 18.420695, 'lng' => -64.639968],
    'u.s. virgin islands' => ['lat' => 18.335765, 'lng' => -64.896335],
    'vietnam' => ['lat' => 14.058324, 'lng' => 108.277199],
    'vanuatu' => ['lat' => -15.376706, 'lng' => 166.959158],
    'wallis and futuna' => ['lat' => -13.768752, 'lng' => -177.156097],
    'samoa' => ['lat' => -13.759029, 'lng' => -172.104629],
    'kosovo' => ['lat' => 42.602636, 'lng' => 20.902977],
    'yemen' => ['lat' => 15.552727, 'lng' => 48.516388],
    'mayotte' => ['lat' => -12.8275, 'lng' => 45.166244],
    'south africa' => ['lat' => -30.559482, 'lng' => 22.937506],
    'zambia' => ['lat' => -13.133897, 'lng' => 27.849332],
    'zimbabwe' => ['lat' => -19.015438, 'lng' => 29.154857],
  ]
);

/**
 * Add theme colors for Gutenberg
 */
add_theme_support('editor-color-palette', array(
  array(
    'name' => 'Dark Gray',
    'slug' => 'gray-dark',
    'color' => SIT_STRINGS_GRAY_DARK,
  ),
  array(
    'name' => 'Dark Red',
    'slug' => 'red-dark',
    'color' => SIT_STRINGS_RED_DARK,
  ),
  array(
    'name' => 'Dark Orange',
    'slug' => 'orange-dark',
    'color' => SIT_STRINGS_ORANGE_DARK,
  ),
  array(
    'name' => 'Dark Purple',
    'slug' => 'purple-dark',
    'color' => SIT_STRINGS_PURPLE_DARK,
  ),
  array(
    'name' => 'Dark Blue',
    'slug' => 'blue-dark',
    'color' => SIT_STRINGS_BLUE_DARK,
  ),
  array(
    'name' => 'Lighter Gray',
    'slug' => 'gray-lighter',
    'color' => SIT_STRINGS_GRAY_LIGHTER,
  ),
  array(
    'name' => 'Gray',
    'slug' => 'gray',
    'color' => SIT_STRINGS_GRAY,
  ),
  array(
    'name' => 'Red',
    'slug' => 'red',
    'color' => SIT_STRINGS_RED,
  ),
  array(
    'name' => 'Orange',
    'slug' => 'orange',
    'color' => SIT_STRINGS_ORANGE,
  ),
  array(
    'name' => 'Purple',
    'slug' => 'purple',
    'color' => SIT_STRINGS_PURPLE,
  ),
  array(
    'name' => 'Blue',
    'slug' => 'blue',
    'color' => SIT_STRINGS_BLUE,
  ),
  array(
    'name' => 'Lightest Gray',
    'slug' => 'gray-lightest',
    'color' => SIT_STRINGS_GRAY_LIGHTEST,
  ),
  array(
    'name' => 'Light Gray',
    'slug' => 'gray-light',
    'color' => SIT_STRINGS_GRAY_LIGHT,
  ),
  array(
    'name' => 'Light Red',
    'slug' => 'red-light',
    'color' => SIT_STRINGS_RED_LIGHT,
  ),
  array(
    'name' => 'Light Orange',
    'slug' => 'orange-light',
    'color' => SIT_STRINGS_ORANGE_LIGHT,
  ),
  array(
    'name' => 'Light Purple',
    'slug' => 'purple-light',
    'color' => SIT_STRINGS_PURPLE_LIGHT,
  ),
  array(
    'name' => 'Light Blue',
    'slug' => 'blue-light',
    'color' => SIT_STRINGS_BLUE_LIGHT,
  ),
  array(
    'name' => 'White',
    'slug' => 'white',
    'color' => SIT_STRINGS_WHITE,
  ),
));

/**
 * Local dev helper
 */
function is_dev($ignore_dist = false) {
  $test_dist = $ignore_dist || !file_exists(dirname(__FILE__) . '/dist/');
  return $_SERVER['HTTP_HOST'] == LOCAL_DOMAIN && $test_dist;
}

/**
 * Asset path helper
 */
function asset_path($path) {
  global $manifest;

  $is_dev = $_SERVER['HTTP_HOST'] == LOCAL_DOMAIN;
  if (!$is_dev) :
    if (empty($manifest)) :
      $manifest_path = dirname(__FILE__) . '/dist/manifest.json';
      $manifest = file_exists($manifest_path) ? json_decode(file_get_contents($manifest_path), true) : [];
    endif;
    $filename = pathinfo($path)['basename'];
    $path = $manifest[$path] ?? $manifest[$filename] ?? $path;
  endif;

  $asset_path = $is_dev ? 'http://localhost:9000/assets' : get_stylesheet_directory_uri();
  return "$asset_path/$path";
}

/**
 * Inline SVG helper
 */
function inline_svg($path) {
  $is_dev = is_dev();
  $is_local = is_dev(true /* ignore dist */);
  $asset_path = asset_path($path);
  $svg_path = $is_dev ? str_replace('http://localhost:9000', dirname(__FILE__), $asset_path) : $asset_path;
  $stream_context = $is_local ? stream_context_create([
    'ssl' => [
      'verify_peer' => false,
      'verify_peer_name' => false,
    ]
  ]) : null;
  return file_get_contents($svg_path, false, $stream_context);
}

/**
 * Setup theme
 */
add_action('init', function () {
  add_post_type_support('page', 'excerpt');

  /**
   * Enable plugins to manage the document title
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
   */
  add_theme_support('title-tag');

  /**
   * Enable post thumbnails
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support('post-thumbnails');

  /**
   * Enable HTML5 markup support
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
   */
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  /**
   * Enable Block Editor features
   */
  add_theme_support('align-wide');
  add_theme_support('editor-styles');
  add_editor_style(asset_path('styles/editor.css'));

  /**
   * Disable WooCommerce sidebar
   */
  remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

  add_role('artist-06', 'Artist - Level 6', get_role('customer')->capabilities);
  add_role('artist-05', 'Artist - Level 5', get_role('customer')->capabilities);
  add_role('artist-04', 'Artist - Level 4', get_role('customer')->capabilities);
  add_role('artist-03', 'Artist - Level 3', get_role('customer')->capabilities);
  add_role('artist-02', 'Artist - Level 2', get_role('customer')->capabilities);
  add_role('artist-01', 'Artist - Level 1', get_role('customer')->capabilities);
});

// add_action('acf/init', function() {
// 	$products = wc_get_products([
// 		"limit" => -1
// 	]);

// 	foreach ($products as $product) {
// 		$product_category_ids = $product->category_ids;
// 		$product_primary_category = $product_category_ids[0];

// 		foreach ($product_category_ids as $id) {
// 			$cat = get_term($id);

// 			if ($cat->parent) {
// 				$product_primary_category = $id;
// 			}
// 		}

// 		$updated = update_field('primary_category', $product_primary_category, $product->id);
// 	}
// });

/**
 * After setup theme
 */
add_action('after_setup_theme', function () {
  /**
   * Enable WooCommerce templates
   */
  add_theme_support('woocommerce');
});

/**
 * Wrap WooCommerce content in .container
 */
add_action('woocommerce_before_main_content', function () {
  echo '<div class="container">';
});
add_action('woocommerce_after_main_content', function () {
  echo '</div">';
});

/**
 * Enqueue editor assets
 */
add_action('enqueue_block_editor_assets', 'sit_strings_custom_block_styles');
function sit_strings_custom_block_styles($hook) {
  wp_enqueue_style('sit-strings-editor-css', asset_path('styles/editor.css'), array(), SIT_STRINGS_VERSION, 'all');
  wp_enqueue_script('sit-strings-editor-js', asset_path('scripts/editor.js'), array('wp-blocks', 'wp-dom'), SIT_STRINGS_VERSION, true);
}

/**
 * Enqueue styles
 */
add_action('wp_enqueue_scripts', 'sit_strings_enqueue_assets', 15);
function sit_strings_enqueue_assets() {
  wp_enqueue_style('sit-strings-css', asset_path('styles/main.css'), array(), SIT_STRINGS_VERSION, 'all');
  wp_enqueue_script('sit-strings-js', asset_path('scripts/main.js'), array('jquery'), SIT_STRINGS_VERSION, true);
  if (is_post_type_archive('dealer')) :
    wp_enqueue_script('sit-strings-dealers-js', asset_path('scripts/dealers.js'), array('sit-strings-js'), SIT_STRINGS_VERSION, true);
  endif;
}

/**
 * Register navigation menus
 */
register_nav_menus([
  'primary_navigation' => __('Primary Navigation', 'sit-strings'),
  'footer_navigation' => __('Footer Navigation', 'sit-strings')
]);

/**
 * Adds Artist image data to primary navigation menu
 */
add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $args) {
  if (1 === $depth && $image_id = get_field('image', $item)) :
    $item_output .= wp_get_attachment_image($image_id, 'large', false, ['class' => 'menu-item-image']);
  endif;
  return $item_output;
}, 10, 4);

/**
 * Adds Reusable Blocks to ACF post types
 */
add_filter('acf/get_post_types', function ($post_types) {
  if (!in_array('wp_block', $post_types)) :
    $post_types[] = 'wp_block';
  endif;
  return $post_types;
});


/**
 * Registers footer widget areas
 */
add_action('widgets_init', function () {
  register_sidebar([
    'name'          => 'Footer 1',
    'id'            => 'footer-1',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ]);
  register_sidebar([
    'name'          => 'Footer 2',
    'id'            => 'footer-2',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ]);
  register_sidebar([
    'name'          => 'Footer 3',
    'id'            => 'footer-3',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ]);
  register_sidebar([
    'name'          => 'Header Button',
    'id'            => 'header-button',
    'before_widget' => '<div class="adjust-wysiwyg">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ]);
});


/**
 * Adds new fields for product variations
 */
add_action('woocommerce_product_after_variable_attributes', function ($loop, $variation_data, $variation) {
  require_once ABSPATH . 'wp-admin/includes/meta-boxes.php';

  woocommerce_wp_text_input([
    'id' => "box_quantity[{$variation->ID}]",
    'label' => 'Box Quantity',
    'value' => get_post_meta($variation->ID, 'box_quantity', true),
    'type' => 'number',
    'wrapper_class' => 'form-row form-row-first',
    'custom_attributes' => [
      'step'   => 'any',
      'min'  => '1'
    ]
  ]);

  woocommerce_wp_text_input([
    'id' => "gauges[{$variation->ID}]",
    'label' => 'Gauges',
    'value' => get_post_meta($variation->ID, 'gauges', true),
    'wrapper_class' => 'form-row form-row-last'
  ]);

  $tags = strip_tags(wc_get_product_tag_list($variation->ID));
  woocommerce_wp_text_input([
    'id' => "product_filters[{$variation->ID}]",
    'label' => 'Product Filter(s)',
    'value' => !empty($tags) ? $tags : get_post_meta($variation->ID, 'product_filters', true),
    'wrapper_class' => 'form-row',
    'description' => 'Separate filters by a comma(ex: "6-String, Rock n Roll, Light, Signature Strings, etc."). Make sure you are using consistent filter naming across all product variations for a consistent filtering experience and user interface.',
  ]);
}, 10, 3);

/**
 * Saves new fields for variations
 */
add_action('woocommerce_save_product_variation', function ($post_id) {
  if (isset($_POST['box_quantity'][$post_id])) {
    $box_quantity = $_POST['box_quantity'][$post_id];
    update_post_meta($post_id, 'box_quantity', esc_attr($box_quantity));
  }

  if (isset($_POST['gauges'][$post_id])) {
    $gauges = $_POST['gauges'][$post_id];
    update_post_meta($post_id, 'gauges', esc_attr($gauges));
  }

  if (isset($_POST['product_filters'][$post_id])) {
    $product_filters = $_POST['product_filters'][$post_id];
    wp_set_post_terms($post_id, esc_attr($product_filters), 'product_tag');
  }
}, 10, 2);


/**
 * Disables Woocommerce Select2
 */
add_action('wp_enqueue_scripts', function () {
  wp_dequeue_style('select2');
  wp_dequeue_script('select2');
  wp_dequeue_script('selectWoo');
}, 11);

/**
 * Rearranges Woocommerce Checkout form
 */
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 20);
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);

add_action('woocommerce_checkout_payment', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_checkout_login', 'woocommerce_checkout_login_form', 20);
add_action('woocommerce_checkout_coupon', 'woocommerce_checkout_coupon_form', 20);

remove_action('woocommerce_thankyou', 'woocommerce_order_details_table', 10);
add_action('woocommerce_thankyou', 'woocommerce_checkout_details_table', 10);


/**
 * Displays checkout order details in a table.
 *
 * @param mixed $order_id Order ID.
 */
function woocommerce_checkout_details_table($order_id) {
  if (!$order_id) {
    return;
  }

  wc_get_template(
    'checkout/order-details.php',
    array(
      'order_id' => $order_id,
    )
  );
}

/**
 * Always display variation price even if all variations are the same price
 */
add_filter('woocommerce_show_variation_price', '__return_true');

/**
 * Helper function get a product image ID, falling back to a default/first variation image if possible
 */
function sit_product_image_id($product) {
  $image_id = $product->get_image_id();
  if (!$image_id && $product->is_type('variable')) :
    $variations = $product->get_available_variations();
    $default_attributes = $product->get_default_attributes();
    $default_variation = null;
    foreach ($variations as $variation) :
      if (empty(array_diff($default_attributes, $variation['attributes']))) :
        $default_variation = $variation;
        break;
      endif;
    endforeach;
    $default_variation = $default_variation ?: array_shift($variations);
    $image_id = $default_variation && !empty($default_variation['image_id']) ? $default_variation['image_id'] : null;
  endif;
  return $image_id;
}

/**
 * Helper function get a product image markup, falling back to a default/first variation image if possible
 */
function sit_product_image($product, $size = null, $icon = null, $attr = null) {
  $image_id = sit_product_image_id($product) ?: get_option('woocommerce_placeholder_image', 0);
  return wp_get_attachment_image($image_id, $size, $icon, $attr);
}

/**
 * Helper function get a category image ID, falling back to the first product image if possible
 */
function sit_category_image_id($category) {
  $image_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
  if (!$image_id) :
    $products = wc_get_products(['limit' => 1, 'category' => [$category->slug]]);
    $product = !empty($products) ? $products[0] : null;
    $image_id = sit_product_image_id($product);
  endif;
  return $image_id;
}

/**
 * Helper function get a category image markup, falling back to the first product image if possible
 */
function sit_category_image($category, $size = null, $icon = null, $attr = null) {
  $image_id = sit_category_image_id($category) ?: get_option('woocommerce_placeholder_image', null);
  return wp_get_attachment_image($image_id, $size, $icon, $attr);
}

/**
 * Show cart contents / total Ajax
 */

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment($fragments) {
  global $woocommerce;
  ob_start();
  $count = $woocommerce->cart->cart_contents_count;
?>
  <span class="navbar-controls__cart-count" data-count="<?= $count ?>">
    <?= $count ?>
  </span>
<?php
  $fragments['span.navbar-controls__cart-count'] = ob_get_clean();
  return $fragments;
}

/**
 * Allow custom "with_brightness" query var for WC product queries
 */
add_filter('woocommerce_product_data_store_cpt_get_products_query', function ($query, $query_vars) {
  if (!empty($query_vars['with_brightness'])) :
    $query['meta_query'][] = [
      'relation' => 'AND',
      [
        'key' => 'brightness',
        'compare' => 'EXISTS'
      ],
      [
        'key' => 'brightness',
        'value' => 0,
        'compare' => '>='
      ]
    ];
  endif;
  return $query;
}, 10, 2);


/**
 * Add Google API key for ACF Pro
 * Note: Set constant in wp-config.php with define('GOOGLE_API_KEY', '...');
 */
add_action('acf/init', function () {
  if (defined('GOOGLE_API_KEY')) :
    acf_update_setting('google_api_key', GOOGLE_API_KEY);
  endif;
});

/**
 * Get all dealer data
 */
function sit_dealer_data($force_update = false) {
  $data = $force_update ? false : get_transient('sit_dealer_data');
  if (empty($data)) :
    $data = array_map(function ($dealer) {
      return array_merge((array) $dealer, get_fields($dealer));
    }, get_posts([
      'post_type' => 'dealer',
      'posts_per_page' => -1,
      'order' => 'ASC',
      'orderby' => 'title',
    ]));
    set_transient('sit_dealer_data', $data);
  endif;
  return  $data;
}

/*
Get distributor data
*/
function sit_distributor_data($force_update = false) {

  $terms = get_terms('distributor-country');

  $data = [];

  foreach ($terms as $term) {
    $new_data = array_map(function ($dealer) {
      return array_merge((array) $dealer, get_fields($dealer));
    }, get_posts([
      'post_type' => 'distributor',
      'posts_per_page' => -1,
      'order' => 'ASC',
      'orderby' => 'title',
      'tax_query'  => array(
        array(
          'taxonomy' => 'distributor-country',
          'field' => 'slug',
          'terms' => $term->slug,
          'operator' => 'IN'
        ),
      )
    ]));

    foreach ($new_data as $key => $value) {
      $new_data[$key]['country'] = $term->slug;
      $location = COUNTRY_LOCATIONS_MAP[$term->slug];
      if ($value['Address']) {
        $new_data[$key]['address'] = strip_tags($value['Address']);
      }

      $new_data[$key]['location'] = $location;
    }

    $data = array_merge($data, $new_data);
  }

  return  $data;
}

/**
 * Update cached dealer data when a dealer post is added or updated
 */
add_action('save_post_dealer', function () {
  sit_dealer_data(true); // force update
});

// Move billing email into shipping section
add_filter('woocommerce_checkout_fields', function ($fields) {
  $fields['shipping']['billing_email'] = $fields['billing']['billing_email'];
  $fields['shipping']['billing_phone'] = $fields['billing']['billing_phone'];
  unset($fields['billing']['billing_email']);
  unset($fields['billing']['billing_phone']);
  return $fields;
});

/**
 * Copy shipping address to billing address if "bill to different address" is not checked
 */
add_action('woocommerce_checkout_process', function () {
  if (!$_POST['bill_to_different_address']) {
    $_POST['billing_first_name'] = $_POST['shipping_first_name'];
    $_POST['billing_last_name'] = $_POST['shipping_last_name'];
    $_POST['billing_company'] = $_POST['shipping_company'];
    $_POST['billing_country'] = $_POST['shipping_country'];
    $_POST['billing_address_1'] = $_POST['shipping_address_1'];
    $_POST['billing_address_2'] = $_POST['shipping_address_2'];
    $_POST['billing_city'] = $_POST['shipping_city'];
    $_POST['billing_state'] = $_POST['shipping_state'];
    $_POST['billing_postcode'] = $_POST['shipping_postcode'];
  }
});

/**
 * My Account pages
 */
add_action('woocommerce_before_customer_login_form', function () {
  echo '<div class="py-4 pt-lg-5 mx-auto myaccount-login">';
}, 1);
add_action('woocommerce_after_customer_login_form', function () {
  echo '</div>';
}, 1);

add_action('woocommerce_account_content', function () {
  echo '<h1 class="mb-md">My Account</h1>';
}, 1);

add_action('woocommerce_before_account_orders', function () {
  echo '<h2 class="h5 mb-4">Orders</h2>';
}, 1);
add_action('woocommerce_before_account_downloads', function () {
  echo '<h2 class="h5 mb-4">Downloads</h2>';
}, 1);
add_action('woocommerce_before_edit_account_address_form', function () {
  echo '<h2 class="h5 mb-4">Addresses</h2>';
}, 1);
add_action('woocommerce_before_account_payment_methods', function () {
  echo '<h2 class="h5 mb-4">Payment Methods</h2>';
}, 1);
add_action('woocommerce_before_edit_account_form', function () {
  echo '<h2 class="h5 mb-4">Account Details</h2>';
}, 1);
add_action('woocommerce_before_edit_account_address_form', function () {
  echo '<div class="wc-form">';
}, 1);
add_action('woocommerce_after_edit_account_address_form', function () {
  echo '</div>';
}, 1);
add_action('woocommerce_before_edit_account_form', function () {
  echo '<div class="wc-form wc-form__account-details">';
}, 1);
add_action('woocommerce_after_edit_account_form', function () {
  echo '</div>';
}, 1);

/**
 * Helper to return the corresponding WP_Posts for all variations of a variable product
 */
function get_product_variation_posts($product, $order = 'menu_order') {
  $product = wc_get_product($product);

  if (!$product->is_type('variable')) return [$product];

  $variations = $product->get_available_variations();
  if (empty($variations)) return [];

  $args = [
    'post_type' => 'product_variation',
    'include' => array_column($variations, 'variation_id'),
  ];

  switch ($order):
    case 'popularity':
      $args['orderby'] = 'meta_value_num';
      $args['meta_key'] = 'total_sales';
      $args['order'] = 'DESC';
      break;
    case 'latest':
      $args['orderby'] = 'date';
      $args['order'] = 'DESC';
      break;
    case 'price':
      $args['orderby'] = 'meta_value_num';
      $args['order'] = 'ASC';
      $args['meta_key'] = '_price';
      break;
    case 'price-desc':
      $args['orderby'] = 'meta_value_num';
      $args['order'] = 'DESC';
      $args['meta_key'] = '_price';
      break;
    default:
      $args['orderby'] = 'menu_order';
      $args['order'] = 'ASC';
      break;
  endswitch;

  return get_posts($args);
}

/**
 * Replace product archive queries with variations
 */
add_filter('posts_results', function ($posts, $query) {
  if (
    !$query->is_admin() && $query->is_main_query() && $query->is_tax('product_cat') &&
    ('subcategories' !== get_term_meta(get_queried_object_id(), 'display_type', true)) &&
    empty(get_field('hide_variations', get_queried_object()))
  ) :
    $new_posts = [];
    $order = $_GET['orderby'] ?: null;

    foreach ($posts as $post) :
      $product = wc_get_product($post->ID);
      if ($product->is_type('variable')) :
        $new_posts = array_merge($new_posts, get_product_variation_posts($product, $order));
      else :
        $new_posts[] = $post;
      endif;
    endforeach;
    return $new_posts;
  endif;
  return $posts;
}, 10, 2);


/**
 * WC BREADCRUMBS
 */

// Update the shop label to "Products"
add_filter('woocommerce_get_breadcrumb', function ($crumbs, $Breadcrumb) {
  $shop_page_id = wc_get_page_id('shop');
  if ($shop_page_id > 0 && !is_shop()) {
    $new_breadcrumb = [
      _x('Products', 'breadcrumb', 'woocommerce'),
      get_permalink(wc_get_page_id('shop'))
    ];
    array_splice($crumbs, 1, 0, [$new_breadcrumb]);
  }
  return $crumbs;
}, 10, 2);

// Change the breadcrumb separator
add_filter('woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter');
function wcc_change_breadcrumb_delimiter($defaults) {
  $chevron = inline_svg('images/icon-chevron-right.svg');
  $defaults['delimiter'] = $chevron;
  return $defaults;
}


/**
 * RANK MATH BREADCRUMBS
 */

// Filters Rank Math breadcrumb settings to add separator
add_filter('rank_math/frontend/breadcrumb/html', function ($html, $crumbs, $class) {
  $chevron = inline_svg('images/icon-chevron-right.svg');
  return str_replace('<span class="separator"> &nbsp; </span>', "<span class='separator'> $chevron </span>", $html);
}, 10, 3);

// Distributors; add Dealers parent
add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
  if (get_post_type() === 'distributor' && is_archive()) {
    $dist_crumb[] = array(
      "0" => esc_html('International Dealers and Distributors'),
      "1" => esc_url('/dealers/distributors/'),
      "hide_in_scheme" => false
    );

    $dealer_crumb[] = array(
      "0" => esc_html('Find a Dealer'),
      "1" => esc_url('/dealers/'),
      "hide_in_scheme" => false
    );

    $new_crumbs = array_merge($dealer_crumb, $dist_crumb);
    array_splice($crumbs, 1, 1, $new_crumbs);

    return $crumbs;
  }
  return $crumbs;
}, 10, 2);

// Artist parent page addition
add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
  if (get_post_type() === 'artist') {

    $new_crumb[]  = array(
      "0" => esc_html('Artists'),
      "1" => esc_url('/artists/'),
      "hide_in_scheme" => false
    );
    array_splice($crumbs, 1, 0, $new_crumb);

    return $crumbs;
  }
  return $crumbs;
}, 10, 2);

// generates a random color class, using a global variable to ensure no repeated colors
$last_color = 0;
function random_color_class() {
  global $last_color;

  $colors = ['has-red-color', 'has-orange-color', 'has-purple-color', 'has-blue-color'];
  $rand = array_rand($colors);

  if ($rand == $last_color) {
    return random_color_class();
  }

  $last_color = $rand;

  return $colors[$rand];
}


// retrieves primary product category id based the primary category ACF field
// else the first sub category attached to the product
// else the first category attached to the product
function get_product_primary_category_id($product_id) {
  $product = wc_get_product($product_id);

  if ($product) {
    $product_primary_category = get_field('primary_category', $product_id);

    if (!$product_primary_category) {
      $product_category_ids = $product->category_ids;
      $product_primary_category = $product->category_ids[0];

      foreach ($product_category_ids as $id) {
        $cat = get_term($id);

        if ($cat->parent) {
          $product_primary_category = $id;
        }
      }
    }

    return $product_primary_category;
  }

  return false;
}

// overwrite relevanssi search match weights based on user chosen priority
add_filter('relevanssi_match', function ($match) {

  if (is_admin()) {
    return $match;
  }

  if (!has_term('single-strings', 'product_cat', $match->doc)) {
    $match->weight = ($match->weight + 500) * 1.25;
  } else {
    $match->weight *= .5;
  }

  return $match;
});

add_filter('pre_get_posts', function ($query) {
  if ($query->is_search() && $query->is_main_query() && !is_admin()) {
    $query->set('posts_per_page', '50');
    $query->set('post_type', ['post', 'page', 'product', 'product_variation', 'artist', 'dealer']);
  }
});

// Redirect logout to login page
add_action('wp_logout', 'ps_redirect_after_logout');
function ps_redirect_after_logout() {
  wp_redirect('/my-account/');
  exit();
}

/**
 * Allow logout without confirmation
 */
add_action('check_admin_referer', 'sit_logout_without_confirm', 10, 2);
function sit_logout_without_confirm($action, $result) {

  if ($action == "log-out" && !isset($_GET['_wpnonce'])) :
    $redirectUrl = '/';
    wp_redirect(wp_logout_url($redirectUrl . '?logout=true'));
    exit;
  endif;
}

// Force shipping fee if artist
add_filter( 'woocommerce_package_rates', 'hide_specific_shipping_method_based_on_user_role', 100, 2 );
function hide_specific_shipping_method_based_on_user_role( $rates, $package ) {
    // Here define the shipping rate ID to hide
    $targeted_rate_id    = 'free_shipping:1'; // The shipping rate ID to hide
    $targeted_user_roles = array('artist-01', 'artist-02', 'artist-03', 'artist-04', 'artist-05', 'artist-06');  // The user roles to target (array)

    $current_user  = wp_get_current_user();
    $matched_roles = array_intersect($targeted_user_roles, $current_user->roles);

    if( ! empty($matched_roles) && isset($rates[$targeted_rate_id]) ) {
        unset($rates[$targeted_rate_id]);
    }
    return $rates;
}
