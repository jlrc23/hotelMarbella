<?php

/*
* Title                   : Booking System Pro (WordPress Plugin)
* Version                 : 1.0
* File                    : dopbsp-debug.php
* File Version            : 1.0
* Created / Last Modified : 4 March 2014
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Booking System PRO Debug Class.
*/
    
    if (!class_exists("DOPBookingSystemPRODebug")){
        class DOPBookingSystemPRODebug{
            function DOPBookingSystemPRODebug(){
                $this->initDebug();
            }
            
            function initDebug(){
                // Define Paths
                $this->initPaths();
            }
            
            function initPaths(){
                if (!defined('DOPBSP_Plugin_URL')){
                    define('DOPBSP_Plugin_URL', plugin_dir_url(__FILE__));
                }

                if (!defined('DOPBSP_Plugin_AbsPath')){
                    define('DOPBSP_Plugin_AbsPath', str_replace('\\', '/', plugin_dir_path(__FILE__)));
                }
                
                if (!defined('DOPBSP_Log_AbsPath')){
                    define('DOPBSP_Log_AbsPath',str_replace('\\', '/', ABSPATH).'wp-content');
                }
            }
            
            function writeToLog($name,$value,$writeType){
                
                $file = DOPBSP_Log_AbsPath.'/dopbsp_debug.log'; 
                $dataLog = '';
                
                if ($writeType == 'w'){
                    $dataLog .= '----------------------------------------'.PHP_EOL;
                    $dataLog .= '    BOOKING SYSTEM PRO DEBUG LOG        '.PHP_EOL;
                    $dataLog .= '----------------------------------------'.PHP_EOL;
                }
                $dataLog .= PHP_EOL;
                $dataLog .= PHP_EOL;
                $dataLog .= '----------------------------------------'.PHP_EOL;
                $dataLog .= '    '.$name.'                           '.PHP_EOL;
                $dataLog .= '----------------------------------------'.PHP_EOL;
                $dataLog .= '    '.$value.'                          '.PHP_EOL;
                $dataLog .= '----------------------------------------'.PHP_EOL;
                
                $handle = fopen($file, $writeType) or die("There was an error, accessing the requested file.");
                fwrite($handle, $dataLog);
                fclose($handle); 
            }
        }
    }