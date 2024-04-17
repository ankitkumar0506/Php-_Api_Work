<?php 

class model
{

    public $connection;

public function __construct()
{

try
{

    $this->connection = new mysqli("localhost","root","","web_assg");
    // echo "Connection was  successful";
}
catch(\Throwable $th)
{
    // echo "Connection was not successful";
}

}

public function insert($tbl, $data)
{
    $keydata = implode(",", array_keys($data));
    $valuedata = implode("','", ($data));
    $SQL = "INSERT INTO $tbl($keydata) VALUES ('$valuedata')";
    $SQLEx = $this->connection->query($SQL);
    if ($SQLEx > 0) {
        $ResData['Data'] = 1;
        $ResData['Msg'] = "Success";
        $ResData['Code'] = "1";
    } else {
        $ResData['Data'] = 0;
        $ResData['Msg'] = "Try again";
        $ResData['Code'] = "0";
    }
    return $ResData;
}

public function login($email, $password)
    {
        $SQL = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $SQLEx = $this->connection->query($SQL);
        if ($SQLEx->num_rows > 0) {
            $FetchData = $SQLEx->fetch_object();
            $ResData['Data'] = $FetchData;
            $ResData['Msg'] = "Success";
            $ResData['Code'] = "1";
        } else {
            $ResData['Data'] = 0;
            $ResData['Msg'] = "Try again";
            $ResData['Code'] = "0";
        }
        return $ResData;
    }

    public function select($tbl)
    {
        $SQL = "SELECT * FROM $tbl";
      
        $SQLEx = $this->connection->query($SQL);
        if ($SQLEx->num_rows > 0) {
            while ($Data = $SQLEx->fetch_object()) {
                $FetchData[] = $Data;
            }
            $ResData['Data'] = $FetchData;
        } else {
            $ResData['Data'] = 0;
        }
        echo "<pre>";
        print_r($ResData);
        return $ResData;
    }

}

?>