<?php

use yii\db\Migration;

/**
 * Class m180816_070218_add_iso_code_table
 */
class m180816_070218_add_iso_code_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->null(),
            'updated_at' => $this->dateTime()->null(),
            'name' => $this->string(191)->null()->defaultValue(null),
            'iso_code' => $this->string(32)->null()->defaultValue(null),
            'phone_code' => $this->string(32)->null()->defaultValue(null),
        ]);

        $created_at = date('Y-m-d H:i:s');

        foreach ($this->codes() as $country){
            $this->insert('{{%country}}', [
                'created_at' => $created_at,
                'iso_code' => $country['iso_code'],
                'phone_code' => $country['phone_code'],
                'name' => $country['name'],
            ]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('country');
    }

    public function codes()
    {
        return [
            ['iso_code' => 'ad','phone_code' => '376','name' => 'Andorra'],
            ['iso_code' => 'ae','phone_code' => '971','name' => 'United Arab Emirates'],
            ['iso_code' => 'af','phone_code' => '93','name' => 'Afghanistan'],
            ['iso_code' => 'ag','phone_code' => '1268','name' => 'Antigua and Barbuda'],
            ['iso_code' => 'ai','phone_code' => '1264','name' => 'Anguilla (GB)'],
            ['iso_code' => 'al','phone_code' => '355','name' => 'Albania'],
            ['iso_code' => 'am','phone_code' => '374','name' => 'Armenia'],
            ['iso_code' => 'ao','phone_code' => '244','name' => 'Angola'],
            ['iso_code' => 'ar','phone_code' => '54','name' => 'Argentina'],
            ['iso_code' => 'as','phone_code' => '684','name' => 'Eastern Samoa (US)'],
            ['iso_code' => 'at','phone_code' => '43','name' => 'Austria'],
            ['iso_code' => 'au','phone_code' => '61','name' => 'Australia'],
            ['iso_code' => 'aw','phone_code' => '297','name' => 'Aruba'],
            ['iso_code' => 'az','phone_code' => '994','name' => 'Azerbaijan'],
            ['iso_code' => 'bb','phone_code' => '1246','name' => 'Barbados'],
            ['iso_code' => 'bd','phone_code' => '880','name' => 'Bangladesh'],
            ['iso_code' => 'be','phone_code' => '32','name' => 'Belgium'],
            ['iso_code' => 'bg','phone_code' => '359','name' => 'Bulgaria'],
            ['iso_code' => 'bh','phone_code' => '973','name' => 'Bahrain'],
            ['iso_code' => 'bi','phone_code' => '257','name' => 'Burundi'],
            ['iso_code' => 'bj','phone_code' => '229','name' => 'Benin'],
            ['iso_code' => 'bm','phone_code' => '1441','name' => 'Bermuda'],
            ['iso_code' => 'bn','phone_code' => '673','name' => 'Brunei Darassalam'],
            ['iso_code' => 'bo','phone_code' => '591','name' => 'Bolivia'],
            ['iso_code' => 'br','phone_code' => '55','name' => 'Brazil'],
            ['iso_code' => 'bs','phone_code' => '1242','name' => 'Bahamas'],
            ['iso_code' => 'bt','phone_code' => '975','name' => 'Bhutan'],
            ['iso_code' => 'bv','phone_code' => '0','name' => 'Beauvais'],
            ['iso_code' => 'bw','phone_code' => '267','name' => 'Botswana'],
            ['iso_code' => 'by','phone_code' => '375','name' => 'Belarus'],
            ['iso_code' => 'bz','phone_code' => '501','name' => 'Belize'],
            ['iso_code' => 'ca','phone_code' => '1','name' => 'Canada'],
            ['iso_code' => 'cc','phone_code' => '672','name' => 'Cocos (Keeling) Islands'],
            ['iso_code' => 'cf','phone_code' => '236','name' => 'Central African Republic'],
            ['iso_code' => 'cg','phone_code' => '242','name' => 'Congo'],
            ['iso_code' => 'ch','phone_code' => '41','name' => 'Switzerland'],
            ['iso_code' => 'ck','phone_code' => '682','name' => 'Cook Islands (NZ)'],
            ['iso_code' => 'cm','phone_code' => '237','name' => 'Cameroon'],
            ['iso_code' => 'cn','phone_code' => '86','name' => 'China'],
            ['iso_code' => 'co','phone_code' => '57','name' => 'Colombia'],
            ['iso_code' => 'cr','phone_code' => '506','name' => 'Costa Rica'],
            ['iso_code' => 'cu','phone_code' => '53','name' => 'Cuba'],
            ['iso_code' => 'cv','phone_code' => '238','name' => 'Cape Verde'],
            ['iso_code' => 'cx','phone_code' => '672','name' => 'Christmas Island'],
            ['iso_code' => 'cy','phone_code' => '357','name' => 'Cyprus'],
            ['iso_code' => 'cz','phone_code' => '420','name' => 'Czech Republic'],
            ['iso_code' => 'de','phone_code' => '49','name' => 'Germany'],
            ['iso_code' => 'dj','phone_code' => '253','name' => 'Djibouti'],
            ['iso_code' => 'dk','phone_code' => '45','name' => 'Denmark'],
            ['iso_code' => 'dm','phone_code' => '1767','name' => 'Dominica'],
            ['iso_code' => 'do','phone_code' => '1809','name' => 'Dominican Republic'],
            ['iso_code' => 'dz','phone_code' => '21','name' => 'Algeria'],
            ['iso_code' => 'ec','phone_code' => '593','name' => 'Ecuador'],
            ['iso_code' => 'ee','phone_code' => '372','name' => 'Estonia'],
            ['iso_code' => 'eg','phone_code' => '20','name' => 'Egypt'],
            ['iso_code' => 'eh','phone_code' => '21','name' => 'West Sahara'],
            ['iso_code' => 'er','phone_code' => '291','name' => 'Eritrea'],
            ['iso_code' => 'es','phone_code' => '34','name' => 'Spain'],
            ['iso_code' => 'et','phone_code' => '251','name' => 'Ethiopia'],
            ['iso_code' => 'fi','phone_code' => '358','name' => 'Finland'],
            ['iso_code' => 'fj','phone_code' => '679','name' => 'Fiji'],
            ['iso_code' => 'fo','phone_code' => '298','name' => 'Faroe Islands (DK)'],
            ['iso_code' => 'fr','phone_code' => '33','name' => 'France'],
            ['iso_code' => 'ga','phone_code' => '241','name' => 'Gabon'],
            ['iso_code' => 'gd','phone_code' => '1473','name' => 'Grenada'],
            ['iso_code' => 'ge','phone_code' => '995','name' => 'Georgia'],
            ['iso_code' => 'gh','phone_code' => '233','name' => 'Ghana'],
            ['iso_code' => 'gi','phone_code' => '350','name' => 'Gibraltar'],
            ['iso_code' => 'gl','phone_code' => '299','name' => 'Greenland (DK)'],
            ['iso_code' => 'gm','phone_code' => '220','name' => 'Gambia'],
            ['iso_code' => 'gn','phone_code' => '224','name' => 'Guinea'],
            ['iso_code' => 'gp','phone_code' => '590','name' => 'Guadeloupe'],
            ['iso_code' => 'go','phone_code' => '240','name' => 'Equatorial Guinea'],
            ['iso_code' => 'gr','phone_code' => '30','name' => 'Greece'],
            ['iso_code' => 'gs','phone_code' => '0','name' => 'South Georgia and the South Sandwich Islands'],
            ['iso_code' => 'gt','phone_code' => '502','name' => 'Guatemala'],
            ['iso_code' => 'gu','phone_code' => '671','name' => 'Guam'],
            ['iso_code' => 'gw','phone_code' => '245','name' => 'Guinea-Bissau'],
            ['iso_code' => 'cy','phone_code' => '592','name' => 'Guyana'],
            ['iso_code' => 'hk','phone_code' => '852','name' => 'Hong Kong (CN)'],
            ['iso_code' => 'hn','phone_code' => '504','name' => 'Honduras'],
            ['iso_code' => 'hr','phone_code' => '385','name' => 'Croatia'],
            ['iso_code' => 'ht','phone_code' => '509','name' => 'Haiti'],
            ['iso_code' => 'hu','phone_code' => '36','name' => 'Hungary'],
            ['iso_code' => 'id','phone_code' => '62','name' => 'Indonesia'],
            ['iso_code' => 'ie','phone_code' => '353','name' => 'Ireland'],
            ['iso_code' => 'il','phone_code' => '972','name' => 'Israel'],
            ['iso_code' => 'in','phone_code' => '91','name' => 'India'],
            ['iso_code' => 'io','phone_code' => '246','name' => 'British Indian Ocean Territory'],
            ['iso_code' => 'iq','phone_code' => '964','name' => 'Iraq'],
            ['iso_code' => 'is','phone_code' => '354','name' => 'Iceland'],
            ['iso_code' => 'it','phone_code' => '39','name' => 'Italy'],
            ['iso_code' => 'jm','phone_code' => '1876','name' => 'Jamaica'],
            ['iso_code' => 'jo','phone_code' => '962','name' => 'Jordan'],
            ['iso_code' => 'jp','phone_code' => '81','name' => 'Japan'],
            ['iso_code' => 'ke','phone_code' => '254','name' => 'Kenya'],
            ['iso_code' => 'kh','phone_code' => '855','name' => 'Cambodia'],
            ['iso_code' => 'ki','phone_code' => '686','name' => 'Kiribati'],
            ['iso_code' => 'km','phone_code' => '269','name' => 'Comoros'],
            ['iso_code' => 'kw','phone_code' => '965','name' => 'Kuwait'],
            ['iso_code' => 'ky','phone_code' => '1345','name' => 'Cayman Islands (GB)'],
            ['iso_code' => 'kz','phone_code' => '7','name' => 'Kazakhstan'],
            ['iso_code' => 'la','phone_code' => '856','name' => 'Laos'],
            ['iso_code' => 'lb','phone_code' => '961','name' => 'Lebanon'],
            ['iso_code' => 'lc','phone_code' => '1758','name' => 'Saint Lucia'],
            ['iso_code' => 'li','phone_code' => '41','name' => 'Liechtenstein'],
            ['iso_code' => 'lk','phone_code' => '94','name' => 'Sri Lanka'],
            ['iso_code' => 'lr','phone_code' => '231','name' => 'Liberia'],
            ['iso_code' => 'ls','phone_code' => '266','name' => 'Lesotho'],
            ['iso_code' => 'lt','phone_code' => '370','name' => 'Lithuania'],
            ['iso_code' => 'lu','phone_code' => '352','name' => 'Luxembourg'],
            ['iso_code' => 'lv','phone_code' => '371','name' => 'Latvia'],
            ['iso_code' => 'ly','phone_code' => '21','name' => 'Libya'],
            ['iso_code' => 'mc','phone_code' => '377','name' => 'Monaco'],
            ['iso_code' => 'mg','phone_code' => '261','name' => 'Madagascar'],
            ['iso_code' => 'mh','phone_code' => '692','name' => 'Marshall Islands'],
            ['iso_code' => 'mk','phone_code' => '389','name' => 'Macedonia'],
            ['iso_code' => 'ml','phone_code' => '223','name' => 'Mali'],
            ['iso_code' => 'mm','phone_code' => '95','name' => 'Myanmar'],
            ['iso_code' => 'mn','phone_code' => '976','name' => 'Mongolia'],
            ['iso_code' => 'mp','phone_code' => '670','name' => 'Northern Mariana Islands (US)'],
            ['iso_code' => 'mq','phone_code' => '596','name' => 'Martinique'],
            ['iso_code' => 'mr','phone_code' => '222','name' => 'Mauritania'],
            ['iso_code' => 'ms','phone_code' => '1664','name' => 'Montserrat Island (GB)'],
            ['iso_code' => 'mt','phone_code' => '356','name' => 'Malta'],
            ['iso_code' => 'mu','phone_code' => '230','name' => 'Mauritius'],
            ['iso_code' => 'mv','phone_code' => '960','name' => 'Maldives'],
            ['iso_code' => 'mw','phone_code' => '265','name' => 'Malawi'],
            ['iso_code' => 'mx','phone_code' => '52','name' => 'Mexico'],
            ['iso_code' => 'my','phone_code' => '60','name' => 'Malaysia'],
            ['iso_code' => 'mz','phone_code' => '258','name' => 'Mozambique'],
            ['iso_code' => 'na','phone_code' => '264','name' => 'Namibia'],
            ['iso_code' => 'nc','phone_code' => '687','name' => 'New Caledonia (FR)'],
            ['iso_code' => 'ne','phone_code' => '227','name' => 'Niger'],
            ['iso_code' => 'nf','phone_code' => '672','name' => 'Norfolk Island'],
            ['iso_code' => 'ng','phone_code' => '234','name' => 'Nigeria'],
            ['iso_code' => 'ni','phone_code' => '505','name' => 'Nicaragua'],
            ['iso_code' => 'no','phone_code' => '47','name' => 'Norway'],
            ['iso_code' => 'np','phone_code' => '977','name' => 'Nepal'],
            ['iso_code' => 'nr','phone_code' => '674','name' => 'Nauru'],
            ['iso_code' => 'nu','phone_code' => '683','name' => 'Niue (NZ)'],
            ['iso_code' => 'nz','phone_code' => '64','name' => 'New Zealand'],
            ['iso_code' => 'om','phone_code' => '968','name' => 'Oman'],
            ['iso_code' => 'pa','phone_code' => '507','name' => 'Panama'],
            ['iso_code' => 'pe','phone_code' => '51','name' => 'Peru'],
            ['iso_code' => 'pf','phone_code' => '689','name' => 'French polynesia'],
            ['iso_code' => 'pg','phone_code' => '675','name' => 'Papua New Guinea'],
            ['iso_code' => 'ph','phone_code' => '63','name' => 'Philippines'],
            ['iso_code' => 'pk','phone_code' => '92','name' => 'Pakistan'],
            ['iso_code' => 'pl','phone_code' => '48','name' => 'Poland'],
            ['iso_code' => 'pr','phone_code' => '1787','name' => 'Puerto Rico (US)'],
            ['iso_code' => 'pt','phone_code' => '351','name' => 'Portugal'],
            ['iso_code' => 'pw','phone_code' => '680','name' => 'Palau (US)'],
            ['iso_code' => 'py','phone_code' => '595','name' => 'Paraguay'],
            ['iso_code' => 'qa','phone_code' => '974','name' => 'Qatar'],
            ['iso_code' => 're','phone_code' => '262','name' => 'Reunion (FR)'],
            ['iso_code' => 'ro','phone_code' => '40','name' => 'Romania'],
            ['iso_code' => 'rw','phone_code' => '250','name' => 'Rwanda'],
            ['iso_code' => 'sa','phone_code' => '966','name' => 'Saudi Arabia'],
            ['iso_code' => 'sb','phone_code' => '677','name' => 'Solomon Islands'],
            ['iso_code' => 'sc','phone_code' => '248','name' => 'Seychelles'],
            ['iso_code' => 'sd','phone_code' => '249','name' => 'Sudan'],
            ['iso_code' => 'se','phone_code' => '46','name' => 'Sweden'],
            ['iso_code' => 'sg','phone_code' => '65','name' => 'Singapore'],
            ['iso_code' => 'si','phone_code' => '386','name' => 'Slovenia'],
            ['iso_code' => 'sl','phone_code' => '232','name' => 'Sierra Leone'],
            ['iso_code' => 'sm','phone_code' => '39','name' => 'San Marino'],
            ['iso_code' => 'sn','phone_code' => '221','name' => 'Senegal'],
            ['iso_code' => 'sv','phone_code' => '503','name' => 'Salvador'],
            ['iso_code' => 'sz','phone_code' => '268','name' => 'Swaziland'],
            ['iso_code' => 'tc','phone_code' => '1649','name' => 'Turks and Caicos Islands'],
            ['iso_code' => 'td','phone_code' => '235','name' => 'Chad'],
            ['iso_code' => 'tf','phone_code' => '0','name' => 'French Southern and Antarctic Lands'],
            ['iso_code' => 'tg','phone_code' => '228','name' => 'Togo'],
            ['iso_code' => 'th','phone_code' => '66','name' => 'Thailand'],
            ['iso_code' => 'tk','phone_code' => '690','name' => 'Tokelau Islands (NZ)'],
            ['iso_code' => 'tm','phone_code' => '993','name' => 'Turkmenistan'],
            ['iso_code' => 'tn','phone_code' => '21','name' => 'Tunisia'],
            ['iso_code' => 'to','phone_code' => '676','name' => 'Tonga'],
            ['iso_code' => 'tr','phone_code' => '90','name' => 'Turkey'],
            ['iso_code' => 'tt','phone_code' => '1868','name' => 'Trinidad and Tobago'],
            ['iso_code' => 'tv','phone_code' => '688','name' => 'Tuvalu'],
            ['iso_code' => 'tw','phone_code' => '886','name' => 'Taiwan'],
            ['iso_code' => 'ua','phone_code' => '380','name' => 'Ukraine'],
            ['iso_code' => 'ug','phone_code' => '256','name' => 'Uganda'],
            ['iso_code' => 'um','phone_code' => '0','name' => 'United States Minor Outlying Islands'],
            ['iso_code' => 'uy','phone_code' => '598','name' => 'Uruguay'],
            ['iso_code' => 'uz','phone_code' => '998','name' => 'Uzbekistan'],
            ['iso_code' => 'vc','phone_code' => '1784','name' => 'Saint Vincent and the Grenadines'],
            ['iso_code' => 've','phone_code' => '58','name' => 'Venezuela'],
            ['iso_code' => 'vg','phone_code' => '1284','name' => 'Virgin Islands (GB)'],
            ['iso_code' => 'vu','phone_code' => '678','name' => 'Vanuatu'],
            ['iso_code' => 'ws','phone_code' => '685','name' => 'Samoa'],
            ['iso_code' => 'ye','phone_code' => '967','name' => 'Yemen'],
            ['iso_code' => 'yt','phone_code' => '269','name' => 'Mayotte'],
            ['iso_code' => 'za','phone_code' => '27','name' => 'South Africa'],
            ['iso_code' => 'zm','phone_code' => '260','name' => 'Zambia'],
            ['iso_code' => 'zw','phone_code' => '263','name' => 'Zimbabwe'],
            ['iso_code' => 'ru','phone_code' => '7','name' => 'Russia'],
            ['iso_code' => 'gb','phone_code' => '44','name' => 'United Kingdom'],
            ['iso_code' => 'us','phone_code' => '1','name' => 'USA'],
            ['iso_code' => 'nl','phone_code' => '31','name' => 'Netherlands'],
            ['iso_code' => 'sk','phone_code' => '421','name' => 'Slovakia'],
            ['iso_code' => 'md','phone_code' => '373','name' => 'Moldova'],
            ['iso_code' => 'kg','phone_code' => '996','name' => 'Kyrgyzstan'],
            ['iso_code' => 'eu','phone_code' => '0','name' => 'European Union'],
            ['iso_code' => 'me','phone_code' => '382','name' => 'Montenegro'],
            ['iso_code' => 'ma','phone_code' => '212','name' => 'Morocco'],
            ['iso_code' => 'rs','phone_code' => '381','name' => 'Serbia'],
            ['iso_code' => 'vn','phone_code' => '84','name' => 'Vietnam']
        ];
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180816_070218_add_iso_code_table cannot be reverted.\n";

        return false;
    }
    */
}
