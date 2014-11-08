<?php
return array(
	'ctrl' => array(
		'label' => 'title',
		'tstamp' => 'tstamp',
		'default_sortby' => 'ORDER BY title',
		'title' => 'LLL:EXT:lang/locallang_tca.xlf:sys_language',
		'adminOnly' => 1,
		'rootLevel' => 1,
		'enablecolumns' => array(
			'disabled' => 'hidden'
		),
		'typeicon_classes' => array(
			'default' => 'mimetypes-x-sys_language'
		),
		'versioningWS_alwaysAllowLiveEdit' => TRUE
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden,title'
	),
	'columns' => array(
		'title' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'input',
				'size' => '35',
				'max' => '80',
				'eval' => 'trim,required'
			)
		),
		'hidden' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.disable',
			'exclude' => 1,
			'config' => array(
				'type' => 'check',
				'default' => '0'
			)
		),
		'language_isocode' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_language.language_isocode',
			'config' => array(
				'type' => 'select',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				// list taken from http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
				'items' => array(
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ab', 'ab'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.aa', 'aa'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.af', 'af'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ak', 'ak'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sq', 'sq'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.am', 'am'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ar', 'ar'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.an', 'an'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.hy', 'hy'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.as', 'as'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.av', 'av'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ae', 'ae'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ay', 'ay'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.az', 'az'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.bm', 'bm'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ba', 'ba'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.eu', 'eu'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.be', 'be'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.bn', 'bn'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.bh', 'bh'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.bi', 'bi'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.bs', 'bs'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.br', 'br'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.bg', 'bg'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.my', 'my'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ca', 'ca'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ch', 'ch'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ce', 'ce'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ny', 'ny'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.zh', 'zh'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.cv', 'cv'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.kw', 'kw'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.co', 'co'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.cr', 'cr'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.hr', 'hr'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.cs', 'cs'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.da', 'da'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.dv', 'dv'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.nl', 'nl'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.dz', 'dz'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.en', 'en'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.eo', 'eo'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.et', 'et'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ee', 'ee'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.fo', 'fo'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.fj', 'fj'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.fi', 'fi'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.fr', 'fr'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ff', 'ff'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.gl', 'gl'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ka', 'ka'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.de', 'de'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.el', 'el'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.gn', 'gn'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.gu', 'gu'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ht', 'ht'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ha', 'ha'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.he', 'he'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.hz', 'hz'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.hi', 'hi'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ho', 'ho'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.hu', 'hu'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ia', 'ia'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.id', 'id'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ie', 'ie'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ga', 'ga'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ig', 'ig'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ik', 'ik'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.io', 'io'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.is', 'is'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.it', 'it'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.iu', 'iu'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ja', 'ja'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.jv', 'jv'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.kl', 'kl'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.kn', 'kn'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.kr', 'kr'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ks', 'ks'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.kk', 'kk'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.km', 'km'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ki', 'ki'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.rw', 'rw'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ky', 'ky'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.kv', 'kv'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.kg', 'kg'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ko', 'ko'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ku', 'ku'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.kj', 'kj'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.la', 'la'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.lb', 'lb'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.lg', 'lg'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.li', 'li'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ln', 'ln'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.lo', 'lo'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.lt', 'lt'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.lu', 'lu'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.lv', 'lv'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.gv', 'gv'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.mk', 'mk'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.mg', 'mg'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ms', 'ms'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ml', 'ml'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.mt', 'mt'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.mi', 'mi'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.mr', 'mr'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.mh', 'mh'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.mn', 'mn'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.na', 'na'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.nv', 'nv'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.nd', 'nd'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ne', 'ne'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ng', 'ng'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.nb', 'nb'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.nn', 'nn'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.no', 'no'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ii', 'ii'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.nr', 'nr'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.oc', 'oc'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.oj', 'oj'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.cu', 'cu'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.om', 'om'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.or', 'or'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.os', 'os'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.pa', 'pa'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.pi', 'pi'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.fa', 'fa'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.pl', 'pl'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ps', 'ps'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.pt', 'pt'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.qu', 'qu'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.rm', 'rm'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.rn', 'rn'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ro', 'ro'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ru', 'ru'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sa', 'sa'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sc', 'sc'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sd', 'sd'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.se', 'se'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sm', 'sm'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sg', 'sg'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sr', 'sr'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.gd', 'gd'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sn', 'sn'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.si', 'si'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sk', 'sk'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sl', 'sl'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.so', 'so'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.st', 'st'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.es', 'es'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.su', 'su'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sw', 'sw'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ss', 'ss'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.sv', 'sv'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ta', 'ta'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.te', 'te'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.tg', 'tg'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.th', 'th'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ti', 'ti'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.bo', 'bo'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.tk', 'tk'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.tl', 'tl'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.tn', 'tn'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.to', 'to'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.tr', 'tr'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ts', 'ts'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.tt', 'tt'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.tw', 'tw'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ty', 'ty'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ug', 'ug'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.uk', 'uk'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ur', 'ur'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.uz', 'uz'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.ve', 've'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.vi', 'vi'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.vo', 'vo'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.wa', 'wa'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.cy', 'cy'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.wo', 'wo'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.fy', 'fy'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.xh', 'xh'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.yi', 'yi'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.yo', 'yo'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.za', 'za'),
					array('LLL:EXT:core/Resources/Private/Language/db.xlf:sys_language.language_isocode.zu', 'zu')
				)
			)
		),
		'static_lang_isocode' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_language.isocode',
			'displayCond' => 'EXT:static_info_tables:LOADED:true',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0)
				),
				'foreign_table' => 'static_languages',
				'foreign_table_where' => 'AND static_languages.pid=0 ORDER BY static_languages.lg_name_en',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1
			)
		),
		'flag' => array(
			'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_language.flag',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0, '')
				),
				'selicon_cols' => 16,
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1
			)
		)
	),
	'types' => array(
		'1' => array('showitem' => 'hidden,title,language_isocode,flag')
	)
);
