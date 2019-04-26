<?php
    class Session
    {
        const SESSION_STARTED = TRUE;
        const SESSION_NOT_STARTED = FALSE;
        
        private static $sessionState = self::SESSION_NOT_STARTED;
                
        private static $start;
                
        private function __construct() {
            $this->current_page = "Login Page";
        }
                
        public static function getStart()  {
            if ( !isset(self::$start))  {
                self::$start = new self;
            }            
            self::$start->startSession();            
            return self::$start;
        }
                
        public function startSession()
        {
            if ( self::$sessionState == self::SESSION_NOT_STARTED ) {
                self::$sessionState = session_start();
            }            
            return self::$sessionState;
        }
               
        public function __set( $name , $value )  {
            $_SESSION[$name] = $value;
        }
               
        public function __get( $name ) {
            if ( isset($_SESSION[$name]))  {
                return $_SESSION[$name];
            }
        }        
        
        public function __isset( $name ) {
            return isset($_SESSION[$name]);
        }        
        
        public function __unset( $name ) {
            unset( $_SESSION[$name] );
        }
        
        public function destroy() {
            if ( $this->sessionState == self::SESSION_STARTED ) {
                $this->sessionState = self::SESSION_NOT_STARTED;
                session_destroy();
                unset( $_SESSION );                
                return !$this->sessionState;
            }            
            return FALSE;
        }
    }
?>