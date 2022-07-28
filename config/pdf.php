 <?php
//return [
	//'font_path' => base_path('webassets/dist/fonts/'),
	//'font_data' => [
		//'Quantify' => [
			//'R'  => 'Cairo-Regular.ttf',
			//'B'  => 'Cairo-Bold.ttf',


		//]
	//]



//];

return [
    'mode'                       => 'utf-8',
    'format'                     => 'A4',
    'default_font_size'          => '12',
    'default_font'               => 'sans-serif',
    'margin_left'                => 10,
    'margin_right'               => 10,
    'margin_top'                 => 10,
    'margin_bottom'              => 10,
    'margin_header'              => 0,
    'margin_footer'              => 0,
    'orientation'                => 'P',
    'title'                      => 'Laravel mPDF',
    'author'                     => '',
    'watermark'                  => '',
    'show_watermark'             => false,
    'show_watermark_image'       => false,
    'watermark_font'             => 'sans-serif',
    'display_mode'               => 'fullpage',
    'watermark_text_alpha'       => 0.1,
    'watermark_image_path'       => '',
    'watermark_image_alpha'      => 0.2,
    'watermark_image_size'       => 'D',
    'watermark_image_position'   => 'P',
    'custom_font_dir'            => '',
    'custom_font_data'           => [],
    'auto_language_detection'    => true,
    'temp_dir'                   => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
    'pdfa'                       => false,
    'pdfaauto'                   => true,
    'use_active_forms'           => false,
'autoScriptToLang' =>  true ,
'autoLangToFont'   => true ,
'unAGlyphs' => true,
'allow_charset_conversion' => false,
    'custom_font_dir'  => base_path('resources/fonts/'), // don't forget the trailing slash!
    'custom_font_data' => [
      'examplefont' => [
       // 'R' => '4_3D.ttf',    // regular font
       'R' => 'Calibri.ttf',
       'B' => 'calibrib.ttf',
                // 'B' => 'Cairo-Bold.ttf',          // optional: bold font
//                        'useOTL' => 0xFF,
                'useOTL' => 0x80,
                'useKashida' => 75,
      ]
        // ...add as many as you want.
    ]












  ];


