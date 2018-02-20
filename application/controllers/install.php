<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {

    public function index ()
    {
    }
    
    
    
    public function database ()
    {
        
        $this->load->model('install_model');
        echo $this->get_header();

        //{pre}sessions
        $table_name = '{pre}sessions';
        $table = 'session_id varchar(40) PRIMARY KEY(session_id),
                    ip_address varchar(45),
                    user_agent varchar(120),
                    last_activity INT,
                    user_data TEXT';     
        echo $this->install_model->create_table($table_name, $table);
        
        
        //{pre}user
        $table_name = '{pre}user';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),
                    email varchar(128) NOT NULL UNIQUE,
                    password varchar(128) NOT NULL,
                    firstname varchar(128) NOT NULL,
                    middlenames varchar(128),
                    lastname varchar(128) NOT NULL,
                    accountnumber varchar(128) UNIQUE,
                    accesslevel INT DEFAULT 1,
                    profileimage varchar(128),
                    timecreated INT,
                    timemodified INT,
                    modifierid INT,
                    deleted INT DEFAULT 0,
                    deletedby INT,
                    timedeleted INT';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}accesslevel
        $table_name = '{pre}accesslevel';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), 
                    name varchar(128) NOT NULL,
                    permissions TEXT';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}permissions
        $table_name = '{pre}permissions';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),
                    name varchar(128) NOT NULL,
                    description TEXT';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}biodata
        $table_name = '{pre}biodata';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),
                    userid INT NOT NULL UNIQUE,
                    address TEXT,
                    county varchar(128),
                    postcode varchar(20),
                    country INT,
                    dob DATE,
                    nationality INT,
                    work_in_uk INT,
                    ever_denied_visa INT,
                    visa_explanation TEXT,
                    criminal_convictions INT,
                    conviction_details TEXT,
                    gender INT,
                    height INT,
                    weight INT,
                    passport_number varchar(128),
                    passport_expiry DATE';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}medical
        $table_name = '{pre}medical';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), userid INT NOT NULL UNIQUE, hold_medical INT DEFAULT 0, conditions TEXT, disabilities TEXT);';
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}aviation_exp
        $table_name = '{pre}aviation_exp';
        $table = 'id INT NOT NULL AUTO_INCREMENT,
        			PRIMARY KEY(id),
        			userid INT NOT NULL UNIQUE,
        			completed_atpl_exams INT DEFAULT 0,
        			exam_count INT DEFAULT 0,
        			flying_ppl_a INT DEFAULT 0,
        			flying_ppl_h INT DEFAULT 0,
        			flying_glider INT DEFAULT 0,
        			flying_military INT DEFAULT 0,
        			flying_cpl_a INT DEFAULT 0,
        			flying_cpl_h INT DEFAULT 0,
        			flying_mpl INT DEFAULT 0,
        			theory_ppl_a INT DEFAULT 0,
        			theory_ppl_h INT DEFAULT 0,
        			thoery_mpl INT DEFAULT 0,
        			theory_military INT DEFAULT 0,
        			thoery_atpl INT DEFAULT 0,
        			hours_fixed_wing INT DEFAULT 0,
        			hours_helicopter INT DEFAULT 0,
        			hours_glider INT DEFAULT 0;';
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}country
        $table_name = '{pre}country';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name varchar(128)';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}country
        $table_name = '{pre}country';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name varchar(128)';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}nationality
        $table_name = '{pre}nationality';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name varchar(128)';       
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}gender
        $table_name = '{pre}gender';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name varchar(20)';       
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}user_qualifications
        $table_name = '{pre}user_qualifications';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),
                    userid INT NOT NULL,
                    level INT,
                    subject INT,
                    grade INT,
                    school varchar(128),
                    description TEXT,
                    date_awarded DATE,
                    sort INT DEFAULT 0';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}qualification_grade
        $table_name = '{pre}qualification_grade';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name varchar(40)';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}qualification_level
        $table_name = '{pre}qualification_level';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name varchar(128), country INT, sort INT';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}qualification_subject
        $table_name = '{pre}qualification_subject';
        $table = 'id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name varchar(128)';     
        echo $this->install_model->create_table($table_name, $table);
        
        //{pre}team_exercise
        $table_name = '{pre}team_exercise';
        $table = 'id INT NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            userid INT,
            assessorid_1 INT,
            assessorid_2 INT,
            date DATE,
            teamwork_image_ref varchar(128),
            teamwork_score INT,
            comms_image_ref varchar(128),
            comms_score INT,
            resilience_image_ref varchar(128),
            resilience_score INT,
            summary_image_ref varchar(128)';       
        echo $this->install_model->create_table($table_name, $table);
        
        
        
        
        
        echo '<hr /><h4>Adding values to tables....</h4>';
        
        
        //table created so now insert values
        
        echo '<hr /><b>Adding Users</b><br />';
        
        //user Jon Williams
        $data = array('email' => 'jon.williams@cae.com',
            'password' => '0bl1v10n',
            'firstname' => 'Jon',
            'middlenames' => 'Marc',
            'lastname' => 'Williams',
            'accesslevel' => '2'
            );
        $this->install_model->insert($data);
        
        
        
        //user levels
        echo '<hr /><b>Adding User Levels</b><br />';
        $this->install_model->add_accesslevel(array('id' => 1, 'name' => 'Default', 'permissions' => '3,6'));
        $this->install_model->add_accesslevel(array('id' => 2, 'name' => 'System Admin', 'permissions' => '1'));
        $this->install_model->add_accesslevel(array('id' => 3, 'name' => 'Admin', 'permissions' => '1'));
                
        
        //permissions
        echo '<hr /><b>Adding Permissions</b><br />';
        $this->install_model->add_permission(array('id' => 1, 'name' => 'do_anything', 'description' => 'Do anything. Overrides all other permissions.'));
        $this->install_model->add_permission(array('id' => 2, 'name' => 'assign_level', 'description' => 'Assign users an access level.'));
        $this->install_model->add_permission(array('id' => 3, 'name' => 'edit_profile', 'description' => ''));
        $this->install_model->add_permission(array('id' => 4, 'name' => 'edit_all_profiles', 'description' => ''));
        $this->install_model->add_permission(array('id' => 5, 'name' => 'view_all_profiles', 'description' => ''));
        $this->install_model->add_permission(array('id' => 6, 'name' => 'upload_profile_image', 'description' => ''));
        $this->install_model->add_permission(array('id' => 7, 'name' => 'view_team_exercise', 'description' => ''));
        $this->install_model->add_permission(array('id' => 8, 'name' => 'delete_user', 'description' => ''));
        $this->install_model->add_permission(array('id' => 9, 'name' => 'view_debug', 'description' => 'View debug pages.'));
        $this->install_model->add_permission(array('id' => 10, 'name' => 'undelete_user', 'description' => 'Can undelete any user.'));
        $this->install_model->add_permission(array('id' => 11, 'name' => 'generate_account_number', 'description' => ''));
                
        
        //countries
        echo '<hr /><b>Adding Countries</b><br />';
        $this->install_model->add_country(array('id'=>'1', 'name'=>'Afghanistan'));
        $this->install_model->add_country(array('id'=>'2', 'name'=>'Aland Islands'));
        $this->install_model->add_country(array('id'=>'3', 'name'=>'Albania'));
        $this->install_model->add_country(array('id'=>'4', 'name'=>'Algeria'));
        $this->install_model->add_country(array('id'=>'5', 'name'=>'American Samoa'));
        $this->install_model->add_country(array('id'=>'6', 'name'=>'Andorra'));
        $this->install_model->add_country(array('id'=>'7', 'name'=>'Angola'));
        $this->install_model->add_country(array('id'=>'8', 'name'=>'Anguilla'));
        $this->install_model->add_country(array('id'=>'9', 'name'=>'Antarctica'));
        $this->install_model->add_country(array('id'=>'10', 'name'=>'Antigua And Barbuda'));
        $this->install_model->add_country(array('id'=>'11', 'name'=>'Argentina'));
        $this->install_model->add_country(array('id'=>'12', 'name'=>'Armenia'));
        $this->install_model->add_country(array('id'=>'13', 'name'=>'Aruba'));
        $this->install_model->add_country(array('id'=>'14', 'name'=>'Australia'));
        $this->install_model->add_country(array('id'=>'15', 'name'=>'Austria'));
        $this->install_model->add_country(array('id'=>'16', 'name'=>'Azerbaijan'));
        $this->install_model->add_country(array('id'=>'17', 'name'=>'Bahamas'));
        $this->install_model->add_country(array('id'=>'18', 'name'=>'Bahrain'));
        $this->install_model->add_country(array('id'=>'19', 'name'=>'Bangladesh'));
        $this->install_model->add_country(array('id'=>'20', 'name'=>'Barbados'));
        $this->install_model->add_country(array('id'=>'21', 'name'=>'Belarus'));
        $this->install_model->add_country(array('id'=>'22', 'name'=>'Belgium'));
        $this->install_model->add_country(array('id'=>'23', 'name'=>'Belize'));
        $this->install_model->add_country(array('id'=>'24', 'name'=>'Benin'));
        $this->install_model->add_country(array('id'=>'25', 'name'=>'Bermuda'));
        $this->install_model->add_country(array('id'=>'26', 'name'=>'Bhutan'));
        $this->install_model->add_country(array('id'=>'27', 'name'=>'Bolivia'));
        $this->install_model->add_country(array('id'=>'28', 'name'=>'Bosnia And Herzegovina'));
        $this->install_model->add_country(array('id'=>'29', 'name'=>'Botswana'));
        $this->install_model->add_country(array('id'=>'30', 'name'=>'Bouvet Island'));
        $this->install_model->add_country(array('id'=>'31', 'name'=>'Brazil'));
        $this->install_model->add_country(array('id'=>'32', 'name'=>'British Indian Ocean Territory'));
        $this->install_model->add_country(array('id'=>'33', 'name'=>'Brunei Darussalam'));
        $this->install_model->add_country(array('id'=>'34', 'name'=>'Bulgaria'));
        $this->install_model->add_country(array('id'=>'35', 'name'=>'Burkina Faso'));
        $this->install_model->add_country(array('id'=>'36', 'name'=>'Burundi'));
        $this->install_model->add_country(array('id'=>'37', 'name'=>'Cambodia'));
        $this->install_model->add_country(array('id'=>'38', 'name'=>'Cameroon'));
        $this->install_model->add_country(array('id'=>'39', 'name'=>'Canada'));
        $this->install_model->add_country(array('id'=>'40', 'name'=>'Cape Verde'));
        $this->install_model->add_country(array('id'=>'41', 'name'=>'Cayman Islands'));
        $this->install_model->add_country(array('id'=>'42', 'name'=>'Central African Republic'));
        $this->install_model->add_country(array('id'=>'43', 'name'=>'Chad'));
        $this->install_model->add_country(array('id'=>'44', 'name'=>'Chile'));
        $this->install_model->add_country(array('id'=>'45', 'name'=>'China'));
        $this->install_model->add_country(array('id'=>'46', 'name'=>'Christmas Island'));
        $this->install_model->add_country(array('id'=>'47', 'name'=>'Cocos (Keeling) Islands'));
        $this->install_model->add_country(array('id'=>'48', 'name'=>'Colombia'));
        $this->install_model->add_country(array('id'=>'49', 'name'=>'Comoros'));
        $this->install_model->add_country(array('id'=>'50', 'name'=>'Congo'));
        $this->install_model->add_country(array('id'=>'51', 'name'=>'Congo, The Democratic Republic Of The'));
        $this->install_model->add_country(array('id'=>'52', 'name'=>'Cook Islands'));
        $this->install_model->add_country(array('id'=>'53', 'name'=>'Costa Rica'));
        $this->install_model->add_country(array('id'=>'54', 'name'=>'Cote D\'ivoire'));
        $this->install_model->add_country(array('id'=>'55', 'name'=>'Croatia'));
        $this->install_model->add_country(array('id'=>'56', 'name'=>'Cuba'));
        $this->install_model->add_country(array('id'=>'57', 'name'=>'Cyprus'));
        $this->install_model->add_country(array('id'=>'58', 'name'=>'Czech Republic'));
        $this->install_model->add_country(array('id'=>'59', 'name'=>'Denmark'));
        $this->install_model->add_country(array('id'=>'60', 'name'=>'Djibouti'));
        $this->install_model->add_country(array('id'=>'61', 'name'=>'Dominica'));
        $this->install_model->add_country(array('id'=>'62', 'name'=>'Dominican Republic'));
        $this->install_model->add_country(array('id'=>'63', 'name'=>'Ecuador'));
        $this->install_model->add_country(array('id'=>'64', 'name'=>'Egypt'));
        $this->install_model->add_country(array('id'=>'65', 'name'=>'El Salvador'));
        $this->install_model->add_country(array('id'=>'66', 'name'=>'Equatorial Guinea'));
        $this->install_model->add_country(array('id'=>'67', 'name'=>'Eritrea'));
        $this->install_model->add_country(array('id'=>'68', 'name'=>'Estonia'));
        $this->install_model->add_country(array('id'=>'69', 'name'=>'Ethiopia'));
        $this->install_model->add_country(array('id'=>'70', 'name'=>'Falkland Islands (Malvinas)'));
        $this->install_model->add_country(array('id'=>'71', 'name'=>'Faroe Islands'));
        $this->install_model->add_country(array('id'=>'72', 'name'=>'Fiji'));
        $this->install_model->add_country(array('id'=>'73', 'name'=>'Finland'));
        $this->install_model->add_country(array('id'=>'74', 'name'=>'France'));
        $this->install_model->add_country(array('id'=>'75', 'name'=>'French Guiana'));
        $this->install_model->add_country(array('id'=>'76', 'name'=>'French Polynesia'));
        $this->install_model->add_country(array('id'=>'77', 'name'=>'French Southern Territories'));
        $this->install_model->add_country(array('id'=>'78', 'name'=>'Gabon'));
        $this->install_model->add_country(array('id'=>'79', 'name'=>'Gambia'));
        $this->install_model->add_country(array('id'=>'80', 'name'=>'Georgia'));
        $this->install_model->add_country(array('id'=>'81', 'name'=>'Germany'));
        $this->install_model->add_country(array('id'=>'82', 'name'=>'Ghana'));
        $this->install_model->add_country(array('id'=>'83', 'name'=>'Gibraltar'));
        $this->install_model->add_country(array('id'=>'84', 'name'=>'Greece'));
        $this->install_model->add_country(array('id'=>'85', 'name'=>'Greenland'));
        $this->install_model->add_country(array('id'=>'86', 'name'=>'Grenada'));
        $this->install_model->add_country(array('id'=>'87', 'name'=>'Guadeloupe'));
        $this->install_model->add_country(array('id'=>'88', 'name'=>'Guam'));
        $this->install_model->add_country(array('id'=>'89', 'name'=>'Guatemala'));
        $this->install_model->add_country(array('id'=>'90', 'name'=>'Guernsey'));
        $this->install_model->add_country(array('id'=>'91', 'name'=>'Guinea'));
        $this->install_model->add_country(array('id'=>'92', 'name'=>'Guinea-bissau'));
        $this->install_model->add_country(array('id'=>'93', 'name'=>'Guyana'));
        $this->install_model->add_country(array('id'=>'94', 'name'=>'Haiti'));
        $this->install_model->add_country(array('id'=>'95', 'name'=>'Heard Island And Mcdonald Islands'));
        $this->install_model->add_country(array('id'=>'96', 'name'=>'Holy See (Vatican City State)'));
        $this->install_model->add_country(array('id'=>'97', 'name'=>'Honduras'));
        $this->install_model->add_country(array('id'=>'98', 'name'=>'Hong Kong'));
        $this->install_model->add_country(array('id'=>'99', 'name'=>'Hungary'));
        $this->install_model->add_country(array('id'=>'100', 'name'=>'Iceland'));
        $this->install_model->add_country(array('id'=>'101', 'name'=>'India'));
        $this->install_model->add_country(array('id'=>'102', 'name'=>'Indonesia'));
        $this->install_model->add_country(array('id'=>'103', 'name'=>'Iran, Islamic Republic Of'));
        $this->install_model->add_country(array('id'=>'104', 'name'=>'Iraq'));
        $this->install_model->add_country(array('id'=>'105', 'name'=>'Ireland'));
        $this->install_model->add_country(array('id'=>'106', 'name'=>'Isle Of Man'));
        $this->install_model->add_country(array('id'=>'107', 'name'=>'Israel'));
        $this->install_model->add_country(array('id'=>'108', 'name'=>'Italy'));
        $this->install_model->add_country(array('id'=>'109', 'name'=>'Jamaica'));
        $this->install_model->add_country(array('id'=>'110', 'name'=>'Japan'));
        $this->install_model->add_country(array('id'=>'111', 'name'=>'Jersey'));
        $this->install_model->add_country(array('id'=>'112', 'name'=>'Jordan'));
        $this->install_model->add_country(array('id'=>'113', 'name'=>'Kazakhstan'));
        $this->install_model->add_country(array('id'=>'114', 'name'=>'Kenya'));
        $this->install_model->add_country(array('id'=>'115', 'name'=>'Kiribati'));
        $this->install_model->add_country(array('id'=>'116', 'name'=>'Korea, Democratic People\'s Republic Of'));
        $this->install_model->add_country(array('id'=>'117', 'name'=>'Korea, Republic Of'));
        $this->install_model->add_country(array('id'=>'118', 'name'=>'Kuwait'));
        $this->install_model->add_country(array('id'=>'119', 'name'=>'Kyrgyzstan'));
        $this->install_model->add_country(array('id'=>'120', 'name'=>'Lao People\'s Democratic Republic'));
        $this->install_model->add_country(array('id'=>'121', 'name'=>'Latvia'));
        $this->install_model->add_country(array('id'=>'122', 'name'=>'Lebanon'));
        $this->install_model->add_country(array('id'=>'123', 'name'=>'Lesotho'));
        $this->install_model->add_country(array('id'=>'124', 'name'=>'Liberia'));
        $this->install_model->add_country(array('id'=>'125', 'name'=>'Libyan Arab Jamahiriya'));
        $this->install_model->add_country(array('id'=>'126', 'name'=>'Liechtenstein'));
        $this->install_model->add_country(array('id'=>'127', 'name'=>'Lithuania'));
        $this->install_model->add_country(array('id'=>'128', 'name'=>'Luxembourg'));
        $this->install_model->add_country(array('id'=>'129', 'name'=>'Macao'));
        $this->install_model->add_country(array('id'=>'130', 'name'=>'Macedonia, The Former Yugoslav Republic Of'));
        $this->install_model->add_country(array('id'=>'131', 'name'=>'Madagascar'));
        $this->install_model->add_country(array('id'=>'132', 'name'=>'Malawi'));
        $this->install_model->add_country(array('id'=>'133', 'name'=>'Malaysia'));
        $this->install_model->add_country(array('id'=>'134', 'name'=>'Maldives'));
        $this->install_model->add_country(array('id'=>'135', 'name'=>'Mali'));
        $this->install_model->add_country(array('id'=>'136', 'name'=>'Malta'));
        $this->install_model->add_country(array('id'=>'137', 'name'=>'Marshall Islands'));
        $this->install_model->add_country(array('id'=>'138', 'name'=>'Martinique'));
        $this->install_model->add_country(array('id'=>'139', 'name'=>'Mauritania'));
        $this->install_model->add_country(array('id'=>'140', 'name'=>'Mauritius'));
        $this->install_model->add_country(array('id'=>'141', 'name'=>'Mayotte'));
        $this->install_model->add_country(array('id'=>'142', 'name'=>'Mexico'));
        $this->install_model->add_country(array('id'=>'143', 'name'=>'Micronesia, Federated States Of'));
        $this->install_model->add_country(array('id'=>'144', 'name'=>'Moldova, Republic Of'));
        $this->install_model->add_country(array('id'=>'145', 'name'=>'Monaco'));
        $this->install_model->add_country(array('id'=>'146', 'name'=>'Mongolia'));
        $this->install_model->add_country(array('id'=>'147', 'name'=>'Montenegro'));
        $this->install_model->add_country(array('id'=>'148', 'name'=>'Montserrat'));
        $this->install_model->add_country(array('id'=>'149', 'name'=>'Morocco'));
        $this->install_model->add_country(array('id'=>'150', 'name'=>'Mozambique'));
        $this->install_model->add_country(array('id'=>'151', 'name'=>'Myanmar'));
        $this->install_model->add_country(array('id'=>'152', 'name'=>'Namibia'));
        $this->install_model->add_country(array('id'=>'153', 'name'=>'Nauru'));
        $this->install_model->add_country(array('id'=>'154', 'name'=>'Nepal'));
        $this->install_model->add_country(array('id'=>'155', 'name'=>'Netherlands'));
        $this->install_model->add_country(array('id'=>'156', 'name'=>'Netherlands Antilles'));
        $this->install_model->add_country(array('id'=>'157', 'name'=>'New Caledonia'));
        $this->install_model->add_country(array('id'=>'158', 'name'=>'New Zealand'));
        $this->install_model->add_country(array('id'=>'159', 'name'=>'Nicaragua'));
        $this->install_model->add_country(array('id'=>'160', 'name'=>'Niger'));
        $this->install_model->add_country(array('id'=>'161', 'name'=>'Nigeria'));
        $this->install_model->add_country(array('id'=>'162', 'name'=>'Niue'));
        $this->install_model->add_country(array('id'=>'163', 'name'=>'Norfolk Island'));
        $this->install_model->add_country(array('id'=>'164', 'name'=>'Northern Mariana Islands'));
        $this->install_model->add_country(array('id'=>'165', 'name'=>'Norway'));
        $this->install_model->add_country(array('id'=>'166', 'name'=>'Oman'));
        $this->install_model->add_country(array('id'=>'167', 'name'=>'Pakistan'));
        $this->install_model->add_country(array('id'=>'168', 'name'=>'Palau'));
        $this->install_model->add_country(array('id'=>'169', 'name'=>'Palestinian Territory, Occupied'));
        $this->install_model->add_country(array('id'=>'170', 'name'=>'Panama'));
        $this->install_model->add_country(array('id'=>'171', 'name'=>'Papua New Guinea'));
        $this->install_model->add_country(array('id'=>'172', 'name'=>'Paraguay'));
        $this->install_model->add_country(array('id'=>'173', 'name'=>'Peru'));
        $this->install_model->add_country(array('id'=>'174', 'name'=>'Philippines'));
        $this->install_model->add_country(array('id'=>'175', 'name'=>'Pitcairn'));
        $this->install_model->add_country(array('id'=>'176', 'name'=>'Poland'));
        $this->install_model->add_country(array('id'=>'177', 'name'=>'Portugal'));
        $this->install_model->add_country(array('id'=>'178', 'name'=>'Puerto Rico'));
        $this->install_model->add_country(array('id'=>'179', 'name'=>'Qatar'));
        $this->install_model->add_country(array('id'=>'180', 'name'=>'Reunion'));
        $this->install_model->add_country(array('id'=>'181', 'name'=>'Romania'));
        $this->install_model->add_country(array('id'=>'182', 'name'=>'Russian Federation'));
        $this->install_model->add_country(array('id'=>'183', 'name'=>'Rwanda'));
        $this->install_model->add_country(array('id'=>'184', 'name'=>'Saint Helena'));
        $this->install_model->add_country(array('id'=>'185', 'name'=>'Saint Kitts And Nevis'));
        $this->install_model->add_country(array('id'=>'186', 'name'=>'Saint Lucia'));
        $this->install_model->add_country(array('id'=>'187', 'name'=>'Saint Pierre And Miquelon'));
        $this->install_model->add_country(array('id'=>'188', 'name'=>'Saint Vincent And The Grenadines'));
        $this->install_model->add_country(array('id'=>'189', 'name'=>'Samoa'));
        $this->install_model->add_country(array('id'=>'190', 'name'=>'San Marino'));
        $this->install_model->add_country(array('id'=>'191', 'name'=>'Sao Tome And Principe'));
        $this->install_model->add_country(array('id'=>'192', 'name'=>'Saudi Arabia'));
        $this->install_model->add_country(array('id'=>'193', 'name'=>'Senegal'));
        $this->install_model->add_country(array('id'=>'194', 'name'=>'Serbia'));
        $this->install_model->add_country(array('id'=>'195', 'name'=>'Seychelles'));
        $this->install_model->add_country(array('id'=>'196', 'name'=>'Sierra Leone'));
        $this->install_model->add_country(array('id'=>'197', 'name'=>'Singapore'));
        $this->install_model->add_country(array('id'=>'198', 'name'=>'Slovakia'));
        $this->install_model->add_country(array('id'=>'199', 'name'=>'Slovenia'));
        $this->install_model->add_country(array('id'=>'200', 'name'=>'Solomon Islands'));
        $this->install_model->add_country(array('id'=>'201', 'name'=>'Somalia'));
        $this->install_model->add_country(array('id'=>'202', 'name'=>'South Africa'));
        $this->install_model->add_country(array('id'=>'203', 'name'=>'South Georgia And The South Sandwich Islands'));
        $this->install_model->add_country(array('id'=>'204', 'name'=>'Spain'));
        $this->install_model->add_country(array('id'=>'205', 'name'=>'Sri Lanka'));
        $this->install_model->add_country(array('id'=>'206', 'name'=>'Sudan'));
        $this->install_model->add_country(array('id'=>'207', 'name'=>'Suriname'));
        $this->install_model->add_country(array('id'=>'208', 'name'=>'Svalbard And Jan Mayen'));
        $this->install_model->add_country(array('id'=>'209', 'name'=>'Swaziland'));
        $this->install_model->add_country(array('id'=>'210', 'name'=>'Sweden'));
        $this->install_model->add_country(array('id'=>'211', 'name'=>'Switzerland'));
        $this->install_model->add_country(array('id'=>'212', 'name'=>'Syrian Arab Republic'));
        $this->install_model->add_country(array('id'=>'213', 'name'=>'Taiwan, Province Of China'));
        $this->install_model->add_country(array('id'=>'214', 'name'=>'Tajikistan'));
        $this->install_model->add_country(array('id'=>'215', 'name'=>'Tanzania, United Republic Of'));
        $this->install_model->add_country(array('id'=>'216', 'name'=>'Thailand'));
        $this->install_model->add_country(array('id'=>'217', 'name'=>'Timor-leste'));
        $this->install_model->add_country(array('id'=>'218', 'name'=>'Togo'));
        $this->install_model->add_country(array('id'=>'219', 'name'=>'Tokelau'));
        $this->install_model->add_country(array('id'=>'220', 'name'=>'Tonga'));
        $this->install_model->add_country(array('id'=>'221', 'name'=>'Trinidad And Tobago'));
        $this->install_model->add_country(array('id'=>'222', 'name'=>'Tunisia'));
        $this->install_model->add_country(array('id'=>'223', 'name'=>'Turkey'));
        $this->install_model->add_country(array('id'=>'224', 'name'=>'Turkmenistan'));
        $this->install_model->add_country(array('id'=>'225', 'name'=>'Turks And Caicos Islands'));
        $this->install_model->add_country(array('id'=>'226', 'name'=>'Tuvalu'));
        $this->install_model->add_country(array('id'=>'227', 'name'=>'Uganda'));
        $this->install_model->add_country(array('id'=>'228', 'name'=>'Ukraine'));
        $this->install_model->add_country(array('id'=>'229', 'name'=>'United Arab Emirates'));
        $this->install_model->add_country(array('id'=>'230', 'name'=>'United Kingdom'));
        $this->install_model->add_country(array('id'=>'231', 'name'=>'United States'));
        $this->install_model->add_country(array('id'=>'232', 'name'=>'United States Minor Outlying Islands'));
        $this->install_model->add_country(array('id'=>'233', 'name'=>'Uruguay'));
        $this->install_model->add_country(array('id'=>'234', 'name'=>'Uzbekistan'));
        $this->install_model->add_country(array('id'=>'235', 'name'=>'Vanuatu'));
        $this->install_model->add_country(array('id'=>'236', 'name'=>'Venezuela'));
        $this->install_model->add_country(array('id'=>'237', 'name'=>'Viet Nam'));
        $this->install_model->add_country(array('id'=>'238', 'name'=>'Virgin Islands, British'));
        $this->install_model->add_country(array('id'=>'239', 'name'=>'Virgin Islands, U.S.'));
        $this->install_model->add_country(array('id'=>'240', 'name'=>'Wallis And Futuna'));
        $this->install_model->add_country(array('id'=>'241', 'name'=>'Western Sahara'));
        $this->install_model->add_country(array('id'=>'242', 'name'=>'Yemen'));
        $this->install_model->add_country(array('id'=>'243', 'name'=>'Zambia'));
        $this->install_model->add_country(array('id'=>'244', 'name'=>'Zimbabwe'));

        
        //nationality
        echo '<hr /><b>Adding Nationalities</b><br />';
        $this->install_model->add_nationality(array('id'=>'1', 'name'=>'Afghan'));
        $this->install_model->add_nationality(array('id'=>'2', 'name'=>'Albanian'));
        $this->install_model->add_nationality(array('id'=>'3', 'name'=>'Algerian'));
        $this->install_model->add_nationality(array('id'=>'4', 'name'=>'American'));
        $this->install_model->add_nationality(array('id'=>'5', 'name'=>'Andorran'));
        $this->install_model->add_nationality(array('id'=>'6', 'name'=>'Angolan'));
        $this->install_model->add_nationality(array('id'=>'7', 'name'=>'Antiguans'));
        $this->install_model->add_nationality(array('id'=>'8', 'name'=>'Argentinean'));
        $this->install_model->add_nationality(array('id'=>'9', 'name'=>'Armenian'));
        $this->install_model->add_nationality(array('id'=>'10', 'name'=>'Australian'));
        $this->install_model->add_nationality(array('id'=>'11', 'name'=>'Austrian'));
        $this->install_model->add_nationality(array('id'=>'12', 'name'=>'Azerbaijani'));
        $this->install_model->add_nationality(array('id'=>'13', 'name'=>'Bahamian'));
        $this->install_model->add_nationality(array('id'=>'14', 'name'=>'Bahraini'));
        $this->install_model->add_nationality(array('id'=>'15', 'name'=>'Bangladeshi'));
        $this->install_model->add_nationality(array('id'=>'16', 'name'=>'Barbadian'));
        $this->install_model->add_nationality(array('id'=>'17', 'name'=>'Barbudans'));
        $this->install_model->add_nationality(array('id'=>'18', 'name'=>'Batswana'));
        $this->install_model->add_nationality(array('id'=>'19', 'name'=>'Belarusian'));
        $this->install_model->add_nationality(array('id'=>'20', 'name'=>'Belgian'));
        $this->install_model->add_nationality(array('id'=>'21', 'name'=>'Belizean'));
        $this->install_model->add_nationality(array('id'=>'22', 'name'=>'Beninese'));
        $this->install_model->add_nationality(array('id'=>'23', 'name'=>'Bhutanese'));
        $this->install_model->add_nationality(array('id'=>'24', 'name'=>'Bolivian'));
        $this->install_model->add_nationality(array('id'=>'25', 'name'=>'Bosnian'));
        $this->install_model->add_nationality(array('id'=>'26', 'name'=>'Brazilian'));
        $this->install_model->add_nationality(array('id'=>'27', 'name'=>'British'));
        $this->install_model->add_nationality(array('id'=>'28', 'name'=>'Bruneian'));
        $this->install_model->add_nationality(array('id'=>'29', 'name'=>'Bulgarian'));
        $this->install_model->add_nationality(array('id'=>'30', 'name'=>'Burkinabe'));
        $this->install_model->add_nationality(array('id'=>'31', 'name'=>'Burmese'));
        $this->install_model->add_nationality(array('id'=>'32', 'name'=>'Burundian'));
        $this->install_model->add_nationality(array('id'=>'33', 'name'=>'Cambodian'));
        $this->install_model->add_nationality(array('id'=>'34', 'name'=>'Cameroonian'));
        $this->install_model->add_nationality(array('id'=>'35', 'name'=>'Canadian'));
        $this->install_model->add_nationality(array('id'=>'36', 'name'=>'Cape Verdean'));
        $this->install_model->add_nationality(array('id'=>'37', 'name'=>'Central African'));
        $this->install_model->add_nationality(array('id'=>'38', 'name'=>'Chadian'));
        $this->install_model->add_nationality(array('id'=>'39', 'name'=>'Chilean'));
        $this->install_model->add_nationality(array('id'=>'40', 'name'=>'Chinese'));
        $this->install_model->add_nationality(array('id'=>'41', 'name'=>'Colombian'));
        $this->install_model->add_nationality(array('id'=>'42', 'name'=>'Comoran'));
        $this->install_model->add_nationality(array('id'=>'43', 'name'=>'Congolese'));
        $this->install_model->add_nationality(array('id'=>'44', 'name'=>'Costa Rican'));
        $this->install_model->add_nationality(array('id'=>'45', 'name'=>'Croatian'));
        $this->install_model->add_nationality(array('id'=>'46', 'name'=>'Cuban'));
        $this->install_model->add_nationality(array('id'=>'47', 'name'=>'Cypriot'));
        $this->install_model->add_nationality(array('id'=>'48', 'name'=>'Czech'));
        $this->install_model->add_nationality(array('id'=>'49', 'name'=>'Danish'));
        $this->install_model->add_nationality(array('id'=>'50', 'name'=>'Djibouti'));
        $this->install_model->add_nationality(array('id'=>'51', 'name'=>'Dominican'));
        $this->install_model->add_nationality(array('id'=>'52', 'name'=>'Dutch'));
        $this->install_model->add_nationality(array('id'=>'53', 'name'=>'East Timorese'));
        $this->install_model->add_nationality(array('id'=>'54', 'name'=>'Ecuadorean'));
        $this->install_model->add_nationality(array('id'=>'55', 'name'=>'Egyptian'));
        $this->install_model->add_nationality(array('id'=>'56', 'name'=>'Emirian'));
        $this->install_model->add_nationality(array('id'=>'57', 'name'=>'Equatorial Guinean'));
        $this->install_model->add_nationality(array('id'=>'58', 'name'=>'Eritrean'));
        $this->install_model->add_nationality(array('id'=>'59', 'name'=>'Estonian'));
        $this->install_model->add_nationality(array('id'=>'60', 'name'=>'Ethiopian'));
        $this->install_model->add_nationality(array('id'=>'61', 'name'=>'Fijian'));
        $this->install_model->add_nationality(array('id'=>'62', 'name'=>'Filipino'));
        $this->install_model->add_nationality(array('id'=>'63', 'name'=>'Finnish'));
        $this->install_model->add_nationality(array('id'=>'64', 'name'=>'French'));
        $this->install_model->add_nationality(array('id'=>'65', 'name'=>'Gabonese'));
        $this->install_model->add_nationality(array('id'=>'66', 'name'=>'Gambian'));
        $this->install_model->add_nationality(array('id'=>'67', 'name'=>'Georgian'));
        $this->install_model->add_nationality(array('id'=>'68', 'name'=>'German'));
        $this->install_model->add_nationality(array('id'=>'69', 'name'=>'Ghanaian'));
        $this->install_model->add_nationality(array('id'=>'70', 'name'=>'Greek'));
        $this->install_model->add_nationality(array('id'=>'71', 'name'=>'Grenadian'));
        $this->install_model->add_nationality(array('id'=>'72', 'name'=>'Guatemalan'));
        $this->install_model->add_nationality(array('id'=>'73', 'name'=>'Guinea-Bissauan'));
        $this->install_model->add_nationality(array('id'=>'74', 'name'=>'Guinean'));
        $this->install_model->add_nationality(array('id'=>'75', 'name'=>'Guyanese'));
        $this->install_model->add_nationality(array('id'=>'76', 'name'=>'Haitian'));
        $this->install_model->add_nationality(array('id'=>'77', 'name'=>'Herzegovinian'));
        $this->install_model->add_nationality(array('id'=>'78', 'name'=>'Honduran'));
        $this->install_model->add_nationality(array('id'=>'79', 'name'=>'Hungarian'));
        $this->install_model->add_nationality(array('id'=>'80', 'name'=>'Icelander'));
        $this->install_model->add_nationality(array('id'=>'81', 'name'=>'Indian'));
        $this->install_model->add_nationality(array('id'=>'82', 'name'=>'Indonesian'));
        $this->install_model->add_nationality(array('id'=>'83', 'name'=>'Iranian'));
        $this->install_model->add_nationality(array('id'=>'84', 'name'=>'Iraqi'));
        $this->install_model->add_nationality(array('id'=>'85', 'name'=>'Irish'));
        $this->install_model->add_nationality(array('id'=>'86', 'name'=>'Israeli'));
        $this->install_model->add_nationality(array('id'=>'87', 'name'=>'Italian'));
        $this->install_model->add_nationality(array('id'=>'88', 'name'=>'Ivorian'));
        $this->install_model->add_nationality(array('id'=>'89', 'name'=>'Jamaican'));
        $this->install_model->add_nationality(array('id'=>'90', 'name'=>'Japanese'));
        $this->install_model->add_nationality(array('id'=>'91', 'name'=>'Jordanian'));
        $this->install_model->add_nationality(array('id'=>'92', 'name'=>'Kazakhstani'));
        $this->install_model->add_nationality(array('id'=>'93', 'name'=>'Kenyan'));
        $this->install_model->add_nationality(array('id'=>'94', 'name'=>'Kittian and Nevisian'));
        $this->install_model->add_nationality(array('id'=>'95', 'name'=>'Kuwaiti'));
        $this->install_model->add_nationality(array('id'=>'96', 'name'=>'Kyrgyz'));
        $this->install_model->add_nationality(array('id'=>'97', 'name'=>'Laotian'));
        $this->install_model->add_nationality(array('id'=>'98', 'name'=>'Latvian'));
        $this->install_model->add_nationality(array('id'=>'99', 'name'=>'Lebanese'));
        $this->install_model->add_nationality(array('id'=>'100', 'name'=>'Liberian'));
        $this->install_model->add_nationality(array('id'=>'101', 'name'=>'Libyan'));
        $this->install_model->add_nationality(array('id'=>'102', 'name'=>'Liechtensteiner'));
        $this->install_model->add_nationality(array('id'=>'103', 'name'=>'Lithuanian'));
        $this->install_model->add_nationality(array('id'=>'104', 'name'=>'Luxembourger'));
        $this->install_model->add_nationality(array('id'=>'105', 'name'=>'Macedonian'));
        $this->install_model->add_nationality(array('id'=>'106', 'name'=>'Malagasy'));
        $this->install_model->add_nationality(array('id'=>'107', 'name'=>'Malawian'));
        $this->install_model->add_nationality(array('id'=>'108', 'name'=>'Malaysian'));
        $this->install_model->add_nationality(array('id'=>'109', 'name'=>'Maldivan'));
        $this->install_model->add_nationality(array('id'=>'110', 'name'=>'Malian'));
        $this->install_model->add_nationality(array('id'=>'111', 'name'=>'Maltese'));
        $this->install_model->add_nationality(array('id'=>'112', 'name'=>'Marshallese'));
        $this->install_model->add_nationality(array('id'=>'113', 'name'=>'Mauritanian'));
        $this->install_model->add_nationality(array('id'=>'114', 'name'=>'Mauritian'));
        $this->install_model->add_nationality(array('id'=>'115', 'name'=>'Mexican'));
        $this->install_model->add_nationality(array('id'=>'116', 'name'=>'Micronesian'));
        $this->install_model->add_nationality(array('id'=>'117', 'name'=>'Moldovan'));
        $this->install_model->add_nationality(array('id'=>'118', 'name'=>'Monacan'));
        $this->install_model->add_nationality(array('id'=>'119', 'name'=>'Mongolian'));
        $this->install_model->add_nationality(array('id'=>'120', 'name'=>'Moroccan'));
        $this->install_model->add_nationality(array('id'=>'121', 'name'=>'Mosotho'));
        $this->install_model->add_nationality(array('id'=>'122', 'name'=>'Motswana'));
        $this->install_model->add_nationality(array('id'=>'123', 'name'=>'Mozambican'));
        $this->install_model->add_nationality(array('id'=>'124', 'name'=>'Namibian'));
        $this->install_model->add_nationality(array('id'=>'125', 'name'=>'Nauruan'));
        $this->install_model->add_nationality(array('id'=>'126', 'name'=>'Nepalese'));
        $this->install_model->add_nationality(array('id'=>'127', 'name'=>'Netherlander'));
        $this->install_model->add_nationality(array('id'=>'128', 'name'=>'New Zealander'));
        $this->install_model->add_nationality(array('id'=>'129', 'name'=>'Ni-Vanuatu'));
        $this->install_model->add_nationality(array('id'=>'130', 'name'=>'Nicaraguan'));
        $this->install_model->add_nationality(array('id'=>'131', 'name'=>'Nigerian'));
        $this->install_model->add_nationality(array('id'=>'132', 'name'=>'Nigerien'));
        $this->install_model->add_nationality(array('id'=>'133', 'name'=>'North Korean'));
        $this->install_model->add_nationality(array('id'=>'134', 'name'=>'Northern Irish'));
        $this->install_model->add_nationality(array('id'=>'135', 'name'=>'Norwegian'));
        $this->install_model->add_nationality(array('id'=>'136', 'name'=>'Omani'));
        $this->install_model->add_nationality(array('id'=>'137', 'name'=>'Pakistani'));
        $this->install_model->add_nationality(array('id'=>'138', 'name'=>'Palauan'));
        $this->install_model->add_nationality(array('id'=>'139', 'name'=>'Panamanian'));
        $this->install_model->add_nationality(array('id'=>'140', 'name'=>'Papua New Guinean'));
        $this->install_model->add_nationality(array('id'=>'141', 'name'=>'Paraguayan'));
        $this->install_model->add_nationality(array('id'=>'142', 'name'=>'Peruvian'));
        $this->install_model->add_nationality(array('id'=>'143', 'name'=>'Polish'));
        $this->install_model->add_nationality(array('id'=>'144', 'name'=>'Portuguese'));
        $this->install_model->add_nationality(array('id'=>'145', 'name'=>'Qatari'));
        $this->install_model->add_nationality(array('id'=>'146', 'name'=>'Romanian'));
        $this->install_model->add_nationality(array('id'=>'147', 'name'=>'Russian'));
        $this->install_model->add_nationality(array('id'=>'148', 'name'=>'Rwandan'));
        $this->install_model->add_nationality(array('id'=>'149', 'name'=>'Saint Lucian'));
        $this->install_model->add_nationality(array('id'=>'150', 'name'=>'Salvadoran'));
        $this->install_model->add_nationality(array('id'=>'151', 'name'=>'Samoan'));
        $this->install_model->add_nationality(array('id'=>'152', 'name'=>'San Marinese'));
        $this->install_model->add_nationality(array('id'=>'153', 'name'=>'Sao Tomean'));
        $this->install_model->add_nationality(array('id'=>'154', 'name'=>'Saudi'));
        $this->install_model->add_nationality(array('id'=>'155', 'name'=>'Scottish'));
        $this->install_model->add_nationality(array('id'=>'156', 'name'=>'Senegalese'));
        $this->install_model->add_nationality(array('id'=>'157', 'name'=>'Serbian'));
        $this->install_model->add_nationality(array('id'=>'158', 'name'=>'Seychellois'));
        $this->install_model->add_nationality(array('id'=>'159', 'name'=>'Sierra Leonean'));
        $this->install_model->add_nationality(array('id'=>'160', 'name'=>'Singaporean'));
        $this->install_model->add_nationality(array('id'=>'161', 'name'=>'Slovakian'));
        $this->install_model->add_nationality(array('id'=>'162', 'name'=>'Slovenian'));
        $this->install_model->add_nationality(array('id'=>'163', 'name'=>'Solomon Islander'));
        $this->install_model->add_nationality(array('id'=>'164', 'name'=>'Somali'));
        $this->install_model->add_nationality(array('id'=>'165', 'name'=>'South African'));
        $this->install_model->add_nationality(array('id'=>'166', 'name'=>'South Korean'));
        $this->install_model->add_nationality(array('id'=>'167', 'name'=>'Spanish'));
        $this->install_model->add_nationality(array('id'=>'168', 'name'=>'Sri Lankan'));
        $this->install_model->add_nationality(array('id'=>'169', 'name'=>'Sudanese'));
        $this->install_model->add_nationality(array('id'=>'170', 'name'=>'Surinamer'));
        $this->install_model->add_nationality(array('id'=>'171', 'name'=>'Swazi'));
        $this->install_model->add_nationality(array('id'=>'172', 'name'=>'Swedish'));
        $this->install_model->add_nationality(array('id'=>'173', 'name'=>'Swiss'));
        $this->install_model->add_nationality(array('id'=>'174', 'name'=>'Syrian'));
        $this->install_model->add_nationality(array('id'=>'175', 'name'=>'Taiwanese'));
        $this->install_model->add_nationality(array('id'=>'176', 'name'=>'Tajik'));
        $this->install_model->add_nationality(array('id'=>'177', 'name'=>'Tanzanian'));
        $this->install_model->add_nationality(array('id'=>'178', 'name'=>'Thai'));
        $this->install_model->add_nationality(array('id'=>'179', 'name'=>'Togolese'));
        $this->install_model->add_nationality(array('id'=>'180', 'name'=>'Tongan'));
        $this->install_model->add_nationality(array('id'=>'181', 'name'=>'Trinidadian or Tobagonian'));
        $this->install_model->add_nationality(array('id'=>'182', 'name'=>'Tunisian'));
        $this->install_model->add_nationality(array('id'=>'183', 'name'=>'Turkish'));
        $this->install_model->add_nationality(array('id'=>'184', 'name'=>'Tuvaluan'));
        $this->install_model->add_nationality(array('id'=>'185', 'name'=>'Ugandan'));
        $this->install_model->add_nationality(array('id'=>'186', 'name'=>'Ukrainian'));
        $this->install_model->add_nationality(array('id'=>'187', 'name'=>'Uruguayan'));
        $this->install_model->add_nationality(array('id'=>'188', 'name'=>'Uzbekistani'));
        $this->install_model->add_nationality(array('id'=>'189', 'name'=>'Venezuelan'));
        $this->install_model->add_nationality(array('id'=>'190', 'name'=>'Vietnamese'));
        $this->install_model->add_nationality(array('id'=>'191', 'name'=>'Welsh'));
        $this->install_model->add_nationality(array('id'=>'192', 'name'=>'Yemenite'));
        $this->install_model->add_nationality(array('id'=>'193', 'name'=>'Zambian'));
        $this->install_model->add_nationality(array('id'=>'194', 'name'=>'Zimbabwean'));

        
        //gender
        echo '<hr /><b>Adding Genders</b><br />';
        $this->install_model->add_gender(array('id' => 1, 'name' => 'Male'));
        $this->install_model->add_gender(array('id' => 2, 'name' => 'Female'));
        
        
        //grades
        echo '<hr /><b>Adding Qualification Grades</b><br />';
        $this->install_model->add_grade(array('id' => 1, 'name' => 'Other'));
        $this->install_model->add_grade(array('id' => 2, 'name' => 'A*'));
        $this->install_model->add_grade(array('id' => 3, 'name' => 'A'));
        $this->install_model->add_grade(array('id' => 4, 'name' => 'B'));
        $this->install_model->add_grade(array('id' => 5, 'name' => 'C'));
        $this->install_model->add_grade(array('id' => 6, 'name' => 'D'));
        $this->install_model->add_grade(array('id' => 7, 'name' => 'E'));
        $this->install_model->add_grade(array('id' => 8, 'name' => 'F'));
        $this->install_model->add_grade(array('id' => 9, 'name' => 'Pass'));
        $this->install_model->add_grade(array('id' => 10, 'name' => 'Fail'));
        $this->install_model->add_grade(array('id' => 11, 'name' => '1'));
        $this->install_model->add_grade(array('id' => 12, 'name' => '2'));
        $this->install_model->add_grade(array('id' => 13, 'name' => '2-2'));
        $this->install_model->add_grade(array('id' => 14, 'name' => '3'));
        
        
        //level
        echo '<hr /><b>Adding Qualification Levels</b><br />';
        $this->install_model->add_level(array('id' => 1, 'name' => 'Other'));
        $this->install_model->add_level(array('id' => 2, 'name' => 'G.C.S.E.'));
        $this->install_model->add_level(array('id' => 3, 'name' => 'A-Level'));
        $this->install_model->add_level(array('id' => 4, 'name' => 'Degree'));
        
        
        //subject
        echo '<hr /><b>Adding Qualification Subjects</b><br />';
        $this->install_model->add_subject(array('id' => 1, 'name' => 'Other'));
        $this->install_model->add_subject(array('id' => 2, 'name' => 'Maths'));
        $this->install_model->add_subject(array('id' => 3, 'name' => 'English'));
        $this->install_model->add_subject(array('id' => 4, 'name' => 'Physics'));
        $this->install_model->add_subject(array('id' => 5, 'name' => 'Chemistry'));
        $this->install_model->add_subject(array('id' => 6, 'name' => 'Science'));
        $this->install_model->add_subject(array('id' => 7, 'name' => 'Biology'));
        
        
        
        
        
        //final messages
        echo '<hr />';
        echo '<h4>Finished!</h4>';
        echo 'Now set config.php L251, to $config[\'sess_use_database\'] = TRUE;';
        
        echo '</div>';
        
    }
    
    
    
    
    public function get_header ()
    {
        
        $header = '<head><title>CAE OAA Applications</title>';
        $header .= '<link href="'.css_path().'/style.css" type="text/css" rel="stylesheet" />';
        $header .= '</head>';
        $header .= '<div style="background: #ffffff; padding: 30px;">';
        
        return $header;
        
    }
    
    
    
}

?>