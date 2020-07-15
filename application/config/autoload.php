<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in system/libraries/ or your
| application/libraries/ directory, with the addition of the
| 'database' library, which is somewhat of a special case.
|
| Prototype:
|
|   $autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|   $autoload['libraries'] = array('user_agent' => 'ua');
*/
$autoload['libraries'] = array(
    'session', 'template', 
    'service_ldap' => 'ldap',
    'database', 'form_validation', 'breadcrumbs', 'service_docx', 'email'
);

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|   $autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|   $autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array('cache');

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|   $autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array('url', 'file', 'form', 'my_helper');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|   $autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|   $autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|   $autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|   $autoload['model'] = array('first_model' => 'first');
*/
$autoload['model'] = array(
    'BUUMember_model' => 'BUUMember',
    'Login_session_model' => 'Login_session',
    'Address_model' => 'Address',
    'Adviser_model' => 'Adviser',
    'Company_Assessment_Form_model' => 'Company_Assessment_Form',
    'Company_model' => 'Company',
    'Coop_Student_Assessment_Form_model' => 'Coop_Student_Assessment_Form',
    'Coop_Student_model' => 'Coop_Student',
    'Coop_Submitted_Form_Search_model' => 'Coop_Submitted_Form_Search',
    'Daily_Report_model' => 'Daily_Report',
    'Form_model' => 'Form',
    'Job_model' => 'Job',
    'Login_session_model' => 'Login_session',
    'News_model' => 'News',
    'Officer_model' => 'Officer',
    'Report_model' => 'Report',
    'Skill_model' => 'Skill',
    'Skill_Search_model' => 'Skill_Search',
    'Skilled_Job_Search_model' => 'Skilled_Job_Search',
    'Std_Submitted_Form_Search_model' => 'Std_Submitted_Form_Search',
    'Student_model' => 'Student',
    'Term_model' => 'Term',
    'Test_model' => 'Test',
    'Trainer_model' => 'Trainer',
    'Training_Check_Student_model' => 'Training_Check_Student',
    'Training_model' => 'Training',
    'News_File_model' => 'News_File',
    'Subject_Report_model' => 'Subject_Report',
    
);
