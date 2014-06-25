<?php

class Filestore {

    public $filename = '';
    public $is_csv = false;

    function __construct($filename = '') 
    {
        // Sets $this->filename
        $this->filename = $filename;

        if (substr($this->filename,-3) == 'csv') 
        {
            $this->is_csv = true;
        }    

    }

   
    //Returns array of lines in $this->filename
    function read_lines()
    {
        $handle = fopen($this->filename, 'r'); // opens file and makes sure its readable
        $contents = fread($handle, filesize($this->filename)); //checks file size
        fclose($handle); // closes the file
        return explode("\n", $contents); // breaks up the 'string' into a array    
    }

    
    //Writes each element in $array to a new line in $this->filename
    function write_lines($array)
    {
        if (is_writable($this->filename)) {     // checks to see is file is a writable file
            $handle = fopen($this->filename, 'w'); // writes newly added task the the files
            fwrite($handle, implode("\n", $array));  // takes array w/ new added task then converst to string
            fclose($handle); // closes the file
        }
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    private function read_csv()
    {
        // Code to read file $this->filename
        $addresses = [];

        // read each line of CSV and add rows to addresses array
        // todo
        $handle = fopen($this->filename,'r');
        while (!feof($handle)) {
            $row = fgetcsv($handle);
            if (is_array($row)) {
                $addresses[] = $row;
            }
        }
        fclose($handle);
        return $addresses;   
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    private function write_csv($array)
    {
        // Code to write $addresses_array to file $this->filename
        if (is_writable($this->filename)) {
            $handle = fopen($this->filename, 'w');
            foreach ($addresses as $entries) {
                fputcsv($handle, $entries);
            }
            fclose($handle);
        }
    }

    public function read()
    {
        if ($this->is_csv) {
            return $this->read_csv();
        } else { 
            return $this->read_lines();   
        }
    }

    public function write($array)
    {
        if($this->is_csv) {
            $this->write_csv($array);
        } else {
            $this->write_lines($array);
        }
    }
}
?>