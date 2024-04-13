<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\UserProfile;
use Auth;

class UserProfileEdit extends Component
{
    public $realName;
    public $country;
    public $language;
    public $birthdate;
    public $gender;
    public $signature;
    public $links;

    // 使用提供的语言列表
    public $languages = [
        'Afrikaans' => 'af',
        'Albanian' => 'sq',
        'Amharic' => 'am',
        'Arabic' => 'ar',
        'Armenian' => 'hy',
        'Assamese' => 'as',
        'Azerbaijani' => 'az',
        'Bambara' => 'bm',
        'Basque' => 'eu',
        'Belarusian' => 'be',
        'Bengali' => 'bn',
        'Bhojpuri' => 'bho',
        'Bosnian' => 'bs',
        'Bulgarian' => 'bg',
        'Catalan' => 'ca',
        'Cebuano' => 'ceb',
        'CentralKhmer' => 'km',
        'Chinese' => 'zh_CN',
        'ChineseHongKong' => 'zh_HK',
        'ChineseT' => 'zh_TW',
        'Croatian' => 'hr',
        'Czech' => 'cs',
        'Danish' => 'da',
        'Dogri' => 'doi',
        'Dutch' => 'nl',
        'English' => 'en',
        'Esperanto' => 'eo',
        'Estonian' => 'et',
        'Ewe' => 'ee',
        'Finnish' => 'fi',
        'French' => 'fr',
        'Frisian' => 'fy',
        'Galician' => 'gl',
        'Georgian' => 'ka',
        'German' => 'de',
        'GermanSwitzerland' => 'de_CH',
        'Greek' => 'el',
        'Gujarati' => 'gu',
        'Hausa' => 'ha',
        'Hawaiian' => 'haw',
        'Hebrew' => 'he',
        'Hindi' => 'hi',
        'Hungarian' => 'hu',
        'Icelandic' => 'is',
        'Igbo' => 'ig',
        'Indonesian' => 'id',
        'Irish' => 'ga',
        'Italian' => 'it',
        'Japanese' => 'ja',
        'Kannada' => 'kn',
        'Kazakh' => 'kk',
        'Kinyarwanda' => 'rw',
        'Korean' => 'ko',
        'Kurdish' => 'ku',
        'KurdishSorani' => 'ckb',
        'Kyrgyz' => 'ky',
        'Lao' => 'lo',
        'Latvian' => 'lv',
        'Lingala' => 'ln',
        'Lithuanian' => 'lt',
        'Luganda' => 'lg',
        'Luxembourgish' => 'lb',
        'Macedonian' => 'mk',
        'Maithili' => 'mai',
        'Malagasy' => 'mg',
        'Malay' => 'ms',
        'Malayalam' => 'ml',
        'Maltese' => 'mt',
        'Maori' => 'mi',
        'Marathi' => 'mr',
        'MeiteilonManipuri' => 'mni_Mtei',
        'Mongolian' => 'mn',
        'MyanmarBurmese' => 'my',
        'Nepali' => 'ne',
        'NorwegianBokmal' => 'nb',
        'NorwegianNynorsk' => 'nn',
        'Occitan' => 'oc',
        'OdiaOriya' => 'or',
        'Oromo' => 'om',
        'Pashto' => 'ps',
        'Persian' => 'fa',
        'Pilipino' => 'fil',
        'Polish' => 'pl',
        'Portuguese' => 'pt',
        'PortugueseBrazil' => 'pt_BR',
        'Punjabi' => 'pa',
        'Quechua' => 'qu',
        'Romanian' => 'ro',
        'Russian' => 'ru',
        'Sanskrit' => 'sa',
        'Sardinian' => 'sc',
        'ScotsGaelic' => 'gd',
        'SerbianCyrillic' => 'sr_Cyrl',
        'SerbianLatin' => 'sr_Latn',
        'SerbianMontenegrin' => 'sr_Latn_ME',
        'Shona' => 'sn',
        'Sindhi' => 'sd',
        'Sinhala' => 'si',
        'Slovak' => 'sk',
        'Slovenian' => 'sl',
        'Somali' => 'so',
        'Spanish' => 'es',
        'Sundanese' => 'su',
        'Swahili' => 'sw',
        'Swedish' => 'sv',
        'Tagalog' => 'tl',
        'Tajik' => 'tg',
        'Tamil' => 'ta',
        'Tatar' => 'tt',
        'Telugu' => 'te',
        'Thai' => 'th',
        'Tigrinya' => 'ti',
        'Turkish' => 'tr',
        'Turkmen' => 'tk',
        'TwiAkan' => 'ak',
        'Uighur' => 'ug',
        'Ukrainian' => 'uk',
        'Urdu' => 'ur',
        'UzbekCyrillic' => 'uz_Cyrl',
        'UzbekLatin' => 'uz_Latn',
        'Vietnamese' => 'vi',
        'Welsh' => 'cy',
        'Xhosa' => 'xh',
        'Yiddish' => 'yi',
        'Yoruba' => 'yo',
        'Zulu' => 'zu',
    ];

    // 使用提供的地区列表
    public $countries = [
        'Afrikaans' => 'af',
        'Albanian' => 'sq',
        'Amharic' => 'am',
        'Arabic' => 'ar',
        'Armenian' => 'hy',
        'Assamese' => 'as',
        'Azerbaijani' => 'az',
        'Bambara' => 'bm',
        'Basque' => 'eu',
        'Belarusian' => 'be',
        'Bengali' => 'bn',
        'Bhojpuri' => 'bho',
        'Bosnian' => 'bs',
        'Bulgarian' => 'bg',
        'Catalan' => 'ca',
        'Cebuano' => 'ceb',
        'CentralKhmer' => 'km',
        'Chinese' => 'zh_CN',
        'ChineseHongKong' => 'zh_HK',
        'ChineseT' => 'zh_TW',
        'Croatian' => 'hr',
        'Czech' => 'cs',
        'Danish' => 'da',
        'Dogri' => 'doi',
        'Dutch' => 'nl',
        'English' => 'en',
        'Esperanto' => 'eo',
        'Estonian' => 'et',
        'Ewe' => 'ee',
        'Finnish' => 'fi',
        'French' => 'fr',
        'Frisian' => 'fy',
        'Galician' => 'gl',
        'Georgian' => 'ka',
        'German' => 'de',
        'GermanSwitzerland' => 'de_CH',
        'Greek' => 'el',
        'Gujarati' => 'gu',
        'Hausa' => 'ha',
        'Hawaiian' => 'haw',
        'Hebrew' => 'he',
        'Hindi' => 'hi',
        'Hungarian' => 'hu',
        'Icelandic' => 'is',
        'Igbo' => 'ig',
        'Indonesian' => 'id',
        'Irish' => 'ga',
        'Italian' => 'it',
        'Japanese' => 'ja',
        'Kannada' => 'kn',
        'Kazakh' => 'kk',
        'Kinyarwanda' => 'rw',
        'Korean' => 'ko',
        'Kurdish' => 'ku',
        'KurdishSorani' => 'ckb',
        'Kyrgyz' => 'ky',
        'Lao' => 'lo',
        'Latvian' => 'lv',
        'Lingala' => 'ln',
        'Lithuanian' => 'lt',
        'Luganda' => 'lg',
        'Luxembourgish' => 'lb',
        'Macedonian' => 'mk',
        'Maithili' => 'mai',
        'Malagasy' => 'mg',
        'Malay' => 'ms',
        'Malayalam' => 'ml',
        'Maltese' => 'mt',
        'Maori' => 'mi',
        'Marathi' => 'mr',
        'MeiteilonManipuri' => 'mni_Mtei',
        'Mongolian' => 'mn',
        'MyanmarBurmese' => 'my',
        'Nepali' => 'ne',
        'NorwegianBokmal' => 'nb',
        'NorwegianNynorsk' => 'nn',
        'Occitan' => 'oc',
        'OdiaOriya' => 'or',
        'Oromo' => 'om',
        'Pashto' => 'ps',
        'Persian' => 'fa',
        'Pilipino' => 'fil',
        'Polish' => 'pl',
        'Portuguese' => 'pt',
        'PortugueseBrazil' => 'pt_BR',
        'Punjabi' => 'pa',
        'Quechua' => 'qu',
        'Romanian' => 'ro',
        'Russian' => 'ru',
        'Sanskrit' => 'sa',
        'Sardinian' => 'sc',
        'ScotsGaelic' => 'gd',
        'SerbianCyrillic' => 'sr_Cyrl',
        'SerbianLatin' => 'sr_Latn',
        'SerbianMontenegrin' => 'sr_Latn_ME',
        'Shona' => 'sn',
        'Sindhi' => 'sd',
        'Sinhala' => 'si',
        'Slovak' => 'sk',
        'Slovenian' => 'sl',
        'Somali' => 'so',
        'Spanish' => 'es',
        'Sundanese' => 'su',
        'Swahili' => 'sw',
        'Swedish' => 'sv',
        'Tagalog' => 'tl',
        'Tajik' => 'tg',
        'Tamil' => 'ta',
        'Tatar' => 'tt',
        'Telugu' => 'te',
        'Thai' => 'th',
        'Tigrinya' => 'ti',
        'Turkish' => 'tr',
        'Turkmen' => 'tk',
        'TwiAkan' => 'ak',
        'Uighur' => 'ug',
        'Ukrainian' => 'uk',
        'Urdu' => 'ur',
        'UzbekCyrillic' => 'uz_Cyrl',
        'UzbekLatin' => 'uz_Latn',
        'Vietnamese' => 'vi',
        'Welsh' => 'cy',
        'Xhosa' => 'xh',
        'Yiddish' => 'yi',
        'Yoruba' => 'yo',
        'Zulu' => 'zu',
    ];

    public function mount()
    {
        // 加载用户个人资料
        $profile = Auth::user()->profile;
        
        // 初始化属性
        $this->realName = $profile->real_name;
        $this->country = $profile->country;
        $this->language = $profile->language;
        $this->birthdate = $profile->birthdate;
        $this->gender = $profile->gender;
        $this->signature = $profile->signature;
        $this->links = $profile->links;

        //session()->flash('message','编辑器创建成功！');
    }

    public function updateProfile()
    {
        // 更新用户个人资料
        $profile = Auth::user()->profile;
        $profile->real_name = $this->realName;
        $profile->country = $this->country;
        $profile->language = $this->language;
        $profile->birthdate = $this->birthdate;
        $profile->gender = $profile->gender;
        $profile->signature = $this->signature;
        $profile->links = $this->links;
        $profile->save();

        session()->flash('message','更改成功！');
    }

    public function render()
    {
        return view('livewire.profile.user-profile-edit');
    }
}
