<?php

defined('AK_TEST_DATABASE_ON') ? null : define('AK_TEST_DATABASE_ON', true);
require_once(dirname(__FILE__).'/../../../fixtures/config/config.php');

require_once(AK_LIB_DIR.DS.'Ak.php');

class test_of_Ak_file_functions extends  UnitTestCase
{
    function Test_file_put_contents()
    {
        $file_name = AK_CACHE_DIR.DS.'test_file_1.txt';
        $content = 'This is the content of file 1';
        $this->assertFalse(!Ak::file_put_contents($file_name, $content));
        
        $file_name = '/cache'.DS.'test_file_1.txt';
        $content = 'This is the NEW content for file 1';
        $this->assertFalse(!Ak::file_put_contents($file_name, $content));
        
        $file_name = AK_CACHE_DIR.DS.'test_file_2.txt';
        $content = "\n\rThis is the content of file 2\n";
        $this->assertFalse(!Ak::file_put_contents($file_name, $content));
        
        $file_name = 'cache'.DS.'test_file_3.txt';
        $content = "\rThis is the content of file 3\r\n";
        $this->assertFalse(!Ak::file_put_contents($file_name, $content));
        
        $file_name = 'cache/test_file_4.txt';
        $content = "\rThis is the content of file 4\r\n";
        $this->assertFalse(!Ak::file_put_contents($file_name, $content));
        
        $file_name = 'ak_test_folder/test_file.txt';
        $content = "\rThis is the content of the test file";
        $this->assertFalse(!Ak::file_put_contents($file_name, $content));
        
        $file_name = 'ak_test_folder/new_folder/test_file.txt';
        $content = "\rThis is the content of the test file";
        $this->assertFalse(!Ak::file_put_contents($file_name, $content));
        
    }

   function Test_file_get_contents()
   {
       $file_name = AK_CACHE_DIR.DS.'test_file_1.txt';
       $content = 'This is the NEW content for file 1';
       $this->assertFalse(!Ak::file_get_contents($file_name) === $content);
       
       $file_name = AK_CACHE_DIR.DS.'test_file_2.txt';
       $content = "\n\rThis is the content of file 2\n";
       $this->assertFalse(!Ak::file_get_contents($file_name) === $content);
       
       $file_name = 'cache'.DS.'test_file_3.txt';
       $content = "\rThis is the content of file 3\r\n";
       $this->assertFalse(!Ak::file_get_contents($file_name) === $content);
       
       $file_name = 'cache/test_file_4.txt';
       $content = "\rThis is the content of file 4\r\n";
       $this->assertFalse(!Ak::file_get_contents($file_name) === $content);
       
   }

   function Test_copy_files()
    {
        $original_path = AK_CACHE_DIR.DS.'test_file_1.txt';
        $copy_path = $original_path.'.copy';
        $this->assertTrue(Ak::copy($original_path, $copy_path));
        $this->assertEqual(Ak::file_get_contents($original_path), Ak::file_get_contents($copy_path));
        $this->assertTrue(Ak::file_delete($copy_path));
    }

    function Test_copy_directories()
     {
         $original_path = 'ak_test_folder';
         $copy_path = $original_path.'_copy';
         $this->assertTrue(Ak::copy($original_path,$copy_path));
         
         $file_name = $copy_path.'/new_folder/test_file.txt';
         $content = "\rThis is the content of the test file";
         $this->assertTrue(Ak::file_get_contents($file_name) === $content);
     }

    function Test_file_delete()
    {
        $this->assertFalse(!Ak::file_delete(AK_CACHE_DIR.DS.'test_file_1.txt'));
        $this->assertFalse(!Ak::file_delete(AK_CACHE_DIR.DS.'test_file_2.txt'));
        $this->assertFalse(!Ak::file_delete(AK_CACHE_DIR.DS.'test_file_3.txt'));
        $this->assertFalse(!Ak::file_delete(AK_CACHE_DIR.'/test_file_4.txt'));
        $this->assertFalse(!Ak::file_delete('ak_test_folder/new_folder/test_file.txt'));

    }
    
    function Test_directory_delete()
    {
        $this->assertFalse(!Ak::directory_delete('ak_test_folder'));
        $this->assertFalse(!Ak::directory_delete('ak_test_folder_copy'));
        $this->assertFalse(Ak::directory_delete('../../'));
        $this->assertFalse(Ak::directory_delete('..\..\\'));
        $this->assertFalse(Ak::directory_delete(' '));
        $this->assertFalse(Ak::directory_delete('/'));
        $this->assertFalse(Ak::directory_delete('./'));
    }
    
    function test_mime_type_detection()
    {
        $this->assertEqual(Ak::mime_content_type(AK_PUBLIC_DIR.DS.'images'.DS.'akelos_framework_logo.png'),'image/png');
        $this->assertEqual(Ak::mime_content_type('C:\Folder\image.png'),'image/png');
    }

}

ak_test('test_of_Ak_file_functions');

?>
