<?php

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
            array('id' => '1','city_name' => 'An Giang','code' => '805','published' => '1','ordering' => '63','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '2','city_name' => 'Bà Rịa - Vũng Tầu','code' => '717','published' => '1','ordering' => '46','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '3','city_name' => 'Bình Dương','code' => '711','published' => '1','ordering' => '45','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '4','city_name' => 'Bình Phước','code' => '707','published' => '1','ordering' => '44','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '5','city_name' => 'Bình Thuận','code' => '715','published' => '1','ordering' => '43','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '6','city_name' => 'Bình Định','code' => '507','published' => '1','ordering' => '42','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '7','city_name' => 'Bắc Giang','code' => '221','published' => '1','ordering' => '41','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '8','city_name' => 'Bắc Kạn','code' => '207','published' => '1','ordering' => '40','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '9','city_name' => 'Bắc Ninh','code' => '223','published' => '1','ordering' => '39','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '10','city_name' => 'Bến Tre','code' => '811','published' => '1','ordering' => '38','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '11','city_name' => 'Cao Bằng','code' => '203','published' => '1','ordering' => '37','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '12','city_name' => 'Cà Mau','code' => '823','published' => '1','ordering' => '36','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '13','city_name' => 'Cần Thơ','code' => '815','published' => '1','ordering' => '35','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '14','city_name' => 'Gia Lai','code' => '603','published' => '1','ordering' => '34','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '15','city_name' => 'Hà Giang','code' => '201','published' => '1','ordering' => '47','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '16','city_name' => 'Hà Nam','code' => '111','published' => '1','ordering' => '48','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '17','city_name' => 'Hà Nội','code' => '101','published' => '1','ordering' => '49','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '18','city_name' => 'Hà Tây','code' => '105','published' => '1','ordering' => '62','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '19','city_name' => 'Hà Tĩnh','code' => '405','published' => '1','ordering' => '61','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '20','city_name' => 'Hòa Bình','code' => '305','published' => '1','ordering' => '60','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '21','city_name' => 'Hưng Yên','code' => '109','published' => '1','ordering' => '59','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '22','city_name' => 'Hải Dương','code' => '107','published' => '1','ordering' => '58','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '23','city_name' => 'Hải Phòng','code' => '103','published' => '1','ordering' => '57','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '24','city_name' => 'Hồ Chí Minh','code' => '701','published' => '1','ordering' => '1','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '1'),
            array('id' => '25','city_name' => 'Khánh Hòa','code' => '511','published' => '1','ordering' => '56','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '27','city_name' => 'Kiên Giang','code' => '813','published' => '1','ordering' => '55','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '28','city_name' => 'Kon Tum','code' => '601','published' => '1','ordering' => '54','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '29','city_name' => 'Lai Châu','code' => '301','published' => '1','ordering' => '53','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '30','city_name' => 'Long An','code' => '801','published' => '1','ordering' => '52','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '31','city_name' => 'Lào Cai','code' => '205','published' => '1','ordering' => '51','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '32','city_name' => 'Lâm Đồng','code' => '703','published' => '1','ordering' => '50','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '33','city_name' => 'Lạng Sơn','code' => '209','published' => '1','ordering' => '33','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '34','city_name' => 'Nam Định','code' => '113','published' => '1','ordering' => '32','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '35','city_name' => 'Nghệ An','code' => '403','published' => '1','ordering' => '15','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '36','city_name' => 'Ninh Bình','code' => '117','published' => '1','ordering' => '14','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '37','city_name' => 'Ninh Thuận','code' => '705','published' => '1','ordering' => '13','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '38','city_name' => 'Phú Thọ','code' => '217','published' => '1','ordering' => '12','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '39','city_name' => 'Phú Yên','code' => '509','published' => '1','ordering' => '11','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '40','city_name' => 'Quảng Bình','code' => '407','published' => '1','ordering' => '10','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '41','city_name' => 'Quảng Nam','code' => '503','published' => '1','ordering' => '9','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '42','city_name' => 'Quảng Ngãi','code' => '505','published' => '1','ordering' => '7','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '43','city_name' => 'Quảng Ninh','code' => '225','published' => '1','ordering' => '6','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '44','city_name' => 'Quảng Trị','code' => '409','published' => '1','ordering' => '5','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '45','city_name' => 'Sơn La','code' => '303','published' => '1','ordering' => '4','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '46','city_name' => 'Thanh Hóa','code' => '401','published' => '1','ordering' => '3','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '47','city_name' => 'Thái Bình','code' => '115','published' => '1','ordering' => '2','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '48','city_name' => 'Thái Nguyên','code' => '215','published' => '1','ordering' => '16','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '49','city_name' => 'Thừa Thiên - Huế','code' => '411','published' => '1','ordering' => '17','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '50','city_name' => 'Tiền Giang','code' => '807','published' => '1','ordering' => '31','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '51','city_name' => 'Trà Vinh','code' => '817','published' => '1','ordering' => '30','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '52','city_name' => 'Tuyên Quang','code' => '211','published' => '1','ordering' => '29','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '53','city_name' => 'Tây Ninh','code' => '709','published' => '1','ordering' => '28','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '54','city_name' => 'Vĩnh Long','code' => '809','published' => '1','ordering' => '27','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '55','city_name' => 'Vĩnh Phúc','code' => '104','published' => '1','ordering' => '26','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '56','city_name' => 'Yên Bái','code' => '213','published' => '1','ordering' => '25','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '57','city_name' => 'Đà Nẵng','code' => '501','published' => '1','ordering' => '24','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '58','city_name' => 'Đắk Lắk','code' => '605','published' => '1','ordering' => '23','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '59','city_name' => 'Đồng Nai','code' => '713','published' => '1','ordering' => '22','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '60','city_name' => 'Đồng Tháp','code' => '803','published' => '1','ordering' => '21','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '61','city_name' => 'Bạc Liêu','code' => '821','published' => '1','ordering' => '20','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '62','city_name' => 'Sóc Trăng','code' => '819','published' => '1','ordering' => '19','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '63','city_name' => 'Hậu Giang','code' => '825','published' => '1','ordering' => '18','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0'),
            array('id' => '64','city_name' => 'Đắk Nông','code' => '607','published' => '1','ordering' => '8','country_code' => 'VN','country_id' => '241','slug' => '','lat' => '','lng' => '','is_default' => '0')
        );


        foreach ( $cities as $city ){
            \App\Models\Cities::create($city);
        }



    }
}
