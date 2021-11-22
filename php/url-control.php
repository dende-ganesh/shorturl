<?php
    include "config.php";
    $full_url = mysqli_real_escape_string($conn, $_POST['full-url']);
    if(!empty($full_url) && filter_var($full_url, FILTER_VALIDATE_URL)){
        $ran_url = substr(md5(microtime()), rand(0, 26), 5);
        $sql = mysqli_query($conn, "SELECT shorten_url FROM url WHERE '{$full_url}' in (select full_url from url)");
        if(mysqli_num_rows($sql) > 0){
            echo mysqli_fetch_assoc($sql)['shorten_url'];
        }else{
            $sql2 = mysqli_query($conn, "INSERT INTO url (full_url, shorten_url, clicks)
                                         VALUES ('{$full_url}', '{$ran_url}', '0')");
            if($sql2){
                $sql3 = mysqli_query($conn, "SELECT shorten_url FROM url WHERE shorten_url = '{$ran_url}'");
                if(mysqli_num_rows($sql3) > 0){
                    $shorten_url = mysqli_fetch_assoc($sql3);
                    echo $shorten_url['shorten_url'];
                }
            }
        }
    }else{
        echo "$full_url - This is not a valid URL!";
    }
?>
