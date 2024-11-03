<?php

//create folder
//absolute file path
$folderPath = "c:\php";

//relative file path
$relPath = "../Images/lightning.png";

if (!file_exists($folderPath)){
    mkdir($folderPath); // makes a new folder
}

//open a file
$filePath = $folderPath . "\users.txt";
//w write, 
//r read, 
//a append,
//a+ append + read,
//w+ read + write,
//x create file
$myFile = fopen($filePath, "a+");//this will create the file if it doesn't exist
fwrite($myFile, "Jim Johnson\r\n");
fwrite($myFile, "Sally Smith\r\n");
rewind($myFile); //go to the beginning of the file

while(!feof($myFile)){ //file end of file
    echo fgets($myFile) . "<br>";
}

printf("the file size is %d <br>", filesize($filePath));

printf("the name of the file is %s <br>", basename($filePath));

printf("the directory path is %s <br>", dirname($filePath));

printf("THE FILE SIZE IS %s", round(filesize($relPath)/1024));

printf("absolute path %s <br>", realpath($relPath));

printf("DISK SPACE REMAINING %d <br>", disk_free_space("c:")/1024/1024/1024);

printf("TOTAL DISK SPACE REMAINING %d <br>", disk_total_space("c:")/1024/1024/1024);

fclose($myFile);

?>